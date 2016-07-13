<div id="<? echo $ElementData['id']?>" class="carousel image-carousel slide">
	<div class="carousel-inner">
	<?php 
	
	$filesize = sizeof($ElementData['file']);
	$navigation = '';
	for($f=0;$f<$filesize;$f++){
		if($ElementData['hidenavigation']==false)
			$navigation .= '<li data-target="#'.$ElementData['id'].'" data-slide-to="'.$f.'" class="'.($f==0?'active':'').'"></li>';
		?>
			<div class="<?php echo $f==0?'active':''?> item">
			<a href="<?php echo $ElementData['file'][$f]['fileurl']?>" target="_blank"><img src="<?php echo $ElementData['file'][$f]['fileurl']?>" class="img-responsive" alt=""></a>
		</div>
		<?php }?>
		
		
	</div>
	<!-- Carousel nav -->
	<?php if($ElementData['hidenavigation']==false){?>
	<a class="carousel-control left" href="#<?php echo $ElementData['id']?>" data-slide="prev">
	<i class="m-icon-big-swapleft m-icon-white"></i>
	</a>
	<a class="carousel-control right" href="#<?php echo $ElementData['id']?>" data-slide="next">
	<i class="m-icon-big-swapright m-icon-white"></i>
	</a>
	<ol class="carousel-indicators">
		<?php echo $navigation?>
	</ol>
	<?php }?>
</div>