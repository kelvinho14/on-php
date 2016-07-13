<?php

class BlogModel extends ArtistModel {

	static protected $active = 1;
	static protected $pending = 0;
	static protected $archived = -1;
	static protected $artistname = '';
	
	
	function __construct(){
		$this->table = dbfield::getTables();
	}
	static function active(){
		return self::$active; 
	}
	static function archived(){
		return self::$archived; 
	}
	static function pending(){
		return self::$pending; 
	}

	
		
	function getBlogPublicList(){
		global $DB;
		
		$this->artistName();
		$sql = 'SELECT 
					'.dbfield::getFieldByLang().'
				FROM
					'.$this->table['artisttype'].'
				WHERE 
					Status= ?';
		
		$para[] = self::active();
		return $DB->returnRes($sql,$para);
	}
	
}
?>