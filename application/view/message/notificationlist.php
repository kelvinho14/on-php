<?php 
if(function_exists('preventDA')){
	preventDA();
}else{
	die;
}


//$_PAGE['jsfile'] = '/include/js/user/add.js';
//$_FOOTER['ready_js'] .= 'User.init();';
$_PLUGIN['timeline'] = 1;


include_once 'application/view/template/admin/admin_header.php';
?>

<!-- BEGIN CONTAINER -->
<div class="container">
	<!-- BEGIN CONTAINER -->
	<div class="page-container">

	<?php
	//$_PAGE['sidebar_dashboard'] = 1;

	$app = new Application(array());
	$app->Load_View('template/admin/admin_sidebar',$_PAGE);
	?>
		<div class="page-content-wrapper">
			<!-- BEGIN PAGE -->
			<div class="page-content">
				<!-- BEGIN PAGE CONTAINER-->
			<?php include_once 'application/view/template/admin/admin_style.php';?>
				<h3 class="page-title">
				<?php echo $Admin_Lang['add_user']?>
				</h3>
				<div class="page-bar">

				<?php
				$breadcrumb_arr = array (
				array (
											'name' => $Admin_Lang['usermgt'],
											'link' => '/user/viewlist'
											),
											array (
											'name' => $Admin_Lang['add_user'] 
											)
											);
											UIElementController::render ( "breadcrumb", $breadcrumb_arr );
											?>
				</div>
				<!-- END PAGE HEADER-->
				<!-- BEGIN PAGE CONTENT-->
				<div class="timeline">
					<?php
						$count = sizeof($Data['notification']); 
						for($a=0;$a<$count;$a++){
						list($icon,$message,$time,$title) = display::renderNotification($Data['notification'][$a],1);
							?>
					<div class="timeline-item">
						<div class="timeline-badge">
							<div class="timeline-icon">
								<?php echo $icon?>
							</div>
						</div>
						<div class="timeline-body">
							<div class="timeline-body-arrow"></div>
							<div class="timeline-body-head">
								<div class="timeline-body-head-caption">
									<span class="timeline-body-alerttitle font-red-intense"><?php echo $title?></span> 
									<span class="timeline-body-time font-grey-cascade"><?php echo $time?></span>
								</div>
								<div class="timeline-body-head-actions">
									<div class="btn-group">
										<button
											class="btn btn-circle grey-salsa btn-sm dropdown-toggle"
											type="button" data-toggle="dropdown" data-hover="dropdown"
											data-close-others="true">
											Actions <i class="fa fa-angle-down"></i>
										</button>
										<ul class="dropdown-menu pull-right" role="menu">
											<li><a href="javascript:;">Action </a>
											</li>
											<li><a href="javascript:;">Another action </a>
											</li>
											<li><a href="javascript:;">Something else here </a>
											</li>
											<li class="divider"></li>
											<li><a href="javascript:;">Separated link </a>
											</li>
										</ul>
									</div>
								</div>
							</div>
							<div class="timeline-body-content">
								<span class="font-grey-cascade"> <?php echo $message?></span>
							</div>
						</div>
					</div>
					<?php }?>
				</div>
				<!-- END PAGE CONTAINER-->
			</div>
			<!-- END PAGE -->
		</div>
	</div>

	<!-- END CONTAINER -->

	<?php
	include_once 'application/view/template/admin/admin_footer.php';
	?>