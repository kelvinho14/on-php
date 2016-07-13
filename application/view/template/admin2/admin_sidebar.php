<?php 
if(function_exists('preventDA')){
	preventDA();
}else{
	die;
} 

/*$_SIDEBAR = array();
$AccessControl = new AccessModel();
if($AccessControl->Check_Access_Right('user','viewlist'))
	$_SIDEBAR['user']['list'] = 1;
if($AccessControl->Check_Access_Right('user','add'))
	$_SIDEBAR['user']['add'] = 1;
if($AccessControl->Check_Access_Right('report','calendar'))
	$_SIDEBAR['report']['calendar'] = 1;
if($AccessControl->Check_Access_Right('setting','access'))
	$_SIDEBAR['setting']['access_setting'] = 1;

if($AccessControl->Check_Access_Right('calendar','view'))
	$_SIDEBAR['calendar']['view'] = 1;


*/

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
<!-- BEGIN SIDEBAR -->
		<div class="page-sidebar-wrapper">
			<!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
			<!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
			<div class="page-sidebar navbar-collapse collapse">
				<!-- BEGIN SIDEBAR MENU -->
				<!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
				<!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
				<!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
				<!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
				<!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
				<!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
				<ul class="page-sidebar-menu page-sidebar-menu-hover-submenu " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
					<li class="start 
					<?php
					unset($sidebarhtml);
					if($Data['sidebar_dashboard']){
						echo ' active open';
					}
					?>">
						<a href="<?echo $CONFIG['home_http']?>user/dashboard/">
						<i class="icon-home"></i>
						<span class="title"><?php echo $Admin_Lang['dashboard']?></span>
						</a>
					</li>
					
					<?php if($_ACCESS['user']){?>
					<li <?php
					unset($sidebarhtml);
					if($Data['sidebar_user']){
						echo 'class="active open"';
						$sidebarhtml = '<span class="selected"></span>';
						$sidebarhtml .= '<span class="arrow open"></span>';
					}else{
						$sidebarhtml .= '<span class="arrow"></span>';
					}
					?>>
						<a href="<?echo $CONFIG['home_http']?>user/viewlist">
						<i class="icon-user"></i>
						<span class="title"><?php echo $Admin_Lang['usermgt']?></span>
						<?php echo $sidebarhtml?>
						</a>
						<ul class="sub-menu">
							<?php if($_ACCESS['user']['list']){?>
							<li <?php echo $Data['sidebar_user']['view']?'class="active"':''?>>
								<a href="<?echo $CONFIG['home_http']?>user/viewlist/">
								<i class="fa fa-table"></i>
								<?php echo $Admin_Lang['view']?></a>
							</li>
							<?php }if($_ACCESS['user']['add']){?>
							<li <?php echo $Data['sidebar_user']['add']?'class="active"':''?>>
								<a href="<?echo $CONFIG['home_http']?>user/add/">
								<i class="fa fa-plus"></i>
								<?php echo $Admin_Lang['add_user']?></a>
							</li>
							<?php }?>
						</ul>
					</li>
					<?php }?>
					<li>
						<a href="<?echo $CONFIG['home_http']?>project/panel/?id=1">
						<i class="icon-rocket"></i>
						<span class="title">Project</span>
						<span class="arrow "></span>
						</a>
						<ul class="sub-menu">
							<li>
								<a href="<?echo $CONFIG['home_http']?>project/panel/?id=1">
								<span class="badge badge-roundless badge-danger">new</span>View</a>
							</li>
							<li>
								<a href="<?echo $CONFIG['home_http']?>project/add"><i class="fa fa-plus"></i>Add</a>
							</li>
						</ul>
					</li>
					<li <?php
					unset($sidebarhtml);
					if($Data['sidebar_mytask']){
						echo 'class="active open"';
						$sidebarhtml = '<span class="selected"></span>';
						$sidebarhtml .= '<span class="arrow open"></span>';
					}else{
						$sidebarhtml .= '<span class="arrow"></span>';
					}
					?>>
						<a href="<?echo $CONFIG['home_http']?>task/mytask/">
						<?php echo ui::fa($CONFIG['task']['fa'])?>
						<span class="title"><?php echo $Admin_Lang['task']?></span>
						<span class="arrow "></span>
						</a>
					</li>
					<?php if($_ACCESS['file']['view']){?>
					<li <?php
					unset($sidebarhtml);
					if($Data['sidebar_file']){
						echo 'class="active open"';
						$sidebarhtml = '<span class="selected"></span>';
						$sidebarhtml .= '<span class="arrow open"></span>';
					}else{
						$sidebarhtml .= '<span class="arrow"></span>';
					}
					?>>
						<a href="<?echo $CONFIG['home_http']?>file/library/">
						<?php echo ui::fa($CONFIG['file']['fa'])?>
						<span class="title"><?php echo $Admin_Lang['file']?></span>
						<span class="arrow "></span>
						</a>
					</li>
					<?php }?>
					<?php if($_ACCESS['calendar']){?>
					<li class=" 
					<?php
					unset($sidebarhtml);
					if($Data['sidebar_calendar']){
						echo ' active open';
						$sidebarhtml = '<span class="selected"></span>';
						$sidebarhtml .= '<span class="arrow open"></span>';
					}else{
						$sidebarhtml .= '<span class="arrow"></span>';
					}
					?>
					">
						<a href="<?echo $CONFIG['home_http']?>calendar/calendar">
						<?php echo ui::fa($CONFIG['calendar']['fa'])?>
						<span class="title"><?php echo $Admin_Lang['calendar']?></span>
						<?php echo $sidebarhtml?>
						</a>
						
					</li>
					<?php }?>
					
					<?php if($_ACCESS['report']){?>
					<li class=" 
					<?php
					unset($sidebarhtml);
					if($Data['sidebar_report']){
						echo ' active open';
						$sidebarhtml = '<span class="selected"></span>';
						$sidebarhtml .= '<span class="arrow open"></span>';
					}else{
						$sidebarhtml .= '<span class="arrow"></span>';
					}
					?>
					">
						<a href="javascript:;">
						<i class="fa fa-bar-chart-o "></i>
						<span class="title"><?php echo $Admin_Lang['report']?></span>
						<?php echo $sidebarhtml?>
						</a>
						<ul class="sub-menu">
							<?php if($_ACCESS['report']['calendar']){?>
							<li <?php echo $Data['sidebar_report']['calendar']?'class="active"':''?>>
								<a href="<?echo $CONFIG['home_http']?>report/calendar"><i class="fa fa-calendar"></i><?php echo $Admin_Lang['calendar_view']?></a>
							</li>
							<?php }?>
						</ul>
					</li>
					<?php }?>
					
					
					<?php if($_ACCESS['setting']){?>
					<li class=" 
					<?php
					unset($sidebarhtml);
					if($Data['sidebar_setting']){
						echo ' active open';
						$sidebarhtml = '<span class="selected"></span>';
						$sidebarhtml .= '<span class="arrow open"></span>';
					}else{
						$sidebarhtml .= '<span class="arrow"></span>';
					}
					?>
					">
						<a href="javascript:;">
						<i class="fa fa-gear "></i>
						<span class="title"><?php echo $Admin_Lang['setting']?></span>
						<?php echo $sidebarhtml?>
						</a>
						<ul class="sub-menu">
							<?php if($_ACCESS['setting']['access_setting']){?>
							<li <?php echo $Data['sidebar_setting']['access']?'class="active"':''?>>
								<a href="<?echo $CONFIG['home_http']?>setting/access"><i class="fa fa-check"></i><?php echo $Admin_Lang['access_setting']?></a>
							</li>
							<?php }?>
						</ul>
					</li>
					<?php }?>
					
				</ul>
				<!-- END SIDEBAR MENU -->
			</div>
		</div>
		<!-- END SIDEBAR -->