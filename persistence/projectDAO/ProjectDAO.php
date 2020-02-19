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

    
     public function searchByInterest($column, $value="", $idprofessor, $isTutor) {
        $propNames = array();
        foreach((new ReflectionClass('ProjectDAO'))->getProperties() as $prop)
            if($prop->getName()!="idcreator")
                array_push($propNames, $prop->getName());
        
        $returnValue = "";
        
        if($isTutor) $isTutor=0;
        else $isTutor = 1;
        
        switch($column) {
            case 'idprojects':
                $returnValue = "SELECT ".implode(", ", $propNames)." FROM project WHERE idprojects like '%".$value."%' AND idprojects IN (SELECT project FROM project_x_professor WHERE professor = '".$idprofessor."' AND role = '".$isTutor."')";
                break;
            case 'title':
                $returnValue = "SELECT ".implode(", ", $propNames)." FROM project WHERE title like '%".$value."%' AND idprojects IN (SELECT project FROM project_x_professor WHERE professor = '".$idprofessor."' AND role = '".$isTutor."')";
                break;
            case 'abstract':
                $returnValue = "SELECT ".implode(", ", $propNames)." FROM project WHERE abstract like '%".$value."%' AND idprojects IN (SELECT project FROM project_x_professor WHERE professor = '".$idprofessor."' AND role = '".$isTutor."')";
                break;
            case 'problem_statement':
                $returnValue = "SELECT ".implode(", ", $propNames)." FROM project WHERE problem_statement like '%".$value."%' AND idprojects IN (SELECT project FROM project_x_professor WHERE professor = '".$idprofessor."' AND role = '".$isTutor."')";
                break;
            case 'objectives':
                $returnValue = "SELECT ".implode(", ", $propNames)." FROM project WHERE objectives like '%".$value."%' AND idprojects IN (SELECT project FROM project_x_professor WHERE professor = '".$idprofessor."' AND role = '".$isTutor."')";
                break;
            case 'pdf_url':
                $returnValue = "SELECT ".implode(", ", $propNames)." FROM project WHERE pdf_url like '%".$value."%' AND idprojects IN (SELECT project FROM project_x_professor WHERE professor = '".$idprofessor."' AND role = '".$isTutor."')";
                break;
            case 'all':
                $returnValue = "SELECT ".implode(", ", $propNames)." FROM project WHERE idprojects IN (SELECT project FROM project_x_professor WHERE professor = '".$idprofessor."' AND role = '".$isTutor."') ";
                break;
        }
        return $returnValue;
    }
    
    
    public function searchByStudent($column, $value="", $idStudent, $isCreator) {
        $propNames = array();
        foreach((new ReflectionClass('ProjectDAO'))->getProperties() as $prop)
            if($prop->getName()!="idcreator")
                array_push($propNames, $prop->getName());
        
        $returnValue = "";
        
        if($isCreator) $isCreator=0;
        else $isCreator = 1;
        
        switch($column) {
            case 'idprojects':
                $returnValue = "SELECT ".implode(", ", $propNames)." FROM project WHERE idprojects like '%".$value."%' AND idprojects IN (SELECT project FROM project_x_student WHERE student = '".$idStudent."' AND role = '".$isCreator."')";
                break;
            case 'title':
                $returnValue = "SELECT ".implode(", ", $propNames)." FROM project WHERE title like '%".$value."%' AND idprojects IN (SELECT project FROM project_x_student WHERE student = '".$idStudent."' AND role = '".$isCreator."')";
                break;
            case 'abstract':
                $returnValue = "SELECT ".implode(", ", $propNames)." FROM project WHERE abstract like '%".$value."%' AND idprojects IN (SELECT project FROM project_x_student WHERE student = '".$idStudent."' AND role = '".$isCreator."')";
                break;
            case 'problem_statement':
                $returnValue = "SELECT ".implode(", ", $propNames)." FROM project WHERE problem_statement like '%".$value."%' AND idprojects IN (SELECT project FROM project_x_student WHERE student = '".$idStudent."' AND role = '".$isCreator."')";
                break;
            case 'objectives':
                $returnValue = "SELECT ".implode(", ", $propNames)." FROM project WHERE objectives like '%".$value."%' AND idprojects IN (SELECT project FROM project_x_student WHERE student = '".$idStudent."' AND role = '".$isCreator."')";
                break;
            case 'pdf_url':
                $returnValue = "SELECT ".implode(", ", $propNames)." FROM project WHERE pdf_url like '%".$value."%' AND idprojects IN (SELECT project FROM project_x_student WHERE student = '".$idStudent."' AND role = '".$isCreator."')";
                break;
            case 'all':
                $returnValue = "SELECT ".implode(", ", $propNames)." FROM project WHERE idprojects IN (SELECT project FROM project_x_student WHERE student = '".$idStudent."' AND role = '".$isCreator."') ";
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
    
    public function retrieveData($idprojects_) {
        return "SELECT * FROM project WHERE idprojects = '".$idprojects_."'";
    }
    
    public function retrieveCreator($idprojects_) {
        return "SELECT student FROM project_x_student WHERE project = '".$idprojects_."'";
    }
    
    public function getCreatorFromDB() {
        return "SELECT student FROM project_x_student WHERE project = '".$this->idprojects."'";
    }
    
    public function setDAORetrievedData($data, $idCreator) {
        $this->idprojects           = $data[0];
        $this->title                = $data[1];
        $this->abstract             = $data[2];
        $this->problem_statement    = $data[3];
        $this->objectives           = $data[4];
        $this->pdf_url              = $data[5];
        $this->state                = $data[6];
        $this->idcreator            = $idCreator;
    }
    
    public function getTutor() {
        return "SELECT professor FROM project_x_professor WHERE project = '".$this->idprojects."' AND role = 0";
    }
    
    public function getJury() {
        return "SELECT professor FROM project_x_professor WHERE project = '".$this->idprojects."' AND role = 1";
    }

    public function setProfessor($idProfessor, $isTutor) {
        return $isTutor ? 
                "INSERT INTO project_x_professor(professor, project, role)"
                . " VALUES ('".$idProfessor."', '".$this->idprojects."', '0')"
                :
                "INSERT INTO project_x_professor(professor, project, role)"
                . " VALUES ('".$idProfessor."', '".$this->idprojects."', '1')";
    }
    
    public function increaseState() {
        $this->state++;
        return "UPDATE project SET state = '".$this->state."' WHERE idprojects = '".$this->idprojects."'";
    }
    
    public function getDBState() {
        return "SELECT state FROM project WHERE idprojects = '".$this->idprojects."'";
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