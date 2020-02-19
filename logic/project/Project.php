<?php
require_once 'persistence/db/DB.php';
require_once 'persistence/projectDAO/ProjectDAO.php';
require_once 'logic/professor/Professor.php';

class Project
{
    private $idprojects;
    private $title;
    private $abstract;
    private $problem_statement;
    private $objectives;
    private $pdf_url;
    private $state;
    private $idcreator;
    
    private $db;
    private $dao;
    
    public function Project($idprojects_="",
                            $title_="",
                            $abstract_="",
                            $problem_statement_="",
                            $objectives_="",
                            $pdf_url_="",
                            $state_="",
                            $idcreator_="") {
        
        $now = new DateTime();
        
        $this->db                   = new DB();
        $this->idprojects           = $this->sanitize($idprojects_);
        $this->title                = $this->sanitize($title_);
        $this->abstract             = $this->sanitize($abstract_);
        $this->problem_statement    = $this->sanitize($problem_statement_);
        $this->objectives           = $this->sanitize($objectives_);
        $this->pdf_url              = $this->sanitize($now->format('Y-m-d_H-i-s_').$pdf_url_);
        $this->state                = $this->sanitize($state_);
        $this->idcreator            = $this->sanitize($idcreator_);
        $this->dao                  = new ProjectDAO($this->idprojects,
                                                     $this->title,
                                                     $this->abstract,
                                                     $this->problem_statement,
                                                     $this->objectives,
                                                     $this->pdf_url,
                                                     $this->state,
                                                     $this->idcreator);
    }
    
    public function sanitize($badString) {
        $goodString = "";
        $this->db->open();
        $goodString .= $this->db->sanitize($badString);
        $this->db->close();
        return $goodString;
    }


    public function insert() {
        $insertProject_x_Student = false;
        $returnBoolean = false;
        $this->db->open();
        $this->db->execute($this->dao->insert());
        $insertProject_x_Student = $this->db->success();
        $this->db->close();
        
        if($insertProject_x_Student) {
            $this->getIdFromDB();
            $this->db->open();
            $this->db->execute($this->dao->insertProject_x_Student());
            $returnBoolean = $this->db->success();
            $this->db->close();
        }
        return $returnBoolean;
    }
    
    public function getIdFromDB() {
        $this->db->open();
        $this->db->execute($this->dao->getIdFromDB());
        $this->idprojects = $this->db->fetch()[0];
        $this->dao->setIdprojects($this->idprojects);
        $this->db->close();
    }
    
