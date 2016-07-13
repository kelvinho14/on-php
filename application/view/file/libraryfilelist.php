<?php 
$dt_arr['table_id'] = 'filelist_table';
$dt_arr['column'] = array($Admin_Lang['file_name'],$Admin_Lang['file_size'],$Admin_Lang['status'],$Admin_Lang['upload_time'],$Admin_Lang['uploaded_by']);

for($a=0;$a<sizeof($Data['FileList']);$a++){
	$canedit = $Data['FileList'][$a]['UserID']==$_SESSION['user_id'];
	
	$file = $Data['FileList'][$a]['Realname'];
	$file.= '<br/>'.ui::downloadBtn('',array('attr'=>array('class'=>' downloadbtn btn-xs','data-id'=>$Data['FileList'][$a]['ID'])));
	//$file.= ui::viewbtn('',array('attr'=>array('class'=>' viewbtn btn-xs','data-id'=>$Data['FileList'][$a]['ID'])));
	$file.= ui::viewlinkbtn('',array('attr'=>array('class'=>' linkbtn btn-xs','data-id'=>$Data['FileList'][$a]['ID'])));
	$file.= ui::input($Data['FileList'][$a]['ID'].'_link',$CONFIG['home_http'].'file/download/?id='.$Data['FileList'][$a]['ID'].'&h='.$Data['FileList'][$a]['FileHash'],'form-control linkinput',array('style'=>'display:none'));
	
	if($canedit)
		$status = ui::checkbox('',1,$Data['FileList'][$a]['Status']==$Data['activestatus']?true:false,'make-switch',array('onChange'=>'Library.changeStatus($(this).prop(\'checked\'),'.$Data['FileList'][$a]['ID'].')','data-on-text'=>$Admin_Lang['publiced'],'data-off-text'=>$Admin_Lang['privated'],'data-on-color'=>'success','data-off-color'=>'warning'));
	else
		$status = $Data['FileList'][$a]['Status']==$Data['activestatus']?$Admin_Lang['publiced']:$Admin_Lang['privated']; 
	$dt_arr['data'][] = array(
			array('data'=>$canedit?$Data['FileList'][$a]['ID']:'','name'=>'FileID[]'),
			array('data'=>$file),
			array('data'=>Cal_Size_2_Unit($Data['FileList'][$a]['Filesize'])),
			//array('data'=>$Data['FileList'][$a]['Status']==USER_ACTIVE?UIElementController::In_To_String("span",array('value'=>$Admin_Lang['active'],'attr'=>array('class'=>'label label-sm label-success'))):UIElementController::In_To_String("span",array('value'=>$Admin_Lang['inactive'],'attr'=>array('class'=>'label label-sm label-danger')))),
			array('data'=>$status),
			array('data'=>$Data['FileList'][$a]['TimeInput'].' ('.display::dayAgo($Data['FileList'][$a]['TimeInput']).')'),
			array('data'=>$Data['FileList'][$a]['Owner'])
	);
}
//if($_ACCESS['user']['edit'])
	$dt_arr['btn'] .= ui::removeBtn('',array('id'=>'removefile','attr'=>array('data-checkempty'=>$Admin_Lang['select_atleast_one_file'],'data-confirmmsg'=>$Admin_Lang['confirm_remove_file'])));
UIElementController::render("datatable",$dt_arr);
?>