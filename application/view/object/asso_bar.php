<?php 

//$totallike = sizeof($Data['like']);
//$totalcomment = sizeof($Data['comment']);
$totallike = $Data['object']['LikeTotal'];
$totalcomment = $Data['object']['CommentTotal'];

$youlike = false;
if(is_array($Data['like'])){
	$youlike = in_array($_SESSION['user_id'],$Data['like']);
}
if($youlike){
	$totallike-=1;
}
if($youlike && $totallike==0){
	$onlyyoulike = true;
	
}

?>
<div class="view-all-comments" id="asso_<?php echo $Data['object']['OID']?>">
	
		
		<?php if(UserModel::canLike()){?>
			<a href="javascript:;" class="assobtn <?php echo $Data['ajaxview']?'ismodal':''?>" data-type="<?php echo AssoModel::like?>" data-item="<?php echo $Data['object']['OID']?>">
			<?php }?>
			<img src="<?php echo display::like();?>"/>
		<?php 
			if($youlike){
				if($onlyyoulike){ 
					echo 'You';
				}else{
					echo 'You and '.$totallike.' others';
				}
			}else{
				echo $totallike.' '.display::plural($totallike,$Lang['like']);
			}?>
		
		<?php if(UserModel::canLike()){?>
			</a>
		<?php }?>
		
		<img src="<?php echo display::comment();?>"/>
		
		<a href="javascript:;" onClick="$(this).parent().parent().find('.assoinput').focus()"><?php echo $totalcomment.' '.display::plural($totallike,$Lang['comment'])?></a>
		<div class="btn-group text-muted">
	        <?php include('share.php')?>
		</div>	
	
</div>