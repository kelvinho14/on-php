<?php 
if(function_exists('preventDA')){
	preventDA();
}else{
	die;
}

$_PAGE['jsfile'] = '/include/js/local/'.$CONFIG['local'].'/user/editprofile.js';
$_FOOTER['ready_js'] .= 'Profile.init();';

include_once 'application/view/template/admin/admin_header.php';
?>

<!-- BEGIN CONTAINER -->
<div class="container">
	<!-- BEGIN CONTAINER -->
	<div class="page-container">

	<?php
	$app = new Application(array());
	$app->Load_View('template/admin/admin_sidebar',$_PAGE);
	?>
		<div class="page-content-wrapper">
			<!-- BEGIN PAGE -->
			<div class="page-content">
				<!-- BEGIN PAGE CONTAINER-->
				<?php include_once 'application/view/template/admin/admin_style.php';?>
							<h3 class="page-title">
				<?php echo $Admin_Lang['myprofile']?>
				</h3>
				<div class="page-bar">

							<?php
							$breadcrumb_arr = array (
									array (
											'name' => $Admin_Lang['myprofile'],
									)
							);
							UIElementController::render ( "breadcrumb", $breadcrumb_arr );
							?>
				</div>
					<!-- END PAGE HEADER-->
					<!-- BEGIN PAGE CONTENT-->
					<form id="mainform" name="mainform" method="post" enctype="multipart/form-data" onsubmit="setFormSubmitting()">					
					<div class="row">
					<div class="col-md-12">
						<!-- BEGIN PROFILE SIDEBAR -->
						
						<!-- END BEGIN PROFILE SIDEBAR -->
						<!-- BEGIN PROFILE CONTENT -->
						<div class="profile-content">
							<div class="row">
								<div class="col-md-12">
									<div class="portlet light">
										<div class="portlet-title tabbable-line">
											<div class="caption caption-md">
												<i class="icon-globe theme-font hide"></i>
												<span class="caption-subject font-blue-madison bold uppercase"><?php echo $Admin_Lang['change_password']?></span>
											</div>
											<?php /*<ul class="nav nav-tabs">
												<li class="active">
													<a data-toggle="tab" href="#tab_1_1">Change Password</a>
												</li>
												
											</ul>*/?>
										</div>
										<div class="portlet-body">
											<div class="tab-content">
												<!-- PERSONAL INFO TAB -->
												<div id="tab_1_1" class="tab-pane active">
													<form method="post">
													<div class="portlet-body form">
														<div class="form-body">
														<div class="form-group form-md-line-input has-success">
															<div class="input-group input-group-sm">
															<div class="input-group-control">
																<label class="control-label"><?php echo $Admin_Lang['currentpassword']?></label>
																<?php 
																$input['attr']['class'] = 'form-control';
																$input['id'] = 'passwordc';
																$input['name'] = 'passwordc';
																$input['attr']['data-emptymsg'] = $Admin_Lang['warning_password_empty'];
																$input['attr']['data-notmatchmsg'] = $Admin_Lang['warning_password_notmatch'];
																UIElementController::render ( "password", $input );
																unset($input);
																?>
															</div>
															</div>
														</div>
														<div class="form-group form-md-line-input has-success">
															<div class="input-group input-group-sm">
															<div class="input-group-control">
																<label class="control-label"><?php echo $Admin_Lang['new_password']?></label>
																<?php 
																$input['attr']['class'] = 'form-control';
																$input['id'] = 'password1';
																$input['name'] = 'password1';
																$input['attr']['data-emptymsg'] = $Admin_Lang['warning_password_empty'];
																$input['attr']['data-notmatchmsg'] = $Admin_Lang['warning_password_notmatch'];
																UIElementController::render ( "password", $input );
																unset($input);
																?>
															</div>
															</div>
														</div>
														<div class="form-group form-md-line-input has-success">
															<div class="input-group input-group-sm">
															<div class="input-group-control">
																<label class="control-label"><?php echo $Admin_Lang['retype_password']?></label>
																<?php 
																$input['attr']['class'] = 'form-control';
																$input['id'] = 'password2';
																$input['name'] = 'password2';
																$input['attr']['data-emptymsg'] = $Admin_Lang['warning_password_empty'];
																$input['attr']['data-notmatchmsg'] = $Admin_Lang['warning_password_notmatch'];
																UIElementController::render ( "password", $input );
																unset($input);
																?>
															</div>
															</div>
														</div>
															<div class="margin-top-10">
																<?php echo ui::submitBtn('',array('id'=>'submitBtn'))?>
															</div>
															</div>
															</div>
													</form>
												</div>
												
												<!-- END PRIVACY SETTINGS TAB -->
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- END PROFILE CONTENT -->
					</div>
				</div>
				
					</form>
				<!-- END PAGE CONTAINER-->
			</div>
			<!-- END PAGE -->
		</div>
		</div>
	
	<!-- END CONTAINER -->
	
	<?php
	
	include_once 'application/view/template/admin/admin_footer.php';
	?>