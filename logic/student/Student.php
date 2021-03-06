<?php
require_once 'persistence/db/DB.php';
require_once 'persistence/studentDAO/StudentDAO.php';
require_once 'logic/Person.php';
require_once 'logic/program/Program.php';
require_once 'logic/project/Project.php';

class Student extends Person
{
    private $db;
    private $dao;
    private $dataRetrieved;
    public function Student($idstudent_="", $username_="", $password_="", $fullname_="", 
                            $profilepic_="", $email_="", $active_="") {
        $this->Person($idstudent_, $username_, $password_, $fullname_, $profilepic_, $email_, $active_);
        $this->db = new DB();
        $this->dao = new StudentDAO($idstudent_, $username_, $password_, $fullname_, $profilepic_, $email_, $active_);
        $this->dataRetrieved = false;
    }
    
    public function insertNewStudent($fullname_, $program_, $email_) {
        $success = false;
        $createStudentHasProgram = false;
        $this->db->open();
        $this->db->execute($this->dao->insertNewStudent($fullname_, $email_));
        $createStudentHasProgram = $this->db->success();
        $this->db->close();
        
        if($createStudentHasProgram)
            if((new Program("","",""))->programExists($program_))
            {
                $this->retrieveAccountData(false);
                $this->db->open();
                $this->db->execute($this->dao->insertNewStudentHasProgram($program_));
                $success = $this->db->success();
                $this->db->close();
            }
        return $success;
    }
    
    public function confirmNewUser($password, $email, $profilepic="") {
        $success = false;
        $this->active = true;
        $this->db->open();
        $this->db->execute($this->dao->confirmNewUser($password, $email, $profilepic, $this->active));
        $success = $this->db->success();
        $this->db->close();
        return $success;
    }

        public function auth() {
        $this->db->open();
        $this->db->execute($this->dao->auth());
        $nRows = $this->db->nRows();
        $this->db->close();
        return $nRows!=0 ? true : false;
    }

    public function isActive() {
        $this->db->open();
        $this->db->execute($this->dao->isActive());
        $isActive = $this->db->fetch()[0];
        $this->db->close();
        return $isActive==1 ? true : false;
    }

    public function retrieveAccountData($withId) {
        $this->db->open();
        $this->db->execute($this->dao->retrieveAccountData($withId));
        $data = $this->db->fetch();
            $this->id           = $data[0];
            $this->username     = $data[1];
            $this->password     = $data[2];
            $this->fullname     = $data[3];
            $this->profilepic   = $data[4];
            $this->email        = $data[5];
            $this->active       = $data[6];
            $this->dataRetrieved = true;
        $this->dao->setData($data);
        $this->db->close();
    }

    // This function will search a string in all columns
    public function search($string) {
        $students = array();

        $this->db->open();
        
        $winnerCol = '';
        
        if($string!="") {
            $this->db->execute($this->dao->searchBy('idstudent', $string));
            if($this->db->nRows() != 0) $winnerCol = 'idstudent';
            else {
                $this->db->execute($this->dao->searchBy('username', $string));
                if($this->db->nRows() != 0) $winnerCol = 'username';
                else {
                    $this->db->execute($this->dao->searchBy('fullname', $string));
                    if($this->db->nRows() != 0) $winnerCol = 'fullname';
                    else {
                        $this->db->execute($this->dao->searchBy('email', $string));
                        if($this->db->nRows() != 0) $winnerCol = 'email';
                    }
                }
            }
        }
        else {
            $this->db->execute($this->dao->searchBy ("all"));
            if($this->db->nRows() != 0) $winnerCol = 'all';
        }
        
        if($winnerCol != '')
            for($i=0; $i<$this->db->nRows(); $i++)
                array_push($students, $this->createDataStudent($this->db->fetch()));
            
        $this->db->close();
        
        return $winnerCol!='' ?  $students : null;
    }
    
    public function conditionSearch() {
        
    }
    
    public function getDataRetrieved() {
        return $this->dataRetrieved;
    }

    public function setDataRetrieved($dataRetrieved) {
        $this->dataRetrieved = $dataRetrieved;
    }
   
    private function createDataStudent($data) {
        $student = new Student($data[0],
                               $data[1],
                               $data[2],
                               $data[3],
                               $data[4],
                               $data[5],
                               $data[6]);
        $student->setDataRetrieved(true);
        return $student;
    }
    
    public function userExists() {
        $returnBoolean = false;
        $this->db->open();
        $this->db->execute($this->dao->userExists());
        if($this->db->nRows()!=0) $returnBoolean = true;
        $this->db->close();
        return $returnBoolean;
    }
    
    public function getCol($what) {
        $returnValue = "";
        switch($what) {
            case "ID":
                $returnValue = $this->getId();
                break;
            case "Username":
                $returnValue = $this->getUsername();
                break;
            case "Nombre Completo":
                $returnValue = $this->getFullname();
                break;
            case "Correo Electrónico":
                $returnValue = $this->getEmail();
                break;
            case "Activo":
                $returnValue = $this->getActive();
                break;
        }
        return $returnValue;
    }

    public function getProjectsByStudentId() {
        $projects = array();
        $this->db->open();
        $this->db->execute($this->dao->getProjectsByStudentId());
        if($this->db->nRows()>0)
            for($i=0; $i<$this->db->nRows(); $i++)
            {
                $data = $this->db->fetch();
                array_push ($projects, new Project($data[0],
                                                    $data[1],
                                                    $data[2],
                                                    $data[3],
                                                    $data[4],
                                                    $data[5],
                                                    $data[6],
                                                    $this->id));
            }
        $this->db->close();
        return $projects;
    }


    public function toString() {
        echo "[".$this->id.", ".
                $this->username.", ".
                $this->password.", ".
                $this->fullname.", ".
                $this->profilepic.", ".
                $this->email.", ".
                $this->active."]</br>";
    }
}