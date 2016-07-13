<?php 
if(function_exists('preventDA')){
	preventDA();
}else{
	die;
}
?>
<div class="scroller" style="height: 305px" data-always-visible="1"
	data-rail-visible="1">
	<div class="todo-tasklist">
	<?php 
		$tasksize = sizeof($Data['milestone']['task']);
		for($a=0;$a<$tasksize;$a++){
			switch($Data['milestone']['task'][$a]['Status']){
				case STATUS_ACTIVEPRJTASK:
					$status_class = 'active';
				break;
			}
			if(timeDiff(date('Y-m-d H:i:s'),$Data['milestone']['task'][$a]['RealDeadline'])<0){
				$status_class = 'overdue';
			}
			
	?>		
	
	<div class="todo-tasklist-item todo-tasklist-item-<? echo $status_class?>">
			<img class="todo-userpic pull-left"
				src="/theme/assets/admin/layout2/img/avatar4.jpg" width="27px"
				height="27px">
			<div class="todo-tasklist-item-title"><?php echo $Data['milestone']['task'][$a]['Name']?></div>
			<div class="todo-tasklist-item-text"><?php echo nl2br($Data['milestone']['task'][$a]['Objective'])?></div>
			<div class="todo-tasklist-controls pull-left">
				<span class="todo-tasklist-date"><i class="fa fa-calendar"></i> <?php echo display::date($Data['milestone']['task'][$a]['RealDeadline'])?></span>
			</div>
		</div>
			
	<?php }
	?>
	</div>
</div>
<div class="task-footer">
<?php if($Data['milestone']['task'][0]['ProjectID']>0){?>
	<span class="pull-right"> <a href="/project/task?projectid=<?php echo $Data['milestone']['task'][0]['ProjectID']?>">See All Tasks <i class="m-icon-swapright m-icon-gray"></i></a> &nbsp; </span>
<?php }?>
</div>
