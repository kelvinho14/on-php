<input type="text" id="<? echo $ElementData['id']?>" name="<? echo $ElementData['name']?>" value="<? echo htmlentities($ElementData['value'])?>" 
<?php 
if(isset($ElementData['attr'])){
	foreach($ElementData['attr'] as $key=>$val){
	echo $key.'="'.$val.'" ';
		
	}
}?>  <?php echo $ElementData['readonly']?'readonly':''?>/>