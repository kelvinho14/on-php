<?php 
if(function_exists('preventDA')){
	preventDA();
}else{
	die;
}
$_PAGE['jsfile'] = 'user/add.js';
$_FOOTER['ready_js'] .= 'User.init();';
$_PLUGIN['datepicker'] = 1;
$_PLUGIN['fileinput'] = 1;
$_PLUGIN['checksave'] = 1;
include_once 'application/view/template/admin/admin_header.php';
?>
<!-- BEGIN CONTAINER -->
<div class="container">
	<!-- BEGIN CONTAINER -->
	<div class="page-container">
	<?php
	$_PAGE['sidebar_user']['add']  =1;
	
	$app = new Application(array());
	$app->Load_View('template/admin/admin_sidebar',$_PAGE);
	?>
		<div class="page-content-wrapper">
			<!-- BEGIN PAGE -->
			<div class="page-content">
				<!-- BEGIN PAGE CONTAINER-->
				<?php include_once 'application/view/template/admin/admin_style.php';?>
				<h3 class="page-title"><?php echo $Admin_Lang['add_user']?></h3>
				<div class="page-bar">
					<?php
					$breadcrumb_arr = array (
							array (
									'name' => $Admin_Lang['usermgt'],
									'link' => $CONFIG['home_http'].'user/viewlist'
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
					<form id="mainform" name="mainform" method="post" enctype="multipart/form-data" onsubmit="setFormSubmitting()">					
					<div class="row ">
						<div class="col-md-6">
						<?php
						//$input ['title'] = 'Discussion';
						$input ['bodyid'] = 'system';
						$input['action']['fullscreen'] = true;
						UIElementController::render ( "portlet_start", $input );
						unset ( $input );?>
							<div class="portlet-body form">
									<div class="form-body">
										<div class="form-group form-md-line-input has-success">
											<div class="fileinput fileinput-new" data-provides="fileinput">
													<div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
														<img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt=""/>
													</div>
													<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;">
													</div>
													<div>
														<span class="btn default btn-file">
														<span class="fileinput-new">
														<?php echo $Admin_Lang["select_img"]?>  </span>
														<span class="fileinput-exists">
														<?php echo $Admin_Lang["change_img"]?>  </span>
														<input type="file" name="profilepic" value="../../assets/admin/layout2/img/avatar3_small.jpg">
														</span>
														<a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput">
														<?php echo $Admin_Lang["remove_img"]?> </a>
													</div>
												</div>
										</div>
										<div class="form-group form-md-line-input has-success">
											<div class="input-icon right">
											<?php 
												$input['attr']['class'] = 'form-control';
												$input['id'] = 'username';
												$input['name'] = 'username';
												$input['attr']['data-emptymsg'] = $Admin_Lang['warning_username_empty'];
												$input['attr']['data-invalidmsg'] = $Admin_Lang['warning_username_invalid'];
												$input['attr']['onChange'] = 'User.validateUserName()';
												UIElementController::render ( "input", $input );
												unset($input);
											?>
												<label for="form_control_1"><?php echo $Admin_Lang['username']?></label>
												<span class="help-block"><?php echo $Admin_Lang["usernamerule"]?></span>
											</div>
										</div>
										<div class="form-group form-md-line-input has-success">
											<div class="input-icon right">
												<?php 
												$input['attr']['class'] = 'form-control';
												$input['id'] = 'email';
												$input['name'] = 'email';
												$input['attr']['data-emptymsg'] = $Admin_Lang['warning_email_empty'];
												$input['attr']['data-invalidmsg'] = $Admin_Lang['warning_email_invalid'];
												$input['attr']['onChange'] = 'User.validateEmail()';
												UIElementController::render ( "input", $input );
												unset($input);
												?>
												<label for="form_control_1"><?php echo $Admin_Lang['emailaddress']?></label>
											</div>
										</div>
										<div class="form-group form-md-line-input has-success">
											<div class="input-group input-group-sm">
												<span class="input-group-btn btn-left">
												</span>
												<div class="input-group-control">
												<?php 
												$input['attr']['class'] = 'form-control';
												$input['id'] = 'password';
												$input['name'] = 'password';
												$input['attr']['data-emptymsg'] = $Admin_Lang['warning_password_empty'];
												$input['attr']['data-notmatchmsg'] = $Admin_Lang['warning_password_notmatch'];
												//$input['attr']['onChange'] = 'User.validatePassword()';
												UIElementController::render ( "input", $input );
												unset($input);
												?>
												<label for="form_control_1"><?php echo $Admin_Lang['password']?></label>
												</div>
												<span class="input-group-btn btn-right">
												<?php 
												$input['id'] = 'passwordbtn';
												$input['value'] = $Admin_Lang['password_generate'];
												$input['attr']['class'] = 'btn green-haze';
												UIElementController::render ( "button", $input );
												unset($input);
												?>
												</span>
											</div>
										</div>
										<div class="form-group form-md-line-input has-success">
											<div class="input-icon right">
												
												<?php 
												$input['attr']['class'] = 'form-control';
												$input['id'] = 'password2';
												$input['name'] = 'password2';
												$input['attr']['data-emptymsg'] = $Admin_Lang['warning_password_empty'];
												//$input['attr']['onChange'] = 'User.validatePassword()';
												UIElementController::render ( "input", $input );
												unset($input);
												?>
												<label for="form_control_1"><?php echo $Admin_Lang['retype_password']?></label>
												
											</div>
										</div>
										<div class="form-group form-md-line-input has-info">
											<div class="input-icon right">
												<?php 
												$input['attr']['class'] = 'form-control';
												$input['id'] = 'roleid';
												$input['name'] = 'roleid';
												$input['option'] = $Data['userrole'];
												$input['attr']['data-emptymsg'] = $Admin_Lang['warning_role_empty'];
												$input['attr']['data-clientrole'] = ROLE_CLIENT;
												//$input['attr']['onChange'] = 'User.validateRole()';
												UIElementController::render("select", $input );
												unset($input);
												?>
												<label for="form_control_1"><?php echo $Admin_Lang['userrole']?></label>
											</div>
										</div>
										<div class="form-group form-md-line-input has-info" id="clientoption" style="display:none">
											<div class="input-icon right">
												<?php 
												$input['attr']['class'] = 'form-control';
												$input['id'] = 'clientid';
												$input['name'] = 'clientid';
												$input['option'] = $Data['clientlist'];
												$input['value'] = $Data['user']['ClientID'];
												$input['attr']['data-emptymsg'] = $Admin_Lang['warning_client_empty'];
												UIElementController::render("select", $input );
												unset($input);
												?>
												<label for="form_control_1"><?php echo $Admin_Lang['client']?></label>
											</div>
										</div>
									</div>
						<?php UIElementController::render ( "portlet_end" );
						unset ( $input );
						?>
						</div>
					</div>
					<div class="col-md-6">
						<?php
						//$input ['title'] = 'Discussion';
						$input ['bodyid'] = 'personal';
						$input['action']['fullscreen'] = true;
						UIElementController::render ( "portlet_start", $input );
						unset ( $input );?>
							<div class="portlet-body form">
								<div class="form-body">
									<div class="form-group form-md-line-input has-success">
										<div class="input-icon right">
											<?php 
											$input['attr']['class'] = 'form-control';
											$input['id'] = 'firstname';
											$input['name'] = 'firstname';
											$input['attr']['data-emptymsg'] = $Admin_Lang['warning_fname_empty'];
											$input['attr']['onChange'] = 'User.validateFirstname()';
											UIElementController::render ( "input", $input );
											unset($input);
											?>
											<label for="form_control_1"><?php echo $Admin_Lang['firstname']?></label>
										</div>
									</div>
									<?php if(setting::useMName()){?>
									<div class="form-group form-md-line-input has-success">
										<div class="input-icon right">
											<?php 
											$input['attr']['class'] = 'form-control';
											$input['id'] = 'middlename';
											$input['name'] = 'middlename';
											UIElementController::render ( "input", $input );
											unset($input);
											?>
											<label for="form_control_1"><?php echo $Admin_Lang['middlename']?></label>
										</div>
									</div>
									<?php }?>
									<div class="form-group form-md-line-input has-success">
										<div class="input-icon right">
												<?php 
											$input['attr']['class'] = 'form-control';
											$input['id'] = 'lastname';
											$input['name'] = 'lastname';
											$input['attr']['data-emptymsg'] = $Admin_Lang['warning_lname_empty'];
											$input['attr']['onChange'] = 'User.validateLastname()';
											UIElementController::render ( "input", $input );
											unset($input);
											?>
											<label for="form_control_1"><?php echo $Admin_Lang['lastname']?></label>
										</div>
									</div>
									<div class="form-group form-md-line-input has-success">
										<div class="input-icon right">
											<?php 
											$input['attr']['class'] = 'form-control';
											$input['id'] = 'gender';
											$input['name'] = 'gender';
											$input['option'] = $Data['genderoption'];
											$input['attr']['data-emptymsg'] = $Admin_Lang['warning_gender_empty'];
											UIElementController::render("select", $input );
											
											unset($input);
											?>
											<label for="form_control_1"><?php echo $Admin_Lang['gender']?></label>
											
										</div>
									</div>
									
									<div class="form-group form-md-line-input has-success">
										<div class="input-icon right">
											<?php 
											$input['attr']['class'] = 'form-control';
											$input['id'] = 'birthday';
											$input['name'] = 'birthday';
											$input['attr']['data-invalidmsg'] = $Admin_Lang['warning_date_invalid'];
											$input['attr']['data-format'] = setting::getDateFormat();
											UIElementController::render("input", $input );
											
											unset($input);
											?> 
											<label for="form_control_1"><?php echo $Admin_Lang['birthday']?></label>
										</div>
									</div>
									<div class="form-group form-md-line-input has-success">
										<div class="input-icon right">
											<?php 
											$input['attr']['class'] = 'form-control';
											$input['id'] = 'phone';
											$input['name'] = 'phone';
											UIElementController::render ( "input", $input );
											unset($input);
											?>
											<label for="form_control_1"><?php echo $Admin_Lang['contactno']?></label>
										</div>
									</div>
									<div class="form-group form-md-line-input has-success">
										<div class="input-icon right">
												<?php 
												$input['attr']['class'] = 'form-control';
												$input['id'] = 'note';
												$input['name'] = 'note';
												UIElementController::render ( "textarea", $input );
												unset($input);
												?>
											<label for="form_control_1"><?php echo $Admin_Lang['usernote']?></label>
										</div>
									</div>
								</div>
						<?php UIElementController::render ( "portlet_end" );
						unset ( $input );
						?>
						</div>
					</div>
					<!-- END PAGE CONTENT-->
				</div>
				<div class="form-actions">
					<div class="row">
						<div class="col-md-offset-4 col-md-8">
							<?php echo ui::submitBtn('',array('id'=>'submitbtn'));?>
							<?php echo ui::backBtn('',array('id'=>'backbtn'));?>
						</div>
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