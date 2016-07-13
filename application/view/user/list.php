<?php 
if(function_exists('preventDA')){
	preventDA();
}else{
	die;
}


$_PLUGIN['datatable'] = 1;

$_PAGE['jsfile'] = 'user/list.js';

$_FOOTER['ready_js'] = 'User.initTable();';
$_FOOTER['ready_js'] .= 'User.initButton();';
//$_FOOTER['ready_js'] = 'App.init();';
 


include_once 'application/view/template/admin/admin_header.php';
?>

<!-- BEGIN CONTAINER -->
<div class="container">
	<!-- BEGIN CONTAINER -->
	<div class="page-container">

	<?php
	$_PAGE['sidebar_user']['view'] = 1;
	//include_once 'application/view/template/admin/admin_sidebar.php';
	$app = new Application(array());
	$app->Load_View('template/admin/admin_sidebar',$_PAGE);
	
	
	?>
	<form id="mainform" name="mainform" method="post"/>
		<div class="page-content-wrapper">
			<!-- BEGIN PAGE -->
			<div class="page-content">
				<!-- BEGIN PAGE CONTAINER-->
				
				<?php include_once 'application/view/template/admin/admin_style.php';?>
				<h3 class="page-title">
					<?php echo $Admin_Lang['usermgt']?> <small></small>
				</h3>
				<div class="page-bar">
						<?php
							$breadcrumb_arr = array (
									array (
											'name' => $Admin_Lang['usermgt'],
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
						//$input ['title'] = UIElementController::In_To_String ( "fa", array ('fa' => 'user') ).' '.$Admin_Lang['user'];
						$input ['bodyid'] = 'user';
						$input['action']['fullscreen'] = true;
						UIElementController::render ( "portlet_start", $input );
						unset ( $input );
 
						$dt_arr['table_id'] = 'userlist_table';
						$dt_arr['column'] = array($Admin_Lang['profilepic'],$Admin_Lang['username'],$Admin_Lang['name'],$Admin_Lang['email'],$Admin_Lang['userrole'],$Admin_Lang['status'],$Admin_Lang['lastlogin'],$Admin_Lang['create_time'],$Admin_Lang['modifiedby']);
						
						for($a=0;$a<sizeof($Data['UserList']);$a++){
							if($Data['UserList'][$a]['ProfilePicSrc']!=''){
								$profilepic = '';
								if($_ACCESS['user']['edit'])
									$profilepic = '<a href="'.$CONFIG['home_http'].'user/edit/?id='.$Data['UserList'][$a]['UserID'].'">';
								$profilepic .= '<img src="'.$Data['UserList'][$a]['ProfilePicSrc'].'">';
								if($_ACCESS['user']['edit']){
									$profilepic .='</a>';
								}
								$profilepic.='<br/>';
								
								if($_ACCESS['user']['edit'])
								$profilepic.= ui::cropBtn('',array('attr'=>array('data-userid'=>$Data['UserList'][$a]['UserID'],'class'=>'cropbtn btn-xs','onClick'=>'window.location=\''.$CONFIG['home_http'].'user/cropprofilepic/?id='.$Data['UserList'][$a]['UserID'].'\'')));
							}else{
								$profilepic = '';
							}
							$dt_arr['data'][] = array(	 
									array('data'=>$Data['UserList'][$a]['UserID'],'name'=>'UserID[]'),
									array('data'=>$profilepic),
									array('data'=>$Data['UserList'][$a]['UserName'],'url'=>$_ACCESS['user']['edit']?$CONFIG['home_http'].'/user/edit/?id='.$Data['UserList'][$a]['UserID']:''),
									array('data'=>$Data['UserList'][$a]['Realname'],'url'=>$_ACCESS['user']['edit']?$CONFIG['home_http'].'/user/edit/?id='.$Data['UserList'][$a]['UserID']:''),
									array('data'=>$Data['UserList'][$a]['UserEmail']),
									array('data'=>$Data['UserList'][$a]['RoleName']),
									array('data'=>$Data['UserList'][$a]['Status']==USER_ACTIVE?UIElementController::In_To_String("span",array('value'=>$Admin_Lang['active'],'attr'=>array('class'=>'label label-sm label-success'))):UIElementController::In_To_String("span",array('value'=>$Admin_Lang['inactive'],'attr'=>array('class'=>'label label-sm label-danger')))),
									array('data'=>$Data['UserList'][$a]['LastLogin'].' ('.display::dayAgo($Data['UserList'][$a]['LastLogin']).')'),
									array('data'=>$Data['UserList'][$a]['TimeInput'].' ('.display::dayAgo($Data['UserList'][$a]['TimeInput']).')'),
									array('data'=>$Data['UserList'][$a]['Modifier'])
							);
						}
						if($_ACCESS['user']['add'])
							$dt_arr['btn'] = ui::addBtn('',array('id'=>'adduser'));
						if($_ACCESS['user']['edit'])
							$dt_arr['btn'] .= ui::removeBtn('',array('id'=>'removeuser','attr'=>array('data-checkempty'=>$Admin_Lang['select_atleast_one_user'],'data-confirmmsg'=>$Admin_Lang['confirm_remove_user'])));
						if($_ACCESS['user']['edit'])
							$dt_arr['btn'] .= ui::activateBtn('',array('id'=>'activateuser','attr'=>array('data-checkempty'=>$Admin_Lang['select_atleast_one_user'],'data-confirmmsg'=>$Admin_Lang['confirm_activate_user'])));
						if($_ACCESS['user']['edit'])
							$dt_arr['btn'] .= ui::deactivateBtn('',array('id'=>'deactivateuser','attr'=>array('data-checkempty'=>$Admin_Lang['select_atleast_one_user'],'data-confirmmsg'=>$Admin_Lang['confirm_deactivate_user'])));
					
							UIElementController::render("datatable",$dt_arr);
						
						
						UIElementController::render("portlet_end");
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
	</form>
	<?php
	
	include_once 'application/view/template/admin/admin_footer.php';
	?>