<?php 
if(function_exists('preventDA')){
	preventDA();
}else{
	die;
}
?>
<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal"
		aria-hidden="true"></button>
	<h4 class="modal-title"><?php echo ui::modalHeader($Admin_Lang['edittaskcodetool'])?></h4>
</div>
<div class="modal-body">
	<div class="row">
		<div class="col-md-12">
			<label for="form_control_1"><?php echo $Admin_Lang['taskcode']?></label>
			<?php
			$input['attr'] ['class'] = 'form-control';
			$input['id'] = 'editname';
			$input['name'] = 'editname';
			$input['value'] = $Data['Name'];
			UIElementController::render ( "input", $input );
			unset ( $input );
			?>
		</div>
		<div class="col-md-12">
			<label for="form_control_1"><?php echo $Admin_Lang['description']?></label>
			<?php
			$input['attr'] ['class'] = 'form-control';
			$input['id'] = 'editdescription';
			$input['name'] = 'editdescription';
			$input['value'] = $Data['Description'];
			UIElementController::render ( "textarea", $input );
			unset ( $input );
			?>
		</div>
		<div class="col-md-12">
			<label for="form_control_1"><?php echo $Admin_Lang['sexual_discussion']?></label>
			<?php
			$input['attr']['class'] = 'form-control';
			$input['id'] = 'editdiscussion';
			$input['name'] = 'editdiscussion';
			$input['value'] = '1';
			$input['checked'] = $Data['Discussion']==true?true:false;
			UIElementController::render ( "checkbox", $input );
			unset($input);
			?>
		</div>
		<div class="col-md-12">
			<label for="form_control_1"><?php echo $Admin_Lang['volunteer']?></label>
			<?php
			$input['attr']['class'] = 'form-control';
			$input['id'] = 'editvolunteer';
			$input['name'] = 'editvolunteer';
			$input['value'] = '1';
			$input['checked'] = $Data['Volunteer']==true?true:false;
			UIElementController::render ( "checkbox", $input );
			unset($input);
			?>
		</div>
		
	</div>
	<div class="modal-footer">
	<?php echo ui::saveBtn('',array('id'=>'taskcode_submit'));?>
	<?php echo ui::closeModalbtn('','',1);?>
	</div>
	<input type="hidden" id="id" value="<?php echo $Data['ID']?>"/>
</div>