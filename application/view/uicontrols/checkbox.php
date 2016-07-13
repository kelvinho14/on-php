<input type="checkbox" id="<? echo $ElementData['id']?>" <? echo $ElementData['checked']?'checked':''?> name="<? echo $ElementData['name']?>" value="<? echo htmlentities($ElementData['value'])?>" 
<?php 
if(isset($ElementData['attr'])){
	foreach($ElementData['attr'] as $key=>$val){
	echo $key.'="'.$val.'" ';
		
	}
}?>/>