<?php

class CalendarController extends Application
{
	
	
	function __construct($args)
	{
		$this->args = $args;
	}
	

	function calendar(){
		global $Admin_Lang;
		
		$eventid = filter::optional_param('id',0,PARAM_INT);
		
		$classname = $this->Load_Model("access");
		$AccessControl = new $classname();
		$AccessControl->handleAccess('calendar','list');
		
		$classname = $this->Load_Model("user");
		$UserModel = new $classname();

		$classname = $this->Load_Model("calendar");
		$CalendarModel = new $classname();
		
		list($roleid) = $UserModel->getMyRole();
		$Data['userfilteroption'] = $UserModel->getActiveStaffs();
		
		$Data['itemcolor'] = $colorobj = $this->getItemColor();
		$Data['itemfilter'] = array('mytask','event');
		
		if($eventid!=''){
			$CalendarModel->id = $eventid; 
			if($event = $CalendarModel->getEventDetail()){
				$Data['gotodate'] = display::displayDate($event['Start']);
				$Data['eventid'] = $CalendarModel->id;
			}	
		}
		
		$Data['filteruser'] = $UserModel->isSA()||$UserModel->isAdmin()||$UserModel->isSuperuser();
		
		$this->Load_View('calendar/calendar', $Data);
	}
	
	function getItemColor(){
		return array('mytask'=>'#447DAD','event'=>'#1BBC9B');
	}
	
	function ajax_getdata(){
		
		global $Admin_Lang;
		
		$classname = $this->Load_Model("access");
		$AccessControl = new $classname();
		$AccessControl->handleAccess('calendar','list');
		
		$classname = $this->Load_Model("task");
		$TaskModel = new $classname();
		
		$return = array();
		$colorobj = $this->getItemColor();

		$showmytask = filter::optional_param('mytaskfilter',0,PARAM_INT);
		$showevent = filter::optional_param('eventfilter',1,PARAM_INT);
		if($showmytask){
			$TaskModel->start = filter::required_param('start',PARAM_TEXT);
			$end = filter::required_param('end',PARAM_TEXT);
			$TaskModel->end = $end.' 00:00:00';
			if($personal = $TaskModel->getMyTaskitem(1)){
				foreach($personal as $key=>$val){
					list($Deadline,$Deadlinetime) = explode(" ",$val['Deadline']);
					$obj = array("id"=>$val['TaskID'],"title"=>$val['Name'],"start"=>$val['Deadline'],"color"=>$colorobj['mytask'],"class"=>'mytask',"Description"=>'');
					if($Deadlinetime=='00:00:00'||$Deadlinetime=='')
						$obj['allDay'] = 1;
					$return[] = $obj;
				}
			}
		}
		if($showevent){
			$classname = $this->Load_Model("calendar");
			$CalendarModel = new $classname();
			
			$CalendarModel->startdate = filter::required_param('start',PARAM_TEXT);
			$CalendarModel->enddate = filter::required_param('end',PARAM_TEXT);
			$CalendarModel->enddate .= ' 00:00:00';
			if($event = $CalendarModel->getEventitem()){
				foreach($event as $key=>$val){
					list($Deadline,$Deadlinetime) = explode(" ",$val['Deadline']);
					$obj = array("id"=>$val['ID'],"title"=>$val['Name'],"start"=>$val['Start'],"end"=>$val['End'],"color"=>$colorobj['event'],"class"=>'event',"Description"=>display::displayTime($val['Start']).' '.$Admin_Lang['to'].' '.display::displayTime($val['End']));
					if($val['IsAllDay'])
						$obj['allDay'] = 1;
					$return[] = $obj;
				}
			}
		}
		echo json_encode($return);
	}
	
	function isAllDay($date){
		return strpos($date,'00:00:00')==true;
	}
	
	function ajax_addeventform(){
		global $Admin_Lang;

		$classname = $this->Load_Model("access");
		$AccessControl = new $classname();
		$AccessControl->handleAccess('calendar','addevent');
		
		echo json_encode(array('html'=>$this->In_To_String('calendar/addeventform', $Data)));
	}
	
	function ajax_editeventform(){
		$classname = $this->Load_Model("access");
		$AccessControl = new $classname();
		$AccessControl->handleAccess('calendar','updateevent');
	
		$classname = $this->Load_Model("calendar");
		$CalendarModel = new $classname();
	
		$CalendarModel->id = filter::required_param('eventid',PARAM_INT);
		if($event = $CalendarModel->getEventDetail()){
			list($Data['start'],$Data['starttime']) = explode(" ",$event['Start']);
			list($Data['end'],$Data['endtime']) = explode(" ",$event['End']);
			$Data['name'] = $event['Name'];
			$Data['description'] = $event['Description'];
			$Data['hidetime'] = $Data['starttime']=='00:00:00' && $Data['endtime']=='00:00:00';
			
		}
		echo json_encode(array('html'=>$this->In_To_String('calendar/editeventform', $Data)));
	}
	
