<?php
require_once 'persistence/db/DB.php';
require_once 'persistence/adminDAO/AdminDAO.php';
require_once 'logic/Person.php';

class Admin extends Person
{
    private $db;
    private $dao;
    private $dataRetrieved;
    public function Admin($idadmin_="", $username_="", $password_="", $fullname_="", $profilepic_="", $email_="", $active_="") {
        $this->Person($idadmin_, $username_, $password_, $fullname_, $profilepic_, $email_, $active_);
        $this->db = new DB();
        $this->dao = new AdminDAO($idadmin_, $username_, $password_, $fullname_, $profilepic_, $email_, $active_);
        $this->dataRetrieved = false;
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
        $this->active = $this->db->fetch()[0];
        $this->db->close();
        return $this->active==1 ? true : false;
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
        if($this->dataRetrieved) {
            $admins = array();

            $this->db->open();
            
            $winnerCol = '';
            $this->db->execute($this->dao->searchBy('idadmin', $string));
            if($this->db->nRows() != 0) $winnerCol = 'idadmin';
            else {
                echo "NO ENCONTRE VALOR POR IDADMIN: ".$this->db->nRows()."<br>";
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
                    array_push($admins, $this->createDataAdmin($this->db->fetch()));
                return $admins;
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
   
    private function createDataAdmin($data) {
        $admin = new Admin($data[0],
                           $data[1],
                           $data[2],
                           $data[3],
                           $data[4],
                           $data[5],
                           $data[6]);
        $admin->setDataRetrieved(true);
        return $admin;
    }
    
    public function toString(){
        echo "[".$this->id.", ".
                $this->username.", ".
                $this->password.", ".
                $this->fullname.", ".
                $this->profilepic.", ".
                $this->email.", ".
                $this->active."]</br>";
    }
}