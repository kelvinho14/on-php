<?php 
if(function_exists('preventDA')){
	preventDA();
}else{
	die;
}
?>
<div class="scroller" style="max-height: 800px;" data-always-visible="0" data-rail-visible="0" data-handle-color="#dae3e7" >
<form action="#" class="form-horizontal">
	<!-- TASK HEAD -->
	<div class="form">
		
		<!-- TASK TITLE -->
		<div class="form-group">
			<div class="col-md-12">
				<?php
				$input['id'] = 'name';
				$input['value'] = $Data['taskdetail']['Name'];
				$input['attr'] = array ('placeholder' => '','class'=>'form-control');
				UIElementController::render ("input", $input );
				unset ( $input );
				?>
			</div>
		</div>
		<!-- TASK DESC -->
		<div class="form-group">
			<div class="col-md-12">
			
			<?php
				$input['id'] = 'objective';
				$input['value'] = $Data['taskdetail']['Objective'];
				//$input['class'] = 'todo-taskbody-taskdesc';
				$input ['attr'] = array ('placeholder' => 'Details');
				UIElementController::render ("textarea", $input );
				unset ( $input );
			?>
			
			</div>
		</div>
		<!-- END TASK DESC -->
		<!-- TASK DUE DATE -->
		<div class="form-group">
			<div class="col-md-4">
			Predict Start Date
			</div>
			<div class="col-md-8">
				<div class="input-icon">
					<i class="fa fa-calendar"></i> 
					<?php
						$input['id'] = 'start';
						$input['value'] = display::date($Data['taskdetail']['Start']);
						$input ['attr'] = array ('class'=>'form-control taskdate','readonly'=>'');
						UIElementController::render ( "input", $input );
						unset ( $input );
					?>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-4">
			Predict End Date
			</div>
			<div class="col-md-8">
				<div class="input-icon">
					<i class="fa fa-calendar"></i> 
					<?php
						$input['id'] = 'deadline';
						$input['value'] = display::date($Data['taskdetail']['Deadline']);
						$input ['attr'] = array ('class'=>'form-control taskdate','readonly'=>'');
						UIElementController::render ( "input", $input );
						unset ( $input );
					?>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-4">
			Actual Start Date
			</div>
			<div class="col-md-8">
				<div class="input-icon">
					<i class="fa fa-calendar"></i> 
					<?php
						$input['id'] = 'realstart';
						$input['value'] = display::date($Data['taskdetail']['RealStart']);
						$input ['attr'] = array ('class'=>'form-control taskdate','readonly'=>'');
						UIElementController::render ( "input", $input );
						unset ( $input );
					?>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-4">
			Actual End Date
			</div>
			<div class="col-md-8">
				<div class="input-icon">
					<i class="fa fa-calendar"></i> 
					<?php
						$input['id'] = 'realdeadline';
						$input['value'] = display::date($Data['taskdetail']['RealDeadline']);
						$input ['attr'] = array ('class'=>'form-control taskdate','readonly'=>'');
						UIElementController::render ( "input", $input );
						unset ( $input );
					?>
				</div>
			</div>
		</div>
		<div class="form-actions right todo-form-actions">
		
			<?php
				$input['id'] = 'saveprjtaskdetail';
				$input['value'] = 'Save Changes';
				$input ['attr'] = array ('class'=>'btn btn-circle btn-sm green-haze','data-id'=>$Data['taskid']);
				UIElementController::render ( "button", $input );
				unset ( $input );
			?>
		</div>
	</div>
	<div class="tabbable-line" id="taskpost">
		<ul class="nav nav-tabs ">
			<li class="active"><a href="#tab_1" data-toggle="tab"> Comment </a></li>
			
		</ul>
		<div class="tab-content">
			<div class="tab-pane active" id="tab_2">
				<ul class="todo-task-history">
				<?php $postsize = sizeof($Data['taskpost']);
				
					for($a=0;$a<$postsize;$a++){
				?>
					<li>
						<div class="todo-task-history-date"><?php echo display::dayago($Data['taskpost'][$a]['TimeInput'])?></div>
						<div class="todo-task-history-desc"><?php echo (nl2br($Data['taskpost'][$a]['Text']))?></div>
					</li>
					
					<?php }?>
				</ul>
				<div class="form-group">
					<div class="col-md-12">
						<ul class="media-list">
							<li class="media">
								<div class="media-body">
									<?php echo ui::textarea('','taskposttext','taskposttext','form-control',array('rows'=>4,'placeholder'=>'Type comment...'))?>
								</div></li>
						</ul>
						
							<?php echo ui::submitBtn('',array('id'=>'submitPost','attr'=>array('class'=>'pull-right btn-sm btn-circle ','data-id'=>$Data['taskid'])))?>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>
</div>