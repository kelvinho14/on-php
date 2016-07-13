<?php
    
class ReportController extends Application
{
	function __construct($args){
		$this->args = $args;
	}
	
	function calendar(){
		global $Admin_Lang;
	
		$this->Load_Model("access");
		$AccessControl = new AccessControlModel();
		$AccessControl->handleAccess('report','calendar');
	
		$this->Load_Model("report");
		$ReportModel = new ReportModel();
	
		//for($a=0;$a<sizeof($Data["UserList"]);$a++){
		//$Data["UserList"][$a]['AvatarImage'] = '<img src="'.$UserModel->Get_Avatar_Path($Data["UserList"][$a]['UserID'],'t_'.$Data["UserList"][$a]['Avatar']).'">';
		//$Data["UserList"][$a]['AvatarImage'] = $UserModel->Get_Avatar_Path($Data["UserList"][$a]['UserID'],$Data["UserList"][$a]['Avatar']);
		//}
	
		$this->Load_View('report/calendar', $Data);
	
	}
	
	function ajax_timesheet(){
		//print_R($_POST);
		
		$this->Load_Model("access");
		$AccessControl = new AccessControlModel();
		$AccessControl->handleAccess('report','calendar');
		
		$event[] = array("id"=>"1","title"=>"New Event","start"=>"2015-12-14T00:01:00+01:30","end"=>"2015-01-14T00:01:00+05:30","allDay"=>false,"color"=>'#99ccff');
		$event[] = array("id"=>"2","title"=>"New Event","start"=>"2015-12-19 18:00:21","end"=>"2015-12-19 18:30:21","allDay"=>false,"color"=>'#cccccc');
		
		echo json_encode($event);
		
	}
	
	function ajax_timesheetdetail(){
		print_R($_GET);
	}
	
}	