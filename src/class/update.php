<?php

/*
	Update class
*/


class update {
	
	private $table;
	private $select;
	private $from; 
	private $where;
	private $end;
	private $set;
	public $error;
	public $query;
	public $total;
	public $limit;
	
	function __construct(){
		$this->select = "*";
		$this->from = "";
		$this->where = " 1 = 1 ";
		$this->end = "";
		$this->total = 0;
		$this->limit = 1;
		$this->error = "No error";
		
	}
	
	private function makeConnection(){
		$ll = mysql_connect(baseHost,baseUser,basePass)or
		die("Could not connect: " . mysql_error());
		mysql_select_db(baseBase);
		
		return $ll;
	}
	private function closeConnection($ll){
		mysql_close($ll);
	}
	public function table($t){
		$this->table = $t;
	}
	public function addCondition($condition){
		
		if(strlen($this->where)) $this->where .= " and ";
		$this->where .= " ".$condition." ";
		
	}
	public function addSet($key, $value){
		if($this->total){
			$this->set .= ", ";
		}
		if(gettype($value) == "string") $this->set .= $key." = '".$value."'";
		else $this->set .= $key." = ".$value;
		$this->total++;
		
	}
	private function limit(){
		
		return ( $this->limit )? "LIMIT ".$this->limit:"";
		
	}
	private function makeQuery(){
		
		return "UPDATE ".$this->table." SET ".$this->set." WHERE ".$this->where.$this->limit();
		
	}
	public function showQuery(){
		return $this->makeQuery();
	}
	public function run(){
		$con = $this->makeConnection();
		
		
		$this->query = $this->makeQuery();
		
		$temp = mysql_query($this->makeQuery());
		
		if (!$temp) { // pregunta si la consulta se realizo satisfactoriamente.
			$this->error  = 'Invalid query: ' . mysql_error() . "\n";
			$this->error .= 'Whole query: ' . $query;
			return false;
		}
		else{
			
			return true;
		}
		
		$this->closeConnection($con);
	}

	
	
}

?>