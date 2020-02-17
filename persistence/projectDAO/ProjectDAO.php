<?php

class ProjectDAO
{
    private $idprojects;
    private $title;
    private $abstract;
    private $problem_statement;
    private $objectives;
    private $pdf_url;
    private $state;
    private $idcreator;
    
    public function ProjectDAO($idprojects_="",
                            $title_,
                            $abstract_,
                            $problem_statement_,
                            $objectives_,
                            $pdf_url_,
                            $state_,
                            $idcreator_) {
        $this->idprojects           = $idprojects_;
        $this->title                = $title_;
        $this->abstract             = $abstract_;
        $this->problem_statement    = $problem_statement_;
        $this->objectives           = $objectives_;
        $this->pdf_url              = $pdf_url_;
        $this->state                = $state_;
        $this->idcreator            = $idcreator_;
    }
    
    public function insert() {
        return "INSERT INTO project(title, abstract, problem_statement, objectives, pdf_url, state) VALUES ("
        . "'".$this->title."',"
        . "'".$this->abstract."',"
        . "'".$this->problem_statement."',"
        . "'".$this->objectives."',"
        . "'".$this->pdf_url."',"
        . "'".$this->state."')";
    }
    
    public function insertProject_x_Student() {
        return "INSERT INTO project_x_student(student, project) VALUES ("
        . "'".$this->idcreator."',"
        . "'".$this->idprojects."')";
    }
    
    public function searchBy($column, $value="") {
        $propNames = array();
        foreach((new ReflectionClass('ProjectDAO'))->getProperties() as $prop)
            if($prop->getName()!="idcreator")
                array_push($propNames, $prop->getName());
        
        $returnValue = "";
        
        switch($column) {
            case 'idprojects':
                $returnValue = "SELECT ".implode(", ", $propNames)." FROM project WHERE idprojects like '%".$value."%'";
                break;
            case 'title':
                $returnValue = "SELECT ".implode(", ", $propNames)." FROM project WHERE title like '%".$value."%'";
                break;
            case 'abstract':
                $returnValue = "SELECT ".implode(", ", $propNames)." FROM project WHERE abstract like '%".$value."%'";
                break;
            case 'problem_statement':
                $returnValue = "SELECT ".implode(", ", $propNames)." FROM project WHERE problem_statement like '%".$value."%'";
                break;
            case 'objectives':
                $returnValue = "SELECT ".implode(", ", $propNames)." FROM project WHERE objectives like '%".$value."%'";
                break;
            case 'pdf_url':
                $returnValue = "SELECT ".implode(", ", $propNames)." FROM project WHERE pdf_url like '%".$value."%'";
                break;
            case 'all':
                $returnValue = "SELECT ".implode(", ", $propNames)." FROM project";
                break;
        }
        return $returnValue;
    }

    public function setStateDB($newState) {
        return "UPDATE project SET state='".$newState."' WHERE idprojects = '".$this->idprojects."'";
    }
    
    public function exists() {
        return "SELECT idprojects FROM project WHERE idprojects = '".$this->idprojects."'";
    }

    public function getIdFromDB() {
        return "SELECT idprojects FROM project WHERE pdf_url = '".$this->pdf_url."'";
    }
    
    public function getCreatorFromDB() {
        return "SELECT student FROM project_x_student WHERE project = '".$this->idprojects."'";
    }
    
    function getIdprojects() {
        return $this->idprojects;
    }

    function getTitle() {
        return $this->title;
    }

    function getAbstract() {
        return $this->abstract;
    }

    function getProblem_statement() {
        return $this->problem_statement;
    }

    function getObjectives() {
        return $this->objectives;
    }

    function getPdf_url() {
        return $this->pdf_url;
    }

    function getState() {
        return $this->state;
    }
    
    function setIdprojects($idprojects) {
        $this->idprojects = $idprojects;
    }
}