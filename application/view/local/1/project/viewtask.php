<?php 
if(function_exists('preventDA')){
	preventDA();
}else{
	die;
}

$_PLUGIN['datatable'] = 1;
$_PLUGIN['modal'] = 1;

$_PAGE['jsfile'] = 'include/js/project/viewtask.js';

$_FOOTER['ready_js'] = 'Task.init();';
//$_FOOTER['ready_js'] .= 'Task.initTable();';

include_once 'application/view/template/admin/admin_header.php';
?>

<!-- BEGIN CONTAINER -->
<div class="container">
	<!-- BEGIN CONTAINER -->
	<div class="page-container">
	<?php
	$_PAGE['sidebar_project'] = 1;
//	$_PAGE['sidebar_project']['channel'.$Data['channelid']] = 1;
	//include_once 'application/view/template/admin/admin_sidebar.php';
	$app = new Application(array());
	$app->Load_View('template/admin/admin_sidebar',$_PAGE);
	?>
	
	
	<?php 
	//<div id="recordform" class="modal container  fade" tabindex="-1" data-keyboard="false" data-backdrop="static">
	//include_once($Data['formfile'].'.php');
	//</div>
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
						//.' ('.$Data['channelname'].')'
							$breadcrumb_arr = array (
									array (
											'name' => $Admin_Lang['projectmgt'],
											'link' => $CONFIG['home_http'].'project/panel/'
									),
									array (
											'name' => $Admin_Lang['taskdetail'].' ('.$Data['taskname'].')',
									)
									
							);
							UIElementController::render ( "breadcrumb", $breadcrumb_arr );
							?>
				</div>
					<!-- END PAGE HEADER-->
					<!-- BEGIN PAGE CONTENT-->
					<div class="row">
						<div class="col-md-12">
							<!-- BEGIN EXAMPLE TABLE PORTLET-->
						<?php
	
						
						
						$recordsize = sizeof($Data['records']);
						
						for($ct=0;$ct<$recordsize;$ct++){
								$display .='<div class="portlet-body">
									<div class="portlet box">
										<div class="portlet-body" >';
								//$display.='<i class="fa fa-'.$Data['records'][$ct]['Icon'].' fa-2x"></i>';
								//$display.= ui::fa($Data['records'][$ct]['Icon'].' fa-2x');
								$channelid = $Data['records'][$ct]['ChannelID'];
								$fieldsize = sizeof($CONFIG['taskrecordfield'][$channelid]);
								for($a=0;$a<$fieldsize;$a++){
									$display.=display::displayField($CONFIG['taskrecordfield'][$channelid][$a],$Data['records'][$ct]);
								}
								if(sizeof($Data['records'][$ct]['file'])>0){
									$input['file'] = $Data['records'][$ct]['file'];
									$input['id'] = 'carousel'.$Data['records'][$ct]['ID'];
									if(sizeof($Data['records'][$ct]['file'])==1)
										$input['hidenavigation'] = true;
									$display.='<div class="row"><div class="col-md-6">'.UIElementController::In_To_String("carousel", $input ).'</div></div>';
									$display.='<div class="row"><div class="col-md-6">&nbsp;</div></div>';
									unset($input);
								}
								
								if($Data['canedit']){
									$display.= ui::editBtn('',array('attr'=>array('data-id'=>$Data['records'][$ct]['ID'],'class'=>' edittaskrecord ')));
									$display.= ui::removeBtn('',array('attr'=>array('data-id'=>$Data['records'][$ct]['ID'],'class'=>' deletetaskrecord ','data-confirmmsg'=>$Admin_Lang['confirm_remove_taskrecord'])));
								}
								$display.='</div>
									</div>
								</div>';
							}
						?>	
						<div class="portlet light bg-inverse">
								<?php if($_ACCESS['project']['taskadd']){?>
								<div class="portlet-title">
									<div class="caption">
										
										<?php echo $Data['addbtns']?>
										
										
									</div>
								</div>
								<?php }
								//$Admin_Lang['add'].' '.$Data['channelname'].' '.$Admin_Lang['taskrecord']
								?>
								<?php echo $display;?>
						</div>
						</div>
					</div>
					<?php //include_once($Data['formfile'].'.php');?>

					<!-- END PAGE CONTENT-->
				</div>
				<!-- END PAGE CONTAINER-->
			</div>
			<!-- END PAGE -->
		</div>
	
	<!-- END CONTAINER -->
	<input type="hidden" name="loadlmsg" id="loadlmsg" value="<?php echo $Admin_Lang['loading']?>"/>
	<input type="hidden" name="channelid" id="channelid" value="<?php echo $Data['channelid']?>"/>
	<input type="hidden" name="jobtaskid" id="jobtaskid" value="<?php echo $Data['jobtaskid']?>"/>
	
	
	<?php
	
	include_once 'application/view/template/admin/admin_footer.php';
	?>