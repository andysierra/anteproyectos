<?php

class ProgramDAO
{
    private $idprogram;
    private $name;
    private $active;
    
    public function ProgramDAO($idprogram_, $name_, $active_) {
        $this->idprogram    = $idprogram_;
        $this->name         = $name_;
        $this->active       = $active_;
    }
    
    public function insert() {
        return "INSERT INTO program (name, active) VALUES ('".$this->name."', '".$this->active."')";
    }
    
    public function fetchProgramNames()
    {
        return "SELECT name FROM program";
    }

    public function exists($idprogram_) {
        return "SELECT * FROM program WHERE idprogram = '".$idprogram_."'";
    }
}