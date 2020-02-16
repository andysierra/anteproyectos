<?php

class Person
{
    protected $id;
    protected $username;
    protected $password;
    protected $fullname;
    protected $profilepic;
    protected $email;
    protected $active;
    
    public function Person( $id_,
                            $username_,
                            $password_,
                            $fullname_,
                            $profilepic_,
                            $email_,
                            $active_) {
        $this->id = $id_;
        $this->username = $username_;
        $this->password = $password_;
        $this->fullname = $fullname_;
        $this->profilepic = $profilepic_;
        $this->email = $email_;
        $this->active = $active_;
    }
    
    function getId() {
        return $this->id;
    }

    function getUsername() {
        return $this->username;
    }

    function getPassword() {
        return $this->password;
    }

    function getFullname() {
        return $this->fullname;
    }

    function getProfilepic() {
        return $this->profilepic;
    }
    
    function getEmail() {
        return $this->email;
    }

    function getActive() {
        return $this->active;
    }
}