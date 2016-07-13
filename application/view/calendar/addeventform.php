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
				UIElementController::render ( "input", $input );
				unset ( $input );
				?>
			<?php ui::div_e()?>
		<?php ui::div_e()?>
		

		<?php ui::div_s(array('class'=>'row'))?>
			<?php ui::div_s(array('size'=>'12'))?>
				<label for="form_control_1"><?php echo $Admin_Lang['eventwholeday']?></label>
				<?php
				$input ['attr'] ['class'] = 'form-control';
				$input ['id'] = 'allday';
				$input ['name'] = 'allday';
				$input['value'] = 1;
				UIElementController::render ( "checkbox", $input );
				unset ( $input );
				?>
				<label for="form_control_1"><?php echo $Admin_Lang['eventisout']?></label>
				<?php
				$input ['attr'] ['class'] = 'form-control';
				$input ['id'] = 'isout';
				$input ['name'] = 'isout';
				$input['value'] = 1;
				UIElementController::render ( "checkbox", $input );
				unset ( $input );
				?>
			<?php ui::div_e()?>
		<?php ui::div_e()?>	
		<?php ui::div_s(array('class'=>'row'))?>
			<?php ui::div_s(array('size'=>'2'))?><?php ui::div_e()?>
			<?php ui::div_s(array('size'=>'5'))?>
				<label for="start"><?php echo $Admin_Lang['eventstart']?></label>
				<?php
				$input ['attr'] ['class'] = 'form-control';
				$input ['id'] = 'start';
				$input ['name'] = 'start';
				
				$input ['attr'] ['data-invalidmsg'] = $Admin_Lang ['warning_date_invalid'];
				$input ['attr'] ['data-emptymsg'] = $Admin_Lang ['warning_eventstart_empty'];
				$input ['attr'] ['data-format'] = setting::getDateformat ();
				UIElementController::render ( "input", $input );
				unset ( $input );
				?>
				<?php ui::div_s(array('id'=>'starttimediv','class'=>'input-icon'))?>
				<i class="fa fa-clock-o"></i>
				<?php
				$input ['attr'] ['class'] = 'form-control';
				$input ['id'] = 'starttime';
				$input ['name'] = 'starttime';
				$input ['attr'] ['data-emptymsg'] = $Admin_Lang ['warning_eventstarttime_empty'];
				// $input['attr']['data-format'] = setting::getDateformat();
				UIElementController::render ( "input", $input );
				unset ( $input );
				?>
				<?php ui::div_e()?>
			<?php ui::div_e()?>
			<?php ui::div_s(array('size'=>5))?>
				<label for="end"><?php echo $Admin_Lang['eventend']?></label>
				<?php
				$input ['attr'] ['class'] = 'form-control';
				$input ['id'] = 'end';
				$input ['name'] = 'end';
				
				$input ['attr'] ['data-invalidmsg'] = $Admin_Lang ['warning_date_invalid'];
				$input ['attr'] ['data-emptymsg'] = $Admin_Lang ['warning_eventend_empty'];
				$input ['attr'] ['data-format'] = setting::getDateformat ();
				UIElementController::render ( "input", $input );
				unset ( $input );
				?>
				<?php ui::div_s(array('id'=>'endtimediv','class'=>'input-icon'))?>
				<i class="fa fa-clock-o"></i>
				<?php
				$input ['attr'] ['class'] = 'form-control';
				$input ['id'] = 'endtime';
				$input ['name'] = 'endtime';
				$input ['attr'] ['data-startenderrormsg'] = $Admin_Lang ['warning_eventstartenderror'];
				$input ['attr'] ['data-emptymsg'] = $Admin_Lang ['warning_eventendtime_empty'];
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
				$input ['id'] = 'description';
				$input ['name'] = 'description';
				
				UIElementController::render ( "textarea", $input );
				unset ( $input );
				?>
			<?php ui::div_e()?>
		<?php ui::div_e()?>	
	<?php ui::div_e()?>
<?php ui::div_s(array('class'=>'modal-footer'))?>
	<?php //echo ui::addBtn('',array('id'=>'event_add','attr'=>array('data-dismiss'=>'modal')));	
			echo ui::addBtn('',array('id'=>'event_add'));
	?>
	<?php echo ui::cancelbtn('',array('attr'=>array('data-dismiss'=>'modal')));	?>
	<?php ui::div_e()?>
<?php ui::div_e()?>