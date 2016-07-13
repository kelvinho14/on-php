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
			<span class="caption-helper">List:</span> &nbsp; <span
				class="caption-subject font-green-sharp bold">
				
				
				<?php
				//echo $Data['listname']
					$input ['id'] = 'listname';
					$input ['value'] = $Data['listname'];
					$input ['attr'] = array (
													'class' => 'editabletext',
													'data-pk' => $Data['listid'],
													'data-type' => 'text',
													'data-placement' => 'right',
													'data-original-title' => 'Enter tasklist name' 
													);

													UIElementController::render ( "a", $input );
													unset ( $input );
													?>
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
					<div class="todo-tasklist" id="mytasklistdiv" data-id="<?php echo $Data['listid']?>" data-name="<?php echo $Data['listname']?>">
					<?php
					$tasksize = sizeof($Data['itemlist']);
					for($a=0;$a<$tasksize;$a++){
						
						/*
						if($Data['itemlist'][$a]['ShowArchiveBtn']){
								
							$input['attr']['class'] = 'btn btn-xs mytaskarchive tooltips '.ui::successcolor();
							 $input['attr']['data-id'] = $Data['itemlist'][$a]['TaskID'];
							 $input['value'] = ui::fa('check');
							 $input['other'] = ui::tt('top',$Admin_Lang['markasdone']);
							 UIElementController::render("input", $input );
							
						
							unset ( $input );
						}else{
							$input['attr']['class'] = 'btn btn-xs mytaskunarchive tooltips '.ui::unarchivecolor();
							$input['attr']['data-id'] = $Data['itemlist'][$a]['TaskID'];
							$input['value'] = ui::fa('rotate-left');
							$input['other'] = ui::tt('top',$Admin_Lang['markasunfinish']);
							UIElementController::render("a", $input );
							unset ( $input );
						}
						*/
						
						 
						?>
							<div class="todo-tasklist-item todo-tasklist-item-<?php echo $Data['itemlist'][$a]['StatusClass']?> " >
							<div class="pull-right">
							
							<?php
							$input['fa'] = 'times';
							$fa = UIElementController::In_To_String("fa", $input );
							unset ( $input );
							
							$input['attr']['class'] = 'btn btn-xs mytaskremove tooltips '.ui::removecolor();
							$input['attr']['data-confirmmsg'] = $Admin_Lang['confirm_remove_record'];
							$input['attr']['data-id'] = $Data['itemlist'][$a]['TaskID'];
							$input['value'] = $fa;
							$input['other'] = ui::tt('top',$Admin_Lang['remove']);
							UIElementController::render("a", $input );
							unset ( $input );
							?>
							
							</div>
							<div class="todo-tasklist-item-title mytaskitem" data-id="<?php echo $Data['itemlist'][$a]['TaskID'];?>" id="mytaskitem<?php echo $Data['itemlist'][$a]['TaskID'];?>">
							<?php 
							$input['attr']['class'] = 'mytaskarchive';
							$input['checked'] = $Data['itemlist'][$a]['ShowArchiveBtn']?false:true;
							$input['attr']['data-id'] = $Data['itemlist'][$a]['TaskID'];
							$input['other'] = ui::tt('top',$Admin_Lang['markasdone']);
							UIElementController::render("checkbox", $input );
						
							echo $Data['itemlist'][$a]['Name']?>
							</div>
							<?php if($Data['itemlist'][$a]['DisplayDeadline']!=''){?>
								
							<div class="todo-tasklist-controls pull-left">
								<span class="todo-tasklist-date-normal tooltips"><?php UIElementController::render ( "fa", array('fa'=>'calendar') )?></i><?php echo $Data['itemlist'][$a]['DisplayDeadline']?></span>
							</div>
							<?php }?>
						</div>
						<?php }?>
					</div>
				</div>
				<br/>
				<div><?php echo ui::addBtn('',array('id'=>'addTask'))?></div>
			</div>
			<div class="todo-tasklist-devider"></div>
			<div class="col-md-7 col-sm-8" id="taskdetail"></div>
		</div>
	</div>
</div>
