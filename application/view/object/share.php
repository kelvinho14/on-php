<?php //data-id="php echo $Data['object']['OID']?>
<div class="btn-group">
	<button class="<?php echo $Data['isprofile']?'profile':''?>sharebtn dropdown-toggle" data-toggle="dropdown" >
    <img src="<?php echo display::share();?>"/>
    </button>
	<ul class="dropdown-menu" >
		<?php foreach($CONFIG['post_share'] as $social){
			$func = 'share2'.$social[1];
			
			$shareobj = $func($Data['sharelink']==''?'page/post/'.$Data['object']['OID']:$Data['sharelink']);
			
		?>
		<li><a href="<?php echo $shareobj['link']?>" target="_blank"><?php echo ui::fa($social[0]).' '.$social[1]?></a></li>
		<?php }?>
	</ul>
</div>