    // This function will search a string in all columns
    public function search($string) {
        $projects = array();

        $this->db->open();
        
        $winnerCol = '';
        
        if($string!="") {
            $this->db->execute($this->dao->searchBy('idprojects', $string));
            if($this->db->nRows() != 0) $winnerCol = 'idprojects';
            else {
                $this->db->execute($this->dao->searchBy('title', $string));
                if($this->db->nRows() != 0) $winnerCol = 'title';
                else {
                    $this->db->execute($this->dao->searchBy('abstract', $string));
                    if($this->db->nRows() != 0) $winnerCol = 'abstract';
                    else {
                        $this->db->execute($this->dao->searchBy('problem_statement', $string));
                        if($this->db->nRows() != 0) $winnerCol = 'problem_statement';
                        else {
                            $this->db->execute($this->dao->searchBy('objectives', $string));
                            if($this->db->nRows() != 0) $winnerCol = 'objectives';
                            else {
                                $this->db->execute($this->dao->searchBy('pdf_url', $string));
                                if($this->db->nRows() != 0) $winnerCol = 'pdf_url';
                            }
                        }
                    }
                }
            }
        }
        else {
            $this->db->execute($this->dao->searchBy("all"));
            if($this->db->nRows() != 0) $winnerCol = 'all';
        }
        
        $nRows = $this->db->nRows();
        $this->db->close();
        
        if($winnerCol != '')
            for($i=0; $i<$nRows; $i++)
                array_push($projects, $this->createDataProject($this->db->fetch()));
        
        return $winnerCol!='' ?  $projects : null;
    }
    

    
    public function searchByInterest($string, $idprofessor, $isTutor) {
        $projects = array();

        $this->db->open();
        
        $winnerCol = '';
        
        if($string!="") {
            $this->db->execute($this->dao->searchByInterest('idprojects', $string, $idprofessor, $isTutor));
            if($this->db->nRows() != 0) $winnerCol = 'idprojects';
            else {
                $this->db->execute($this->dao->searchByInterest('title', $string, $idprofessor, $isTutor));
                if($this->db->nRows() != 0) $winnerCol = 'title';
                else {
                    $this->db->execute($this->dao->searchByInterest('abstract', $string, $idprofessor, $isTutor));
                    if($this->db->nRows() != 0) $winnerCol = 'abstract';
                    else {
                        $this->db->execute($this->dao->searchByInterest('problem_statement', $string, $idprofessor, $isTutor));
                        if($this->db->nRows() != 0) $winnerCol = 'problem_statement';
                        else {
                            $this->db->execute($this->dao->searchByInterest('objectives', $string, $idprofessor, $isTutor));
                            if($this->db->nRows() != 0) $winnerCol = 'objectives';
                            else {
                                $this->db->execute($this->dao->searchByInterest('pdf_url', $string, $idprofessor, $isTutor));
                                if($this->db->nRows() != 0) $winnerCol = 'pdf_url';
                            }
                        }
                    }
                }
            }
        }
    else {
            $this->db->execute($this->dao->searchByInterest("all", "", $idprofessor, $isTutor));
            if($this->db->nRows() != 0) $winnerCol = 'all';
        }
        
        $nRows = $this->db->nRows();
        $this->db->close();
        
        if($winnerCol != '')
            for($i=0; $i<$nRows; $i++)
                array_push($projects, $this->createDataProject($this->db->fetch()));
        
        return $winnerCol!='' ?  $projects : null;
    }
    
    
    public function searchByStudent($string, $idStudent, $isCreator) {
        $projects = array();

        $this->db->open();
        
        $winnerCol = '';
        
        if($string!="") {
            $this->db->execute($this->dao->searchByStudent('idprojects', $string, $idStudent, $isCreator));
            if($this->db->nRows() != 0) $winnerCol = 'idprojects';
            else {
                $this->db->execute($this->dao->searchByStudent('title', $string, $idStudent, $isCreator));
                if($this->db->nRows() != 0) $winnerCol = 'title';
                else {
                    $this->db->execute($this->dao->searchByStudent('abstract', $string, $idStudent, $isCreator));
                    if($this->db->nRows() != 0) $winnerCol = 'abstract';
                    else {
                        $this->db->execute($this->dao->searchByStudent('problem_statement', $string, $idStudent, $isCreator));
                        if($this->db->nRows() != 0) $winnerCol = 'problem_statement';
                        else {
                            $this->db->execute($this->dao->searchByStudent('objectives', $string, $idStudent, $isCreator));
                            if($this->db->nRows() != 0) $winnerCol = 'objectives';
                            else {
                                $this->db->execute($this->dao->searchByStudent('pdf_url', $string, $idStudent, $isCreator));
                                if($this->db->nRows() != 0) $winnerCol = 'pdf_url';
                            }
                        }
                    }
                }
            }
        }
    else {
            $this->db->execute($this->dao->searchByStudent("all", "", $idStudent, $isCreator));
            if($this->db->nRows() != 0) $winnerCol = 'all';
        }
        
        $nRows = $this->db->nRows();
        $this->db->close();
        
        if($winnerCol != '')
            for($i=0; $i<$nRows; $i++)
                array_push($projects, $this->createDataProject($this->db->fetch()));
        
        return $winnerCol!='' ?  $projects : null;
    }
    
    
    public function createDataProject($data) {
        $project = new Project($data[0],
                               $data[1],
                               $data[2],
                               $data[3],
                               $data[4],
                               $data[5],
                               $data[6],
                               0);
        $project->setIdcreator($project->getCreatorFromDB());
        return $project;
    }

    public function getCreatorFromDB() {
        $returnValue = "";
        $this->db->open();
        $this->db->execute($this->dao->getCreatorFromDB());
        $returnValue = $this->db->fetch()[0];
        $this->db->close();
        return $returnValue;
    }
    
