<?php 
if(function_exists('preventDA')){
	preventDA();
}else{
	die;
}

$_PAGE['jsfile'] = '/include/js/user/addclient.js';
$_FOOTER['ready_js'] .= 'Client.init();';
$_PLUGIN['datepicker'] = 1;
$_PLUGIN['checksave'] = 1;

include_once 'application/view/template/admin/admin_header.php';
?>

<!-- BEGIN CONTAINER -->
<div class="container">
	<!-- BEGIN CONTAINER -->
	<div class="page-container">

	<?php
	$_PAGE['sidebar_client']['add']  =1;
	
	$app = new Application(array());
	$app->Load_View('template/admin/admin_sidebar',$_PAGE);
	?>
		<div class="page-content-wrapper">
			<!-- BEGIN PAGE -->
			<div class="page-content">
				<!-- BEGIN PAGE CONTAINER-->
				
				<?php include_once 'application/view/template/admin/admin_style.php';?>
				<h3 class="page-title">
				<?php echo $Admin_Lang['add_client']?>
				</h3>
				<div class="page-bar">

							<?php
							$breadcrumb_arr = array (
									array (
											'name' => $Admin_Lang['clientmgt'],
											'link' => '/user/viewclientlist'
									),
									array (
											'name' => $Admin_Lang['add_client'] 
									) 
							);
							UIElementController::render ( "breadcrumb", $breadcrumb_arr );
							?>
				</div>
					<!-- END PAGE HEADER-->
					<!-- BEGIN PAGE CONTENT-->
					<form id="mainform" name="mainform" method="post" enctype="multipart/form-data" onsubmit="setFormSubmitting()">					
					<div class="row ">
						
					<div class="col-md-12">
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
												$input['attr']['onChange'] = 'Client.validateFirstname()';
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
										
										<?php /*<div class="form-group form-md-line-input has-success">
											<div class="input-icon right">
													<?php 
												$input['attr']['class'] = 'form-control';
												$input['id'] = 'lastname';
												$input['name'] = 'lastname';
												$input['attr']['data-emptymsg'] = $Admin_Lang['warning_lname_empty'];
												
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
												$input['id'] = 'uniquestring';
												$input['name'] = 'uniquestring';
												$input['attr']['data-emptymsg'] = $Admin_Lang['warning_uniquestring_empty'];
												
												UIElementController::render ( "input", $input );
												unset($input);
												?>
												<label for="form_control_1"><?php echo $Admin_Lang['uniquestring']?></label>
											</div>
										</div>*/
										?>
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