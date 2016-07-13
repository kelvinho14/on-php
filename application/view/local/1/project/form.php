<?php 
if(function_exists('preventDA')){
	preventDA();
}else{
	die;
}


$_PLUGIN['editable'] = 1;
$_PLUGIN['dropzone'] = 1;
$_PLUGIN['fileinput'] = 1;
$_PLUGIN['datepicker'] = 1;
$_PLUGIN['timepicker'] = 1;
$_PLUGIN['checksave'] = 1;
$_PAGE['jsfile'] = '/include/js/local/'.$CONFIG['local'].'/project/apps_form.js';
//$_PAGE['cssfile'] = '/include/css/project/panel.css';

$_FOOTER['ready_js'] .= 'Panel.init();';

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
		<div class="page-content-wrapper">
			<!-- BEGIN PAGE -->
			<div class="page-content">
				<!-- BEGIN PAGE CONTAINER-->
				
				<?php include_once 'application/view/template/admin/admin_style.php';?>
				<h3 class="page-title">
				<?php echo $Admin_Lang['projectmgt'].' - '.$Data['typename'] ?>
				</h3>
				<div class="page-bar">

							<?php
							$breadcrumb_arr = array (
									array (
											'name' => 'Project',
											'link' => $CONFIG['home_http'].'project/list'
									),
									array (
											'name' => $Admin_Lang['projectmgt'].' - '.$Data['typename'] 
									) 
							);
							UIElementController::render ( "breadcrumb", $breadcrumb_arr );
							?>
				</div>
				<!-- END PAGE CONTENT-->
				<?php include_once($Data['formfile'])?>
				
			</div>
				<!-- END PAGE CONTAINER-->
		</div>
			<!-- END PAGE -->
	</div>
	
	<!-- END CONTAINER -->
	
	<?php
	
	include_once 'application/view/template/admin/admin_footer.php';
	?>