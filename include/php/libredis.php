<?php 

class redis{
	
	function redis(){
		$this->client = '';
	}
	
	function open_redis(){
		try {
			Predis\Autoloader::register();
		    $this->client = new Predis\Client();
		/*
		    $redis = new PredisClient(array(
		        "scheme" => "tcp",
		        "host" => "127.0.0.1",
		        "port" => 6379));
		*/
		  //  echo "Successfully connected to Redis";
		}
		catch (Exception $e) {
		    echo "Couldn't connected to Redis";
		    echo $e->getMessage();
		}
	}
}

?>