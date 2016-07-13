<?php 
if(function_exists('preventDA')){
	preventDA();
}else{
	die;
}

$_PLUGIN['calendar'] = 1;
$_PLUGIN['modal'] = 1;
$_PLUGIN['datepicker'] = 1;
$_PLUGIN['timepicker'] = 1;
$_PAGE['jsfile'] = 'calendar/calendar.js';
$_FOOTER['ready_js'] .= 'Calendar.init();';
$_FOOTER['ready_js'] .= 'App.init();';
$_PAGE['jsvariable'] = 'var usertags = ["red", "green", "blue", "yellow", "pink"];';
include_once 'application/view/template/admin/admin_header.php';
?>
<!-- BEGIN CONTAINER -->
<?php ui::div_s(array('class'=>'container'))?>
	<!-- BEGIN CONTAINER -->
	<?php ui::div_s(array('class'=>'page-container'))?>
	<form action="export/" method="POST" target="_blank" id="mainform" name="mainform">
	<?php
	$_PAGE['sidebar_calendar']['calendar'] = 1;
	$app = new Application(array());
	$app->Load_View('template/admin/admin_sidebar',$_PAGE);
	?>
	<?php ui::div_s(array('id'=>'vieweventmodal','class'=>'modal fade','attr'=>array('tabindex'=>'-1','data-keyboard'=>'false','data-backdrop'=>'static')))?><?php ui::div_e()?>
	<?php ui::div_s(array('id'=>'editeventmodal','class'=>'modal fade','attr'=>array('tabindex'=>'-1','data-keyboard'=>'false','data-backdrop'=>'static')))?><?php ui::div_e()?>
	<?php ui::div_s(array('id'=>'addeventmodal','class'=>'modal fade','attr'=>array('tabindex'=>'-1','data-keyboard'=>'false','data-backdrop'=>'static')))?><?php ui::div_e()?>
	
	<?php ui::div_s(array('class'=>'page-content-wrapper'))?>
		<?php ui::div_s(array('class'=>'page-content'))?>
				<!-- BEGIN PAGE HEADER-->
				<h3 class="page-title">
				<?php echo $Admin_Lang['calendar']?>
				</h3>
				<?php ui::div_s(array('class'=>'page-bar'))?>
						<?php
							$breadcrumb_arr = array (
									array (
											'name' => $Admin_Lang['calendar'],
									)
							);
							UIElementController::render ( "breadcrumb", $breadcrumb_arr );
							?>
				<?php ui::div_e()?>
				<!-- END PAGE HEADER-->
				<!-- BEGIN PAGE CONTENT-->
				<?php ui::div_s(array('class'=>'row'))?>
					<?php ui::div_s(array('size'=>12))?>
						<?php ui::div_s(array('class'=>'portlet box green-meadow calendar'))?>
							<?php ui::div_s(array('class'=>'portlet-title'))?>
								<?php ui::div_s(array('class'=>'caption'))?>
								<?php ui::div_e()?>
							<?php ui::div_e()?>
							<?php ui::div_s(array('class'=>'portlet-body'))?>
								<?php ui::div_s(array('class'=>'row'))?>
									<?php ui::div_s(array('size'=>'2'))?>
										<!-- BEGIN DRAGGABLE EVENTS PORTLET-->
										<?php ui::div_s(array('id'=>'external-events'))?>
											<?php if($_ACCESS['calendar']['add']){
												echo ui::addBtn($Admin_Lang['eventadd'],array('id'=>'event_form')).'<br/><br/>';
											}?>
											
											<?php echo ui::exportBtn('',array('id'=>'export_event'))?>
											<hr/>
											<?php 
											$filtersize = sizeof($Data['itemfilter']);
											for($a=0;$a<$filtersize;$a++){?>
											<div>
												<input type="checkbox" id="<?php echo $Data['itemfilter'][$a]?>filter" name="<?php echo $Data['itemfilter'][$a]?>filter" class="" checked>
												<label for="<?php echo $Data['itemfilter'][$a]?>filter"><?php echo $Admin_Lang[$Data['itemfilter'][$a]]?></label>
												<div class="label label-sm " style="background-color: <?php echo $Data['itemcolor'][$Data['itemfilter'][$a]]?>">&nbsp;&nbsp;&nbsp;</div>
											</div>
											<?php }?>
											<hr class="visible-xs"/>
											
										<?php ui::div_e()?>
										<!-- END DRAGGABLE EVENTS PORTLET-->
									<?php ui::div_e()?>
									<?php ui::div_s(array('size'=>'10'))?>
										<?php ui::div_s(array('id'=>'calendar','class'=>'has-toolbar','attr'=>array("data-lang"=>"zh-tw")))?>
										<?php ui::div_e()?>
										
										
										<?php ui::div_s(array('class'=>'row'))?>
											<?php ui::div_s(array('size'=>'12','attr'=>array('style'=>'text-align:right')))?>
											&nbsp;<?php ui::div_e()?>
										<?php ui::div_e()?>
									<?php ui::div_e()?>
								<?php ui::div_e()?>
								<?php ui::div_s(array('class'=>'row'))?>
									<?php ui::div_s(array('size'=>'2'))?>
									<?php ui::div_e()?>
									<?php ui::div_s(array('size'=>'10'))?>
									<br/>
										<?php ui::div_s(array('id'=>'calendarfooter'))?>
										<?php ui::div_e()?>
									<?php ui::div_e()?>
								<?php ui::div_e()?>
								<!-- END CALENDAR PORTLET-->
							<?php ui::div_e()?>
						<?php ui::div_e()?>
					<?php ui::div_e()?>
				<?php ui::div_e()?>
				<!-- END PAGE CONTENT-->
			<?php ui::div_e()?>
		<?php ui::div_e()?>
		<input type="hidden" id="filteruserid" name="filteruserid"/>
		<input type="hidden" id="clickstart"/>
		<input type="hidden" id="clickend"/>
		<input type="hidden" id="clickstarttime"/>
		<input type="hidden" id="clickendtime"/>
		<input type="hidden" id="eventid" value="<?php echo $Data['eventid']?>" name="eventid"/>
		<input type="hidden" id="gotodate" value="<?php echo $Data['gotodate']?>"/>
		<input type="hidden" id="loadcalmsg" value="<?php echo $Admin_Lang['loading']?>"/>
		<input type="hidden" id="getdataerror" value="<?php echo $Admin_Lang['growl']['calendar_getdateerror']?>"/>
		<input type="hidden" id="currentviewstart" name="currentviewstart"/>
		<input type="hidden" id="currentviewtype" name="currentviewtype"/>
			<!-- END PAGE -->
		</form>
<?php ui::div_e()?>
	<!-- END CONTAINER -->
<?php
include_once 'application/view/template/admin/admin_footer.php';
?>