<?php

/*
	Insert class
*/

class insert {
	
	private $table;
	private $select;
	private $fields; 
	private $values;
	public $error;
	public $query;
	public $total;
	public $limit;
	
	function __construct(){
		$this->query = "";
		$this->limit = 1;
		$this->select = "*";
		$this->values = "";
		$this->fields = "";
		$this->total = 0;
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
	private function makeQuery(){
		return $this->query = "insert into	 ".$this->table." (".$this->fields.") values (".$this->values.")";
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
			$this->error .= 'Whole query: ' . $this->query;
			return false;
		}
		else{
			return true;
		}
		
		$this->closeConnection($con);
	}	
	
}

?>