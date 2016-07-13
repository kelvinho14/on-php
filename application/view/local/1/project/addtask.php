<?php 
if(function_exists('preventDA')){
	preventDA();
}else{
	die;
}

$_PLUGIN['checksave'] = 1;
$_PLUGIN['datetimepicker'] = 1;
$_PLUGIN['timepicker'] = 1;

$_PAGE['jsfile'] = '/include/js/local/'.$CONFIG['local'].'/project/addtask.js';
$_FOOTER['ready_js'] .= 'Task.init();';

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
				<?php echo $Admin_Lang['projectmgt']?>
				</h3>
				<div class="page-bar">

							<?php
							$breadcrumb_arr = array (
									array (
											'name' => $Admin_Lang['projectmgt'],
											'link' => $CONFIG['home_http'].'project/panel'
									),
									array (
											'name' => $Data['ID']==''?$Admin_Lang['add']:$Admin_Lang['edit']
									) 
							);
							UIElementController::render ( "breadcrumb", $breadcrumb_arr );
							?>
				</div>
				<!-- END PAGE CONTENT-->
								
			<div class="row ">
				<form id="mainform" name="mainform" method="post" enctype="multipart/form-data" onsubmit="setFormSubmitting()">
					<div class="col-md-12">
						<?php
							UIElementController::render ( "portlet_start", $input );
							unset ( $input );?>
							<div class="portlet-body form">
								<div class="form-body">
									<div class="form-group form-md-line-input has-success">
										<div class="input-icon" >
											<i class="fa fa-calendar-o"></i>
											<?php 
											$input['attr']['class'] = 'form-control';
											$input['id'] = 'date';
											$input['name'] = 'date';
											$input ['attr'] ['data-emptymsg'] = $Admin_Lang ['warning_date_empty'];
											$input['attr']['data-format'] = setting::getDatetimeformat();
											$input['value'] = $Data['Date']==''?display::datepickerToday():($Data['Date']);
											UIElementController::render("input", $input );
											
											unset($input);
											?>
											<label for="form_control_1"><?php echo $Admin_Lang['date']?></label>
										</div>
									</div>
									<?php 
									
									foreach($Data['channels'] as $datum){
										switch($datum['ChannelID']){
											case 1:
												$id = 'ForumDuration';
											break;
											case 2:
												$id = 'AppDuration';
											break;
											case 3:
												$id = 'FBPostDuration';
											break;
											case 4:
												$id = 'FBMessageDuration';
											break;
										}
										?>
									<div class="form-group form-md-line-input has-success ">
										<div class="input-icon" >
											<i class="tooltips fa fa-<?php echo $Admin_Lang['outreachtype'][$datum['ChannelID']]['icon']?>  data-container="body" data-placement="top" data-original-title="<?php echo $datum['ChannelName']?>"></i>
											<?php 
											$input['attr']['class'] = 'form-control timepicker';
											$input['id'] = $id;
											$input['name'] = $id;
											$input['attr'] ['data-emptymsg'] = $Admin_Lang ['warning_duration_empty'];
											$input['value'] = $Data['channelduration'][$id]==''?0:$Data['channelduration'][$id];
											UIElementController::render("input", $input );
											
											unset($input);
											?>

										</div>
									</div>
									<?php }?>
									
								</div>
						<?php UIElementController::render ( "portlet_end" );
							unset ( $input );
							?>								
						</div>
					</div>
				</div>
			<div class="form-actions">
				<div class="row">
					<div class="col-md-offset-4 col-md-8">
						<?php echo ui::submitBtn('',array('id'=>'submitbtn'));?>
						<?php echo ui::backBtn('',array('id'=>'backbtn'));?>
					</div>
				</div>
			</div>
			<input type="hidden" id="id" name="id" value="<?php echo $Data['ID']?>"/>
			</form>
					
				
			</div>
				<!-- END PAGE CONTAINER-->
		</div>
			<!-- END PAGE -->
	</div>
	
	<!-- END CONTAINER -->
	
	<?php
	
	include_once 'application/view/template/admin/admin_footer.php';
	?>