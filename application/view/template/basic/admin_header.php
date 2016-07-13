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


// artist
$classname = $Application->Load_Model("artist");
$ArtistControl = new $classname();
$artistmenu = $ArtistControl->getMenu();






$AccessControl = new AccessModel();
if($AccessControl->Check_Access_Right('user','list'))
	$_ACCESS['user']['list'] = 1;
if($AccessControl->Check_Access_Right('user','add'))
	$_ACCESS['user']['add'] = 1;
if($AccessControl->Check_Access_Right('user','edit'))
	$_ACCESS['user']['edit'] = 1;

if($AccessControl->Check_Access_Right('client','list'))
	$_ACCESS['client']['list'] = 1;
if($AccessControl->Check_Access_Right('client','add'))
	$_ACCESS['client']['add'] = 1;
if($AccessControl->Check_Access_Right('client','edit'))
	$_ACCESS['client']['edit'] = 1;

if($AccessControl->Check_Access_Right('calendar','list'))
	$_ACCESS['calendar']['list'] = 1;
if($AccessControl->Check_Access_Right('calendar','add'))
	$_ACCESS['calendar']['add'] = 1;
if($AccessControl->Check_Access_Right('calendar','edit'))
	$_ACCESS['calendar']['edit'] = 1;


if($AccessControl->Check_Access_Right('file','view'))
	$_ACCESS['file']['view'] = 1;
if($AccessControl->Check_Access_Right('file','upload'))
	$_ACCESS['file']['upload'] = 1;


//if($AccessControl->Check_Access_Right('setting','access'))
	//$_ACCESS['setting']['access_setting'] = 1;
