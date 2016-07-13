<?php 
if(function_exists('preventDA')){
	preventDA();
}else{
	die;
}
?>
<ul class="nav nav-pills nav-stacked">
<?php 
	$tasksize = sizeof($Data['prjlist']);
	for($a=0;$a<$tasksize;$a++){
		if($Data['listid']>0&&$Data['listid']==$Data['prjlist'][$a]['ListID']){
			$liclass = 'active'; 
			$badgeclass = 'badge-active';
		}else{
			$liclass = '';
			$badgeclass = '';
		}
?>
		<li class="<?php echo $liclass?>">
		<a href="javascript:;" class="focusProject" data-id="<?php echo $Data['prjlist'][$a]['ProjectID']?>" data-listname="<?php echo htmlentities($Data['prjlist'][$a]['Name'])?>" > 
			<?php
			$input['value'] = $Data['prjlist'][$a]['TaskNo'];
			$input['attr']['class'] = 'badge badge-success '.$badgeclass;
			
			UIElementController::render ( "span", $input );
			unset ( $input );
			echo $Data['prjlist'][$a]['Name']?></a>
		</li>
	<?php }?>
</ul>