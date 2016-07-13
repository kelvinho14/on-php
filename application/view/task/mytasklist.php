<?php 
if(function_exists('preventDA')){
	preventDA();
}else{
	die;
}
?>
<ul class="nav nav-pills nav-stacked">
<?php 
	$tasksize = sizeof($Data['mytasklist']);
	for($a=0;$a<$tasksize;$a++){
		if($Data['listid']>0&&$Data['listid']==$Data['mytasklist'][$a]['ListID']){
			$liclass = 'active'; 
			$badgeclass = 'badge-active';
		}else{
			$liclass = '';
			$badgeclass = '';
		}
?>
		<li class="<?php echo $liclass?>">
		<a href="javascript:;" class="focusMylist" id="mytasklist<?php echo $Data['mytasklist'][$a]['ListID']?>" data-id="<?php echo $Data['mytasklist'][$a]['ListID']?>" data-listname="<?php echo htmlentities($Data['mytasklist'][$a]['Name'])?>" data-confirmmsg="<?php echo $Admin_Lang['confirm_remove_record'];?>"> 
			<?php
			$input['value'] = $Data['mytasklist'][$a]['TaskNo'];
			$input['attr']['class'] = 'badge badge-success '.$badgeclass;
			
			UIElementController::render ( "span", $input );
			unset ( $input );
			echo $Data['mytasklist'][$a]['Name']?></a>
		</li>
	<?php }?>
</ul>