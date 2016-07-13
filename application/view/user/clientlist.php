<?php 
if(function_exists('preventDA')){
	preventDA();
}else{
	die;
}


$_PLUGIN['datatable'] = 1;

$_PAGE['jsfile'] = '/include/js/user/clientlist.js';

$_FOOTER['ready_js'] = 'Client.initTable();';
$_FOOTER['ready_js'] .= 'Client.initButton();';
//$_FOOTER['ready_js'] = 'App.init();';
 


include_once 'application/view/template/admin/admin_header.php';
?>

<!-- BEGIN CONTAINER -->
<?php ui::div_s(array('class'=>'container'))?>
	<!-- BEGIN CONTAINER -->
	<?php ui::div_s(array('class'=>'page-container'))?>

	<?php
	$_PAGE['sidebar_client']['view'] = 1;
	//include_once 'application/view/template/admin/admin_sidebar.php';
	$app = new Application(array());
	$app->Load_View('template/admin/admin_sidebar',$_PAGE);
	?>
	<form id="mainform" name="mainform" method="post"/>
		<?php ui::div_s(array('class'=>'page-content-wrapper'))?>
			<!-- BEGIN PAGE -->
			<?php ui::div_s(array('class'=>'page-content'))?>
				<!-- BEGIN PAGE CONTAINER-->
				
				<?php include_once 'application/view/template/admin/admin_style.php';?>
				<h3 class="page-title">
					<?php echo $Admin_Lang['clientmgt']?> <small></small>
				</h3>
				<?php ui::div_s(array('class'=>'page-bar'))?>
						<?php
							$breadcrumb_arr = array (
									array (
											'name' => $Admin_Lang['clientmgt'],
									)
							);
							UIElementController::render ( "breadcrumb", $breadcrumb_arr );
							?>
				<?php ui::div_e()?>
					<!-- END PAGE HEADER-->
					<!-- BEGIN PAGE CONTENT-->
					<?php ui::div_s(array('class'=>'row'))?>
					<?php ui::div_s(array('size'=>'12'))?>
						<!-- BEGIN EXAMPLE TABLE PORTLET-->
						
							
					<?php 
						//$input ['title'] = UIElementController::In_To_String ( "fa", array ('fa' => 'user') ).' '.$Admin_Lang['user'];
						$input ['bodyid'] = 'client';
						$input['action']['fullscreen'] = true;
						UIElementController::render ( "portlet_start", $input );
						unset ( $input );
 
					
					
					
						$dt_arr['table_id'] = 'clientlist_table';
						//,$Admin_Lang['uniquestring']
						$dt_arr['column'] = array($Admin_Lang['name'],$Admin_Lang['email'],$Admin_Lang['phone'],$Admin_Lang['create_time'],$Admin_Lang['modifiedby']);
						
						
						for($a=0;$a<sizeof($Data['UserList']);$a++){
							if($Data['UserList'][$a]['ProfilePicSrc']!=''){
								$profilepic = '<img src="'.$Data['UserList'][$a]['ProfilePicSrc'].'"><br/>';
								$profilepic.= ui::cropBtn('',array('attr'=>array('class'=>'btn-xs')));
							}else{
								$profilepic = '';
							}
							//array('data'=>$Data['UserList'][$a]['UniqueString']),
							$dt_arr['data'][] = array(	 
									array('data'=>$Data['UserList'][$a]['UserID'],'name'=>'UserID[]'),
									array('data'=>$Data['UserList'][$a]['Realname'],'url'=>$CONFIG['home_http'].'user/editclient/?id='.$Data['UserList'][$a]['UserID']),
									array('data'=>$Data['UserList'][$a]['UserEmail']),
									array('data'=>$Data['UserList'][$a]['Phone']),
									array('data'=>$Data['UserList'][$a]['TimeInput'].' ('.display::dayAgo($Data['UserList'][$a]['TimeInput']).')'),
									array('data'=>$Data['UserList'][$a]['Modifier']),
							);
						}
						$dt_arr['btn'] = ui::addBtn('',array('id'=>'addclient'));
						if($Data['CanEdit']){
							$dt_arr['btn'] .= ui::removeBtn('',array('id'=>'removeclient','attr'=>array('data-checkempty'=>$Admin_Lang['select_atleast_one_user'],'data-confirmmsg'=>$Admin_Lang['confirm_remove_user'])));
						}
							UIElementController::render("datatable",$dt_arr);
						
						
						UIElementController::render("portlet_end");
						?>
						
						<!-- END EXAMPLE TABLE PORTLET-->
					<?php ui::div_e()?>
				<?php ui::div_e()?>

					<!-- END PAGE CONTENT-->
				<?php ui::div_e()?>
				<!-- END PAGE CONTAINER-->
			<?php ui::div_e()?>
			<!-- END PAGE -->
		<?php ui::div_e()?>
	
	<!-- END CONTAINER -->
	</form>
	<?php
	
	include_once 'application/view/template/admin/admin_footer.php';
	?>