<?php

class database
{

	var $Database;
	var $Result;


	/*
	* Initialize
	*/
	function database(){
		$this->conn = '';
	}

	function open_db()
	{
		global $CONFIG;
		
		$this->conn = new PDO("mysql:host=".$CONFIG['db_host'].";dbname=".$CONFIG['db_name'],$CONFIG['db_login'],$CONFIG['db_password']);
		$this->conn->exec("set character_set_database='utf8'");
		$this->conn->exec("set names utf8");
	}
	
	function returnRes($sql,$param=array()){
		//$this->open_db();
		$q = $this->conn->prepare($sql);
		$q->execute($param);
	
		$q->setFetchMode(PDO::FETCH_BOTH);
		
		if(get_magic_quotes_gpc())
			$need_stripslashes = true;
		else
			$need_stripslashes = false;
		
		// fetch
		while($r = $q->fetch()){
			/*if($need_stripslashes){
				foreach($r as $key=>$value)
					$r[$key] = stripslashes($value);
			}*/
				foreach($r as $key=>$value){
					if($need_stripslashes){
						$r[$key] = stripslashes($value);
					}
					$r[$key] = ($value);//display::inputValue
					
				}
					
				
			$res[] = $r;
		}
		//$this->close_db();
		return $res;
	}
	
	function returnVec($sql,$param=array()){
		//$this->open_db();
		
		$q = $this->conn->prepare($sql);
		$q->execute($param);
	
		$q->setFetchMode(PDO::FETCH_BOTH);
	
		if(get_magic_quotes_gpc())
			$need_stripslashes = true;
		else
			$need_stripslashes = false;
		
		// fetch
		while($r = $q->fetch()){
			/*if($need_stripslashes){
				foreach($r as $key=>$value)
					$r[$key] = stripslashes($value);
			}*/
				foreach($r as $key=>$value){
					if($need_stripslashes){
						$r[$key] = stripslashes($value);
					}
					$r[$key] = ($value);//display::inputValue
				}
				
			
			//$this->close_db();
			return $r;
		}
		
	}

	/*
	* Get the ID of the record just inserted
	*/
	/*function db_db_insert(){

		$this->open_db();
		
		$ReturnVal = mysql_insert_id();
		
		$this->close_db();
		return $ReturnVal;

	}*/



	/*
	* Get the number of rows of current result
	*/
	function db_num_rows(){

		$ReturnVal = mysql_num_rows($this->Result);

		return $ReturnVal;

	}

	/*
	* Run query on database
	*	- show sql statement if failed and debug mode is ON
	*/
	function db_db_query($sql,$param=array(),$return_id=false){
		//$this->open_db();
		
		$q = $this->conn->prepare($sql);
		
		if ( false===$q ) {
			print_r($param);
			die('prepare() failed: ' . print_R($q));
		}
		$result = $q->execute($param);
		if ( false===$result ) {
			print_r($param);
			die('execute() failed: ' . print_R($q));
		}
		
		if($return_id && $result==true){
			$id = $this->conn->lastInsertId();
			//$this->close_db();
			return $id;
		}else{
			//$this->close_db();
			return $result;
		}
	}

	
	function close_db()
	{
		$this->conn = null;
	}
	
	
}

?>