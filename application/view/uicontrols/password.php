<input type="password" id="<? echo $ElementData['id']?>" name="<? echo $ElementData['name']?>" 
<?php 
if(isset($ElementData['attr'])){
	foreach($ElementData['attr'] as $key=>$val){
	echo $key.'="'.$val.'" ';
		
	}
}?>/>