<?php

/*
	Insert class
*/

class insert extends general{
	
	private $select;
	private $fields; 
	private $values;
	
	function __construct(){
		$this->query = "";
		$this->select = "*";
		$this->values = "";
		$this->fields = "";
		$this->total = 0;
		$this->error = "No error";
	}
	private function makeQuery(){
		return $this->query = "insert into ".$this->table." (".$this->fields.") values (".$this->values.")";
	}
	public function addValue($key, $value){
		if($this->total){
			$this->fields .= ", ";
			$this->values .= ", ";
		}
		$this->fields .= $key;
		if(gettype($value) == "string") $this->values .= "'".$value."'";
		else $this->values .= $value;
		$this->total++;
		
	}
	
	public function showQuery(){
		
		return $this->makeQuery();
		
	}
	public function run(){
		return $this->runQuery($this->makeQuery());
	}
	
}

?>