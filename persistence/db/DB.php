<?php
class DB {    
	private $mysqli;
	private $result;
	public function open(){
		$this -> mysqli = new mysqli("localhost", "root", "", "anteproyectos");
		$this -> mysqli -> set_charset("utf8");
	}
	public function lastId(){
		return $this -> mysqli -> insert_id;
	}
	public function execute($sentence){
		$this->result = $this->mysqli->query($sentence);
	}
	public function close(){
		$this -> mysqli -> close();
	}
	public function nRows(){
		if($this->result !=null){
			return $this->result->num_rows;
		}else{
			return 0;
		}
	}
	public function fetch(){
		return $this->result->fetch_row();
	}
	public function success(){
		if($this->result === TRUE){
			return true;
		}else{
			return false;
		}
	}
}
?>