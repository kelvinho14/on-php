<?php
	include_once 'application/view/template/'.$_SESSION['theme'].'/admin_header.php';
?>
<link href="assets/css/pages/profile.css" rel="stylesheet" type="text/css" />
<link href="assets/plugins/jcrop/css/jquery.Jcrop.min.css" rel="stylesheet"/>
<link href="assets/css/pages/image-crop.css" rel="stylesheet"/>
<style>
#preview-pane .thumbpreview-container {
    height: 170px;
    overflow: hidden;
    width: 170px;
}
</style>
	<!-- BEGIN CONTAINER -->   
	<div class="page-container row-fluid">
<?php 
	$sidebar_system_active 				= 1;
	$sidebar_system_access_active		= 1;
	$sidebar_system_roleaccess_active 	= 1;
	
	include_once 'application/view/template/'.$_SESSION['theme'].'/admin_sidebar.php';
?>
		<!-- BEGIN PAGE -->
		<div class="page-content">
			<!-- BEGIN PAGE CONTAINER-->
			<div class="container-fluid">
				<!-- BEGIN PAGE HEADER-->   
				<div class="row-fluid">
					<div class="span12">
						<?php include_once 'application/view/template/'.$_SESSION['theme'].'/admin_style.php';?>
						<h3 class="page-title">
							<?php echo $Lang['role_access_management'];?>
							<small><?php echo $Lang['role_access_management_desc'];?></small>
						</h3>
						<?php 
						$breadcrumb_arr = array(array('name'=>$Lang['role_access_management']));
						UIElementController::render("breadcrumb",$breadcrumb_arr);
						?>
						
						
					</div>
				</div>
				<!-- END PAGE HEADER-->
				<!-- BEGIN PAGE CONTENT-->
				<div class="row-fluid profile">
				<form id="form1" name="form1" action="?ctr=access_role_accessedit" method="post"/>
					<div class="span12">
						<!--BEGIN TABS-->
						<div class="row-fluid add-portfolio">
										<div class="pull-left">
											<span><?php echo $Lang['please_select_a_role']?>:</span>
										</div>
										<div class="pull-left">
											
										
										<?php
														
														$input['ID'] 		= 'RoleID';
														$input['Name'] 		= 'RoleID';
														$input['Option'] 	= $Data['all_role'];
														$input['OnChange']	= "changeRole(this.value)";
														$input['Value']		= $Data['RoleID'];
														$input['Class']		= ' ';
														UIElementController::render("selection",$input);
														unset($input);?>
										
										</div>
							</div>
									
						<div class="tabbable tabbable-custom tabbable-full-width">
							<ul class="nav nav-tabs">
							<?php foreach($Data['AccessList'] as $module=>$section_arr){?>
								<li class="<?php echo $Data['action']==$module?'active':'';?>"><a data-toggle="tab" href="#tab_<?php echo $module?>"><?php echo $module?></a></li>
								
								<?php }?>
							</ul>
							<div class="tab-content">
							<?php foreach($Data['AccessList'] as $module=>$section_arr){?>
								<div id="tab_<?php echo $module?>" class="tab-pane row-fluid <?php echo $Data['action']==$module?'active':'';?>">
									
									
									<?php foreach($section_arr as $section=>$action_arr){?>
									<div class="row-fluid portfolio-block">
										
										<div style="overflow:hidden;" class="span10">
										<?php for($a=1;$a<=sizeof($action_arr);$a++){?>
											<div class="portfolio-info m-wrap tooltips"  data-trigger="hover" data-original-title="<?php echo $Lang['access_'.$action_arr[$a][1].'_desc']?>">
												<label for="<?php echo 'cb_'.$action_arr[$a][0]?>"><?php echo str_replace("_"," ",$action_arr[$a][1]);?></label>
											<div class="controls">	
												<input type="checkbox"  value="<?php echo $action_arr[$a][0]?>" class="access_cb_<?php echo $section;?> access_setting_cb" <?php echo in_array($action_arr[$a][0],$Data['RoleAccess'][$Data['RoleID']])?'checked':'';?> id="<?php echo 'cb_'.$action_arr[$a][0]?>" name="<?php echo 'cb_'.$action_arr[$a][0]?>"/>
												
												
											
										</div>
												
											</div>
											<?php }?>
										</div>
										<div class="span2 portfolio-btn">
											<a class="btn bigicn-only" href="javascript:void(0)" onClick="toggleCB('<?php echo $section?>')"><span><?php echo $Lang['check_or_uncheck_all']?></span></a>                      
										</div>
									</div>
									<?php }?>
									<!--end row-fluid-->
									
							</div>	
							<?php }?>
								<!--end tab-pane-->
									<div class="form-actions">
										<div class="submit-btn">
										<a class="btn green" href="javascript:void(0)" onClick="document.form1.submit();">Save Changes</a>
										<a class="btn" href="#">Cancel</a>
										</div>
									</div>		
								
								
								
								
							
							</div>
						</div>
						<!--END TABS-->
					</div>
					</form>
				</div>
				<!-- END PAGE CONTENT-->         
			</div>
			<!-- BEGIN PAGE CONTAINER-->     
		</div>
		<!-- END PAGE --> 
	</div>
	<script>
function changeRole(RoleID){
	window.location='?ctr=access_role_accessview&RoleID='+RoleID;
}


	</script>
	
	<!-- END CONTAINER -->
	<?php 
	
		$ready_js .= Display_Action_Msg();
		 
include_once 'application/view/template/'.$_SESSION['theme'].'/admin_footer.php';
?>
