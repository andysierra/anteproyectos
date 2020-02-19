<?php
require_once 'persistence/db/DB.php';
require_once 'persistence/professorDAO/ProfessorDAO.php';
require_once 'logic/Person.php';
require_once 'logic/program/Program.php';

class Professor extends Person
{
    private $db;
    private $dao;
    private $dataRetrieved;
    public function Professor($idprofessor_="", $username_="", $password_="", $fullname_="", 
                            $profilepic_="", $email_="", $active_="") {
        $this->Person($idprofessor_, $username_, $password_, $fullname_, $profilepic_, $email_, $active_);
        $this->db = new DB();
        $this->dao = new ProfessorDAO($idprofessor_, $username_, $password_, $fullname_, $profilepic_, $email_, $active_);
        $this->dataRetrieved = false;
    }
    
    public function insertNewProfessor($fullname_, $program_, $email_) {
        $success = false;
        $createProfessorHasProgram = false;
        $this->db->open();
        $this->db->execute($this->dao->insertNewProfessor($fullname_, $email_));
        $createProfessorHasProgram = $this->db->success();
        $this->db->close();
        
        if($createProfessorHasProgram)
            if((new Program("","",""))->programExists($program_))
            {
                $this->retrieveAccountData(false);
                $this->db->open();
                $this->db->execute($this->dao->insertNewProfessorHasProgram($program_));
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
        $professors = array();

        $this->db->open();
        
        $winnerCol = '';
        
        if($string!="") {
            $this->db->execute($this->dao->searchBy('idprofessor', $string));
            if($this->db->nRows() != 0) $winnerCol = 'idprofessor';
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
                array_push($professors, $this->createDataProfessor($this->db->fetch()));
            
        $this->db->close();
        
        return $winnerCol!='' ?  $professors : null;
    }
    
    public function conditionSearch() {
        
    }
    
    public function getDataRetrieved() {
        return $this->dataRetrieved;
    }

    public function setDataRetrieved($dataRetrieved) {
        $this->dataRetrieved = $dataRetrieved;
    }
   
    private function createDataProfessor($data) {
        $professor = new Professor($data[0],
                               $data[1],
                               $data[2],
                               $data[3],
                               $data[4],
                               $data[5],
                               $data[6]);
        $professor->setDataRetrieved(true);
        return $professor;
    }
    
    public function userExists($withId) {
        $returnBoolean = false;
        $this->db->open();
        $this->db->execute($this->dao->userExists($withId));
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
    
    public function staticAdvancedSearch(array $column_x_value) {
        $professors = array();
        
        $this->db->open();
        $this->db->execute($this->dao->query($column_x_value));
        if($this->db->nRows()>0)
            for($i=0; $i<$this->db->nRows(); $i++) {
                $data = $this->db->fetch();
                array_push($professors, new Professor($data[0],
                        $data[1],
                        $data[2],
                        $data[3],
                        $data[4],
                        $data[5],
                        $data[6]));
            }
        $this->db->close();
        
        return $professors;
    }
    
    public function getIdprofessor() {
        return $this->id;
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