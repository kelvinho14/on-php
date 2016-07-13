<?php 
if(function_exists('preventDA')){
	preventDA();
}else{
	die;
}


$_PLUGIN['datatable'] = 1;
$_PLUGIN['modal'] = 1;
$_PAGE['jsfile'] = '/include/js/project/taskcodelist.js';

$_FOOTER['ready_js'] = 'TaskCode.initTable();';
$_FOOTER['ready_js'] .= 'TaskCode.initButton();';
//$_FOOTER['ready_js'] = 'App.init();';
 


include_once 'application/view/template/admin/admin_header.php';
?>

<!-- BEGIN CONTAINER -->
<div class="container">
	<!-- BEGIN CONTAINER -->
	<div class="page-container">

	<?php
	$_PAGE['sidebar_project']['taskcodelist'] = 1;
	$app = new Application(array());
	$app->Load_View('template/admin/admin_sidebar',$_PAGE);
	
	
	?>
	<form id="mainform" name="mainform" method="post"/>
		<div id="taskcodemodal" class="modal fade" tabindex="-1" data-keyboard="false" data-backdrop="static"></div>
		<div class="page-content-wrapper">
			<!-- BEGIN PAGE -->
			<div class="page-content">
				<!-- BEGIN PAGE CONTAINER-->
				
				<?php include_once 'application/view/template/admin/admin_style.php';?>
				<h3 class="page-title">
					<?php echo $Admin_Lang['taskcodemgt']?> <small></small>
				</h3>
				<div class="page-bar">
						<?php
							$breadcrumb_arr = array (
									array (
											'name' => $Admin_Lang['taskcodemgt'],
									)
							);
							UIElementController::render ( "breadcrumb", $breadcrumb_arr );
							?>
				</div>
					<!-- END PAGE HEADER-->
					<!-- BEGIN PAGE CONTENT-->
					<div class="row">
					<div class="col-md-12">
						<!-- BEGIN EXAMPLE TABLE PORTLET-->
						
							
					<?php 

						
							$input['action']['fullscreen'] = true;
							
							UIElementController::render ( "portlet_start", $input );
							unset ( $input );
	 
							$dt_arr['table_id'] = 'taskcodelist_table';
							$dt_arr['column'] = array($Admin_Lang['taskcode'],$Admin_Lang['description'],$Admin_Lang['sexual_discussion'],$Admin_Lang['volunteer'],$Admin_Lang['status'],$Admin_Lang['create_time']);
							for($a=0;$a<sizeof($Data['TaskCodelist']);$a++){
								$dt_arr['data'][] = array(	 
										array('data'=>$Data['TaskCodelist'][$a]['ID'],'name'=>'TaskCodeID[]'),
										array('data'=>$Data['TaskCodelist'][$a]['Name'],'url'=>'javascript:TaskCode.edit('.$Data['TaskCodelist'][$a]['ID'].')'),
										array('data'=>$Data['TaskCodelist'][$a]['Description']),
										array('data'=>$Data['TaskCodelist'][$a]['Discussion']?$Admin_Lang['yes']:$Admin_Lang['no']),
										array('data'=>$Data['TaskCodelist'][$a]['Volunteer']?$Admin_Lang['yes']:$Admin_Lang['no']),
										array('data'=>$Data['TaskCodelist'][$a]['Status']==STATUS_ACTIVETASKCODE?UIElementController::In_To_String("span",array('value'=>$Admin_Lang['active'],'attr'=>array('class'=>'label label-sm label-success'))):UIElementController::In_To_String("span",array('value'=>$Admin_Lang['inactive'],'attr'=>array('class'=>'label label-sm label-danger')))),
										array('data'=>display::dayAgo($Data['TaskCodelist'][$a]['TimeInput']))
								);
							}
							$dt_arr['btn'] = ui::addBtn('',array('id'=>'addtaskcode'));
							if($ct==0){
								$dt_arr['btn'] .= ui::removeBtn('',array('id'=>'removetaskcode','attr'=>array('data-checkempty'=>$Admin_Lang['select_atleast_one_user'],'data-confirmmsg'=>$Admin_Lang['confirm_remove_user'])));
								$dt_arr['btn'] .= ui::activateBtn('',array('id'=>'activatetaskcode','attr'=>array('data-checkempty'=>$Admin_Lang['select_atleast_one_user'],'data-confirmmsg'=>$Admin_Lang['confirm_activate_user'])));
								$dt_arr['btn'] .= ui::deactivateBtn('',array('id'=>'deactivatetaskcode','attr'=>array('data-checkempty'=>$Admin_Lang['select_atleast_one_user'],'data-confirmmsg'=>$Admin_Lang['confirm_deactivate_user'])));
							}
							
							UIElementController::render("datatable",$dt_arr);
							unset($dt_arr);
							
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
	<input type="hidden" id="loadmsg" value="<?php echo $Admin_Lang['loading']?>"/> 
	</form>
	<?php
	
	include_once 'application/view/template/admin/admin_footer.php';
	?>