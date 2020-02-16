<?php

class AdminDAO
{
    private $idadmin;
    private $username;
    private $password;
    private $fullname;
    private $profilepic;
    private $email;
    private $active;
    
    public function AdminDAO( $id_,
                              $username_,
                              $password_,
                              $fullname_,
                              $profilepic_,
                              $email_,
                              $active_) {
        $this->idadmin = $id_;
        $this->username = $username_;
        $this->password = $password_;
        $this->fullname = $fullname_;
        $this->profilepic = $profilepic_;
        $this->email = $email_;
        $this->active = $active_;
    }
    
    public function auth() {
        return "SELECT * FROM admin WHERE "
        . "username = '".$this->username."' AND "
        . "password = md5('".$this->password."')";
    }
    
    public function isActive() {
        return "SELECT active FROM admin WHERE username = '".$this->username."'";
    }

    public function retrieveAccountData($withId) {
        $propNames = array();
        foreach((new ReflectionClass('AdminDAO'))->getProperties() as $prop)
            array_push($propNames, $prop->getName());
        return $withId==true ? 
                "SELECT ".implode(", ", $propNames)." FROM admin WHERE idadmin = '".$this->idadmin."'"
                :
                "SELECT ".implode(", ", $propNames)." FROM admin WHERE username = '".$this->username."'";
    }
    
    public function searchBy($column, $value) {
        $propNames = array();
        foreach((new ReflectionClass('AdminDAO'))->getProperties() as $prop)
            array_push($propNames, $prop->getName());
        
        $returnValue = "";
        
        switch($column) {
            case 'idadmin':
                $returnValue = "SELECT ".implode(", ", $propNames)." FROM admin WHERE idadmin = '".$value."'";
                break;
            case 'username':
                $returnValue = "SELECT ".implode(", ", $propNames)." FROM admin WHERE username = '".$value."'";
                break;
            case 'fullname':
                $returnValue = "SELECT ".implode(", ", $propNames)." FROM admin WHERE fullname = '".$value."'";
                break;
            case 'email':
                $returnValue = "SELECT ".implode(", ", $propNames)." FROM admin WHERE email = '".$value."'";
                break;
        }
        return $returnValue;
    }
    
    public function setData($data) {
        $this->idadmin      = $data[0];
        $this->username     = $data[1];
        $this->password     = $data[2];
        $this->fullname     = $data[3];
        $this->profilepic   = $data[4];
        $this->email        = $data[5];
        $this->active       = $data[6];
    }
    
}