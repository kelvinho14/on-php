<?php 
if(function_exists('preventDA')){
	preventDA();
}else{
	die;
}


$_PLUGIN['datatable'] = 1;

$_PAGE['jsfile'] = '/include/js/local/'.$CONFIG['local'].'/project/panel.js';

$_FOOTER['ready_js'] = 'Panel.init();';
$_FOOTER['ready_js'] .= 'Panel.initTable();';
//$_FOOTER['ready_js'] = 'App.init();';
 


include_once 'application/view/template/admin/admin_header.php';
?>

<!-- BEGIN CONTAINER -->
<div class="container">
	<!-- BEGIN CONTAINER -->
	<div class="page-container">

	<?php
	$_PAGE['sidebar_project']['channel'.$Data['channelid']] = 1;
	//include_once 'application/view/template/admin/admin_sidebar.php';
	$app = new Application(array());
	$app->Load_View('template/admin/admin_sidebar',$_PAGE);
	
	
	?>
	<form id="mainform" name="mainform" method="post"/>
		<div class="page-content-wrapper">
			<!-- BEGIN PAGE -->
			<div class="page-content">
				<!-- BEGIN PAGE CONTAINER-->
				
				<?php include_once 'application/view/template/admin/admin_style.php';?>
				<h3 class="page-title">
					<?php echo $Admin_Lang['projectmgt']?> <small></small>
				</h3>
				<div class="page-bar">
						<?php
						//.' ('.$Data['channelname'].')'
							$breadcrumb_arr = array (
									array (
											'name' => $Admin_Lang['projectmgt'],
									)
							);
							UIElementController::render ( "breadcrumb", $breadcrumb_arr );
							?>
				</div>
					<!-- END PAGE HEADER-->
					<!-- BEGIN PAGE CONTENT-->
					<div class="row">
					<div class="col-md-12">
					<div class="note bg-grey-steel">
						<h4>
							 <?php UIElementController::render ( "fa", array('fa'=>'lightbulb-o')); ?> <?php echo $Admin_Lang['tips']?>
						</h4>
						<p><?php echo $Admin_Lang['outreachform_guide']?></p>
						</div>
					</div>
					
					<div class="col-md-12">
						<!-- BEGIN EXAMPLE TABLE PORTLET-->
						
							
					<?php 
						//$input ['title'] = UIElementController::In_To_String ( "fa", array ('fa' => 'user') ).' '.$Admin_Lang['user'];
						$input ['bodyid'] = 'user';
						$input['action']['fullscreen'] = true;
						UIElementController::render ( "portlet_start", $input );
						unset ( $input );
 
						$dt_arr['table_id'] = 'tasklist_table';
						$dt_arr['column'] = array($Admin_Lang['tasktime'],$Admin_Lang['taskrecord'],$Admin_Lang['status'],$Admin_Lang['duration']);
						//if($Data['everyone'])
						{
							$dt_arr['column'][] = $Admin_Lang['user'];
						}
						
						for($a=0;$a<sizeof($Data['tasklist']);$a++){
							
							$canedittasktime = false;
							if($_ACCESS['project']['taskedit'] && ($Data['meonly']==false || $_SESSION['user_id']==$Data['tasklist'][$a]['UserID'])){
								$canedittasktime = true;
								$start = '<a href="'.$CONFIG['home_http'].'project/edittask?id='.$Data['tasklist'][$a]['ID'].'">'.display::displayDatetime($Data['tasklist'][$a]['Start']).'</a> '.ui::editBtn('&nbsp;',array('attr'=>array('class'=>'edittimebtn','data-id'=>$Data['tasklist'][$a]['ID'],'tooltiptitle'=>$Admin_Lang['edittasktime'])));
							}else{
								$start = display::displayDatetime($Data['tasklist'][$a]['Start']);
							}
							if($_ACCESS['project']['taskedit'])
								$outreachtask = '<a href="'.$CONFIG['home_http'].'project/viewtask/?id='.$Data['tasklist'][$a]['ID'].'">'.$Data['tasklist'][$a]['recordct'].'</a> '.ui::btn(ui::fa('pencil'),array('attr'=>array('class'=>'editoutreachbtn blue','data-id'=>$Data['tasklist'][$a]['ID'],'tooltiptitle'=>$Admin_Lang['editoutreach'])));
							else	
								$outreachtask = $Data['tasklist'][$a]['recordct'];
							
							
							
							$totalduration = array();
							$totaldurationdisplay = '';
							foreach($Admin_Lang['outreachtype'] as $data){
								if($Data['tasklist'][$a][$data['field']]!='')
									$totalduration[] = ui::fa($data['icon']).' ('.($Data['tasklist'][$a][$data['field']]).')';
							}
							
							
							if($canedittasktime){
								$status = '<a href="'.$CONFIG['home_http'].'project/edittask?id='.$Data['tasklist'][$a]['ID'].'">'.($_SESSION['user_id']==$Data['tasklist'][$a]['UserID']?$Admin_Lang['warning_duration_empty']:$Admin_Lang['durationnotyetentered']).'</a>';
							}else{
								$status = $Admin_Lang['durationnotyetentered'];
							}
							
							
							if(sizeof($totalduration)>0){
								$totaldurationdisplay = implode("&nbsp;|&nbsp;",$totalduration);
							
								if($Data['meonly']==false || $_SESSION['user_id']==$Data['tasklist'][$a]['UserID']){
									$status = '<input type="checkbox" onChange="Panel.changeTaskStatus($(this).prop(\'checked\'),'.$Data['tasklist'][$a]['ID'].')" class="make-switch" data-on-color="success" data-off-color="warning" '.($Data['tasklist'][$a]['Status']==STATUS_DRAFTTASK?'':'checked').' data-on-text="'.$Admin_Lang['finished'].'" data-off-text="'.$Admin_Lang['drafting'].'">';
								}else{
									$status = $Data['tasklist'][$a]['Status']==STATUS_DRAFTTASK?$Admin_Lang['drafting']:$Admin_Lang['finished'];
								}
							}
							
							//display::minutesToHr($Data['tasklist'][$a]['totaldurationminutes']
							$dt_arr['data'][$a] = array(	 
									array('data'=>$Data['tasklist'][$a]['ID'],'name'=>'TaskID[]'),
									array('data'=>$start),
									array('data'=>$outreachtask),
									array('data'=>$status),
									array('data'=>$totaldurationdisplay),
							);
							//if($Data['everyone']){
								$dt_arr['data'][$a][] = array('data'=>$Data['tasklist'][$a]['Staffname']);
								
							//}
						}
						if($_ACCESS['project']['taskadd'])
							$dt_arr['btn'] = ui::addBtn('',array('id'=>'addtask'));
						if($_ACCESS['project']['taskedit']){
							$dt_arr['btn'] .= ui::removeBtn('',array('id'=>'removetask','attr'=>array('data-checkempty'=>$Admin_Lang['select_atleast_one_task'],'data-confirmmsg'=>$Admin_Lang['confirm_remove_task'])));
						}
							UIElementController::render("datatable",$dt_arr);
						
						
						UIElementController::render("portlet_end");
						?>
						 
						
						<!-- END EXAMPLE TABLE PORTLET-->
					</div>
				</div>

					<!-- END PAGE CONTENT-->
				</div>
				<!-- END PAGE CONTAINER-->
			</div>
			<!-- END PAGE -->
		</div>
	
	<!-- END CONTAINER -->

	</form>
	<?php
	
	include_once 'application/view/template/admin/admin_footer.php';
	?>