if($AccessControl->Check_Access_Right('event','list'))
	$_ACCESS['event']['list'] = 1;
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
<link href="<?echo $CONFIG['home_http']?>theme/assets/admin/<?php echo $CONFIG['asset']?>/css/layout.css" rel="stylesheet" type="text/css"/>
<link id="style_color" href="<?echo $CONFIG['home_http']?>theme/assets/admin/<?php echo $CONFIG['asset']?>/css/themes/grey.css" rel="stylesheet" type="text/css"/>
<link href="<?echo $CONFIG['home_http']?>theme/assets/admin/<?php echo $CONFIG['asset']?>/css/custom.css" rel="stylesheet" type="text/css"/>
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
<!-- DOC: Apply "page-header-menu-fixed" class to set the mega menu fixed  -->
<!-- DOC: Apply "page-header-top-fixed" class to set the top menu fixed  -->
<body class="page-md">
<!-- BEGIN HEADER -->
<div class="page-header">
	<!-- BEGIN HEADER TOP -->
	<div class="page-header-top">
		<div class="container">
			<!-- BEGIN LOGO -->
			<div class="page-logo">
				<a href="index.html"><img src="<?echo $CONFIG['home_http']?>theme/assets/admin/layout3/img/logo-default.png" alt="logo" class="logo-default"></a>
			</div>
			<!-- END LOGO -->
			<!-- BEGIN RESPONSIVE MENU TOGGLER -->
			<a href="javascript:;" class="menu-toggler"></a>
			<!-- END RESPONSIVE MENU TOGGLER -->
			<!-- BEGIN TOP NAVIGATION MENU -->
			<div class="top-menu">
				<ul class="nav navbar-nav pull-right">
					<!-- BEGIN NOTIFICATION DROPDOWN -->
					<li class="dropdown dropdown-extended dropdown-dark dropdown-notification" id="header_notification_bar">
						<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
						<i class="icon-bell"></i>
						<span class="badge badge-default">7</span>
						</a>
						<ul class="dropdown-menu">
							<li class="external">
								<h3>You have <strong>12 pending</strong> tasks</h3>
								<a href="javascript:;">view all</a>
							</li>
							<li>
								<ul class="dropdown-menu-list scroller" style="height: 250px;" data-handle-color="#637283">
									<li>
										<a href="javascript:;">
										<span class="time">just now</span>
										<span class="details">
										<span class="label label-sm label-icon label-success">
										<i class="fa fa-plus"></i>
										</span>
										New user registered. </span>
										</a>
									</li>
									<li>
										<a href="javascript:;">
										<span class="time">3 mins</span>
										<span class="details">
										<span class="label label-sm label-icon label-danger">
										<i class="fa fa-bolt"></i>
										</span>
										Server #12 overloaded. </span>
										</a>
									</li>
									<li>
										<a href="javascript:;">
										<span class="time">10 mins</span>
										<span class="details">
										<span class="label label-sm label-icon label-warning">
										<i class="fa fa-bell-o"></i>
										</span>
										Server #2 not responding. </span>
										</a>
									</li>
									<li>
										<a href="javascript:;">
										<span class="time">14 hrs</span>
										<span class="details">
										<span class="label label-sm label-icon label-info">
										<i class="fa fa-bullhorn"></i>
										</span>
										Application error. </span>
										</a>
									</li>
									<li>
										<a href="javascript:;">
										<span class="time">2 days</span>
										<span class="details">
										<span class="label label-sm label-icon label-danger">
										<i class="fa fa-bolt"></i>
										</span>
										Database overloaded 68%. </span>
										</a>
									</li>
									<li>
										<a href="javascript:;">
										<span class="time">3 days</span>
										<span class="details">
										<span class="label label-sm label-icon label-danger">
										<i class="fa fa-bolt"></i>
										</span>
										A user IP blocked. </span>
										</a>
									</li>
									<li>
										<a href="javascript:;">
										<span class="time">4 days</span>
										<span class="details">
										<span class="label label-sm label-icon label-warning">
										<i class="fa fa-bell-o"></i>
										</span>
										Storage Server #4 not responding dfdfdfd. </span>
										</a>
									</li>
									<li>
										<a href="javascript:;">
										<span class="time">5 days</span>
										<span class="details">
										<span class="label label-sm label-icon label-info">
										<i class="fa fa-bullhorn"></i>
										</span>
										System Error. </span>
										</a>
									</li>
									<li>
										<a href="javascript:;">
										<span class="time">9 days</span>
										<span class="details">
										<span class="label label-sm label-icon label-danger">
										<i class="fa fa-bolt"></i>
										</span>
										Storage server failed. </span>
										</a>
									</li>
								</ul>
							</li>
						</ul>
					</li>
					<!-- END NOTIFICATION DROPDOWN -->
					<!-- BEGIN TODO DROPDOWN -->
					<li class="dropdown dropdown-extended dropdown-dark dropdown-tasks" id="header_task_bar">
						<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
						<i class="icon-calendar"></i>
						<span class="badge badge-default">3</span>
						</a>
						<ul class="dropdown-menu extended tasks">
							<li class="external">
								<h3>You have <strong>12 pending</strong> tasks</h3>
								<a href="javascript:;">view all</a>
							</li>
							<li>
								<ul class="dropdown-menu-list scroller" style="height: 275px;" data-handle-color="#637283">
									<li>
										<a href="javascript:;">
										<span class="task">
										<span class="desc">New release v1.2 </span>
										<span class="percent">30%</span>
										</span>
										<span class="progress">
										<span style="width: 40%;" class="progress-bar progress-bar-success" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"><span class="sr-only">40% Complete</span></span>
										</span>
										</a>
									</li>
									<li>
										<a href="javascript:;">
										<span class="task">
										<span class="desc">Application deployment</span>
										<span class="percent">65%</span>
										</span>
										<span class="progress">
										<span style="width: 65%;" class="progress-bar progress-bar-danger" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"><span class="sr-only">65% Complete</span></span>
										</span>
										</a>
									</li>
									<li>
										<a href="javascript:;">
										<span class="task">
										<span class="desc">Mobile app release</span>
										<span class="percent">98%</span>
										</span>
										<span class="progress">
										<span style="width: 98%;" class="progress-bar progress-bar-success" aria-valuenow="98" aria-valuemin="0" aria-valuemax="100"><span class="sr-only">98% Complete</span></span>
										</span>
										</a>
									</li>
									<li>
										<a href="javascript:;">
										<span class="task">
										<span class="desc">Database migration</span>
										<span class="percent">10%</span>
										</span>
										<span class="progress">
										<span style="width: 10%;" class="progress-bar progress-bar-warning" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"><span class="sr-only">10% Complete</span></span>
										</span>
										</a>
									</li>
									<li>
										<a href="javascript:;">
										<span class="task">
										<span class="desc">Web server upgrade</span>
										<span class="percent">58%</span>
										</span>
										<span class="progress">
										<span style="width: 58%;" class="progress-bar progress-bar-info" aria-valuenow="58" aria-valuemin="0" aria-valuemax="100"><span class="sr-only">58% Complete</span></span>
										</span>
										</a>
									</li>
									<li>
										<a href="javascript:;">
										<span class="task">
										<span class="desc">Mobile development</span>
										<span class="percent">85%</span>
										</span>
										<span class="progress">
										<span style="width: 85%;" class="progress-bar progress-bar-success" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"><span class="sr-only">85% Complete</span></span>
										</span>
										</a>
									</li>
									<li>
										<a href="javascript:;">
										<span class="task">
										<span class="desc">New UI release</span>
										<span class="percent">38%</span>
										</span>
										<span class="progress progress-striped">
										<span style="width: 38%;" class="progress-bar progress-bar-important" aria-valuenow="18" aria-valuemin="0" aria-valuemax="100"><span class="sr-only">38% Complete</span></span>
										</span>
										</a>
									</li>
								</ul>
							</li>
						</ul>
					</li>
					<!-- END TODO DROPDOWN -->
					<li class="droddown dropdown-separator">
						<span class="separator"></span>
					</li>
					<!-- BEGIN INBOX DROPDOWN -->
					<li class="dropdown dropdown-extended dropdown-dark dropdown-inbox" id="header_inbox_bar">
						<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
						<span class="circle">3</span>
						<span class="corner"></span>
						</a>
						<ul class="dropdown-menu">
							<li class="external">
								<h3>You have <strong>7 New</strong> Messages</h3>
								<a href="javascript:;">view all</a>
							</li>
							<li>
								<ul class="dropdown-menu-list scroller" style="height: 275px;" data-handle-color="#637283">
									<li>
										<a href="inbox.html?a=view">
										<span class="photo">
										<img src="<?echo $CONFIG['home_http']?>theme/assets/admin/layout3/img/avatar2.jpg" class="img-circle" alt="">
										</span>
										<span class="subject">
										<span class="from">
										Lisa Wong </span>
										<span class="time">Just Now </span>
										</span>
										<span class="message">
										Vivamus sed auctor nibh congue nibh. auctor nibh auctor nibh... </span>
										</a>
									</li>
									<li>
										<a href="inbox.html?a=view">
										<span class="photo">
										<img src="<?echo $CONFIG['home_http']?>theme/assets/admin/layout3/img/avatar3.jpg" class="img-circle" alt="">
										</span>
										<span class="subject">
										<span class="from">
										Richard Doe </span>
										<span class="time">16 mins </span>
										</span>
										<span class="message">
										Vivamus sed congue nibh auctor nibh congue nibh. auctor nibh auctor nibh... </span>
										</a>
									</li>
									<li>
										<a href="inbox.html?a=view">
										<span class="photo">
										<img src="<?echo $CONFIG['home_http']?>theme/assets/admin/layout3/img/avatar1.jpg" class="img-circle" alt="">
										</span>
										<span class="subject">
										<span class="from">
										Bob Nilson </span>
										<span class="time">2 hrs </span>
										</span>
										<span class="message">
										Vivamus sed nibh auctor nibh congue nibh. auctor nibh auctor nibh... </span>
										</a>
									</li>
									<li>
										<a href="inbox.html?a=view">
										<span class="photo">
										<img src="<?echo $CONFIG['home_http']?>theme/assets/admin/layout3/img/avatar2.jpg" class="img-circle" alt="">
										</span>
										<span class="subject">
										<span class="from">
										Lisa Wong </span>
										<span class="time">40 mins </span>
										</span>
										<span class="message">
										Vivamus sed auctor 40% nibh congue nibh... </span>
										</a>
									</li>
									<li>
										<a href="inbox.html?a=view">
										<span class="photo">
										<img src="<?echo $CONFIG['home_http']?>theme/assets/admin/layout3/img/avatar3.jpg" class="img-circle" alt="">
										</span>
										<span class="subject">
										<span class="from">
										Richard Doe </span>
										<span class="time">46 mins </span>
										</span>
										<span class="message">
										Vivamus sed congue nibh auctor nibh congue nibh. auctor nibh auctor nibh... </span>
										</a>
									</li>
								</ul>
							</li>
						</ul>
					</li>
					<!-- END INBOX DROPDOWN -->
					<!-- BEGIN USER LOGIN DROPDOWN -->
					<li class="dropdown dropdown-user dropdown-dark">
						<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
						<img alt="" class="img-circle" src="<?echo $profileimgsrc?>">
						<span class="username username-hide-mobile"><?php echo $_SESSION['user_name']?></span>
						</a>
						<ul class="dropdown-menu dropdown-menu-default">
							<li>
								<a href="extra_profile.html">
								<i class="icon-user"></i> My Profile </a>
							</li>
							<li>
								<a href="page_calendar.html">
								<i class="icon-calendar"></i> My Calendar </a>
							</li>
							<li>
								<a href="inbox.html">
								<i class="icon-envelope-open"></i> My Inbox <span class="badge badge-danger">
								3 </span>
								</a>
							</li>
							<li>
								<a href="javascript:;">
								<i class="icon-rocket"></i> My Tasks <span class="badge badge-success">
								7 </span>
								</a>
							</li>
							<li class="divider">
							</li>
							<li>
								<a href="extra_lock.html">
								<i class="icon-lock"></i> Lock Screen </a>
							</li>
							<li>
								<a href="login.html">
								<i class="icon-key"></i> Log Out </a>
							</li>
						</ul>
					</li>
					<!-- END USER LOGIN DROPDOWN -->
					<!-- BEGIN USER LOGIN DROPDOWN -->
					<li class="dropdown dropdown-extended quick-sidebar-toggler">
	                    <span class="sr-only">Toggle Quick Sidebar</span>
	                    <i class="icon-logout"></i>
	                </li>
					<!-- END USER LOGIN DROPDOWN -->
				</ul>
			</div>
			<!-- END TOP NAVIGATION MENU -->
		</div>
	</div>
	<!-- END HEADER TOP -->
	<!-- BEGIN HEADER MENU -->
	<div class="page-header-menu">
		<div class="container">
			<!-- BEGIN HEADER SEARCH BOX -->
			<form class="search-form" action="extra_search.html" method="GET">
				<div class="input-group">
					<input type="text" class="form-control" placeholder="Search" name="query">
					<span class="input-group-btn">
					<a href="javascript:;" class="btn submit"><i class="icon-magnifier"></i></a>
					</span>
				</div>
			</form>
			<!-- END HEADER SEARCH BOX -->
			<!-- BEGIN MEGA MENU -->
			<!-- DOC: Apply "hor-menu-light" class after the "hor-menu" class below to have a horizontal menu with white background -->
			<!-- DOC: Remove data-hover="dropdown" and data-close-others="true" attributes below to disable the dropdown opening on mouse hover -->
			<div class="hor-menu ">
				<ul class="nav navbar-nav">
					<li class="active">
						<a href="index.html">Dashboard</a>
					</li>
					<li class="menu-dropdown mega-menu-dropdown ">
						<a data-hover="megamenu-dropdown" data-close-others="true" data-toggle="dropdown" href="javascript:;" class="dropdown-toggle">
						Artist <i class="fa fa-angle-down"></i>
						</a>
						<ul class="dropdown-menu" style="min-width: 710px">
							<li>
								<div class="mega-menu-content">
									<div class="row">
										<?php 
										foreach($artistmenu['item'] as $k=>$v){?>
										<div class="col-md-<?php echo $artistmenu['block']?>">
											<ul class="mega-menu-submenu">
												<li>
													<h3><?php echo $k?></h3>
												</li>
												<?php $itemsize = sizeof($v);
												for($b=0;$b<$itemsize;$b++){
												?>
												<li>
													<a href="<?php echo $v[$b]['Url']?>" class="iconify"><i class="icon-home"></i><?php echo $v[$b]['Name']?></a>
												</li>
												<?php }?>
												
											</ul>
										</div>
										<?php }
										unset($menusize);?>
									</div>
								</div>
							</li>
						</ul>
					</li>
					<li class="menu-dropdown mega-menu-dropdown mega-menu-full ">
						<a data-hover="megamenu-dropdown" data-close-others="true" data-toggle="dropdown" href="javascript:;" class="dropdown-toggle">
						Pages <i class="fa fa-angle-down"></i>
						</a>
						<ul class="dropdown-menu">
							<li>
								<div class="mega-menu-content">
									<div class="row">
										<div class="col-md-3">
											<ul class="mega-menu-submenu">
												<li>
													<h3>User Pages</h3>
												</li>
												<li>
													<a href="page_timeline.html">
													<i class="fa fa-angle-right"></i>
													New Timeline <span class="badge badge-warning">2</span></a>
												</li>
												<li>
													<a href="extra_profile.html">
													<i class="fa fa-angle-right"></i>
													New User Profile <span class="badge badge-success badge-roundless">new</span></a>
												</li>
												<li>
													<a href="page_todo.html">
													<i class="fa fa-angle-right"></i>
													Todo & Tasks <span class="badge badge-danger">4</span></a>
												</li>
												<li>
													<a href="inbox.html">
													<i class="fa fa-angle-right"></i>
													User Inbox <span class="badge badge-success">4</span></a>
												</li>
												<li>
													<a href="page_calendar.html">
													<i class="fa fa-angle-right"></i>
													User Calendar <span class="badge badge-warning">14</span></a>
												</li>
												<li>
													<a href="page_timeline_old.html">
													<i class="fa fa-angle-right"></i>
													Old Timeline <span class="badge badge-warning">2</span></a>
												</li>
												<li>
													<a href="extra_profile_old.html">
													<i class="fa fa-angle-right"></i>
													Old User Profile </a>
												</li>
											</ul>
										</div>
										<div class="col-md-3">
											<ul class="mega-menu-submenu">
												<li>
													<h3>General Pages</h3>
												</li>
												<li>
													<a href="extra_faq.html">
													<i class="fa fa-angle-right"></i>
													FAQ Page </a>
												</li>
												<li>
													<a href="page_portfolio.html">
													<i class="fa fa-angle-right"></i>
													Portfolio </a>
												</li>
												<li>
													<a href="page_timeline.html">
													<i class="fa fa-angle-right"></i>
													Timeline <span class="badge badge-info">4</span></a>
												</li>
												<li>
													<a href="page_coming_soon.html">
													<i class="fa fa-angle-right"></i>
													Coming Soon </a>
												</li>
												<li>
													<a href="extra_invoice.html">
													<i class="fa fa-angle-right"></i>
													Invoice </a>
												</li>
												<li>
													<a href="page_blog.html">
													<i class="fa fa-angle-right"></i>
													Blog </a>
												</li>
												<li>
													<a href="page_blog_item.html">
													<i class="fa fa-angle-right"></i>
													Blog Post </a>
												</li>
											</ul>
										</div>
										<div class="col-md-3">
											<ul class="mega-menu-submenu">
												<li>
													<h3>Custom Pages</h3>
												</li>
												<li>
													<a href="page_news.html">
													<i class="fa fa-angle-right"></i>
													News <span class="badge badge-success">9</span></a>
												</li>
												<li>
													<a href="page_news_item.html">
													<i class="fa fa-angle-right"></i>
													News View </a>
												</li>
												<li>
													<a href="page_about.html">
													<i class="fa fa-angle-right"></i>
													About Us </a>
												</li>
												<li>
													<a href="page_contact.html">
													<i class="fa fa-angle-right"></i>
													Contact Us </a>
												</li>
												<li>
													<a href="extra_search.html">
													<i class="fa fa-angle-right"></i>
													Search Results </a>
												</li>
												<li>
													<a href="extra_pricing_table.html">
													<i class="fa fa-angle-right"></i>
													Pricing Tables </a>
												</li>
												<li>
													<a href="login.html">
													<i class="fa fa-angle-right"></i>
													Login Form 1 </a>
												</li>
												<li>
													<a href="login_2.html">
													<i class="fa fa-angle-right"></i>
													Login Form 2 </a>
												</li>
												<li>
													<a href="login_3.html">
													<i class="fa fa-angle-right"></i>
													Login Form 3 </a>
												</li>
												<li>
													<a href="login_soft.html">
													<i class="fa fa-angle-right"></i>
													Login Form 4 </a>
												</li>
											</ul>
										</div>
										<div class="col-md-3">
											<ul class="mega-menu-submenu">
												<li>
													<h3>Miscellaneous</h3>
												</li>
												<li>
													<a href="extra_lock.html">
													<i class="fa fa-angle-right"></i>
													Lock Screen 1 </a>
												</li>
												<li>
													<a href="extra_lock2.html">
													<i class="fa fa-angle-right"></i>
													Lock Screen 2 </a>
												</li>
												<li>
													<a href="extra_404_option1.html">
													<i class="fa fa-angle-right"></i>
													404 Page Option 1 </a>
												</li>
												<li>
													<a href="extra_404_option2.html">
													<i class="fa fa-angle-right"></i>
													404 Page Option 2 </a>
												</li>
												<li>
													<a href="extra_404_option3.html">
													<i class="fa fa-angle-right"></i>
													404 Page Option 3 </a>
												</li>
												<li>
													<a href="extra_500_option1.html">
													<i class="fa fa-angle-right"></i>
													500 Page Option 1 </a>
												</li>
												<li>
													<a href="extra_500_option2.html">
													<i class="fa fa-angle-right"></i>
													500 Page Option 2 </a>
												</li>

											</ul>
										</div>
									</div>
								</div>
							</li>
						</ul>
					</li>
					<li class="menu-dropdown">
						<a href="angularjs" target="_blank" class="tooltips" data-container="body" data-placement="bottom" data-html="true" data-original-title="AngularJS version demo">
						AngularJS Version </a>
					</li>
				</ul>
			</div>
			<!-- END MEGA MENU -->
		</div>
	</div>
	<!-- END HEADER MENU -->
</div>
<!-- END HEADER -->