<?php 
include('asso_bar.php');
?>
<ul class="comments" id="<?php echo $Data['object']['OID']?>_comment">

	<?php 
	include('commentlist.php');
		if(UserModel::canComment()){
	?>
	<!--  <li class="media">View More</li>-->
    <li class="comment-form">
    	<div class="input-group">
			<input type="text" class="form-control assoinput" data-type="<?php echo AssoModel::comment?>" data-item="<?php echo $Data['object']['OID']?>"/>
			<span class="input-group-btn">
            	<a href="" class="btn btn-default"><i class="fa fa-photo"></i></a>
            </span>
		 </div>
	</li>
	<?php }?>
</ul>
</div>
</div>
</div>