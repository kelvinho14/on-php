<?php 
if(function_exists('preventDA')){
	preventDA();
}else{
	die;
}


$_PLUGIN['datatable'] = 1;
$_PLUGIN['modal'] = 1;
$_PAGE['jsfile'] = '/include/js/project/channellist.js';

$_FOOTER['ready_js'] = 'Channel.initTable();';
$_FOOTER['ready_js'] .= 'Channel.initButton();';
//$_FOOTER['ready_js'] = 'App.init();';
 


include_once 'application/view/template/admin/admin_header.php';
?>

<!-- BEGIN CONTAINER -->
<div class="container">
	<!-- BEGIN CONTAINER -->
	<div class="page-container">

	<?php
	$_PAGE['sidebar_project']['channellist'] = 1;
	$app = new Application(array());
	$app->Load_View('template/admin/admin_sidebar',$_PAGE);
	
	
	?>
	
		<div id="channeltoolmodal" class="modal fade" tabindex="-1" data-keyboard="false" data-backdrop="static"></div>
		<div class="page-content-wrapper">
			<!-- BEGIN PAGE -->
			<div class="page-content">
				<!-- BEGIN PAGE CONTAINER-->
				
				<?php include_once 'application/view/template/admin/admin_style.php';?>
				<h3 class="page-title">
					<?php echo $Admin_Lang['channelmgt']?> <small></small>
				</h3>
				<div class="page-bar">
						<?php
							$breadcrumb_arr = array (
									array (
											'name' => $Admin_Lang['channelmgt'],
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

						//$ct = 0;
						foreach($Data['Channellist'] as $channel=>$v){
							echo '<form id="form'.$channel.'" name="form'.$channel.'" method="post"/>';
							$input['action']['fullscreen'] = true;
							$input['title'] = $channel;
							UIElementController::render ( "portlet_start", $input );
							unset ( $input );
	 
							$dt_arr['table_id'] = $channel.'list_table';
							$dt_arr['column'] = array($Admin_Lang['channeltool'],$Admin_Lang['status'],$Admin_Lang['create_time']);
							for($a=0;$a<sizeof($v);$a++){
								$channelname = ui::editBtn('',array('attr'=>array('onClick'=>'javascript:Channel.editTool('.$v[$a]['ID'].')')));
								$channelname .= '<a href="javascript:void(0)" onClick="javascript:Channel.editTool('.$v[$a]['ID'].')">'.$v[$a]['Name'].'</a>';
								
								$dt_arr['data'][] = array(	 
										array('data'=>$v[$a]['ID'],'name'=>'ChannelID[]'),
										array('data'=>$channelname),
										array('data'=>$v[$a]['Status']==STATUS_ACTIVECHANNELTOOL?UIElementController::In_To_String("span",array('value'=>$Admin_Lang['active'],'attr'=>array('class'=>'label label-sm label-success'))):UIElementController::In_To_String("span",array('value'=>$Admin_Lang['inactive'],'attr'=>array('class'=>'label label-sm label-danger')))),
										array('data'=>display::dayAgo($v[$a]['TimeInput']))
								);
							}
							$dt_arr['btn'] = ui::addBtn('',array('attr'=>array('class'=>'addchanneltool','data-channelname'=>$channel)));
							//if($ct==0){
								$dt_arr['btn'] .= ui::removeBtn('',array('attr'=>array('class'=>'removechanneltool','data-checkempty'=>$Admin_Lang['select_atleast_one_user'],'data-confirmmsg'=>$Admin_Lang['confirm_remove_user'],'data-form'=>'form'.$channel)));
								$dt_arr['btn'] .= ui::activateBtn('',array('attr'=>array('class'=>'activatechanneltool','data-checkempty'=>$Admin_Lang['select_atleast_one_user'],'data-confirmmsg'=>$Admin_Lang['confirm_activate_user'],'data-form'=>'form'.$channel)));
								$dt_arr['btn'] .= ui::deactivateBtn('',array('attr'=>array('class'=>'deactivatechanneltool','data-checkempty'=>$Admin_Lang['select_atleast_one_user'],'data-confirmmsg'=>$Admin_Lang['confirm_deactivate_user'],'data-form'=>'form'.$channel)));
							//}
							
							UIElementController::render("datatable",$dt_arr);
							unset($dt_arr);
							
							UIElementController::render("portlet_end");
							//$ct++;
							echo '</form>';
						}
						?>
						
						<!-- END EXAMPLE TABLE PORTLET-->
					</div>
				</div>

					<!-- END PAGE CONTENT-->
				</div>
				<!-- END PAGE CONTAINER-->
			</div>
			<!-- END PAGE -->
		</div>
	
	<!-- END CONTAINER -->
	<input type="hidden" id="loadmsg" value="<?php echo $Admin_Lang['loading']?>"/> 
	
	<?php
	
	include_once 'application/view/template/admin/admin_footer.php';
	?>