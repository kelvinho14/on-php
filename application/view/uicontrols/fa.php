<i class="fa fa-<?php echo $ElementData['fa']?>" <?php 
if(isset($ElementData['attr'])){
	foreach($ElementData['attr'] as $key=>$val){
	echo $key.'="'.$val.'" ';
		
	}
}?>></i>