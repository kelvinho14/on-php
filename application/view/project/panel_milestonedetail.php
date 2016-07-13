<?php 
if(function_exists('preventDA')){
	preventDA();
}else{
	die;
}
?>
<div class="portlet-body">
	<!--BEGIN TABS-->
	<div class="tabbable tabbable-custom">
		<ul class="nav nav-tabs">
			<li class="active"><a href="#ms_task" data-toggle="tab" id="mstaskbtn" data-msid="<?php echo $Data['milestone']['id']?>">Tasks</a></li>
			<li><a href="#ms_activities" data-toggle="tab" onClick="MS.focusMSActivities()" data-msid="<?php echo $Data['milestone']['id']?>">Activities</a></li>
			<li><a href="#ms_staff" data-toggle="tab" id="msstaffbtn" onClick="MS.focusMSStaff()" data-msid="<?php echo $Data['milestone']['id']?>">Involved staff</a></li>
			<li><a href="#ms_todo" data-toggle="tab" onClick="MS.focusMSTodo()" data-msid="<?php echo $Data['milestone']['id']?>">To do</a></li>
			<!--  <li class="active"><a href="#ms_task" data-toggle="tab" >Tasks</a></li>
			<li><a href="#ms_activities" data-toggle="tab" >Activities</a></li>
			<li><a href="#ms_staff" data-toggle="tab" >Involved staff</a></li>
			<li><a href="#ms_todo" data-toggle="tab" >To do</a></li>-->
		</ul>
		<div class="tab-content">
			<div class="tab-pane tab tasks-widget active" id="ms_task">
				<?php include_once('panel_milestonetask.php');?>
			</div>
			<div class="tab-pane  tab" id="ms_activities">
				<?php //include_once('panel_milestoneactivities.php');?>
			</div>
			<div class="tab-pane  tab" id="ms_staff">
			<?php //include_once('panel_milestonestaff.php');?>
			</div>
			<div class="tab-pane tasks-widget  tab" id="ms_todo">
			<?php //include_once('panel_milestonetodo.php');?>
			</div>
		</div>
	</div>
	<!--END TABS-->
</div>
