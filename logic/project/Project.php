<?php
require_once 'persistence/db/DB.php';
require_once 'persistence/projectDAO/ProjectDAO.php';

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
        
        $this->idprojects           = $idprojects_;
        $this->title                = $title_;
        $this->abstract             = $abstract_;
        $this->problem_statement    = $problem_statement_;
        $this->objectives           = $objectives_;
        $this->pdf_url              = $now->format('Y-m-d_H-i-s_').$pdf_url_;
        $this->state                = $state_;
        $this->idcreator            = $idcreator_;
        $this->db                   = new DB();
        $this->dao                  = new ProjectDAO($this->idprojects,
                                                     $this->title,
                                                     $this->abstract,
                                                     $this->problem_statement,
                                                     $this->objectives,
                                                     $this->pdf_url,
                                                     $this->state,
                                                     $this->idcreator);
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
                echo "NO PUDE ENCONTRAR POR IDPROJECTS :'(<br>";
                $this->db->execute($this->dao->searchBy('title', $string));
                if($this->db->nRows() != 0) $winnerCol = 'title';
                else {
                    echo "NO PUDE ENCONTRAR POR TITULO :'(<br>";
                    $this->db->execute($this->dao->searchBy('abstract', $string));
                    if($this->db->nRows() != 0) $winnerCol = 'abstract';
                    else {
                        echo "NO PUDE ENCONTRAR POR ABSTRACT :'(<br>";
                        $this->db->execute($this->dao->searchBy('problem_statement', $string));
                        if($this->db->nRows() != 0) $winnerCol = 'problem_statement';
                        else {
                            echo "NO PUDE ENCONTRAR POR PROBLEM :'(<br>";
                            $this->db->execute($this->dao->searchBy('objectives', $string));
                            if($this->db->nRows() != 0) $winnerCol = 'objectives';
                            else {
                                echo "NO PUDE ENCONTRAR POR OBJECTIVES :'(<br>";
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
    
    public function getCol($what) {
        $returnValue = "";
        switch($what) {
            case "ID":
                $returnValue = $this->getIdprojects();
                break;
            case "Título":
                $returnValue = $this->getTitle();
                break;
            case "Resumen":
                $returnValue = $this->getAbstract();
                break;
            case "Planteamiento":
                $returnValue = $this->getProblem_statement();
                break;
            case "Objetivos":
                $returnValue = $this->getObjectives();
                break;
            case "PDF":
                $returnValue = $this->getPdf_url();
                break;
            case "Estado":
                $returnValue = $this->getState();
                break;
        }
        return $returnValue;
    }
    
    function setStateBD($newState) {
        $this->db->open();
        $this->db->execute($this->dao->setStateBD($newState));
        $this->db->close();
    }
    
    function setIdcreator($idcreator) {
        $this->idcreator = $idcreator;
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
            $this->dao->setDAORetrievedData($data);
            $success = true;
        } else $success = false;
        $this->db->close();
        return $success;
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