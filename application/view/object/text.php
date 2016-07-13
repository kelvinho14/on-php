<?php 
if(!$Data['ajaxview']){
	include('header.php');
}
//$json = json_decode($Data['object']['OData']);
$text = ObjectModel::getText($Data['object']['OData']);

$view = $CONFIG['home_http'].'page/ajax_viewpost?id='.$Data['object']['OID'];
if(!$Data['ajaxview']){
	$text = display::subStrDisplay($text,$view);
}else
	$text = $text;
$text = nl2br($text);
if($Data['ajaxview']){
?>
<div id="modal-row">
<?php }?>
	<div class="panel-body">
		<?php echo $text?>
	</div>
	<?php 
	if($Data['ajaxview']){ 
		include('asso_bar.php');
	?>
	<div class="panel panel-default">
			<ul class="comments" id="<?php echo $Data['object']['OID']?>_comment">
				<?php 
					include('commentlist.php');
					if(UserModel::canComment()){
				?>
				<li class="comment-form">
					<div class="input-group">
						<input type="text" class="form-control assoinput ismodal" data-type="<?php echo AssoModel::comment?>" data-item="<?php echo $Data['object']['OID']?>"/>
						<span class="input-group-btn">
				        	<a href="" class="btn btn-default"><i class="fa fa-photo"></i></a>
				        </span>
					</div>
				</li>
				<?php }?>
			</ul>
		</div>

	<?php }
	if($Data['ajaxview']){?>
</div>
<?php }
if(!$Data['ajaxview']){
	include('footer.php');
}?>                    