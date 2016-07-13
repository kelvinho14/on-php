<?php 

if(sizeof($Data['notification'])==0){
	
}else{
	foreach($Data['notification'] as $notify){
?>
	<li class="<?php echo $notify['class']?>">
		<a href="<?php echo $notify['link']?>" target="_blank">
		<?php echo $notify['avatar']?><?php echo $notify['word']?>
		<div class="pull-right posttime" style="display:inline-block"><?php echo $notify['time']?></div>
		</a>
		
	</li>
<?php 
	}?>
	<li class="center"><a href="<?php echo $CONFIG['home_http'].'page/notification'?>">See all</a></li>
<?php }?>