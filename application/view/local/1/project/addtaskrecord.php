<?php 
if(function_exists('preventDA')){
	preventDA();
}else{
	die;
}
$_PLUGIN['checksave'] = 1;
$_PLUGIN['datepicker'] = 1;
$_PLUGIN['timepicker'] = 1;
$_PLUGIN['dropzone'] = 1;
$_PAGE['jsfile'] = 'include/js/local/'.$CONFIG['local'].'/project/'.$Data['jsfile'];
$_FOOTER['ready_js'] = 'Record.init();';
include_once 'application/view/template/admin/admin_header.php';
?>

<!-- BEGIN CONTAINER -->
<div class="container">
	<!-- BEGIN CONTAINER -->
	<div class="page-container">
	<?php
	$_PAGE['sidebar_project'] = 1;
	//include_once 'application/view/template/admin/admin_sidebar.php';
	$app = new Application(array());
	$app->Load_View('template/admin/admin_sidebar',$_PAGE);
	
	
	?>
	
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
							$breadcrumb_arr = array (
									array (
											'name' => $Admin_Lang['projectmgt'],
											'link' => $CONFIG['home_http'].'project/panel/'
									),
									array (
											'name' => $Admin_Lang['taskdetail'].' ('.display::displayDatetime($Data['taskname']).')',
											'link' => $CONFIG['home_http'].'project/viewtask/?id='.$Data['jobtaskid']
									),
									array (
											'name' => ($Data['isedit']?$Admin_Lang['edit']:$Admin_Lang['add']).' '.ui::fa($Data['channelicon'].' fa-2x'),
									)
									
							);
							UIElementController::render ( "breadcrumb", $breadcrumb_arr );
							?>
				</div>
					<!-- END PAGE HEADER-->
					<!-- BEGIN PAGE CONTENT-->
					<?php include_once($Data['formfile'])?>

					<!-- END PAGE CONTENT-->
				</div>
				<!-- END PAGE CONTAINER-->
			</div>
			<!-- END PAGE -->
		</div>
	
	<!-- END CONTAINER -->
	
<?php
include_once 'application/view/template/admin/admin_footer.php';
?>