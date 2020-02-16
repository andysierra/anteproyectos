<?php
require_once 'persistence/db/DB.php';
require_once 'persistence/professorDAO/ProfessorDAO.php';
require_once 'logic/Person.php';

class Professor extends Person
{
    private $db;
    private $dao;
    private $dataRetrieved;
    public function Professor($idstudent_="", $username_="", $password_="", $fullname_="", 
                            $profilepic_="", $email_="", $active_="") {
        $this->Person($idstudent_, $username_, $password_, $fullname_, $profilepic_, $email_, $active_);
        $this->db = new DB();
        $this->dao = new ProfessorDAO($idstudent_, $username_, $password_, $fullname_, $profilepic_, $email_, $active_);
        $this->dataRetrieved = false;
    }
    
    public function insertNewProfessor($fullname_, $program_) {
        $success = false;
        $this->db->open();
        $this->db->execute($this->dao->insertNewStudent($fullname_, $program_));
        $success = $this->db->success();
        $this->db->close();
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
            $this->program      = $data[4];
            $this->profilepic   = $data[5];
            $this->email        = $data[6];
            $this->active       = $data[7];
            $this->dataRetrieved = true;
        $this->dao->setData($data);
        $this->db->close();
    }

    // This function will search a string in all columns
    public function search($string) {
        if($this->dataRetrieved) {
            $students = array();

            $this->db->open();
            
            $winnerCol = '';
            $this->db->execute($this->dao->searchBy('idStudent', $string));
            if($this->db->nRows() != 0) $winnerCol = 'idStudent';
            else {
                echo "NO ENCONTRE VALOR POR IDSTUDENT: ".$this->db->nRows()."<br>";
                $this->db->execute($this->dao->searchBy('username', $string));
                if($this->db->nRows() != 0) $winnerCol = 'username';
                else {
                    echo "NO ENCONTRE VALOR POR USERNAME: ".$this->db->nRows()."<br>";
                    $this->db->execute($this->dao->searchBy('fullname', $string));
                    if($this->db->nRows() != 0) $winnerCol = 'fullname';
                    else {
                        echo "NO ENCONTRE VALOR POR FULLNAME: ".$this->db->nRows()."<br>";
                        $this->db->execute($this->dao->searchBy('email', $string));
                        if($this->db->nRows() != 0) $winnerCol = 'email';
                        else echo "NO ENCONTRE VALOR POR EMAIL";
                    }
                }
            }
            
            if($winnerCol != ''){
                for($i=0; $i<$this->db->nRows(); $i++)
                    array_push($students, $this->createDataStudent($this->db->fetch()));
                return $students;
            } else {
                echo "NO ENCONTRÉ NADA <br>";
                return null;
            }
            
            $this->db->close();
        } else return null;
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
                               $data[6],
                               $data[7]);
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

    public function toString() {
        echo "[".$this->id.", ".
                $this->username.", ".
                $this->password.", ".
                $this->fullname.", ".
                $this->program.", ".
                $this->profilepic.", ".
                $this->email.", ".
                $this->active."]</br>";
    }
}