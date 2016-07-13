<?php 
if(function_exists('preventDA')){
	preventDA();
}else{
	die;
}


//$_PAGE['jsfile'] = '/include/js/user/add.js';
//$_FOOTER['ready_js'] .= 'User.init();';
$_PLUGIN['notification'] = 1;


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
				<?php echo $Admin_Lang['notification']?>
				</h3>
				<div class="page-bar">
				<?php
					$breadcrumb_arr = array (
						array (
							'name' => $Admin_Lang['notification'] 
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
							<?php if($Data['notification'][$a]['SenderProfilePic']!=''){?>
							<img src="<?php echo $Data['notification'][$a]['SenderProfilePic']?>" class="timeline-badge-userpic">
							<?php }?>
						</div>
						<div class="timeline-body">
							<div class="timeline-body-arrow"></div>
							<div class="timeline-body-head">
								<div class="timeline-body-head-caption">
									<span class="timeline-body-alerttitle font-red-intense"><?php echo $title?></span> 
									<span class="timeline-body-time font-grey-cascade"><?php echo $time?></span>
								</div>
							</div>
							<div class="timeline-body-content" style="margin-top:25px">
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