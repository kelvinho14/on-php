<?php 
if(function_exists('preventDA')){
	preventDA();
}else{
	die;
} 

$Application = new Application('');
$classname = $Application->Load_Model("message");
$NotificationControl = new $classname();
if($notification_obj = $NotificationControl->getNotification()){
	list($unread,$notification) = $notification_obj;
	$notification_count = sizeof($notification);
}

$classname = $Application->Load_Model("user");
$UserControl = new $classname();
$profileimgsrc = $UserControl->renderProfilePicSrc('',$_SESSION['user_id'],1);



?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title><?php echo $CONFIG['backend_site_title']?></title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<meta content="" name="description"/>
<meta content="" name="author"/>
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css">
<link href="<?echo $CONFIG['home_http']?>theme/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="<?echo $CONFIG['home_http']?>theme/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css">
<link href="<?echo $CONFIG['home_http']?>theme/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="<?echo $CONFIG['home_http']?>theme/assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css">
<link href="<?echo $CONFIG['home_http']?>theme/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css"/>
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN PLUGINS USED BY X-EDITABLE -->
<link rel="stylesheet" type="text/css" href="<?echo $CONFIG['home_http']?>theme/assets/global/plugins/select2/select2.css"/>
<link rel="stylesheet" type="text/css" href="<?echo $CONFIG['home_http']?>theme/assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css"/>
<?php if($_PLUGIN['datepicker']){?>
<link rel="stylesheet" type="text/css" href="<?echo $CONFIG['home_http']?>theme/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css"/>
<?php }?>
<?php if($_PLUGIN['datetimepicker']){?>
<link rel="stylesheet" type="text/css" href="<?echo $CONFIG['home_http']?>theme/assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css"/>
<link rel="stylesheet" type="text/css" href="<?echo $CONFIG['home_http']?>theme/assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css"/>
<?php }?>
<?php if($_PLUGIN['timepicker']){?>
<link rel="stylesheet" type="text/css" href="<?echo $CONFIG['home_http']?>theme/assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css"/>
<?php }?>
<link rel="stylesheet" type="text/css" href="<?echo $CONFIG['home_http']?>theme/assets/global/plugins/bootstrap-editable/bootstrap-editable/css/bootstrap-editable.css"/>
<link rel="stylesheet" type="text/css" href="<?echo $CONFIG['home_http']?>theme/assets/global/plugins/bootstrap-editable/inputs-ext/address/address.css"/>
<?php if($_PLUGIN ['task']){?>
<link href="<?echo $CONFIG['home_http']?>theme/assets/admin/pages/css/tasks.css" rel="stylesheet" type="text/css"/>
<?php }?>
<!-- END PLUGINS USED BY X-EDITABLE -->
<!-- BEGIN THEME STYLES -->
<link href="<?echo $CONFIG['home_http']?>theme/assets/global/css/components-md.css" id="style_components" rel="stylesheet" type="text/css"/>
<link href="<?echo $CONFIG['home_http']?>theme/assets/global/css/plugins-md.css" rel="stylesheet" type="text/css"/>
<link href="<?echo $CONFIG['home_http']?>theme/assets/admin/<?php echo $CONFIG['theme']?>/css/layout.css" rel="stylesheet" type="text/css"/>
<link id="style_color" href="<?echo $CONFIG['home_http']?>theme/assets/admin/<?php echo $CONFIG['theme']?>/css/themes/grey.css" rel="stylesheet" type="text/css"/>
<link href="<?echo $CONFIG['home_http']?>theme/assets/admin/<?php echo $CONFIG['theme']?>/css/custom.css" rel="stylesheet" type="text/css"/>
<link href="<?echo $CONFIG['home_http']?>theme/assets/admin/pages/css/todo.css" rel="stylesheet" type="text/css"/>

<?php if($_PLUGIN['datatable']){?>
<link rel="stylesheet" type="text/css" href="<?echo $CONFIG['home_http']?>theme/assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
<?php }?>

<?php if($_PLUGIN['calendar']){?>
<link href="<?echo $CONFIG['home_http']?>theme/assets/global/plugins/fullcalendar/fullcalendar.min.css" rel="stylesheet"/>
<?php }?>
<?php if($_PLUGIN['fileupload']){?>
<link href="<?echo $CONFIG['home_http']?>theme/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css"/>
<?php }?>

