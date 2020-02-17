<?php

class ProfessorDAO
{
    private $idprofessor;
    private $username;
    private $password;
    private $fullname;
    private $profilepic;
    private $email;
    private $active;
    
    public function ProfessorDAO( $idprofessor_,
                              $username_,
                              $password_,
                              $fullname_,
                              $profilepic_,
                              $email_,
                              $active_) {
        $this->idprofessor = $idprofessor_;
        $this->username = $username_;
        $this->password = $password_;
        $this->fullname = $fullname_;
        $this->profilepic = $profilepic_;
        $this->email    = $email_;
        $this->active = $active_;
    }
    
    public function insertNewProfessor($fullname_, $email_) {
        return "INSERT INTO professor(username, fullname, email) VALUES("
        . "'".$this->username."',"
        . "'".$fullname_."',"
        . "'".$email_."')";
    }
    
    public function insertNewProfessorHasProgram($program_) {
        return "INSERT INTO professor_x_program(professor, program) VALUES('".$this->idprofessor."','".$program_."')";
    }

    public function confirmNewUser($password_, $email_, $profilepic_, $active_) {
        $this->password = $password_;
        $this->email = $email_;
        $this->active = $active_;       // Activando usuario por confirmación
        if($profilepic_!="") {
            $this->profilepic = $profilepic_;
            $now = new DateTime();
        }
        return $profilepic_!="" ? 
                "UPDATE professor SET "
                . "password=md5('".$this->password."'),"
                . "email='".$this->email."',"
                . "profilepic='".$now->format('Y-m-d_H-i-s_').$this->profilepic."',"
                . "active='".$this->active."' WHERE username='".$this->username."'"
                :
                "UPDATE professor SET "
                . "password=md5('".$this->password."'),"
                . "email='".$this->email."',"
                . "active='".$this->active."' WHERE username='".$this->username."'";
    }

        public function auth() {
        return "SELECT * FROM professor WHERE "
        . "username = '".$this->username."' AND "
        . "password = md5('".$this->password."')";
    }
    
    public function isActive() {
        return "SELECT active FROM professor WHERE username = '".$this->username."'";
    }

    public function retrieveAccountData($withId) {
        $propNames = array();
        foreach((new ReflectionClass('ProfessorDAO'))->getProperties() as $prop)
            array_push($propNames, $prop->getName());
        
        return $withId==true ? 
                "SELECT ".implode(", ", $propNames)." FROM professor WHERE idprofessor = '".$this->idprofessor."'"
                :
                "SELECT ".implode(", ", $propNames)." FROM professor WHERE username = '".$this->username."'";
    }
    
public function searchBy($column, $value="") {
        $propNames = array();
        foreach((new ReflectionClass('ProfessorDAO'))->getProperties() as $prop)
            array_push($propNames, $prop->getName());
        
        $returnValue = "";
        
        switch($column) {
            case 'idprofessor':
                $returnValue = "SELECT ".implode(", ", $propNames)." FROM professor WHERE idprofessor like '%".$value."%'";
                break;
            case 'username':
                $returnValue = "SELECT ".implode(", ", $propNames)." FROM professor WHERE username like '%".$value."%'";
                break;
            case 'fullname':
                $returnValue = "SELECT ".implode(", ", $propNames)." FROM professor WHERE fullname like '%".$value."%'";
                break;
            case 'email':
                $returnValue = "SELECT ".implode(", ", $propNames)." FROM professor WHERE email like '%".$value."%'";
                break;
            case 'all':
                $returnValue = "SELECT ".implode(", ", $propNames)." FROM professor";
                break;
        }
        return $returnValue;
    }
    
    public function staticListAllProfessorsByPair($column, $value) {
        return "SELECT * FROM professor WHERE ".$column." like '%".$value."%' limit 10";
    }

        public function userExists() {
        return "SELECT idprofessor FROM professor WHERE username = '".$this->username."'";
    }

    public function setData($data) {
        $this->idprofessor  = $data[0];
        $this->username     = $data[1];
        $this->password     = $data[2];
        $this->fullname     = $data[3];
        $this->profilepic   = $data[4];
        $this->email        = $data[5];
        $this->active       = $data[6];
    }
}