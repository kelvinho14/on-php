<?php include('header.php');

$json = json_decode($Data['object']['OData']);


?>
<div class="panel-body">
	<a href="#" class="h4 margin-none"><?php echo $json->Name?></a>
    	<div>
        	<span class="fa fa-star text-primary"></span>
            <span class="fa fa-star text-primary"></span>
            <span class="fa fa-star text-primary"></span>
            <span class="fa fa-star text-primary"></span>
            <span class="fa fa-star-o"></span>
		</div>

	<div class="media">
    	<div class="media-left">
        	<a href="#"><img src="<?php echo $json->Image?>" alt="" class="media-object" <?php $imagewidth?>></a>
        </div>
		<div class="media-body">
	    	<p><?php echo nl2br($json->Desc)?></p>
		</div>
	</div>
	<ul class="icon-list">
		<li><i class="fa fa-clock-o fa-fw"></i> <?php echo display::dayago($json->Date)?></li>
    	<li><i class="fa fa-star fa-fw"></i>Genre <?php echo $json->Genre?></li>
	</ul>
</div>
<?php include('footer.php')?>