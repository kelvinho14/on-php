<!DOCTYPE html>
<html class="st-layout ls-top-navbar ls-bottom-footer hide-sidebar sidebar-r2" lang="en">

<head>
<meta charset="utf-8">
  <meta http-equiv="Content-type" content="text/html; charset=utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php echo renderOgMeta($Data['og'])?>
  <meta name="author" content="Maruon">
   <meta name="apple-mobile-web-app-capable" content="yes" />
  <title><?php echo $CONFIG['site_title'][$_SESSION['language']]?></title>
  <link href="<?echo $CONFIG['home_http']?>theme/assets/<?php echo $CONFIG['asset']?>/css/vendor/all.css" rel="stylesheet">
  <link href="<?echo $CONFIG['home_http']?>theme/assets/<?php echo $CONFIG['asset']?>/css/app/app.css" rel="stylesheet">
  <link rel="stylesheet" href="<?echo $CONFIG['home_http']?>include/tools/fancybox/source/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
  <link href="<?echo $CONFIG['home_http']?>theme/assets/<?php echo $CONFIG['asset']?>/css/app/custom.css" rel="stylesheet">
</head>
<body>



  <!-- Wrapper required for sidebar transitions -->
  <div class="st-container">

    <!-- Fixed navbar -->
    <div class="navbar navbar-main navbar-primary navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-nav">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button> 
          <a class="navbar-brand" href="<?php echo $CONFIG['home_http']?>"><img src="<?echo $CONFIG['home_http']?>theme/assets/<?php echo $CONFIG['asset']?>/images/logo.png"></a>
          <!--  <a href="#sidebar-chat" data-toggle="sidebar-menu" class="toggle pull-right visible-xs"><i class="fa fa-comments"></i></a>
          <a href="#sidebar-chat" data-toggle="sidebar-menu" class="toggle pull-right visible-xs"><?php echo ui::fa('bell')?><span class="badge badgenotification"> 7 </span>	</a>-->
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="main-nav">
          
          <ul class="nav navbar-nav  navbar-right ">
          <?php if(isLoggedIn()){?>
           <li class="dropdown">
              <a href="javascript:;" class="dropdown-toggle" id="notificationddmbtn" data-toggle="dropdown">
                <?php echo ui::fa('bell')?>
                <span class="badge badgenotification" id="notificationbadge" > 7 </span>
              </a>
              <ul class="dropdown-menu notification-menu" role="menu" id="notificationmenu">
              </ul>
            </li>
            <?php }?>
            <?php /*<li class="hidden-xs">
              <a href="#sidebar-chat" data-toggle="sidebar-menu">
                <i class="fa fa-comments"></i>
              </a>
            </li>*/?>
            <!-- User -->
            <?php if(isloggedin()==false){?>
            <li>
            	<a href="<?php echo $CONFIG['home_http']?>login"><?php echo $Lang['login']?></a>
            </li>
            <?php }else{
            
            	if(class_exists('UserModel')==false){
            		$Application = new Application('');
            		$Application->Load_Model("user");
            	}
            	
            	?>  
            <li class="dropdown">
              <a href="#" class="dropdown-toggle user" data-toggle="dropdown">
                <img src="<?php echo UserModel::renderProfilePicSrc('','',1)?>" alt="<?php echo $_SESSION['user_name']?>" class="img-circle" width="40" /> <?php echo $_SESSION['user_name']?> <span class="caret"></span>
              </a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="<?php echo $CONFIG['home_http']?>setting"><?php echo $Lang['setting']?></a></li>
                <li><a href="<?php echo $CONFIG['home_http']?>logout"><?php echo $Lang['logout']?></a></li>
              </ul>
            </li>
			<?php }?>
          </ul>
        </div>
        <!-- /.navbar-collapse -->
      </div>
    </div>
    <?php if(isLoggedIn()){?>
    <div class="row ">
    	<div class="col-md-2">
    	</div>
 		<div class="col-md-8">
			<div class="btn-group btn-group-justified">
				<a class="btn btnpagemenu <?php echo $_MENU['home']?'btn-primary':'btn-default'?>" href="<?php echo $CONFIG['home_http']?>"><img src="<?echo $CONFIG['home_http']?>theme/assets/<?php echo $CONFIG['asset']?>/images/home.png" width="22px"/></a>
				<a href="<?php echo $CONFIG['home_http']?>myfeed" class="btn btnpagemenu <?php echo $_MENU['myfeed']?'btn-primary':'btn-default'?>"><img src="<?echo $CONFIG['home_http']?>theme/assets/<?php echo $CONFIG['asset']?>/images/myartists.png" width="22px"/></a>
				<a href="<?php echo $CONFIG['home_http']?>page/saved" class="btn btnpagemenu <?php echo $_MENU['saved']?'btn-primary':'btn-default'?>"><img src="<?echo $CONFIG['home_http']?>theme/assets/<?php echo $CONFIG['asset']?>/images/saved.png" width="22px"/></a>
				<a href="<?php echo $CONFIG['home_http']?>page/mypage" class="btn btnpagemenu <?php echo $_MENU['mypage']?'btn-primary':'btn-default'?>"><img src="<?echo $CONFIG['home_http']?>theme/assets/<?php echo $CONFIG['asset']?>/images/mypage.png" width="22px"/></a>
				<?php if(UserModel::isArtist()){?>
				<a href="javascript:;" id="openpost" class="btn btn-default btnpagemenu"><img src="<?echo $CONFIG['home_http']?>theme/assets/<?php echo $CONFIG['asset']?>/images/post.png" width="22px"/></a>
				<?php }?>
				
			</div>
		</div>
		<div class="col-md-2">
    	</div>
 	</div>
 	<?php }?>

  <?php //include_once('chatpanel.php')?>

    <!-- sidebar effects OUTSIDE of st-pusher: -->
    <!-- st-effect-1, st-effect-2, st-effect-4, st-effect-5, st-effect-9, st-effect-10, st-effect-11, st-effect-12, st-effect-13 -->

    <!-- content push wrapper -->
    <div class="st-pusher" id="content">

      <!-- sidebar effects INSIDE of st-pusher: -->
      <!-- st-effect-3, st-effect-6, st-effect-7, st-effect-8, st-effect-14 -->

      <!-- this is the wrapper for the content -->
      <div class="st-content" id="scrollcontent">

        <!-- extra div for emulating position:fixed of the menu -->
        <div class="st-content-inner <?php echo ($_MENU['home']||$_MENU['myfeed']||$_MENU['mypage']||$_MENU['saved']||$_MENU['userpage'])?'infscroll':''?>" id="scrollcontentinner">           