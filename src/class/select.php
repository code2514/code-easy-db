<?php

/*
	Select class
*/


class select extends general{
	
	private $select;
	private $from; 
	private $where;
	private $end;
	
	function __construct(){
		$this->select = "*";
		$this->from = "";
		$this->where = " 1 = 1 ";
		$this->end = "";
	}

	private function makeQuery(){
		
		$queryString  = "select ".$this->select." ";
		$queryString .= " from ".$this->table." ";
		$queryString .= " where ".$this->where." ";
		
		return $queryString;
		
	}
	public function select($select){
		$this->select = $select;
	}
	public function addSelect($select){
		$this->select .= ", ".$select;
		
	}
	public function addCondition($condition){
		
		if(strlen($this->where)) $this->where .= " and ";
		$this->where .= " ".$condition." ";
		
	}
	public function showQuery(){
		return $this->makeQuery();
		
	}
	public function run(){
		return $this->runQuery($this->makeQuery);
	}
	
}
?>