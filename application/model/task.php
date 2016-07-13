<?php


// my task

class TaskModel extends database {

	static protected $active = 1;
	static protected $pending = 0;
	static protected $archived = -1;
	static protected $deleted = -2;
	static protected $listactive = 1;
	static protected $listdeleted = -1;
	
	function __construct(){
		$this->table = dbfield::getTables();
	}
	static function active(){
		return self::$active; 
	}
	static function archived(){
		return self::$archived; 
	}
	static function deleted(){
		return self::$deleted; 
	}
	static function pending(){
		return self::$pending; 
	}
	static function listactive(){
		return self::$listactive;
	}
	static function listdeleted(){
		return self::$listdeleted; 
	}
		
	function Get_MyPrjTasklist(){
		global $DB;
		
		$sql = 'SELECT 
					p.Name,count(t.TaskID) as TaskNo ,p.ProjectID
				FROM
					'.$this->table['project'].' as p
				INNER JOIN
					'.$this->table['milestonetask'].' as t
				ON
					p.Projectid = t.ProjectID
				INNER JOIN
					'.$this->table['milestonetaskassign'].' as a 
				ON
					a.TaskID = t.TaskID 	 
				WHERE
					a.UserID = ? 
				AND 
					p.Status!= ?
				AND 
					t.Status!= ?
				AND 
					a.Status!= ?
					group by p.projectId';
		  
		$para[] = $_SESSION['user_id'];
		$para[] = STATUS_DELETEDMS;
		$para[] = STATUS_DELETEDPRJTASK;
		$para[] = STATUS_DELETEDPRJASSIGNTASK;

		return $DB->returnRes($sql,$para);
	}
	
	function Get_MyTasklist(){  
		global $DB;
		
		$para[] = self::deleted();
		$para[] = $_SESSION['user_id'];
		$para[] = $_SESSION['user_id'];
		$para[] = self::listdeleted();
		
		if($this->listid!=''){
			$cond = ' AND l.ListID = ?';
			$para[] = $this->listid;
		}
		
		$sql = 'SELECT 
					l.Name,sum(if(t.status=1,1,0)) as TaskNo,l.ListID
				FROM
					'.$this->table['mytasklist'].' as l 
				LEFT JOIN
					'.$this->table['mytask'].' as t 
				ON
					t.listid = l.listid  AND t.Status!=? AND t.UserID = ? 
				WHERE
					l.UserID = ? 
				AND 
					l.Status!=? '.$cond.'
				GROUP BY
					l.listid
							';
		return $DB->returnRes($sql,$para);
	}
	
	function getProjectTaskitem(){
		global $DB;
		
		$cond = '';
		
		$para[] = STATUS_DELETEDPRJTASK;
		$para[] = $_SESSION['user_id'];
		
		if($this->projectid!=''){
			$cond.= ' AND t.ProjectID = ?';
			$para[] = $this->projectid;
		}
		if($this->taskid!=''){
			$cond.= ' AND t.TaskID=? ';
			$para[] = $this->taskid;
		}
		
		$sql = 'SELECT
					t.*,p.Name as ProjectName, a.Role
				FROM
					'.$this->table['milestonetask'].' as t
				INNER JOIN
					'.$this->table['project'].' as p
				ON
					p.ProjectID = t.ProjectID	
				INNER JOIN
					'.$this->table['milestonetaskassign'].' as a
				ON
					a.TaskID = t.TaskID
				WHERE
					t.Status!=?
				AND
					a.UserID = ?
					'.$cond.'
				ORDER BY t.Status desc,
				t.RealDeadline,
				CASE WHEN t.Deadline not in("","0000-00-00 00:00:00") then t.Deadline else 9999999 end,
				t.TaskID desc
							';
		/*CASE WHEN RealDeadline not in("","0000-00-00 00:00:00") then RealDeadline else 9999999 end,
		 CASE WHEN Deadline not in("","0000-00-00 00:00:00") then Deadline else 9999999 end,*/
		
		return $DB->returnRes($sql,$para);
	}
	
	function getMyTaskTotal($active=''){
		$obj = $this->getMyTaskitem($active,true);
		return $obj[0];
	}
	function getMyTaskitem($active='',$returntotal=false){
		global $DB;
		
		$cond = '';
		$para[] = $_SESSION['user_id'];
		if($this->listid!=''){
			$cond.= ' AND ListID = ?';
			$para[] = $this->listid;
		}
		if($this->taskid!=''){
			$cond.= ' AND TaskID=? ';
			$para[] = $this->taskid;
		}
		
		$cond.= ' AND Status!=? ';
		$para[] = self::deleted();
		if($active){
			$cond.= ' AND Status = ?';
			$para[] = self::active();
		}
		if($this->start!='' && $this->end!=''){
			//$cond.= ' AND RealStart between ? AND ?';
			//$cond.= ' AND (RealStart between ? AND ? or Start between ? AND ? or RealDeadline between ? AND ?)';
			$cond.= ' AND Deadline between ? AND ?';
			$para[] = $this->start;
			$para[] = $this->end;
		}
		
		$field = $returntotal?'count(*) as total':'*';
		$func = $returntotal?'returnVec':'returnRes';
		$sql = 'SELECT
					'.$field.'
				FROM
					'.$this->table['mytask'].'
				WHERE
					UserID = ?
				'.$cond.'
				ORDER BY Status desc,
											
				TaskID desc';
		
		/*ORDER BY Status desc,
				RealDeadline,
				CASE WHEN Deadline not in("","0000-00-00 00:00:00") then Deadline else 9999999 end,										
				TaskID desc';*/
		
		return $DB->$func($sql,$para);
	}
	
