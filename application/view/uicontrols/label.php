<label <?php echo $ElementData['for']==''?'':'for="'.$ElementData['for'].'"'?> 
<?php 
if(isset($ElementData['attr'])){
	foreach($ElementData['attr'] as $key=>$val){
	echo $key.'="'.$val.'"';
		
	}
}?>><?php echo $ElementData['value']?></label>