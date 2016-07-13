<?php include('header.php');
$json = json_decode($Data['object']['OData']);
//print_r($Data['object']);die;
$thumbnail = ObjectModel::getThumbnail($Data['object']['OData']);

?>
                   
<div class="panel-body">
	<?php echo nl2br($json->Desc)?>
</div>
<!-- 4:3 aspect ratio -->
<div class="embed-responsive embed-responsive-4by3 center">
	<img src="<?php echo $thumbnail?>"/>
	
	<?php
	if(false){?>
		<iframe width="560" height="315" src="<?php echo $json->videolink?>" frameborder="0" allowfullscreen></iframe>
		<script type="text/javascript" src="http://ext.nicovideo.jp/thumb_watch/sm6416696"></script><noscript><a href="http://www.nicovideo.jp/watch/sm6416696">Niconico JAZZ　quiet night cafe【Work BGM】</a></noscript>?>
	<?php }?>
</div>

<?php include('footer.php')?>