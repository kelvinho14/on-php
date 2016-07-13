<?php 
if(function_exists('preventDA')){
	preventDA();
}else{
	die;
} 

//$_ACCESS = array();
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


if($AccessControl->Check_Access_Right('project','tasklist'))
	$_ACCESS['project']['tasklist'] = 1;
if($AccessControl->Check_Access_Right('project','taskadd'))
	$_ACCESS['project']['taskadd'] = 1;
if($AccessControl->Check_Access_Right('project','taskedit'))
	$_ACCESS['project']['taskedit'] = 1;
	
if($AccessControl->Check_Access_Right('project','taskcodemgt'))
	$_ACCESS['project']['taskcodemgt'] = 1;	
if($AccessControl->Check_Access_Right('project','channellistmgt'))
	$_ACCESS['project']['channellistmgt'] = 1;

//if($AccessControl->Check_Access_Right('setting','access'))
	//$_ACCESS['setting']['access_setting'] = 1;
if($AccessControl->Check_Access_Right('event','list'))
	$_ACCESS['event']['list'] = 1;


Application::Load_Model("project");
$ProjectControl = new ProjectModel();
$channels = $ProjectControl->getChannels();

//$_ACCESS['useredit'] = $AccessControl->Check_Access_Right('user','edit');
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
						if($Data['sidebar_dashboard']||$Data['sidebar_client']||$Data['sidebar_project']['channellist']||$Data['sidebar_project']['taskcodelist']){
							echo  'active open';
							$sidebarhtml = '<span class="selected"></span>';
							$sidebarhtml .= '<span class="arrow open"></span>';
						}else{
							$sidebarhtml .= '<span class="arrow"></span>';
						}?>">
						<a href="javascript:;">
						<i class="fa fa-suitcase"></i>
						<span class="title"><?php echo $Admin_Lang['dashboard']?></span>
						<?php echo $sidebarhtml?>
						</a>
						<ul class="sub-menu">
							<li class="<?php echo $Data['sidebar_dashboard']['dashboard_list']?'active':''?>">
								<a href="<?echo $CONFIG['home_http']?>user/dashboardlist/">
								<i class="fa fa-list"></i>
								<?php echo $Admin_Lang['dashboard_list']?></a>
							</li>
							<?php if($_ACCESS['client']['list']){?>
							<li class="<?php echo $Data['sidebar_client']['list']?'active':''?>">
								<a href="<?echo $CONFIG['home_http']?>user/viewclientlist/">
								<i class="fa fa-users"></i>
								<?php echo $Admin_Lang['clientmgt']?></a>
							</li>
							<?php }?>
							<?php if($_ACCESS['project']['channellistmgt'] || $_ACCESS['project']['taskcodemgt']){?>
							<li class=" 
							<?php
								if($Data['sidebar_dashboard']['dashboard_list']){
									echo 'class="active open"';
									$sidebarhtml = '<span class="selected"></span>';
									$sidebarhtml .= '<span class="arrow open"></span>';
								}else{
									$sidebarhtml .= '<span class="arrow"></span>';
								}?>">
								<a href="javascript:;">
								<i class="fa-cog fa"></i>
								<span class="title"><?php echo $Admin_Lang['setting']?></span>
								<?php echo $sidebarhtml?>
								</a>
								<ul class="sub-menu">
									<?php 
									if($_ACCESS['project']['channellistmgt']){
									?>
									<li <?php echo $Data['sidebar_project']['channellist']?'class="active"':''?>>
										<a href="<?echo $CONFIG['home_http']?>project/channellist/">
										<i class="fa fa-<?php echo $channels[$a]['Icon']?>"></i>
										<?php echo $Admin_Lang['channelmgt']?></a>
									</li>
									<?php }?>
									<?php if($_ACCESS['project']['taskcodemgt']){?>
									<li <?php echo $Data['sidebar_project']['dashboard_list']?'class="active"':''?>>
										<a href="<?echo $CONFIG['home_http']?>project/taskcodelist/">
										<i class="fa fa-<?php echo $channels[$a]['Icon']?>"></i>
										<?php echo $Admin_Lang['taskcodemgt']?></a>
									</li>
									<?php }?>
								</ul>
							</li>
							<?php }?>
						</ul>
					</li>
					
					<?php if($_ACCESS['calendar']['list']){?>
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
						<i class="fa fa-calendar "></i>
						<span class="title"><?php echo $Admin_Lang['calendar']?></span>
						<?php echo $sidebarhtml?>
						</a>
					</li>
					<?php }?>
					
					<?php if($_ACCESS['project']['tasklist']){?>
					<li <?php
						if($Data['sidebar_project'] && ($Data['sidebar_project']['channellist']==''&&$Data['sidebar_project']['taskcodelist']=='')){
							echo 'class="active open"';
							$sidebarhtml = '<span class="selected"></span>';
							$sidebarhtml .= '<span class="arrow open"></span>';
						}else{
							$sidebarhtml .= '<span class="arrow"></span>';
						}?>
					>
						<a href="<?php echo $CONFIG['home_http']?>project/panel/">
						<i class="fa-file-text-o fa"></i>
						<span class="title"><?php echo $Admin_Lang['projectmgt']?></span>
						<?php echo $sidebarhtml?>
						</a>
					</li>
					<?php }?>
					
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
						<a href="javascript:void(0)">
						<i class="icon-user"></i>
						<span class="title"><?php echo $Admin_Lang['usermgt']?></span>
						<?php echo $sidebarhtml?>
						</a>
						<ul class="sub-menu">
							<?php if($_ACCESS['user']['list']){?>
							<li <?php echo $Data['sidebar_user']['list']?'class="active"':''?>>
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
					
					<?php /*if($_ACCESS['client']){?>
					<li <?php
					
					unset($sidebarhtml);
					if($Data['sidebar_client']){
						echo 'class="active open"';
						$sidebarhtml = '<span class="selected"></span>';
						$sidebarhtml .= '<span class="arrow open"></span>';
					}else{
						$sidebarhtml .= '<span class="arrow"></span>';
					}
					?>>
						<a href="/user/viewclientlist/">
						<i class="icon-users"></i>
						<span class="title"><?php echo $Admin_Lang['clientmgt']?></span>
						<?php echo $sidebarhtml?>
						</a>
						<ul class="sub-menu">
							<?php if($_ACCESS['client']['list']){?>
							<li <?php echo $Data['sidebar_client']['view']?'class="active"':''?>>
								<a href="/user/viewclientlist/">
								<i class="fa fa-table"></i>
								<?php echo $Admin_Lang['view']?></a>
							</li>
							<?php }if($_ACCESS['client']['add']){?>
							<li <?php echo $Data['sidebar_client']['add']?'class="active"':''?>>
								<a href="/user/addclient/">
								<i class="fa fa-plus"></i>
								<?php echo $Admin_Lang['add_client']?></a>
							</li>
							<?php }?>
						</ul>
					</li>
					<?php }*/?>
					
					
					
				
					
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