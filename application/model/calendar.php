<?php

define("STATUS_ACTIVE",1);

define("STATUS_CHANNELACTIVE",1);
define("STATUS_CHANNELTOOLACTIVE",1);

define("TYPE_EVENT",1);

class CalendarModel extends database {

	static protected $eventtype = 1;
	
	static function eventtype(){
		return self::$eventtype;
	}

	function __construct()
	{
		global $CONFIG;
		
		//$this->open_db();
		//$this->db_prefix = $CONFIG['db_table_prefix'];
		$this->table = dbfield::getTables();
	}
	
	function addEvent(){
		global $DB;
		$sql = "INSERT INTO
				".$this->table['event']."
			SET
				UserID 		= ?,
				Name		= ?,
				Description = ?,
				IsAllDay    = ?,
				Type 		= ?,
				Start		= ?,
				End			= ?,
				TimeInput 	= now(),
				Timemodified= now()";
		$para[] = $_SESSION['user_id'];
		$para[] = $this->name;
		$para[] = $this->description;
		$para[] = $this->isallday;
		$para[] = self::eventtype();
		$para[] = $this->startdate.' '.$this->starttime;
		$para[] = $this->enddate.' '.$this->endtime;

		return $DB->db_db_query($sql,$para);
	}
	
	function updateEvent(){
		global $DB;
		$sql = "UPDATE
				".$this->table['event']."
			SET
				Name		= ?,
				Description = ?,
				IsAllDay	= ?,
				Start		= ?,
				End			= ?,
				Timemodified= now()
			WHERE
				ID = ?
			AND
				UserID = ?";
		
		$para[] = $this->name;
		$para[] = $this->description;
		$para[] = $this->isallday;
		$para[] = $this->startdate.' '.$this->starttime;
		$para[] = $this->enddate.' '.$this->endtime;
		$para[] = $this->id;
		$para[] = $_SESSION['user_id'];
		
		return $DB->db_db_query($sql,$para);
	}
	
	function getEventitem(){
		global $DB;
		
		$cond = '';
		$para[] = $_SESSION['user_id'];
		$para[] = self::eventtype();
		if($this->start!='' && $this->end!=''){
			$cond.= ' AND Start between ? AND ?';
			$para[] = $this->startdate;
			$para[] = $this->enddate;
		}
		
		$sql = 'SELECT
					*
				FROM
					'.$this->table['event'].'
				WHERE
					UserID = ?
				AND
					Type = ?
				'.$cond;
		
		return $DB->returnRes($sql,$para);
	}
	function getCalendaritem($canseeroleid='',$filteruserid=''){die;
		global $DB;
		$cond = '';
		$para[] = $this->status;
	
		if($this->start!='' && $this->end!=''){
			$cond.= ' AND Start between ? AND ?';
			$para[] = $this->start;
			$para[] = $this->end;
		}
		
		/*if($canseeroleid!=''){
			list($c,$arr) = dbfield::in($canseeroleid,'u.RoleID in');
			$cond.=$c;
			$para = array_merge($para,$arr);
		}*/
		
		if($filteruserid!=''){
			list($c,$arr) = dbfield::in($filteruserid,'u.UserID in');
			$cond.=$c;
			$para = array_merge($para,$arr);
		}
	
		$sql = 'SELECT
					*
				FROM
					'.$this->table['event'].'
				WHERE
					Status=?
				'.$cond.'
				ORDER by Start ASC';
		return $DB->returnRes($sql,$para);
	}
	
	function getEventDetail(){
		global $DB;
		$sql = 'SELECT
					*
				FROM
					'.$this->table['event'].'
				WHERE
					Status=?
				AND
					ID = ?
				';
		$para[] = STATUS_ACTIVE;
		$para[] = $this->id;
		
		return $DB->returnVec($sql,$para);
		
	}
	
	function isWholeDay($starttime,$endtime){
		return ($starttime=='00:00' && $endtime=='00:00'||$starttime=='00:00:00' && $endtime=='00:00:00');
	}
	
	function exportEvent($start,$end,$filteruserid){
		global $Admin_Lang;
		
		$this->status = STATUS_ACTIVE;
		$this->start = $start;
		$this->end = $end.' 23:59:59';
		$item = $this->getCalendaritem('',$filteruserid,1);
		
		$itemsize = sizeof($item);
		for($a=0;$a<$itemsize;$a++){
			$csvdata[] = array($item[$a]['Username'],$item[$a]['Start'],$item[$a]['End']); 
		}
		
		$csvheading = array($Admin_Lang['user'],$Admin_Lang['eventstarttime'],$Admin_Lang['eventendtime']);
		
		$filename = 'workinghr';

		export2CSV($filename,$csvheading,$csvdata);
	}
}
?>