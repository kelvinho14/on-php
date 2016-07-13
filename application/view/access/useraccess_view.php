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
	$sidebar_system_useraccess_active 	= 1;
	
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
							<?php echo $Lang['user_access_management'];?>
							<small><?php echo $Lang['user_access_management_desc'];?></small>
						</h3>
						<?php 
						$breadcrumb_arr = array(array('name'=>$Lang['user_access_management'],'link'=>'?ctr=access_user_accesslist'),array('name'=>$Data['UserName']));
						UIElementController::render("breadcrumb",$breadcrumb_arr);
						?>
						
						
					</div>
				</div>
				<!-- END PAGE HEADER-->
				<!-- BEGIN PAGE CONTENT-->
				<div class="row-fluid profile">
				<form id="form1" name="form1" action="?ctr=access_user_accessedit" method="post"/>
					<div class="span12">
						<!--BEGIN TABS-->
						<div class="row-fluid add-portfolio">
										<div class="pull-left">
											<span><?php echo $Lang['user_access_mgt_instruction']?></span>
										</div>
										<div class="pull-left">
											
										<?php
														
														$input['ID'] 		= 'RoleID';
														$input['Name'] 		= 'RoleID';
														$input['Option'] 	= $Data['all_role'];
														$input['Class'] 	= ' ';
														$input['OnChange'] 	= 'applyRight(this.value)';
														
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
												<label for="<?php echo $module.'_'.$action_arr[$a][1]?>"><?php echo str_replace("_"," ",$action_arr[$a][1]);?></label>
											<div class="controls">	
												<input type="checkbox"  value="1" class="access_cb_<?php echo $section;?> access_setting_cb" <?php echo $Data['function'][$module][$action_arr[$a][1]]?'checked':'';?> id="<?php echo 'cb_'.$action_arr[$a][0]?>" name="<?php echo 'cb_'.$action_arr[$a][0]?>"/>
												
												
											
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
										<a class="btn green" href="javascript:void(0)" onClick="$('#form1').submit();">Save Changes</a>
										<a class="btn" href="#">Cancel</a>
										</div>
									</div>		
								
								
								
								
							
							</div>
						</div>
						<!--END TABS-->
					</div>
					<input type="hidden" name="ID" id="ID" value="<?php echo $_REQUEST['ID']?>"/>
					</form>
				</div>
				<!-- END PAGE CONTENT-->         
			</div>
			<!-- BEGIN PAGE CONTAINER-->     
		</div>
		<!-- END PAGE --> 
	</div>
	<script>

function applyRight(RoleID){
	
	$.post('index.php?ctr=access_get_roleaccessid&IsAjax=1', {RoleID: RoleID}, function(res) {
			if (res.status == 'OK') {
				$('.access_setting_cb').parent().removeClass('checked');
				$('.access_setting_cb').parent().attr('checked',false);
				
				id_arr = res.id.split(",");
				
				for(var a=0;a<id_arr.length;a++){
					$('#cb_'+id_arr[a]).parent().addClass('checked');
					$('#cb_'+id_arr[a]).attr('checked',true);
				}

			} else {
				$.gritter.add({
				    title: '<?php UIElementController::render("action_warn",(array('msg'=>$Lang['gritter_warn_title'])));?>',
				    text: res.message,
				    sticky: false,
				    class_name: 'my-sticky-class'
				});
			}
	}, 'json');
}


	</script>
	
	<!-- END CONTAINER -->
	<?php 
	
		$ready_js .= Display_Action_Msg();
		 
include_once 'application/view/template/'.$_SESSION['theme'].'/admin_footer.php';
?>
