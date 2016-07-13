<?php 
if(function_exists('preventDA')){
	preventDA();
}else{
	die;
}

$input['title'] = 'Project Name';
$input['titleicon'] = 'icon-speech';
$input['fullscreen'] = true;
UIElementController::render ( "portlet_start", $input );
unset ( $input );
?>
<h4>
<?php echo $ElementData['heading']?>
</h4>


<form action="#" class="horizontal-form">
	<div class="form-body">
		<div class="row">
			<div class="col-md-4">
				<div class="form-group">
				<?php
				$input ['for'] = 'name';
				$input ['value'] = '<b>Project Name</b>';
				$input ['attr'] = array (
												'class' => 'control-label' 
												);

												UIElementController::render ( "label", $input );
												unset ( $input );
												?>
					<br />
					<?php
					$input ['id'] = 'name';
					$input ['value'] = $Data['project']['Name'];
					$input ['attr'] = array (
													'class' => 'editabletext',
													'data-pk' => $Data['project_id'],
													'data-type' => 'text',
													'data-placement' => 'right',
													'data-placeholder' => 'Required',
													'data-successmsg' => 'Name update!',
													'data-dangermsg' => 'Cannot update..please contact your admin',
													'data-original-title' => 'Enter your firstname' 
													);

													UIElementController::render ( "a", $input );
													unset ( $input );
													?>
				</div>
			</div>
			<div class="col-md-4 ">
				<div class="form-group">
				<?php
				$input ['for'] = 'start';
				$input ['value'] = '<b>Project start</b>';
				$input ['attr'] = array (
									'class' => 'control-label' 
									);
				UIElementController::render ( "label", $input );
				unset ( $input );
				?>
					<br />
					<?php
					$input ['id'] = 'start';
					$input ['attr'] = array (
											'data-type' => 'date',
											'data-pk' => $Data['project_id'],
											'data-successmsg' => 'Start update!',
											'data-dangermsg' => 'Cannot update..please contact your admin',
											'data-emptytext' =>htmlspecialchars('Start')
											);
					$input ['value'] = display::date($Data['project']['Start']);
					UIElementController::render ( "a", $input );
					unset ( $input );
					?>
				</div>
			</div>
			<div class="col-md-4 ">
				<div class="form-group">
				<?php
				$input ['for'] = 'end';
				$input ['value'] = '<b>Project deadline</b>';
				$input ['attr'] = array (
												'class' => 'control-label' 
									);
				UIElementController::render ( "label", $input );
				unset ( $input );
				?>
					<br />
					<?php
					$input ['id'] = 'end';
					$input ['attr'] = array (
											'data-type' => 'date',
											'data-pk' => $Data['project_id'],
											'data-successmsg' => 'End update!',
											'data-dangermsg' => 'Cannot update..please contact your admin',
											'data-emptytext' =>htmlspecialchars('Deadline')
											);
					$input ['value'] = display::date($Data['project']['End']);
					UIElementController::render ( "a", $input );
					unset ( $input );
					?>
			
				</div>
			</div>
			<!--/span-->

			<!--/span-->
		</div>
		<!--/row-->
		<div class="row">
			<div class="col-md-4 ">
				<div class="form-group">
				<?php
				$input ['for'] = 'clientid';
				$input ['value'] = '<b>Client</b>';
				$input ['attr'] = array (
										'class' => 'control-label' 
										);

				UIElementController::render ( "label", $input );
				unset ( $input );
				?>
				<br/>
				<?php 
				$input ['id'] = 'clientid';
				$input ['attr'] = array (
										'data-type' => 'select2',
										'data-pk' => $Data['project_id'],
										'data-value' => $Data['project']['ClientID'],
										'data-emptytext' => 'Select a client',
										'data-successmsg' => 'End update!',
										'data-dangermsg' => 'Cannot update..please contact your admin',
										'data-original-title' => 'Select Client' 
										);

				UIElementController::render ( "a", $input );
				unset ( $input );?>
				&nbsp;
				<?php if($Data['project']['ClientID']>0){
					$input ['attr'] = array (
										'class' => 'btn btn-xs default clienticon' 
										);
					$input['value'] = UIElementController::In_To_String ( "fa", array('fa'=>'user'));
					UIElementController::render ( "a", $input );
					unset ( $input );
				}
				 ?>
				</div>
			</div>
			<div class="col-md-8">
				<div class="form-group">
				<?php
				$input ['for'] = 'objective';
				$input ['value'] = '<b>Objective</b>';
				$input ['attr'] = array (
												'class' => 'control-label' 
												);

												UIElementController::render ( "label", $input );
												unset ( $input );
												?>
												<?php
												$input ['id'] = 'objective';
												$input ['value'] = nl2br($Data['project']['Objective']);
												$input ['attr'] = array (
													'class' => '',
													'data-pk' => $Data['project_id'],
													'data-type' => 'wysihtml5',
													'data-toggle' => 'manual',
													'data-original-title' => 'Enter notes' 
													);
													UIElementController::render ( "div", $input );
													unset ( $input );
													?>


				</div>
			</div>

		</div>



	</div>
</form>

													<?php

													UIElementController::render ( "portlet_end" );
													?>