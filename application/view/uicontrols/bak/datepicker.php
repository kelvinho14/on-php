
		<input class="m-wrap m-ctrl-medium date-picker" readonly size="16" type="text" value="<?php echo $ElementData["Value"]?>" id="<?php echo $ElementData["ID"]?>" name="<?php echo $ElementData["Name"]?>" <?php if($ElementData['OnChange']!='') echo 'onChange="'.$ElementData['OnChange'].'"';?>/>
		<span class="add-on"><i class="icon-calendar"></i></span>
		<?php if($ElementData["Hint"]!=''){?>
		<span class="help-inline"><?php echo $ElementData["Hint"]?></span>
		<?php }?>
		
