<?php

$commentsize = sizeof($Data['comment']);
if($commentsize>0){
	if($Data['object']['CommentTotal']>$CONFIG['postcommentpreload']){
?>	
<li class="media morecomment">View More</li>
<?php }?>
<?php foreach($Data['comment'] as $comment){
		$commentjson = json_decode($comment['AData']);
		list($pcolor,$scolor) = display::artistColor($comment['OArtistColor']);
?>
<li class="media" id="comment_<?php echo $comment['AID']?>">
	<div class="media-left" style="position: relative; ">
		<a href=""><img src="<?php echo UserModel::renderProfilePicSrc($comment['AUPic'],$comment['AUserID'],1)?>" class="media-object mediaavatar"></a>
		<?php if(UserModel::role_artist==$comment['ARoleID']){?>
		<div style="background-color:<?php echo $scolor?>;" class="center commentartistcolor"> <?php echo $comment['OArtistType']?> </div>
		<?php }?>
	</div>
	<div class="media-body">
		<div class="pull-right dropdown" data-show-hover="li">
	    	<a href="#" data-toggle="dropdown" class="toggle-button">
	        	<i class="fa fa-pencil"></i>
			</a>
			<ul class="dropdown-menu" role="menu">
	        	<li><a href="#">Edit</a></li>
	            <li><a href="#">Delete</a></li>
	        </ul>
		</div>
	    <a href="<?php echo $CONFIG['home_http']?>page/<?php echo $comment['AUser']?>" class="comment-author pull-left"><?php echo $comment['AUser']?></a>
			<span><?php echo nl2br($commentjson->Text);?></span>
	    <div class="comment-date"><?php echo display::dayAgo($comment['ATime'])?></div>
	</div>
</li>
		<?php }
		
}?>