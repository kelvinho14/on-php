<a href="javascript:;" class="btn btn-circle <?php echo $ElementData['class']?> btn-default"
<?php 
if(isset($ElementData['attr'])){
	foreach($ElementData['attr'] as $key=>$val){
	echo $key.'="'.$val.'"';
		
	}
}?>
> <i class="fa fa-<?php echo $ElementData['fa']?>"></i> <?php echo $ElementData['text']?> </a>