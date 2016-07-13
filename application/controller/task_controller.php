<?php

class TaskController extends Application
{
	function __construct($args)
	{
		$this->args = $args;
	}

	
	function mytask(){
		
		global $Admin_Lang;
		
		$classname = $this->Load_Model("task");
		$TaskModel = new $classname();
		
		$classname = $this->Load_Model("access");
		$AccessControl = new $classname();
		$AccessControl->handleAccess('task','mytask');
		
		$Data['prjlist'] = $TaskModel->Get_MyPrjTasklist();
		$Data['mytasklist'] = $TaskModel->Get_MyTasklist();
		
		
		$type = filter::optional_param('type','',PARAM_TEXT);
		$id = filter::optional_param('id','',PARAM_INT);
		
		if($type=='mytask'&&$id!=''){
			$TaskModel->taskid = $id;
			if($tasklist = $TaskModel->getTasklist()){
				//$Data['js'] = "Task.focusMylist(".$tasklist['ListID'].",'".$tasklist['Name']."');";
				$Data['js'] = "$('#mytasklist".$tasklist['ListID']."').trigger('click');";
				$Data['js'] .= "setTimeout(function(){
  									$('#mytaskitem".$TaskModel->taskid."').trigger('click');
								}, 1000);";
				
			}
		}
		
		$this->Load_View('task/mytask', $Data);
	}
	
	function myviewtask(){
	
		global $Admin_Lang,$CONFIG;
	
		$classname = $this->Load_Model("task");
		$TaskModel = new $classname();
	
		$classname = $this->Load_Model("access");
		$AccessControl = new $classname();
		$AccessControl->handleAccess('task','mytask');
	
		$classname = $this->Load_Model("user");
		$UserModel = new $classname();
	
		$tasks = $TaskModel->getMyTask();
		$Data['tasklist'] = $tasks;
		$this->Load_View('project/panel', $Data);
	
	}
	
	function viewtask(){
	
		global $Admin_Lang,$CONFIG;
	
		
		$classname = $this->Load_Model("access");
		$AccessControl = new $classname();
		$AccessControl->handleAccess('task','taskedit');
		
		$classname = $this->Load_Model("user");
		$UserModel = new $classname();
		$classname = $this->Load_Model("task");
		$TaskModel = new $classname();
		
		$TaskModel->setJobTaskID(filter::required_param('id',PARAM_INT));
		//$TaskModel->setChannelID(filter::required_param('cid',PARAM_INT));
		
		$Data['jobtaskid'] = $TaskModel->getJobTaskID();
		
		//if($UserModel->isSA()||$UserModel->isAdmin()||$UserModel->isSuperuser()){
		$Data['canedit'] = false;
		if($UserModel->isParttimeStaff()){
			$Data['parttimestaff'] = true;
			if($ismine=$TaskModel->getMyJobTaskRecord(1,1,1)){
				$Data['canedit'] = true;
			}
		}elseif($UserModel->isSA()||$UserModel->isAdmin()||$UserModel->isSuperuser()){
			$Data['canedit'] = true;
		}
			$Data['records'] = $TaskModel->getEveryoneJobTaskRecord(1,1,1,1);
			$task = $TaskModel->getEveryoneJobTask();
		/*}else{
			$Data['records'] = $TaskModel->getMyJobTaskRecord(1,1,1);
			$task = $TaskModel->getMyJobTask();
		}*/
		
		if($task==''){
			header("location:".$CONFIG['home_http']."user/dashboardlist");
		}
		
		$Data['addbtns'] = '<span>';
		if($Data['canedit']){
			if($channels = $TaskModel->getChannels()){
				foreach($channels as $k=>$v){
					$Data['addbtns'].= ui::addBtn($Admin_Lang['add'].'<i class="fa fa-'.$v['Icon'].' fa-2x"></i>',array('attr'=>array('class'=>'addrecordbtn','tooltiptitle'=>$Admin_Lang['add'].' '.$v['Name'].' '.$Admin_Lang['taskrecord'],'data-cid'=>$v['ID'])));
				}
			}
			$Data['addbtns'].= ui::editBtn($Admin_Lang['edittasktime'],array('id'=>'edittasktime'));
		}
		$Data['addbtns'].='</span>&nbsp;';
		
		
		
		//$Data['channelid'] = $TaskModel->getChannelID();
		$Data['taskname'] = $task['Start'];
		
		
		$channel = $TaskModel->getChannels();
		$Data['channelname'] = $channel['Name'];
		$Data['channelicon'] = $channel['Icon'];
		
		//$TaskModel->channelid = $task['ChannelID'];
		//$channel = $TaskModel->getChannels();
		
		//$Data['formfile'] = strtolower($channel['Name']).'_form';
		$Data['maxfilesize'] = $CONFIG['upload']['project']['maxsize'];
		if($channel = $TaskModel->getChannelToolsOption())
			$Data['channeltooloption'] = display::addSelectOption($channel);
		if($taskcodeoption = $TaskModel->getTaskcodeOption())
			$Data['taskcodeoption'] = display::addSelectOption($taskcodeoption);
		
		$this->Load_View('project/viewtask', $Data);
	
	}
	
	
	function ajax_tasklist(){
		$this->Load_View('project/task_tasklist', $Data);
	}
	function ajax_prjtaskitem(){
		global $Admin_Lang;
		
		$classname = $this->Load_Model("task");
		$TaskModel = new $classname();
		
		$TaskModel->projectid = filter::required_param('project_id',PARAM_INT);
		
		$Data['itemlist'] = $TaskModel->getProjectTaskitem();
		
		
		$this->Load_View('project/task_prjtaskitem', $Data);
	}
	
	
	
	function ajax_dashboard(){
		global $Admin_Lang;
		
		$classname = $this->Load_Model("task");
		$TaskModel = new $classname();
		$Data['mytasklist'] = $TaskModel->Get_MyTasklist();
		$Data['totaltask'] = $TaskModel->getMyTaskTotal(1);
		
		$TaskModel->listid = filter::required_param('listid',PARAM_INT);
		
		if($TaskModel->listid==0){
			$TaskModel->listid = $Data['mytasklist'][0]['ListID'];
			$Data['itemlistname'] = $Data['mytasklist'][0]['Name'];
			$Data['itemlisttotal'] = $Data['mytasklist'][0]['TaskNo'];
		}else{
			$size = sizeof($Data['mytasklist']);
			for($a=0;$a<$size;$a++){
				if($TaskModel->listid==$Data['mytasklist'][$a]['ListID']){
					$Data['itemlistname'] = $Data['mytasklist'][$a]['Name'];
					$Data['itemlisttotal'] = $Data['mytasklist'][$a]['TaskNo'];
					break;
				}
			}
		}
		$Data['itemlist'] = $TaskModel->getMyTaskitem();
		
		$tasksize = sizeof($Data['itemlist']);
		for($a=0;$a<$tasksize;$a++){
			$Data['itemlist'][$a]['DisplayDeadline'] = $TaskModel->displayDeadline($Data['itemlist'][$a]['Deadline']);
			$Data['itemlist'][$a]['ShowArchiveBtn'] = true;
			switch($Data['itemlist'][$a]['Status']){
				case $classname::archived():
					$Data['itemlist'][$a]['ShowArchiveBtn'] = false;
					//$badge_status = 'Archived';
				break;
			}
		}
		$Data['listid'] = $TaskModel->listid;
		
		echo json_encode(array('tile'=>$this->In_To_String('task/tile', $Data),'widget'=>$this->In_To_String('task/widget', $Data)));
	}
	
	function ajax_mytaskitem(){
		global $Admin_Lang;
		
		$classname = $this->Load_Model("task");
		$TaskModel = new $classname();
		
		$TaskModel->listid = filter::required_param('listid',PARAM_INT);
		$Data['listname'] = filter::required_param('listname',PARAM_TEXT);
		
		$Data['itemlist'] = $TaskModel->getMyTaskitem();
		
		$tasksize = sizeof($Data['itemlist']);
		for($a=0;$a<$tasksize;$a++){
		
			$Data['itemlist'][$a]['DisplayDeadline'] = $TaskModel->displayDeadline($Data['itemlist'][$a]['Deadline']);
			$Data['itemlist'][$a]['ShowArchiveBtn'] = true;
			switch($Data['itemlist'][$a]['Status']){
				case $classname::active():
					$Data['itemlist'][$a]['StatusClass'] = 'active';
					break;
				CASE $classname::pending():
					$Data['itemlist'][$a]['StatusClass'] = 'predict';
					break;
				case $classname::archived():
					$Data['itemlist'][$a]['StatusClass'] = 'archive';
					$Data['itemlist'][$a]['ShowArchiveBtn'] = false;
					break;
			}
			
			
			/*$Data['itemlist'][$a]['Start'] = display::date($Data['itemlist'][$a]['Start']);
			list($deadline,$deadlinetime) = explode(" ",$Data['itemlist'][$a]['Deadline']);
			$Data['itemlist'][$a]['Deadlinetime'] = $deadlinetime;
			$Data['itemlist'][$a]['Deadline'] = display::date($Data['itemlist'][$a]['Deadline']);
			$Data['itemlist'][$a]['p_fa'] = UIElementController::In_To_String ( "fa", array('fa'=>'road') );
				
			$Data['itemlist'][$a]['p_starttt'] = ui::tt('top','Predict Start');
			$Data['itemlist'][$a]['p_endtt'] = ui::tt('top','Predict End');
				
		
			
			$Data['itemlist'][$a]['r_start'] = display::date($Data['itemlist'][$a]['RealStart']);
			$Data['itemlist'][$a]['r_end'] = display::date($Data['itemlist'][$a]['RealDeadline']);
			//$Data['itemlist'][$a]['r_fa'] = UIElementController::In_To_String ( "fa", array('fa'=>'calendar') );
				
			$Data['itemlist'][$a]['r_starttt'] = ui::tt('top','Deadline');
			$Data['itemlist'][$a]['r_endtt'] = ui::tt('top','Actual End');
		
			$Data['itemlist'][$a]['ShowArchiveBtn'] = true;
			$Data['itemlist'][$a]['overdue'] = 'normal';
			switch($Data['itemlist'][$a]['Status']){
				case $classname::active():
					$Data['itemlist'][$a]['StatusClass'] = 'active';
					if(filter::isEmptyDate($Data['itemlist'][$a]['RealDeadline'])==false){
						if(timeDiff(date('Y-m-d H:i:s'),$Data['itemlist'][$a]['RealDeadline'])<0){
							$Data['itemlist'][$a]['StatusClass'] = 'overdue';
							$Data['itemlist'][$a]['overdue'] = 'overdue';
						}
					}
					
					//$badge_status = 'Active';
					break;
				CASE $classname::pending():
					$Data['itemlist'][$a]['StatusClass'] = 'predict';
					//$badge_status = 'Predict';
					break;
				case $classname::archived():
					$Data['itemlist'][$a]['StatusClass'] = 'archive';
					$Data['itemlist'][$a]['ShowArchiveBtn'] = false;
					//$badge_status = 'Archived';
					break;
			}*/
		}
		$Data['listid'] = $TaskModel->listid;
		$this->Load_View('task/mytaskitem', $Data);
	}
	
	function ajax_tasknew(){
		$this->Load_View('project/task_newtask', $Data);
	}
	
	function ajax_mytaskitemdetail(){
		global $Admin_Lang;
		
		$classname = $this->Load_Model("task");
		$TaskModel = new $classname();
		$TaskModel->taskid = filter::required_param('taskid',PARAM_INT);
		$Data['taskdetail'] = $TaskModel->getMyTaskitem();
		$Data['taskdetail'] = $Data['taskdetail'][0];
		list($Data['taskdetail']['Deadline'],$Data['taskdetail']['Deadlinetime']) = explode(" ",$Data['taskdetail']['Deadline']);
		$Data['taskid'] = $TaskModel->taskid;
		$Data['taskpost'] = $TaskModel->getMyTaskitemPost();
		$this->Load_View('task/mytaskitemdetail', $Data);
	}
	
	function ajax_projecttaskitemdetail(){
		global $Admin_Lang;
		
		$classname = $this->Load_Model("task");
		$TaskModel = new $classname();
		$TaskModel->taskid = filter::required_param('taskid',PARAM_INT);
		$Data['taskdetail'] = $TaskModel->getProjectTaskitem();
		$Data['taskdetail'] = $Data['taskdetail'][0];
		
		//$Data['taskid'] = $TaskModel->taskid;
		//$Data['taskpost'] = $TaskModel->getMyTaskitemPost();
		$this->Load_View('project/task_prjtaskitemdetail', $Data);
	}
	
	
	
	function ajax_addmytasklist(){
		global $Admin_Lang;
		
		$listname = filter::required_param('listname',PARAM_TEXT);
		
		$classname = $this->Load_Model("task");
		$TaskModel = new $classname();
		
		$TaskModel->tasklistname = $listname;
		if($TaskModel->addMyTaskList()){
			$Data['tasklist'] = $TaskModel->Get_MyTasklist();
			$this->Load_View('project/task_mytasklist', $Data);
		}
	}
	
	function ajax_loadmytasklist(){
		global $Admin_Lang;
		
		$classname = $this->Load_Model("task");
		$TaskModel = new $classname();
		
		$Data['listid'] = filter::optional_param('listid','',PARAM_INT);
		$Data['mytasklist'] = $TaskModel->Get_MyTasklist();
		$this->Load_View('project/task_mytasklist', $Data);
	}
	
	function ajax_addmytask(){
		global $Admin_Lang;
	
		$classname = $this->Load_Model("task");
		$TaskModel = new $classname();
		
		$TaskModel->listid = filter::required_param('listid',PARAM_INT);
		$TaskModel->taskname = filter::required_param('taskname',PARAM_TEXT);
	
		
	
		
		if($TaskModel->addMyTask()){
 			echo json_encode(array('msg'=>'Add','type'=>'success'));	
 		}else{
			echo json_encode(array('msg'=>'Failed','type'=>'warning'));
 		}
	}
	
	function ajax_savemytaskdetail(){
		global $Admin_Lang;
		
		$classname = $this->Load_Model("task");
		$TaskModel = new $classname();
		
		$TaskModel->taskid = filter::required_param('taskid',PARAM_INT);
		$TaskModel->taskname = filter::required_param('name',PARAM_TEXT);
		$TaskModel->objective = filter::optional_param('objective','',PARAM_TEXT);
		//$TaskModel->date = filter::optional_param('date','',PARAM_DATE);
		//$TaskModel->start = filter::optional_param('start','',PARAM_DATE);
		$TaskModel->deadline = filter::optional_param('deadline','',PARAM_DATE);
		$deadlinetime = filter::optional_param('deadlinetime','',PARAM_TIME);
		if($deadlinetime!='')
			$TaskModel->deadline.= ' '.$deadlinetime;
		
		//$TaskModel->realstart = filter::optional_param('realstart','',PARAM_DATE);
		//$TaskModel->realdeadline = filter::optional_param('realdeadline','',PARAM_DATE);
		$TaskModel->taskstatus = $TaskModel::active();
		/*if(!filter::isEmptyDate($TaskModel->realstart) && !filter::isEmptyDate($TaskModel->realdeadline)){
			$TaskModel->taskstatus = STATUS_ACTIVEMYTASK; 
		}else{
			$TaskModel->taskstatus = STATUS_PENDMYTASK;
		}*/
		
 		if($TaskModel->updateTaskDetail()){
 			echo json_encode(array('msg'=>'Updated','type'=>'success'));	
 		}else{
			echo json_encode(array('msg'=>'Failed','type'=>'warning'));
 		}
	}
	
	function ajax_removemytask(){
		global $Admin_Lang;
		
		$classname = $this->Load_Model("task");
		$TaskModel = new $classname();
		
		$TaskModel->taskid = filter::required_param('taskid',PARAM_INT);
		
		if($TaskModel->removeMyTask()){
			echo json_encode(array('msg'=>$Admin_Lang['task_removed'],'type'=>'success'));
		}else{
			echo json_encode(array('msg'=>$Admin_Lang['taskremove_failed'],'type'=>'warning'));
		}
	}
	
	function ajax_archivemytask(){
		global $Admin_Lang;
	
		$classname = $this->Load_Model("task");
		$TaskModel = new $classname();
	
		$TaskModel->taskid = filter::required_param('taskid',PARAM_INT);
	
		if($TaskModel->archiveMyTask()){
			echo json_encode(array('msg'=>$Admin_Lang['archived'],'type'=>'success'));
		}else{
			echo json_encode(array('msg'=>'Failed','type'=>'warning'));
		}
	}
	
	function ajax_unarchivemytask(){
		global $Admin_Lang;
	
		$classname = $this->Load_Model("task");
		$TaskModel = new $classname();
	
		$TaskModel->taskid = filter::required_param('taskid',PARAM_INT);
	
		if($TaskModel->unarchiveMyTask()){
			echo json_encode(array('msg'=>$Admin_Lang['unarchived'],'type'=>'success'));
		}else{
			echo json_encode(array('msg'=>'Failed','type'=>'warning'));
		}
	}
	
	function ajax_removemytasklist(){
		global $Admin_Lang;
		
		$classname = $this->Load_Model("task");
		$TaskModel = new $classname();
		
		$TaskModel->listid = filter::required_param('listid',PARAM_INT);
		
		if($TaskModel->removeMyTaskList()){
			echo json_encode(array('msg'=>'Removed','type'=>'success'));
		}else{
			echo json_encode(array('msg'=>'Failed','type'=>'warning'));
		}
	}
	
	function ajax_renamemytasklist(){
		global $Admin_Lang;
		
		$classname = $this->Load_Model("task");
		$TaskModel = new $classname();
		
		$TaskModel->listid = filter::required_param('pk',PARAM_INT);
		$field = filter::required_param('name',PARAM_TEXT);
		$TaskModel->listname = filter::required_param('value',PARAM_TEXT);
		
		if($field!='listname')
			MVC_Perform_Action("error", "Raise_Error", NULL, array($Lang['invalidfield']));
		
		if($TaskModel->renameMyTaskList()){
			echo json_encode(array('msg'=>'Updated','type'=>'success'));
		}else{
			echo json_encode(array('msg'=>'Failed','type'=>'warning'));
		}
	}
	
	function ajax_submitTaskPost(){
		global $Admin_Lang;
		
		$classname = $this->Load_Model("task");
		$TaskModel = new $classname();
		
		$TaskModel->taskid = filter::required_param('taskid',PARAM_INT);
		$TaskModel->tasktext = filter::required_param('text',PARAM_TEXT);
		
		if($TaskModel->submitTaskPost()){
			echo json_encode(array('msg'=>'Submitted','type'=>'success'));
		}else{
			echo json_encode(array('msg'=>'Failed','type'=>'warning'));
		}
	}
	
}
?>