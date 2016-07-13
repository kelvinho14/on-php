<?php 
if(function_exists('preventDA')){
	preventDA();
}else{
	die;
}

//$_PLUGIN['datepicker'] = 1;
$_PLUGIN['calendar'] = 1;
$size = sizeof($Data['widget']);

$_PAGE['jsfile'] = array();
$_PAGE['jsfile'][] = 'user/dashboard.js';
$_PAGE['cssfile'] = array();
$_FOOTER['ready_js'] = 'Dashboard.init();';
for($a=0;$a<$size;$a++){
	$_PAGE['jsfile'][] = $Data['widget'][$a].'/widget.js';
	$_FOOTER['ready_js'] .= ucfirst($Data['widget'][$a]).'.init();';
	$_PAGE['cssfile'][] = 'assets/admin/pages/css/'.$Data['widget'][$a].'.css';
}




$_FOOTER['ready_js'] .= 'App.init();';

$app = new Application();

include_once 'application/view/template/admin/admin_header.php';
?>

<!-- BEGIN CONTAINER -->
<?php ui::div_s(array('class'=>'container'))?>
	<!-- BEGIN CONTAINER -->
	<form id="mainform" name="mainform" method="post" action="<?php echo $CONFIG['home_http']?>/project/exporttask/">
	<?php ui::div_s(array('class'=>'page-container'))?>
	<?php
	$_PAGE['sidebar_dashboard'] = 1;
	
	
	$app->Load_View('template/admin/admin_sidebar',$_PAGE);
	?>
		<?php ui::div_s(array('class'=>'page-content-wrapper'))?>
			<!-- BEGIN PAGE -->
			<?php ui::div_s(array('class'=>'page-content'))?>
				<!-- BEGIN PAGE CONTAINER-->
				
						<?php include_once 'application/view/template/admin/admin_style.php';?>
							<h3 class="page-title">
				<?php echo $Admin_Lang['dashboard']?>
				</h3>
				<?php ui::div_s(array('class'=>'page-bar'))?>
				<?php ui::div_e()?>
				<div class="row" id="tilediv">
					
					<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
						<a class="dashboard-stat dashboard-stat-light red-soft" href="javascript:;">
						<div class="visual">
							<i class="fa fa-trophy"></i>
						</div>
						<div class="details">
							<div class="number">
								 12,5M$
							</div>
							<div class="desc">
								 Total Profit
							</div>
						</div>
						</a>
					</div>
					<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
						<a class="dashboard-stat dashboard-stat-light green-soft" href="javascript:;">
						<div class="visual">
							<i class="fa fa-shopping-cart"></i>
						</div>
						<div class="details">
							<div class="number">
								 549
							</div>
							<div class="desc">
								 New Orders
							</div>
						</div>
						</a>
					</div>
					<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
						<a class="dashboard-stat dashboard-stat-light purple-soft" href="javascript:;">
						<div class="visual">
							<i class="fa fa-globe"></i>
						</div>
						<div class="details">
							<div class="number">
								 +89%
							</div>
							<div class="desc">
								 Brand Popularity
							</div>
						</div>
						</a>
					</div>
				</div>
				<!-- END DASHBOARD STATS -->
				<div class="clearfix">
				</div>
				<div class="row">
					<div class="col-md-6 col-sm-6">
						<!-- BEGIN PORTLET-->
						<div class="portlet light ">
							<div class="portlet-title">
								<div class="caption">
									<i class="icon-share font-red-sunglo hide"></i>
									<span class="caption-subject font-red-sunglo bold uppercase">Revenue</span>
									<span class="caption-helper">monthly stats...</span>
								</div>
								<div class="actions">
									<div class="btn-group">
										<a href="" class="btn grey-salsa btn-circle btn-sm dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
										Filter Range&nbsp;<span class="fa fa-angle-down">
										</span>
										</a>
										<ul class="dropdown-menu pull-right">
											<li>
												<a href="javascript:;">
												Q1 2014 <span class="label label-sm label-default">
												past </span>
												</a>
											</li>
											<li>
												<a href="javascript:;">
												Q2 2014 <span class="label label-sm label-default">
												past </span>
												</a>
											</li>
											<li class="active">
												<a href="javascript:;">
												Q3 2014 <span class="label label-sm label-success">
												current </span>
												</a>
											</li>
											<li>
												<a href="javascript:;">
												Q4 2014 <span class="label label-sm label-warning">
												upcoming </span>
												</a>
											</li>
										</ul>
									</div>
								</div>
							</div>
							<div class="portlet-body">
								<div id="site_activities_loading">
									<img src="../../assets/admin/layout2/img/loading.gif" alt="loading"/>
								</div>
								<div id="site_activities_content" class="display-none">
									<div id="site_activities" style="height: 228px;">
									</div>
								</div>
								<div style="margin: 20px 0 10px 30px">
									<div class="row">
										<div class="col-md-3 col-sm-3 col-xs-6 text-stat">
											<span class="label label-sm label-success">
											Revenue: </span>
											<h3>$13,234</h3>
										</div>
										<div class="col-md-3 col-sm-3 col-xs-6 text-stat">
											<span class="label label-sm label-danger">
											Shipment: </span>
											<h3>$1,134</h3>
										</div>
										<div class="col-md-3 col-sm-3 col-xs-6 text-stat">
											<span class="label label-sm label-primary">
											Orders: </span>
											<h3>235090</h3>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- END PORTLET-->
					</div>
					<div class="col-md-6 col-sm-6" id="taskwidget">
						<?php $app->Load_View('task/widget', $Data);?>
					</div>
				</div>
				<div class="clearfix">
				</div>
				<div class="row">
					<div class="col-md-6 col-sm-6" id="calendarwidget">
						<!-- BEGIN PORTLET-->
						<?php $app->Load_View('calendar/widget', $Data);?>
						<!-- END PORTLET-->
					</div>
					<div class="col-md-6 col-sm-6">
						<!-- BEGIN PORTLET-->
						<div class="portlet light ">
							<div class="portlet-title">
								<div class="caption">
									<i class="icon-bubble font-red-sunglo"></i>
									<span class="caption-subject font-red-sunglo bold uppercase">Chats</span>
								</div>
								<div class="inputs">
									<div class="portlet-input input-inline input-small">
										<div class="input-icon right">
											<i class="icon-magnifier"></i>
											<input type="text" class="form-control input-circle" placeholder="search...">
										</div>
									</div>
								</div>
							</div>
							<div class="portlet-body" id="chats">
								<div class="scroller" style="height: 353px;" data-always-visible="1" data-rail-visible1="1">
									<ul class="chats">
										<li class="in">
											<img class="avatar" alt="" src="../../assets/admin/layout2/img/avatar1.jpg"/>
											<div class="message">
												<span class="arrow">
												</span>
												<a href="javascript:;" class="name">
												Bob Nilson </a>
												<span class="datetime">
												at 20:09 </span>
												<span class="body">
												Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. </span>
											</div>
										</li>
										<li class="out">
											<img class="avatar" alt="" src="../../assets/admin/layout2/img/avatar2.jpg"/>
											<div class="message">
												<span class="arrow">
												</span>
												<a href="javascript:;" class="name">
												Lisa Wong </a>
												<span class="datetime">
												at 20:11 </span>
												<span class="body">
												Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. </span>
											</div>
										</li>
										<li class="in">
											<img class="avatar" alt="" src="../../assets/admin/layout2/img/avatar1.jpg"/>
											<div class="message">
												<span class="arrow">
												</span>
												<a href="javascript:;" class="name">
												Bob Nilson </a>
												<span class="datetime">
												at 20:30 </span>
												<span class="body">
												Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. </span>
											</div>
										</li>
										<li class="out">
											<img class="avatar" alt="" src="../../assets/admin/layout2/img/avatar3.jpg"/>
											<div class="message">
												<span class="arrow">
												</span>
												<a href="javascript:;" class="name">
												Richard Doe </a>
												<span class="datetime">
												at 20:33 </span>
												<span class="body">
												Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. </span>
											</div>
										</li>
										<li class="in">
											<img class="avatar" alt="" src="../../assets/admin/layout2/img/avatar3.jpg"/>
											<div class="message">
												<span class="arrow">
												</span>
												<a href="javascript:;" class="name">
												Richard Doe </a>
												<span class="datetime">
												at 20:35 </span>
												<span class="body">
												Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. </span>
											</div>
										</li>
										<li class="out">
											<img class="avatar" alt="" src="../../assets/admin/layout2/img/avatar1.jpg"/>
											<div class="message">
												<span class="arrow">
												</span>
												<a href="javascript:;" class="name">
												Bob Nilson </a>
												<span class="datetime">
												at 20:40 </span>
												<span class="body">
												Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. </span>
											</div>
										</li>
										<li class="in">
											<img class="avatar" alt="" src="../../assets/admin/layout2/img/avatar3.jpg"/>
											<div class="message">
												<span class="arrow">
												</span>
												<a href="javascript:;" class="name">
												Richard Doe </a>
												<span class="datetime">
												at 20:40 </span>
												<span class="body">
												Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. </span>
											</div>
										</li>
										<li class="out">
											<img class="avatar" alt="" src="../../assets/admin/layout2/img/avatar1.jpg"/>
											<div class="message">
												<span class="arrow">
												</span>
												<a href="javascript:;" class="name">
												Bob Nilson </a>
												<span class="datetime">
												at 20:54 </span>
												<span class="body">
												Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. sed diam nonummy nibh euismod tincidunt ut laoreet. </span>
											</div>
										</li>
									</ul>
								</div>
								<div class="chat-form">
									<div class="input-cont">
										<input class="form-control" type="text" placeholder="Type a message here..."/>
									</div>
									<div class="btn-cont">
										<span class="arrow">
										</span>
										<a href="" class="btn blue icn-only">
										<i class="fa fa-check icon-white"></i>
										</a>
									</div>
								</div>
							</div>
						</div>
						<!-- END PORTLET-->
					</div>
				</div>
			
			</form>
		</div>
	</div>
</div>
	<?php
	
	include_once 'application/view/template/admin/admin_footer.php';
	?>