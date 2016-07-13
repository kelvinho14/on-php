<ul class="page-breadcrumb breadcrumb">
	<li><i class="fa fa-home"></i> <a href="<?php echo $CONFIG['home_http']?>user/dashboardlist/"><?php echo $Admin_Lang['home']?></a> <i class="fa fa-angle-right"></i></li>
		<?php for($a=0;$a<sizeof($ElementData);$a++){?>
	<li>
		<?php if($ElementData[$a]['link']!=''){?>
		<a	href="<?php echo $ElementData[$a]['link']?>">
		<?php }?>
		<?php echo $ElementData[$a]['name']?> 
		<?php if($ElementData[$a]['link']!=''){?>
		</a>
		<?php }?>
		<?php if($a<sizeof($ElementData)-1){?>
		<i class="fa fa-angle-right"></i>
		<?php }?></li>
		<?php }?>
</ul>