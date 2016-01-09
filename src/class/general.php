<?php


class general{

	protected $table;
	protected $debug;
	protected $query;
	protected $total;
	protected $error;
	protected $limit;
	protected $order;
	protected $typeOrder;
	public $results;
	
	function __construct(){
		$this->table = "";
		$this->total = 0;
		$this->query = "";
		$this->debug = false;
		$this->error = "No Error";
		$this->limit = 1;
		$this->typeOrder = "ASC";
		$this->order = "";
	}
	private function makeConnection(){
		$ll = @mysql_connect(baseHost,baseUser,basePass)or
		$this->error("Check your config.php. ");
		mysql_select_db(baseBase);
		
		return $ll;
	}
	
	private function closeConnection($ll){
		mysql_close($ll);
	}
	protected function error($msg){
		echo "
			<p style='margin:0 auto; width:80%; margin-top:20px; display:block; text-align:center;background-color:#E92828; font-size:30px; padding:20px 0px; color:white;'>
				".$msg."
			</p>
		";
		die();
	}
	protected function runQuery($queryString, $total = false){
		
		if(!strlen($this->table)){
			$this->error("You must be add table_name<br>example: class->table('table_name');");
		}
		
		$con = $this->makeConnection();
		
		$this->query = $queryString;
		
		$temp = mysql_query($queryString);
		
		if (!$temp) { // pregunta si la consulta se realizo satisfactoriamente.
			$this->error  = 'Invalid query: ' . mysql_error() . "\n";
			$this->error .= 'Whole query: ' . $query;
			if($this->debug) $this->error($this->error);
			return false;
		}
		else{
			if($total) $this->total = mysql_num_rows($temp);
			if($total){
				while( $row = mysql_fetch_assoc( $temp)){
					$results[] = $row;
				}
				$this->results = $results;
			}
			return true;
		}
		
		$this->closeConnection($con);
	}
	protected function limit(){
		return $this->limit;
	}
	protected function getOrder(){
		return (strlen($this->order))? "ORDER BY ".$this->order." ".$this->typeOrder:"";
	}
	public function typeOrder($order = "ASC"){
		if(strtoupper($order) != "ASC" and strtoupper($order) != "DESC"){
			$this->error  = 'Uknown clause '.$order." in typeOrder, accepted 'ASC' or 'DESC'";
			if($this->debug) $this->error($this->error);
		}
		else $this->typeOrder  strtoupper($order);
	}
	public function addOrder($condition){
		if(strlen($this->order)) $this->order .= ", ";
		$this->order .= " ".$condition." ";
	}
	public function setLimit($limit = 1){
		$this->limit = $limit;
	}
	public function debug($debug){
		$this->debug = $debug;
	}
	public function table($t){
		$this->table = $t;
	}
	public function getResults(){
		return $this->results;
	}
	public function getQuery(){
		return $this->query;
	}
	public function getTotal(){
		return $this->total;
	}
	public function getError(){
		return $this->error;
	}
	
	

}

?> 