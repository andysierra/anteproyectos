<?php

class StudentDAO
{
    private $idStudent;
    private $username;
    private $password;
    private $fullname;
    private $program;
    private $profilepic;
    private $email;
    private $active;
    
    public function StudentDAO( $idStudent_,
                              $username_,
                              $password_,
                              $fullname_,
                              $program_,
                              $profilepic_,
                              $email_,
                              $active_) {
        $this->idStudent = $idStudent_;
        $this->username = $username_;
        $this->password = $password_;
        $this->fullname = $fullname_;
        $this->program  = $program_;
        $this->profilepic = $profilepic_;
        $this->email    = $email_;
        $this->active = $active_;
    }
    
    public function insertNewStudent($fullname_, $program_, $email_) {
        return "INSERT INTO student(username, fullname, program, email) VALUES("
        . "'".$this->username."',"
        . "'".$fullname_."',"
        . "'".$program_."',"
        . "'".$email_."')";
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
                "UPDATE student SET "
                . "password=md5('".$this->password."'),"
                . "email='".$this->email."',"
                . "profilepic='".$now->format('Y-m-d_H-i-s_').$this->profilepic."',"
                . "active='".$this->active."' WHERE username='".$this->username."'"
                :
                "UPDATE student SET "
                . "password=md5('".$this->password."'),"
                . "email='".$this->email."',"
                . "active='".$this->active."' WHERE username='".$this->username."'";
    }

        public function auth() {
        return "SELECT * FROM student WHERE "
        . "username = '".$this->username."' AND "
        . "password = md5('".$this->password."')";
    }
    
    public function isActive() {
        return "SELECT active FROM student WHERE username = '".$this->username."'";
    }

    public function retrieveAccountData($withId) {
        $propNames = array();
        foreach((new ReflectionClass('StudentDAO'))->getProperties() as $prop)
            array_push($propNames, $prop->getName());
        return $withId==true ? 
                "SELECT ".implode(", ", $propNames)." FROM student WHERE idstudent = '".$this->idStudent."'"
                :
                "SELECT ".implode(", ", $propNames)." FROM student WHERE username = '".$this->username."'";
    }
    
    public function searchBy($column, $value) {
        $propNames = array();
        foreach((new ReflectionClass('StudentDAO'))->getProperties() as $prop)
            array_push($propNames, $prop->getName());
        
        $returnValue = "";
        
        switch($column) {
            case 'idStudent':
                $returnValue = "SELECT ".implode(", ", $propNames)." FROM student WHERE idstudent = '".$value."'";
                break;
            case 'username':
                $returnValue = "SELECT ".implode(", ", $propNames)." FROM student WHERE username = '".$value."'";
                break;
            case 'fullname':
                $returnValue = "SELECT ".implode(", ", $propNames)." FROM student WHERE fullname = '".$value."'";
                break;
            case 'email':
                $returnValue = "SELECT ".implode(", ", $propNames)." FROM student WHERE email = '".$value."'";
                break;
        }
        return $returnValue;
    }
    
    public function userExists() {
        return "SELECT idstudent FROM student WHERE username = '".$this->username."'";
    }

    public function setData($data) {
        $this->idadmin      = $data[0];
        $this->username     = $data[1];
        $this->password     = $data[2];
        $this->fullname     = $data[3];
        $this->program      = $data[4];
        $this->profilepic   = $data[5];
        $this->email        = $data[6];
        $this->active       = $data[7];
    }
}