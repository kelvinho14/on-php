<?php

define("STATUS_UNREAD",1);
define("STATUS_READ",2);

define("TYPE_EMPLOYEECHANGEJOBTIME",1);

class MessageModel extends database {


	function __construct(){
		
		
		$this->table = dbfield::getTables();
	}
	
	function addNotification(){
		global $DB;
		$sql = "INSERT INTO
				".$this->table['event']."
			SET
				UserID 		= ?,
				Name		= ?,
				Description = ?,
				Start		= ?,
				End			= ?,
				TimeInput 	= now(),
				Timemodified= now()";
		$para[] = $_SESSION['user_id'];
		$para[] = $this->name;
		$para[] = $this->description;
		$para[] = $this->startdate.' '.$this->starttime;
		$para[] = $this->enddate.' '.$this->endtime;

		return $DB->db_db_query($sql,$para);
	}
	
	function getNotification(){
		global $DB;
		$sql = 'SELECT
					n.*,'.dbfield::getUsername('u','Sender').', if(n.Status=?,1,0) as IsUnread,n.Sender as SenderID
				FROM
					'.$this->table['notification'].' as n
				INNER JOIN
					'.$this->table['user'].' as u
				ON
					u.UserID = n.Sender
				WHERE
					n.Type=?
				AND
					n.Recipient=?
				GROUP BY
					n.ID
				';
		$para[] = STATUS_UNREAD;
		$para[] = TYPE_EMPLOYEECHANGEJOBTIME;
		$para[] = $_SESSION['user_id'];
	
	
		if($notification = $DB->returnRes($sql,$para)){
			$notification_count = sizeof($notification);
			$unread = 0;
			for($a=0;$a<$notification_count;$a++){
				if($notification[$a]['Status']==STATUS_UNREAD)
					$unread++;
			}
				
			return array($unread,$notification);
		}
	}
	
	function getNotificationCount(){
		global $DB;
		$sql = 'SELECT
					count(*)
				FROM
					'.$this->table['notification'].'
				WHERE
					Status=?
				AND
					Recipient=?
				';
		$para[] = STATUS_UNREAD;
		$para[] = $_SESSION['user_id'];
		
		$obj = $DB->returnVec($sql,$para);
		return $obj[0];
	}
	
	function getTopmenuNotification(){
		global $DB;
		$sql = 'SELECT
					n.*,'.dbfield::getUsername('u','Sender').'
				FROM
					'.$this->table['notification'].' as n
				INNER JOIN
					'.$this->table['user'].' as u
				ON
					u.UserID = n.Sender
				WHERE
					n.Status=?
				AND
					n.Recipient=?
				';
		$para[] = STATUS_UNREAD;
		$para[] = $_SESSION['user_id'];
		
		return $DB->returnRes($sql,$para);
	}
	
	function sendNotification($param){
		global $Admin_Lang;
	
	
		$type = filter::required($param, 'notificationtype', PARAM_TEXT);
		$sender = filter::required($param, 'sender', PARAM_TEXT);
		$recipient = $param['recipient'];
		$data = $param['data'];
	
		if(is_array($recipient)){
			$size = sizeof($recipient);
			for($a=0;$a<$psize;$a++){
				if($recipient[$a]=='')
					return false;
			}
		}else{
			if($recipient=='')
				return false;
		}
		
		if($template = $Admin_Lang['notification_template'][$type]){
			$psize = sizeof($template['param']);
			for($a=0;$a<$psize;$a++){
				$result[$template['param'][$a]] = $data[$template['param'][$a]];
			}
			$json = json_encode($result);
				
			if(is_array($recipient)){
				$size = sizeof($recipient);
				for($a=0;$a<$psize;$a++){
					if($recipient[$a]!='')
						$this->insertNotification($json,$type,$sender,$recipient[$a]);
				}
			}else{
				$this->insertNotification($json,$type,$sender,$recipient);
			}
				
		}
	}
	
	function insertNotification($json,$type,$sender,$recipient){
		global $DB;
		
		$sql = "INSERT INTO
					".$this->table['notification']."
				SET
					Data 		= ?,
					Type		= ?,
					Sender		= ?,
					Recipient	= ?,
					TimeInput 	= now()";
			
		return $DB->db_db_query($sql,array($json,$type,$sender,$recipient));
	}
	
	function markAllRead(){
		global $DB;
		$sql = "UPDATE ".$this->table['notification']." SET Status=? WHERE Recipient=?";
		return $DB->db_db_query($sql,array(STATUS_READ,$_SESSION['user_id']));
	}
}
?>