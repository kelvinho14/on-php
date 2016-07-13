<?php 
if(function_exists('preventDA')){
	preventDA();
}else{
	die;
}
?>
<div class="portlet light">
	<!-- PROJECT HEAD -->
	<div class="portlet-title">
		<div class="caption">
			<span class="caption-helper">Project:</span> &nbsp; <span class="caption-subject font-green-sharp bold">
				<?php echo $Data['itemlist'][0]['ProjectName']; ?>
				</span>
		</div>
	</div>
	<!-- end PROJECT HEAD -->
	<div class="portlet-body">
		<div class="row">
			<div class="col-md-5 col-sm-4">
				<div class="scroller" style="max-height: 600px;"
					data-always-visible="1" data-rail-visible="1"
					data-handle-color="#637283">
					<div class="todo-tasklist" id="projecttasklistdiv" data-id="<?php echo $Data['listid']?>" data-name="<?php echo $Data['listname']?>">
					<?php
					$tasksize = sizeof($Data['itemlist']);
					for($a=0;$a<$tasksize;$a++){
						
							$p_start = display::date($Data['itemlist'][$a]['Start']);
							$p_end = display::date($Data['itemlist'][$a]['Deadline']);
							$p_fa = UIElementController::In_To_String ( "fa", array('fa'=>'road') );
							
							$p_starttt = ui::tt('top','Predict Start');
							$p_endtt = ui::tt('top','Predict End');
							
						
							
							$r_start = display::date($Data['itemlist'][$a]['RealStart']);
							$r_end = display::date($Data['itemlist'][$a]['RealDeadline']);
							$r_fa = UIElementController::In_To_String ( "fa", array('fa'=>'calendar') );
							
							$r_starttt = ui::tt('top','Actual Start');
							$r_endtt = ui::tt('top','Actual End');
						
						
						$show_archivebtn = true;
						$overdue = 'normal';
						switch($Data['itemlist'][$a]['Status']){
							case STATUS_ACTIVETASK:
								$status_class = 'active';
								//$badge_status = 'Active';
							break;
							CASE STATUS_PENDTASK:
								$status_class = 'predict';
								//$badge_status = 'Predict';
							break;
							case STATUS_ARCHIVEDTASK:
								$status_class = 'archive';
								$show_archivebtn = false;
								//$badge_status = 'Archived';
							break;
						}
						if(filter::isEmptyDate($Data['itemlist'][$a]['RealDeadline'])==false){
							
							if(timeDiff(date('Y-m-d H:i:s'),$Data['itemlist'][$a]['RealDeadline'])<0){
								$overdue = 'overdue';
								$status_class = $overdue;
							}
						}
						
						 
						?>
						<div class="todo-tasklist-item todo-tasklist-item-<?php echo $status_class?> " >
							<div class="pull-right">
							
							<?php
							$input['fa'] = 'times';
							$fa = UIElementController::In_To_String("fa", $input );
							unset ( $input );
							
							if($Data['itemlist'][$a]['Role'] == ROLE_TASKASSIGNER){
								$input['attr']['class'] = 'btn btn-xs projecttaskremove tooltips '.ui::removecolor();
								$input['attr']['data-id'] = $Data['itemlist'][$a]['TaskID'];
								$input['value'] = $fa;
								$input['other'] = ui::tt('top','Remove it');
								UIElementController::render("a", $input );
								unset ( $input );
							}
							
							if($show_archivebtn){
								$input['fa'] = 'archive';
								$fa = UIElementController::In_To_String("fa", $input );
								unset ( $input );
									
								$input['attr']['class'] = 'btn btn-xs projecttaskarchive tooltips '.ui::archivecolor();
								$input['attr']['data-id'] = $Data['itemlist'][$a]['TaskID'];
								$input['value'] = $fa;
								$input['other'] = ui::tt('top','Archive it');
								UIElementController::render("a", $input );
								unset ( $input );
							}else{
								$input['fa'] = 'archive';
								$fa = UIElementController::In_To_String("fa", $input );
								unset ( $input );
									
								$input['attr']['class'] = 'btn btn-xs projecttaskunarchive tooltips '.ui::unarchivecolor();
								$input['attr']['data-id'] = $Data['itemlist'][$a]['TaskID'];
								$input['value'] = $fa;
								$input['other'] = ui::tt('top','Unarchive it');
								UIElementController::render("a", $input );
								unset ( $input );
							}
							?>
							
							</div>
							<div class="todo-tasklist-item-title projecttaskitem" data-id="<?php echo $Data['itemlist'][$a]['TaskID'];?>">
							<?php echo $Data['itemlist'][$a]['Name']?>
							</div>
							
							<div class="todo-tasklist-controls pull-left">
								<?php if($r_start!=''||$r_end!=''){
								?>
								
								<span class="todo-tasklist-date-normal tooltips" <?php echo $r_starttt?>><?php echo $r_fa?></i><?php echo $r_start?></span>
								<span class="todo-tasklist-date-<?php echo $overdue?> tooltips" <?php echo $r_endtt?>><?php echo $r_fa?><?php echo $r_end?></span>
								<br/>
								<?php }?>
								<?php if($p_start!=''||$p_end!=''){?>
								<span class="todo-tasklist-date-normal tooltips" <?php echo $p_starttt?>><?php echo $p_fa?></i><?php echo $p_start?></span>
								<span class="todo-tasklist-date-normal tooltips" <?php echo $p_endtt?>><?php echo $p_fa?><?php echo $p_end?></span>
								<?php }?>
								<br/>
								
								<!-- <span class="todo-tasklist-badge-<?php echo $status_class?> badge badge-roundless"><?php echo $badge_status?></span> -->
							</div>
						</div>
						<?php }?>
					</div>
				</div>
				<div><?php echo ui::addBtn('',array('id'=>'addTask'))?></div>
			</div>
			<div class="todo-tasklist-devider"></div>
			<div class="col-md-7 col-sm-8" id="taskdetail"></div>
		</div>
	</div>
</div>
