<div id="<?php echo $ElementData['id']?>" <?php
if(isset($ElementData['attr'])){
	foreach($ElementData['attr'] as $key=>$val){
		echo $key.'="'.$val.'" ';
	}
}

if(isset($ElementData['class'])==false && $ElementData['size']!=''){
	$ElementData['class']= "col-md-".$ElementData['size'];
}
?> class="<?php echo $ElementData['class'];?>">
<?php echo $ElementData['value']?> 									