	function getMyTaskitemPost(){
		global $DB;
		
		$sql = "SELECT * FROM ".$this->table['mytaskpost']." WHERE TaskID = ? AND UserID = ? AND Status = ? ORDER BY Timeinput";
		
		$para[] = $this->taskid;
		$para[] = $_SESSION['user_id'];
		$para[] = self::active();
		
		return $DB->returnRes($sql,$para);
	}
	
	
	function addMyTaskList(){
		global $DB;
		$sql = "INSERT INTO 
					".$this->table['mytasklist']."
				SET
					UserID 		= ?,
					Name		= ?,
					TimeInput 	= now(),
					Timemodified= now()";
		$para[] = $_SESSION['user_id'];
		$para[] = $this->tasklistname;
		
		return $DB->db_db_query($sql,$para);
	}
	
	function addMyTask(){
		global $DB;
		$sql = "INSERT INTO
					".$this->table['mytask']."
				SET
					UserID 		= ?,
					Name		= ?,
					ListID	= ?,
					TimeInput 	= now(),
					Timemodified= now()";
		$para[] = $_SESSION['user_id'];
		$para[] = $this->taskname;
		
		$para[] = $this->listid;
		return $DB->db_db_query($sql,$para);
	}
	
	function updateTaskDetail(){
		global $DB;
		$sql = "UPDATE ".$this->table['mytask']." SET Name = ? , Objective = ?, Date = ?, Start = ?, Deadline = ?, RealStart = ?, RealDeadline = ?, Status = ?, TimeModified = now() WHERE TaskID = ? AND UserID = ?";
		
		
		$para[] = $this->taskname;
		$para[] = $this->objective;
		$para[] = $this->date;
		$para[] = $this->start;
		$para[] = $this->deadline;
		$para[] = $this->realstart;
		$para[] = $this->realdeadline;
		$para[] = $this->taskstatus;
		$para[] = $this->taskid;
		$para[] = $_SESSION['user_id'];
		
		return $DB->db_db_query($sql,$para);
	}
	
	function removeMyTask(){
		global $DB;
		$sql = "UPDATE ".$this->table['mytask']." SET Status =?, TimeModified = now() WHERE TaskID =? AND UserID =?";
		$para[] = self::deleted();
		$para[] = $this->taskid;
		$para[] = $_SESSION['user_id'];
		
		return $DB->db_db_query($sql,$para);
	}
	
	function archiveMyTask(){
		global $DB;
		$sql = "UPDATE ".$this->table['mytask']." SET Status =?, TimeModified = now() WHERE TaskID =? AND UserID =?";
		$para[] = self::archived();
		$para[] = $this->taskid;
		$para[] = $_SESSION['user_id'];
		
		return $DB->db_db_query($sql,$para);
	}
	
	function unarchiveMyTask(){
		global $DB;
		$sql = "UPDATE ".$this->table['mytask']." SET Status =?, TimeModified = now() WHERE TaskID =? AND UserID =?";
		$para[] = self::active();
		$para[] = $this->taskid;
		$para[] = $_SESSION['user_id'];
	
		return $DB->db_db_query($sql,$para);
	}
	
	function removeMyTaskList(){
		global $DB;
		$sql = "UPDATE ".$this->table['mytasklist']." SET Status =?, TimeModified = now() WHERE ListID =? AND UserID =?";
		$para[] = self::listdeleted();
		$para[] = $this->listid;
		$para[] = $_SESSION['user_id'];
		
		return $DB->db_db_query($sql,$para);
	}
	
	function renameMyTaskList(){
		global $DB;
		$sql = "UPDATE ".$this->table['mytasklist']." SET Name =?, TimeModified = now() WHERE ListID =? AND UserID =?";
		$para[] = $this->listname;
		$para[] = $this->listid;
		$para[] = $_SESSION['user_id'];
	
		return $DB->db_db_query($sql,$para);
	}
	
	function submitTaskPost(){
		global $DB;
		$sql = "INSERT INTO
					".$this->table['mytaskpost']."
				SET
					TaskID		= ?,
					UserID 		= ?,
					Text		= ?,
					TimeInput 	= now(),
					Timemodified= now()";
	
		$para[] = $this->taskid;
		$para[] = $_SESSION['user_id'];
		$para[] = $this->tasktext;
		
		return $DB->db_db_query($sql,$para);
	}
	
	function getTasklist(){
		global $DB;
		$sql = "SELECT l.Name,l.ListID FROM ".$this->table['mytask']." as t INNER JOIN ".$this->table['mytasklist']." as l ON l.ListID = t.ListID WHERE t.TaskID=?";
		if($obj = $DB->returnVec($sql,array($this->taskid))){
			return $obj;
		}
	}
	
	function displayDeadline($deadline){
		list($deadlinedate,$deadlinetime) = explode(" ",$deadline);
		if($deadlinetime=='00:00:00')
			return $deadlinedate;
		else
			return display::displaydatetime($deadline);  
	}
}
?>