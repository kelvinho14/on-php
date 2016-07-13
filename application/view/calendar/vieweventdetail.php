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
	<h4 class="modal-title"><?php echo ui::modalHeader($Admin_Lang['eventdetail'])?></h4>
<?php ui::div_e()?>
<?php ui::div_s(array('class'=>'modal-body'))?>
		<?php ui::div_s(array('class'=>'row'))?>
			<?php ui::div_s(array('size'=>'3'))?><label for="start"><?php echo $Admin_Lang['eventname']?>:</label><?php ui::div_e()?>
			<?php ui::div_s(array('size'=>'9'))?><?php echo $Data['Name']; ?><?php ui::div_e()?>
		<?php ui::div_e()?>
		<?php ui::div_s(array('class'=>'row'))?>
			<?php ui::div_s(array('size'=>'3'))?><label for="start"><?php echo $Admin_Lang['eventstart']?>:</label><?php ui::div_e()?>
			<?php ui::div_s(array('size'=>'9'))?><?php echo $Data['Start']; ?><?php ui::div_e()?>
		<?php ui::div_e()?>
		<?php ui::div_s(array('class'=>'row'))?>
			<?php ui::div_s(array('size'=>'3'))?><label for="end"><?php echo $Admin_Lang['eventend']?>:</label><?php ui::div_e()?>
			<?php ui::div_s(array('size'=>'9'))?><?php echo $Data['End'];?><?php ui::div_e()?>
		<?php ui::div_e()?>
		<?php ui::div_s(array('class'=>'row'))?>
			<?php ui::div_s(array('size'=>'3'))?><label for="end"><?php echo $Admin_Lang['eventdescription']?>:</label><?php ui::div_e()?>
			<?php ui::div_s(array('size'=>'9'))?><?php echo trim($Data['Description'])==''?'-':nl2br($Data['Description']);?><?php ui::div_e()?>
		<?php ui::div_e()?>
		<?php ui::div_s(array('class'=>'row'))?>
			<?php ui::div_s(array('size'=>'3'))?><label for="end"><?php echo $Admin_Lang['eventisout']?>:</label><?php ui::div_e()?>
			<?php ui::div_s(array('size'=>'9'))?><?php echo $Data['IsOut']==1?$Admin_Lang['yes']:$Admin_Lang['no'];?><?php ui::div_e()?>
		<?php ui::div_e()?>
		
<?php ui::div_e()?>
	<div class="modal-footer">
	<?php if($Data['CanEdit']){echo ui::editBtn('',array('id'=>'editevent'));}?>
	<?php echo ui::closeBtn('',array('attr'=>array('data-dismiss'=>'modal')));	?>
	
	<?php ui::div_e()?>
