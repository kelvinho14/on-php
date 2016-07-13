<div class="portlet light">
	<div class="portlet-title">
		<div class="caption">
		<?php echo $ElementData['titleicon']?'<i class="'.$ElementData['titleicon'].'"></i> ':''?>
			<span class="caption-subject bold uppercase <?php echo $ElementData['titlecolor']?>"><?php echo $ElementData['title']?>
			</span> <span class="caption-helper"><?php echo $ElementData['caption']?>
			</span>
		</div>
		<?php if(sizeof($ElementData['action'])>0){?>
		<div class="actions">
			<?php if($ElementData['action']['remove']){?>
			<a href="javascript:;" class="btn btn-circle btn-icon-only btn-default <?php echo $ElementData['action']['remove']['class']==''?'':$ElementData['action']['remove']['class']?>" 
			<?php echo $ElementData['action']['remove']['id']==''?'':'id="'.$ElementData['action']['remove']['id'].'"'?>><i class="icon-trash"></i></a>
			<?php }
			if($ElementData['action']['fullscreen']){
			?>
			<a href="javascript:;" class="btn btn-circle btn-default btn-icon-only fullscreen"></a>
			<?php }
			if($ElementData['action']['collapse']){
			?>
			<a href="javascript:;" class="btn btn-circle btn-default btn-icon-only collapse" style="display:inline"><i class="fa fa-angle-down "></i></a>
			<?php }?>
			
		</div>
		<?php }?>
	</div>
	<div class="portlet-body form" <?php echo $ElementData['bodyid']==''?'':'id="'.$ElementData['bodyid'].'"'?>>
		<!-- BEGIN FORM-->
		
		<?php 
		/*
		
		<div class="actions">
			
									<a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;">
									</a>
			
									<a class="btn btn-circle btn-icon-only btn-default " href="javascript:;">
									<i class="icon-wrench"></i>
									</a>
												
									<a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
									<i class="icon-trash"></i>
									</a>
			
								</div>
		
		*/
		?>