<textarea class="form-control <?php echo $ElementData['class']?>" id="<?php echo $ElementData['id']?>" name="<?php echo $ElementData['name']?>" rows="<?php echo $ElementData['rows']==''?3:$ElementData['rows']?>" <?php 
if(isset($ElementData['attr'])){
	foreach($ElementData['attr'] as $key=>$val){
	echo $key.'="'.$val.'" ';
		
	}
}?>><?php echo $ElementData['value']==''?'':htmlentities($ElementData['value'])?></textarea>