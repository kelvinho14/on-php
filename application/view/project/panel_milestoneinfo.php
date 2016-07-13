<?php 
if(function_exists('preventDA')){
	preventDA();
}else{
	die;
}
?>
<form class="horizontal-form" action="#">
	<div class="row">
		<div class="col-md-6 ">
			<div class="form-group">
			<?php
			$input ['for'] = 'name';
			$input ['value'] = '<b>Milestone Name</b>';
			$input ['attr'] = array (
							'class' => 'control-label' 
							);

							UIElementController::render ( "label", $input );
							unset ( $input );
							?>
				<div class="controls">
				<?php
				$input ['id'] = 'ms_name';
				$input ['value'] = $Data['milestone']['name'];
				$input ['attr'] = array (
								'class' => 'editabletext',
								'data-pk' => $Data['milestone']['id'],
								'data-type' => 'text',
								'data-placement' => 'right',
								'data-placeholder' => 'Required',
								'data-original-title' => 'Enter milestone name' 
								);

								UIElementController::render ( "a", $input );
								unset ( $input );
								?>
				</div>
			</div>
		</div>
		<!--/span-->
		<div class="col-md-6 ">
			<div class="form-group">
			<?php
			$input ['for'] = 'ms_objective';
			$input ['value'] = '<b>Objective</b>';
			$input ['attr'] = array (
							'class' => 'control-label' 
							);

							UIElementController::render ( "label", $input );
							unset ( $input );
							?>
				<div class="controls">
				<?php
				$input ['id'] = 'ms_objective';
				$input ['value'] = $Data['milestone']['objective'];
				$input ['attr'] = array (
								'class' => '',
								'data-pk' => $Data['milestone']['id'],
								'data-type' => 'wysihtml5',
								'data-toggle' => 'manual',
								'data-original-title' => 'Enter notes' 
								);
								UIElementController::render ( "div", $input );
								unset ( $input );
								?>

								<?php
								/*
								 * $input['id'] 		= 'description_pencil';
								 * $input['value']		= '<i class="icon-pencil"></i> [edit]';
								 * UIElementController::render("a",$input);
								 * unset($input);
								 */
								?>
				</div>
			</div>
		</div>
		<!--/span-->
	</div>
	<!--/row-->
	<div class="row">
		<div class="col-md-6 ">
			<div class="form-group">
			<?php
			$input ['for'] = 'start';
			$input ['value'] = '<b>Milestone Start</b>';
			$input ['attr'] = array (
							'class' => 'control-label' 
							);
							UIElementController::render ( "label", $input );
							unset ( $input );
							?>
				<div class="controls">
				<?php
				$input ['id'] = 'ms_start';
				$input ['attr'] = array (
								'data-type' => 'date',
								'data-pk' => $Data['milestone']['id'],
								'data-placement' => 'right',
								'data-original-title' => 'Set date & time',
								'data-viewformat' => 'yyyy-mm-dd' 
								);
								$input['value'] = display::date($Data['milestone']['start']);
								UIElementController::render ( "a", $input );
								unset ( $input );

								?>
				</div>
			</div>
		</div>
		<!--/span-->
		<div class="col-md-6 ">
			<div class="form-group">
			<?php
			$input ['for'] = 'start';
			$input ['value'] = '<b>Milestone End</b>';
			$input ['attr'] = array (
							'class' => 'control-label' 
							);
							UIElementController::render ( "label", $input );
							unset ( $input );
							?>
				<div class="controls">
				<?php
				$input ['id'] = 'ms_end';
				$input ['attr'] = array (
								'data-type' => 'date',
								'data-pk' => $Data['milestone']['id'],
								'data-placement' => 'right',
								'data-original-title' => 'Set date & time',
								'data-viewformat' => 'yyyy-mm-dd' 
								);
								$input ['value'] = display::date($Data['milestone']['end']);
								UIElementController::render ( "a", $input );
								unset ( $input );

								?>
				</div>
			</div>
		</div>
	</div>
	<?php include_once('panel_milestonedetail.php')?>
</form>