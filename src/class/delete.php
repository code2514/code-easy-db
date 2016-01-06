<?php

/*
	Delete class
*/

class delete extends general{
	
	private $where;
	
	function __construct(){
		$this->where = " 1 = 1 ";
		$this->end = "";
	}
	
	private function makeQuery(){
		
		return "DELETE FROM ".$this->table." WHERE ".$this->where.$this->limit();
		
	}
	
	public function addCondition($condition){
		if(strlen($this->where)) $this->where .= " and ";
		$this->where .= " ".$condition." ";
	}
	
	public function showQuery(){
		
		return $this->makeQuery();
		
	}
	public function run(){
		return $this->runQuery($this->makeQuery());
	}
	
}

?>