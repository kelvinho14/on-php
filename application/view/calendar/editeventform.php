<?php 
if(function_exists('preventDA')){
	preventDA();
}else{
	die;
}
?>
<?php ui::div_s(array('class'=>'modal-header'))?>
	<button type="button" class="close" data-dismiss="modal"
		aria-hidden="true"></button>
	<h4 class="modal-title"><?php echo ui::modalHeader($Admin_Lang['eventadd'])?></h4>
<?php ui::div_e()?>
<?php ui::div_s(array('class'=>'modal-body'))?>
	<?php ui::div_s(array('class'=>'row'))?>
			<?php ui::div_s(array('size'=>'12'))?>
				<label for="form_control_1"><?php echo $Admin_Lang['eventname']?></label>
				<?php
				$input ['attr'] ['class'] = 'form-control';
				$input ['id'] = 'name';
				$input ['name'] = 'name';
				$input['value'] = $Data['name'];
				UIElementController::render ( "input", $input );
				unset ( $input );
				?>
			<?php ui::div_e()?>
		<?php ui::div_e()?>
	<?php ui::div_s(array('class'=>'row'))?>
		<?php ui::div_s(array('size'=>'12'))?>
			<label for="form_control_1"><?php echo $Admin_Lang['eventwholeday']?></label>
			<?php
			$input['attr'] ['class'] = 'form-control';
			$input['id'] = 'editallday';
			$input['name'] = 'editallday';
			$input['value'] = 1;
			if($Data['hidetime']){
				$input['checked'] = true;
			}
			UIElementController::render ( "checkbox", $input );
			unset ( $input );
			?>
			<label for="form_control_1"><?php echo $Admin_Lang['eventisout']?></label>
			<?php
			$input ['attr'] ['class'] = 'form-control';
			$input ['id'] = 'editisout';
			$input ['name'] = 'editisout';
			$input['value'] = 1;
			if($Data['IsOut']){
				$input['checked'] = true;
			}
			UIElementController::render ( "checkbox", $input );
			unset ( $input );
			?>
			<?php ui::div_e()?>
	<?php ui::div_e()?>
	<?php ui::div_s(array('class'=>'row'))?>
		<?php ui::div_s(array('size'=>'2'))?><?php ui::div_e()?>
		<?php ui::div_s(array('size'=>'5'))?>
			<label for="editstart"><?php echo $Admin_Lang['eventstart']?></label>
				<?php
				$input ['attr'] ['class'] = 'form-control';
				$input ['id'] = 'editstart';
				$input ['name'] = 'editstart';
				
				$input ['attr'] ['data-invalidmsg'] = $Admin_Lang ['warning_date_invalid'];
				$input ['attr'] ['data-emptymsg'] = $Admin_Lang ['warning_eventstart_empty'];
				$input ['attr'] ['data-format'] = setting::getDateformat ();
				$input['value'] = $Data['start'];
				UIElementController::render ( "input", $input );
				unset ( $input );
				?>
				<?php ui::div_s(array('id'=>'editstarttimediv','class'=>'input-icon','attr'=>array('style'=>$Data['hidetime']?"display:none":"")))?>
				
				<i class="fa fa-clock-o"></i>
				<?php
				$input ['attr'] ['class'] = 'form-control';
				$input ['id'] = 'editstarttime';
				$input ['name'] = 'editstarttime';
				$input ['attr'] ['data-emptymsg'] = $Admin_Lang ['warning_eventstarttime_empty'];
				$input['value'] = $Data['starttime'];
				// $input['attr']['data-format'] = setting::getDateformat();
				UIElementController::render ( "input", $input );
				unset ( $input );
				?>
				<?php ui::div_e()?>
		<?php ui::div_e()?>
		<?php ui::div_s(array('size'=>'5'))?>
			<label for="editend"><?php echo $Admin_Lang['eventend']?></label>
				<?php
				$input ['attr'] ['class'] = 'form-control';
				$input ['id'] = 'editend';
				$input ['name'] = 'editend';
			
				$input ['attr'] ['data-invalidmsg'] = $Admin_Lang ['warning_date_invalid'];
				$input ['attr'] ['data-emptymsg'] = $Admin_Lang ['warning_eventend_empty'];
				$input ['attr'] ['data-format'] = setting::getDateformat ();
				$input['value'] = $Data['end'];
				UIElementController::render ( "input", $input );
				unset ( $input );
				?>
				
			<?php ui::div_s(array('id'=>'editendtimediv','class'=>'input-icon','attr'=>array('style'=>$Data['hidetime']?"display:none":"")))?>
				<i class="fa fa-clock-o"></i>
				<?php
				$input ['attr'] ['class'] = 'form-control';
				$input ['id'] = 'editendtime';
				$input ['name'] = 'editendtime';
				$input ['attr'] ['data-startenderrormsg'] = $Admin_Lang ['warning_eventstartenderror'];
				$input ['attr'] ['data-emptymsg'] = $Admin_Lang ['warning_eventendtime_empty'];
				$input['value'] = $Data['endtime'];
				// $input['attr']['data-format'] = setting::getDateformat();
				UIElementController::render ( "input", $input );
				unset ( $input );
				?>
				<?php ui::div_e()?>
			<?php ui::div_e()?>
		<?php ui::div_e()?>
		<?php ui::div_s(array('class'=>'row'))?>
			<?php ui::div_s(array('size'=>'12'))?>
			<label for="start"><?php echo $Admin_Lang['eventdescription']?></label>
				<?php
				$input ['attr'] ['class'] = 'form-control';
				$input ['id'] = 'editdescription';
				$input ['name'] = 'editdescription';
				$input['value'] = $Data['description'];
				UIElementController::render ( "textarea", $input );
				unset ( $input );
				?>
			<?php ui::div_e()?>
		<?php ui::div_e()?>
	<?php ui::div_e()?>
	<?php ui::div_s(array('class'=>'modal-footer'))?>
		<?php //echo ui::saveBtn('',array('id'=>'event_update','attr'=>array('onClick'=>'$(\'.modal\').modal(\'hide\')')));	
			echo ui::saveBtn('',array('id'=>'event_update'));
			?>
	<?php echo ui::closeModalbtn('','',1);?>
	<?php ui::div_e()?>
<?php ui::div_e()?>