    public function getCol($what, $truncated=false) {
        $returnValue = "";
        switch($what) {
            case "ID":
                $returnValue = $this->getIdprojects();
                break;
            case "Título":
                $returnValue = $this->getTitle();
                break;
            case "Resumen":
                ($truncated)? $returnValue = substr($this->getAbstract(), 0, 300) : $returnValue = $this->getAbstract();
                break;
            case "Planteamiento":
                ($truncated)? $returnValue = substr($this->getProblem_statement(), 0, 300) : $returnValue = $this->getProblem_statement();
                break;
            case "Objetivos":
                ($truncated)? $returnValue = substr($this->getObjectives(), 0, 300) : $this->getObjectives();
                break;
            case "PDF":
                $returnValue = $this->getPdf_url();
                break;
            case "Estado":
                $returnValue = $this->getState();
                break;
        }
        return strlen($returnValue)>298? $returnValue." ..." 
                : 
               $returnValue;
    }
    
    function setStateBD($newState) {
        $this->db->open();
        $this->db->execute($this->dao->setStateBD($newState));
        $this->db->close();
    }
    
    function setIdcreator($idcreator) {
        $this->idcreator = $idcreator;
    }
    
    function getIdCreator() {
        return $this->idcreator;
    }
    
    function setIdprojects($idprojects) {
        $this->idprojects = $idprojects;
    }
    
    function exists() {
        $returnBoolean = false;
        $this->db->open();
        $this->db->execute($this->dao->exists());
        if($this->db->nRows() > 0)
            $returnBoolean = true;
        $this->db->close();
        return $returnBoolean;
    }

    function retrieveData($idprojects_) {
        $success = false;
        $this->db->open();
        $this->db->execute($this->dao->retrieveData($idprojects_));
        if($this->db->nRows()>0) {
            $data = $this->db->fetch();
            $this->idprojects           = $data[0];
            $this->title                = $data[1];
            $this->abstract             = $data[2];
            $this->problem_statement    = $data[3];
            $this->objectives           = $data[4];
            $this->pdf_url              = $data[5];
            $this->state                = $data[6];
            
            $this->db->execute($this->dao->retrieveCreator($idprojects_));
            $this->idcreator = $this->db->fetch()[0];
            
            $this->dao->setDAORetrievedData($data, $this->idcreator);
            $success = true;
        } else $success = false;
        $this->db->close();
        return $success;
    }
    
    public function getTutor() {
        $returnIdProfessor = null;
        $this->db->open();
        $this->db->execute($this->dao->getTutor());
        if($this->db->nRows()>0)
            $returnIdProfessor = $this->db->fetch()[0];
        $this->db->close();
        return $returnIdProfessor;
    }
    
    public function getJury() {
        $juries = array();
        $this->db->open();
        $this->db->execute($this->dao->getJury());
        if($this->db->nRows()>0)
            for($i=0; $i<$this->db->nRows(); $i++)
                array_push ($juries, $this->db->fetch()[0]);
        $this->db->close();
        return $juries;
    }
    
    public function updateState($idProfessor="") {
        $reason = 0;
        if($this->state<5) {
            if($idProfessor != "") {
                if((new Professor($idProfessor,"","","","","",""))->userExists(true) && $this->state<3) {
                    $this->db->open();
                    if($this->state==0)
                        $this->db->execute($this->dao->setProfessor($idProfessor,true));
                    else if ($this->state==2)
                        $this->db->execute($this->dao->setProfessor($idProfessor,false));
                    $success = $this->db->success();
                    $this->db->close();
                    if($success && $this->state%2==0) $this->increaseDBState();
                } else $reason++; // professor doesn't exist
            } 
            else {
                if($this->state == 1 || $this->state == 3) $this->increaseDBState();
                else $reason = 2; // operation forbidden due to current state
            }
        }
        return $reason;
    }

    public function increaseDBState() {
        $this->db->open();
        $this->db->execute($this->dao->increaseState());
        $this->db->execute($this->dao->getDBState());
        $this->state = (int)$this->db->fetch()[0];
        $this->db->close();
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
}