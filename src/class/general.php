<?php

class general{

	protected $table;
	public $query;
	public $total;
	public $error;
	public $results;
	
	function __construct(){
		$this->table = "";
		$this->total = 0;
		$this->query = "";
		$this->error = "No Error";
	}

	private function makeConnection(){
		$ll = mysql_connect(baseHosts,baseUser,basePass)or
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
	
	protected function runQuery($queryString){
		$con = $this->makeConnection();
		
		$this->query = $queryString;
		
		$temp = mysql_query($queryString);
		
		if (!$temp) { // pregunta si la consulta se realizo satisfactoriamente.
			$this->error  = 'Invalid query: ' . mysql_error() . "\n";
			$this->error .= 'Whole query: ' . $query;
			return false;
		}
		else{
			$this->total = mysql_num_rows($temp);
			if($this->total){
				while( $row = mysql_fetch_assoc( $temp)){
					$results[] = $row; // Inside while loop
				}
				$this->results = $results;
			}
			return true;
		}
		
		$this->closeConnection($con);
	}

}

?>