	function ajax_addevent(){
		global $Admin_Lang;

		$classname = $this->Load_Model("access");
		$AccessControl = new $classname();
		$AccessControl->handleAccess('calendar','addevent');
		
		$classname = $this->Load_Model("calendar");
		$CalendarModel = new $classname();
		
		$CalendarModel->startdate = filter::required_param('start',PARAM_DATE);
		$CalendarModel->enddate = filter::required_param('end',PARAM_DATE);
		$CalendarModel->isallday = filter::required_param('allday',PARAM_INT);
		$CalendarModel->name = filter::required_param('name',PARAM_TEXT);
		$CalendarModel->description = filter::required_param('desc',PARAM_TEXT);
		
		$allday = filter::optional_param('allday',0,PARAM_INT);
		
		if($allday){
			$CalendarModel->starttime = '00:00:00';
			$CalendarModel->endtime = '00:00:00';
		}else{
			$CalendarModel->starttime = filter::required_param('starttime',PARAM_TIME);
			$CalendarModel->endtime = filter::required_param('endtime',PARAM_TIME);
		}
		
		if($CalendarModel->addEvent(1))
			echo json_encode(array('status'=>'ok','msg'=>$Admin_Lang['growl']['event_added']));
		else
			echo json_encode(array('status'=>'ok','msg'=>$Admin_Lang['growl']['event_addfailed']));
	}
	
	function ajax_geteventdetail(){
		global $Admin_Lang;
		
		$classname = $this->Load_Model("access");
		$AccessControl = new $classname();
		$AccessControl->handleAccess('calendar','list');
		
		$classname = $this->Load_Model("calendar");
		$CalendarModel = new $classname();
		
		$CalendarModel->id = filter::required_param('eventid',PARAM_INT);
		if($event = $CalendarModel->getEventDetail()){
			$Data = $event;
			$Data['CanEdit'] = $event['UserID']==$_SESSION['user_id'];
		}
		echo json_encode(array('html'=>$this->In_To_String('calendar/vieweventdetail', $Data)));
	}
	
	function ajax_updateevent(){
		global $Admin_Lang;
		
		$classname = $this->Load_Model("access");
		$AccessControl = new $classname();
		$AccessControl->handleAccess('calendar','updateevent');
		
		$classname = $this->Load_Model("calendar");
		$CalendarModel = new $classname();
		$CalendarModel->id = filter::required_param('id',PARAM_INT);
		$CalendarModel->startdate = filter::required_param('start',PARAM_DATE);
		$CalendarModel->enddate = filter::required_param('end',PARAM_DATE);
		$CalendarModel->isallday = filter::required_param('allday',PARAM_INT);
		$CalendarModel->name = filter::required_param('name',PARAM_TEXT);
		$CalendarModel->description = filter::required_param('desc',PARAM_TEXT);
		
		$allday = filter::optional_param('allday',0,PARAM_INT);
		if($allday){
			$CalendarModel->starttime = '00:00:00';
			$CalendarModel->endtime = '00:00:00';
		}else{
			$CalendarModel->starttime = filter::required_param('starttime',PARAM_TIME);
			$CalendarModel->endtime = filter::required_param('endtime',PARAM_TIME);
		}
		
		if($CalendarModel->updateEvent())
			echo json_encode(array('status'=>'ok','msg'=>$Admin_Lang['growl']['event_updated']));
		else
			echo json_encode(array('status'=>'ok','msg'=>$Admin_Lang['growl']['event_updatefailed']));
	}
	
	function export(){
		
		global $Admin_Lang;
		
		$start = filter::required_param('currentviewstart',PARAM_TEXT);
		$type = filter::required_param('currentviewtype',PARAM_TEXT);
		$filteruserid = filter::optional_param('filteruserid','',PARAM_TEXT);
		
		list($year,$month,$day) = explode("-",$start);
		 
		switch($type){
			case 'month':
				$start = $year.'-'.$month.'-01';
				$end = getMonthLastday($start);
			break;
			case 'agendaWeek':
				$start = $year.'-'.$month.'-'.$day;
				$end = addDay($start,6,1);
			break;
			case 'agendaDay':
				$start = $year.'-'.$month.'-'.$day;
				$end = $start;
			break;
		}
		
		
		$classname = $this->Load_Model("access");
		$AccessControl = new $classname();
		$AccessControl->handleAccess('calendar','list');
		
		$classname = $this->Load_Model("calendar");
		$CalendarModel = new $classname();
		
		$CalendarModel->exportEvent($start,$end,$filteruserid);
		
	}
}
?>