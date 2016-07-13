<?php 
if(function_exists('preventDA')){
	preventDA();
}else{
	die;
}

$input['title'] = 'Projects';
$input['titlecolor'] = 'font-green-sharp';
$input['action']['collapse'] = true;
$input['action']['reload'] = true;
UIElementController::render ( "portlet_start", $input );
unset ( $input );
?>
<div class="portlet-body todo-project-list-content">
<?php

/*$input['for'] = 'project_status';
$input['value'] = 'Project';
UIElementController::render("label",$input);
unset($input);*/

/*$input['id']         = 'project_id';
$input['attr'] = array('class'=>'form-control');
UIElementController::render("select",$input);
unset($input);

$input['for'] = 'project_status';
$input['value'] = 'Status';
UIElementController::render("label",$input);
unset($input);

$input['option'] = array(array(0,'Incomplete'),array(1,'In progress'),array(2,'Completed'));
$input['id']         = 'project_status';
$input['attr'] = array('class'=>'form-control');
UIElementController::render("select",$input);
unset($input);*/
?>	
	<div class="todo-project-list">
		<?php include_once('task_prjtasklist.php')?>
		<!-- <ul class="nav nav-pills nav-stacked">
			<li><a href="javascript:;" class="focusProject" data-id="1"> <span class="badge badge-success"> 6 </span>
					AirAsia Ads </a>
			</li>
			<li><a href="javascript:;" class="focusProject" data-id="2"> <span class="badge badge-success"> 2 </span>
					HSBC Promo </a>
			</li>
			<li class="active"><a href="javascript:;" class="focusProject" data-id="3"> <span
					class="badge badge-success badge-active"> 3 </span> GlobalEx System
			</a>
			</li>
			<li><a href="javascript:;" class="focusProject" data-id="4"> <span class="badge badge-default"> 14 </span>
					Empire City </a>
			</li>
			<li><a href="javascript:;" class="focusProject" data-id="5"> <span class="badge badge-success"> 6 </span>
					AirAsia Ads </a>
			</li>
			<li><a href="javascript:;" class="focusProject" data-id="5"> <span class="badge badge-success"> 2 </span>
					Loop Inc Promo </a>
			</li>
		</ul> -->
	</div>
</div>
<?php

UIElementController::render ( "portlet_end", $input );
unset ( $input );
?>


<?php
$input['title'] = 'My list 1';
$input['titlecolor'] = 'font-green-sharp';
$input['action']['collapse'] = true;
$input['action']['remove']['id'] = 'removetasklist';
UIElementController::render ( "portlet_start", $input );
unset ( $input );
?>
<div class="portlet-body todo-project-list-content">
	<div class="todo-project-list" id="mytasklist">
		<?php include_once('task_mytasklist.php')?>
	</div>
	<div><?php echo ui::addBtn('',array('id'=>'addTaskList'))?></div>
</div>
<?php

UIElementController::render ( "portlet_end", $input );
unset ( $input );
?>
