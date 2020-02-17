<?php
require_once 'persistence/db/DB.php';
require_once 'persistence/programDAO/ProgramDAO.php';

class Program
{
    private $idprogram;
    private $name;
    private $active;
    
    private $db;
    private $dao;
    
    public function Program($idprogram_="", $name_="", $active_="") {
        $this->idprogram    = $idprogram_;
        $this->name         = $name_;
        $this->active       = $active_;
        
        $this->db = new DB();
        $this->dao = new ProgramDAO($idprogram_, $name_, $active_);
    }
    
    public function insert() {
        $this->db->open();
        $this->db->execute($this->dao->insert());
        $this->db->close();
    }
    
    public function fetchProgramNames()
    {
        $programNames = array();
        $this->db->open();
        $this->db->execute($this->dao->fetchProgramNames());
        if($this->db->nRows() != 0)
            for($i=0; $i<$this->db->nRows(); $i++)
                array_push ($programNames, $this->db->fetch()[0]);
        $this->db->close();
        return $programNames;
    }


    public function programExists($idprogram_) {
        $exists = false;
        $this->db->open();
        $this->db->execute($this->dao->exists($idprogram_));
        if($this->db->nRows()!=0) $exists = true;
        $this->db->close();
        return $exists;
    }
}
