<select <?php 
if(isset($ElementData['attr'])){
	foreach($ElementData['attr'] as $key=>$val){
	echo $key.'="'.$val.'" ';
	}
	//data-placeholder="Your Favorite Football Teams" class="chosen span6" multiple="multiple" tabindex="6"
}?> id="<?php echo $ElementData['id']?>" name="<?php echo $ElementData['name']?>">
<?php if(sizeof($ElementData['option'])>0){
	foreach($ElementData['option'] as $key=>$val){
		if(is_array($val[0])){
			echo '<optgroup label="'.$key.'">';
			for($a=0;$a<sizeof($val);$a++){
				$selected = '';
				if(is_array($ElementData['value'])){
					$selected = in_array($val[$a][0],$ElementData['value'])?'selected':'';
				}else{
					$selected = $ElementData['value']==$val[$a][0]?'selected':'';
				}
				echo '<option value="'.$val[$a][0].'" '.($selected).'>'.$val[$a][1].'</option>';
			}	
		}else{
			echo '<option value="'.$val[0].'" '.($ElementData['value']==$val[0]?'selected':'').'>'.$val[1].'</option>';
		}
	}
}?>
</select> 