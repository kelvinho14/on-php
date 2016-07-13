<?php 
if(function_exists('preventDA')){
	preventDA();
}else{
	die;
}

$_PLUGIN['datepicker'] = 1;
$_PLUGIN['timepicker'] = 1;

include_once 'application/view/template/admin/admin_header.php';
$_FOOTER['ready_js'] = 'Task.init();';
if($Data['js']!='')
$_FOOTER['ready_js'] .= $Data['js'];
$_PAGE['jsfile'] = 'task/task.js';
?>

<!-- BEGIN CONTAINER -->
<div class="container">
	<!-- BEGIN CONTAINER -->
	<div class="page-container">

	<?php
	$_PAGE['sidebar_mytask'] = 1;
	$app = new Application(array());
	$app->Load_View('template/admin/admin_sidebar',$_PAGE);
	?>
		<div class="page-content-wrapper">
			<!-- BEGIN PAGE -->
			<div class="page-content">
				<!-- BEGIN PAGE CONTAINER-->
				
				<h3 class="page-title">
				<?php echo $Admin_Lang['task']?>
				</h3>
				<div class="page-bar">

				<?php
				$breadcrumb_arr = array (
					array (
					'name' => $Admin_Lang['task'] 
					) 
					);
				UIElementController::render ( "breadcrumb", $breadcrumb_arr );
				?>
				</div>
					<!-- END PAGE HEADER-->
					<!-- BEGIN PAGE CONTENT-->
					<!-- BEGIN PAGE CONTENT-->
				<div class="row">
					<div class="col-md-12">
						<!-- BEGIN TODO SIDEBAR -->
						<div class="todo-sidebar" id="tasklist">
						<?php include_once('tasklist.php')?>
						</div>
						<!-- END TODO SIDEBAR -->
						<!-- BEGIN TODO CONTENT -->
						<div class="todo-content" id="taskitem">
							
						<?php //include_once('task_taskitem.php')?>
										
						</div>
						<!-- END TODO CONTENT -->
					</div>
				</div>
				
					
					
					<?php //include_once('panel_file.php')?>


					<!-- END PAGE CONTENT-->
				</div>
				<!-- END PAGE CONTAINER-->
			</div>
			<!-- END PAGE -->
		</div>
	
	<!-- END CONTAINER -->

	<?php
	// $_FOOTER['ready_js'] .= Display_Action_Msg ();
	
	include_once 'application/view/template/admin/admin_footer.php';
	?>