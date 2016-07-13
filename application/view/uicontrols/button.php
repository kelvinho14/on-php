<button id="<?php echo $ElementData['id']?>" type="<?php echo $ElementData['type']==''?'button':$ElementData['type'];?>" class="btn <?php echo $ElementData['class']==''?' btn-primary ':$ElementData['class']?>" <?php 
if(isset($ElementData['attr'])){
	foreach($ElementData['attr'] as $key=>$val){
	echo $key.'="'.$val.'" ';
	}}?>><?php echo $ElementData['value']?></button>