<?php if($_PLUGIN['modal']){?>
<link href="<?echo $CONFIG['home_http']?>theme/assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css"/>
<link href="<?echo $CONFIG['home_http']?>theme/assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/>
<?php }?>
<?php if($_PLUGIN['fileinput']){?>
<link rel="stylesheet" type="text/css" href="<?echo $CONFIG['home_http']?>theme/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css"/>
<?php }?>
<?php if($_PLUGIN['crop']){?>
<link href="<?echo $CONFIG['home_http']?>theme/assets/global/plugins/jcrop/css/jquery.Jcrop.min.css" rel="stylesheet"/>
<link href="<?echo $CONFIG['home_http']?>theme/assets/admin/pages/css/image-crop.css" rel="stylesheet"/>
<?php }?>
<?php if($_PLUGIN['dropzone']){?>
<link href="<?echo $CONFIG['home_http']?>theme/assets/global/plugins/dropzone/css/dropzone.css" rel="stylesheet"/>
<?php }?>
<?php if($_PAGE['cssfile']){?>
	<link href="<?php echo $_PAGE['cssfile']?>" rel="stylesheet" />
	<?php }?>
<!-- END THEME STYLES -->
<link rel="shortcut icon" href="favicon.ico"/>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<!-- DOC: Apply "page-header-fixed-mobile" and "page-footer-fixed-mobile" class to body element to force fixed header or footer in mobile devices -->
<!-- DOC: Apply "page-sidebar-closed" class to the body and "page-sidebar-menu-closed" class to the sidebar menu element to hide the sidebar by default -->
<!-- DOC: Apply "page-sidebar-hide" class to the body to make the sidebar completely hidden on toggle -->
<!-- DOC: Apply "page-sidebar-closed-hide-logo" class to the body element to make the logo hidden on sidebar toggle -->
<!-- DOC: Apply "page-sidebar-hide" class to body element to completely hide the sidebar on sidebar toggle -->
<!-- DOC: Apply "page-sidebar-fixed" class to have fixed sidebar -->
<!-- DOC: Apply "page-footer-fixed" class to the body element to have fixed footer -->
<!-- DOC: Apply "page-sidebar-reversed" class to put the sidebar on the right side -->
<!-- DOC: Apply "page-full-width" class to the body element to have full width page without the sidebar menu -->
<body class="page-md page-boxed page-header-fixed page-container-bg-solid page-sidebar-closed-hide-logo ">
<!-- BEGIN HEADER -->
<div class="page-header md-shadow-z-1-i navbar navbar-fixed-top">
	<!-- BEGIN HEADER INNER -->
	<div class="page-header-inner container">
		<!-- BEGIN LOGO -->
		<div class="page-logo">
			<a href="<?php echo $CONFIG['home_http']?>user/dashboardlist/">
			<img src="<?echo $CONFIG['home_http']?>theme/assets/gutsarmy-logo update-150526-2.png" alt="logo" class="logo-default" style="height:60px"/>
			</a>
			<div class="menu-toggler sidebar-toggler">
				<!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
			</div>
		</div>
		<!-- END LOGO -->
		<!-- BEGIN RESPONSIVE MENU TOGGLER -->
		<a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
		</a>
		<!-- END RESPONSIVE MENU TOGGLER -->
		<!-- BEGIN PAGE ACTIONS -->
		<!-- DOC: Remove "hide" class to enable the page header actions -->
		<!-- END PAGE ACTIONS -->
		<!-- BEGIN PAGE TOP -->
		<div class="page-top">
			<!-- BEGIN HEADER SEARCH BOX -->
			<!-- DOC: Apply "search-form-expanded" right after the "search-form" class to have half expanded search box -->
			<!-- END HEADER SEARCH BOX -->
			<!-- BEGIN TOP NAVIGATION MENU -->
			<div class="top-menu">
				<ul class="nav navbar-nav pull-right">
					<!-- BEGIN NOTIFICATION DROPDOWN -->
					<!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
					<!--  <li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar">
						<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">-->
					<li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar">
						<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" id="notificationtoogle">	
						<i class="icon-bell"></i>
						<?php if($unread>0){?>
						<span class="badge badge-default"><?php echo $unread?></span>
						<?php }?>
						</a>
						<ul class="dropdown-menu" id="notificationdropdown">
							<li class="external">
								
								<h3>
								<span class="bold">
								<?php if($unread>0){?><?php echo $unread.$Admin_Lang['piece']?><?php echo display::plural($unread,$Admin_Lang['newnotification']);}else{ echo '&nbsp;';}?></span>
								</h3>
								
								<a href="<?php echo $CONFIG['home_http']?>message/viewlist"><?php echo $Admin_Lang['viewallnotification']?></a>
							</li>
							<?php if($notification_count>0){?>
							<li>
								<ul class="dropdown-menu-list scroller" style="height: 250px;" data-handle-color="#637283">
								<?php for($a=0;$a<$notification_count;$a++){
									list($icon,$message,$time,$title,$link) = display::renderNotification($notification[$a],0);
									?>
									<li <?php echo $notification[$a]['IsUnread']?'class="newnotification"':''?>>
										<a href="<?php echo $link?>">
										<span class="time"><?php echo $time?></span>
										<span class="details">
										<?php echo $icon?>
										<?php echo $message;?></span>
										</a>
									</li>
								<?php }?>
								</ul>
							</li>
							<?php }?>
						</ul>
					</li>
					<?php 
						$classname = $Application->Load_Model("file");
						$FileControl = new $classname();
						$storagestats = $FileControl->getStorageStats();
						
					?>
					<li class="dropdown dropdown-extended dropdown-tasks" id="header_storage_bar">
						<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
						<?php echo ui::fa($CONFIG['file']['fa'])?>
						
						</a>
						<ul class="dropdown-menu extended tasks">
							<li class="external">
								<h3><?php echo $Admin_Lang['fileusagestats']?></h3>
							</li>
							<li>
								<ul class="dropdown-menu-list scroller" style="height: 75px;" data-handle-color="#637283">
									<li>
										<a href="javascript:;">
										<span class="task">
										<span class="desc"><?php echo Cal_Size_2_Unit($storagestats['used']).'/'.Cal_Size_2_Unit($storagestats['allow'])?></span>
										<span class="percent"><?php echo $storagestats['usedper']?>%</span>
										</span>
										<span class="progress">
										<span style="width: <?php echo $storagestats['usedper']?>%;" class="progress-bar progress-bar-success" aria-valuenow="<?php echo $storagestats['usedper']?>" aria-valuemin="0" aria-valuemax="100"><span class="sr-only">40% Complete</span></span>
										</span>
										</a>
									</li>
									
								</ul>
							</li>
						</ul>
					</li>
					<!-- END NOTIFICATION DROPDOWN -->
					<!-- BEGIN INBOX DROPDOWN -->
					<!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
					
					<!-- END INBOX DROPDOWN -->
					<!-- BEGIN TODO DROPDOWN -->
					<!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
					
					<!-- END TODO DROPDOWN -->
					<!-- BEGIN USER LOGIN DROPDOWN -->
					<!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
					<li class="dropdown dropdown-user">
						<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
						<img alt="" class="img-circle" src="<?php echo $profileimgsrc?>"/>
						<span class="username username-hide-on-mobile"><?php echo $_SESSION['user_name']?><br/>[<?php echo $_SESSION['rolename']?>]</span>
						<i class="fa fa-angle-down"></i>
						</a>
						<ul class="dropdown-menu dropdown-menu-default">
							<li>
								<a href="<?php echo $CONFIG['home_http']?>user/profile/">
								<i class="icon-user"></i> <?php echo $Admin_Lang['myprofile']?></a>
							</li>
							<li class="divider">
							</li>
							<li>
								<a href="<?php echo $CONFIG['home_http']?>user/logout/">
								<i class="icon-key"></i> Log Out </a>
							</li>
						</ul>
					</li>
					<!-- END USER LOGIN DROPDOWN -->
				</ul>
			</div>
			<!-- END TOP NAVIGATION MENU -->
		</div>
		<!-- END PAGE TOP -->
	</div>
	<!-- END HEADER INNER -->
</div>
<!-- END HEADER -->
<div class="clearfix">
</div>