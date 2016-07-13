<?php 

if(!$Data['ajaxview']){
	include('header.php');
}
//$json = json_decode($Data['object']['OData']);

$view = $CONFIG['home_http'].'page/ajax_viewpost?id='.$Data['object']['OID'];

/*$text = $json->Text;
if(!$Data['ajaxview']){
	$text = nl2br(display::subStrDisplay($text,$view));
}*/

$text = ObjectModel::getText($Data['object']['OData']);
$imagesrc = ObjectModel::getImageSrc($Data['object']['OData']);
if(!$Data['ajaxview']){
	$text = display::subStrDisplay($text,$view);
}else
	$text = $text;
$text = nl2br($text);

/*<div id="carousel_<?php echo $Data['object']['OID']?>" class="carousel slide" data-ride="carousel">
		  <!-- Indicators -->
		  <ol class="carousel-indicators">
		  <?php $ct=0;foreach($json->Src as $src){?>
		    <li data-target="#carousel_<?php echo $Data['object']['OID']?>" data-slide-to="<?php echo $ct?>" class="<?php echo $ct==0?'active':''?>"></li>
		    <?php $ct++;}?>
		  </ol>
		
		  <!-- Wrapper for slides -->
		  <div class="carousel-inner" role="listbox">
		  <?php $ct=0;foreach($json->Src as $src){
		  	$imageurl = FileModel::getAttachmentUrl('post',$src,$Data['object']['OUserID']);
		  	?>
		    <div class="item <?php echo $ct==0?'active':''?>">
		      <img src="<?php echo $imageurl?>" alt="Chania">
		    </div>
		    <?php $ct++;}?>
		
		  </div>
		
		  <!-- Left and right controls -->
		  <a class="left carousel-control" href="#carousel_<?php echo $Data['object']['OID']?>" role="button" data-slide="prev">
		    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
		    <span class="sr-only">Previous</span>
		  </a>
		  <a class="right carousel-control" href="#carousel_<?php echo $Data['object']['OID']?>" role="button" data-slide="next">
		    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
		    <span class="sr-only">Next</span>
		  </a>
		</div>*/

if($Data['ajaxview']){?>
	<div class="row" id="modal-row">
		<div class=" col-md-8 " style="text-align:center">
			<?php 
			if(is_array($imagesrc)){
				foreach($imagesrc as $src){
				$imageurl = FileModel::getAttachmentUrl('post',$src,$Data['object']['OUserID']);
			?>
			<a href="<?php echo $imageurl?>" class="fancyboximg" rel="<?php echo 'gallery_'.$Data['object']['OID']?>" ><img src="<?php echo $imageurl?>" style="max-width:100%" alt="photo"/></a>
			<?php }
				}?>
		</div>
		<div class="col-md-4">
			<div style="padding:5px;overflow-y: scroll;height: 350px;"><?php echo $text?></div>
			<?php 
				include('asso_bar.php');
				?>
				<div class="panel panel-default">
				<ul class="comments" id="<?php echo $Data['object']['OID']?>_comment">
				
					<?php 
					include('commentlist.php');
						if(UserModel::canComment()){
					?>
					<!--  <li class="media">View More</li>-->
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
		</div>
	</div>	
<?php }else{
?>
<div class="panel-body">
	<div><?php echo $text?></div>
	<br/>
	<div class="timeline-added-images">
	<?php 
		$imgwidth = sizeof($imagesrc)>1?'50px':'300px';
		if(is_array($imagesrc)){
		foreach($imagesrc as $src){
			$imageurl = FileModel::getAttachmentUrl('post',$src,$Data['object']['OUserID']);
	?>
		<a href="<?php echo $imageurl?>" class="fancyboximg" rel="<?php echo 'gallery_'.$Data['object']['OID']?>" ><img src="<?php echo $imageurl?>" style="max-width:<?php echo $imgwidth?>" alt="photo"/></a>
	<?php }
		}?>
	</div>
</div>
<?php }
if(!$Data['ajaxview']){
	include('footer.php');
}
?>                    