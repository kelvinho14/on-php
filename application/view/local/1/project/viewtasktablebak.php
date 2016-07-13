<?php 
if(function_exists('preventDA')){
	preventDA();
}else{
	die;
}

$_PLUGIN['datatable'] = 1;
$_PAGE['jsfile'] = 'include/js/project/viewtask.js';

$_FOOTER['ready_js'] = 'Task.init();';
$_FOOTER['ready_js'] .= 'Task.initTable();';

include_once 'application/view/template/admin/admin_header.php';
?>

<!-- BEGIN CONTAINER -->
<div class="container">
	<!-- BEGIN CONTAINER -->
	<div class="page-container">
	<?php
	$_PAGE['sidebar_user']['view'] = 1;
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
					<?php echo $Admin_Lang['usermgt']?> <small></small>
				</h3>
				<div class="page-bar">
						<?php
							$breadcrumb_arr = array (
									array (
											'name' => $Admin_Lang['task'],
											'link' => $CONFIG['home_http'].'project/panel/?cid='.$Data['channelid']
									),
									array (
											'name' => $Admin_Lang['taskdetail'],
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
						//$input ['title'] = UIElementController::In_To_String ( "fa", array ('fa' => 'user') ).' '.$Admin_Lang['user'];
						$input ['bodyid'] = 'user';
						$input['action']['fullscreen'] = true;
						UIElementController::render ( "portlet_start", $input );
						unset ( $input );
 
						$size = sizeof($CONFIG['taskrecordfield'][$Data['channelid']]);
						$dt_arr['table_id'] = 'records_table';
						for($ct=0;$ct<$size;$ct++){
							$dt_arr['column'][] = $CONFIG['taskrecordfield'][$Data['channelid']][$ct];
						}
						//$dt_arr['column'] = array($Admin_Lang['channel'],$Admin_Lang['taskstart'],$Admin_Lang['task_duration']);
						
						
						for($a=0;$a<sizeof($Data['records']);$a++){
							
							/*$dt_arr['data'][] = array(	 
									array('data'=>$Data['records'][$a]['ID'],'name'=>'RecordID[]'),
									array('data'=>$Data['records'][$a]['Name'],'url'=>$CONFIG['home_http'].'project/viewtask/?id='.$Data['records'][$a]['ID']),
									array('data'=>$Data['records'][$a]['Start']),
									array('data'=>$Data['records'][$a]['Duration']),
							);*/
							$fieldsarr[] = array('data'=>$Data['records'][$a]['ID'],'name'=>'RecordID[]');
							for($ct=0;$ct<$size;$ct++){
								$fieldsarr[] = array('data'=>$Data['records'][$a][$CONFIG['taskrecordfield'][$Data['channelid']][$ct]]);
							}
							
							$dt_arr['data'][] = $fieldsarr;
						}
						
						$dt_arr['btn'] = ui::addBtn('',array('id'=>'adduser'));
						//print_R($dt_arr);die;
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