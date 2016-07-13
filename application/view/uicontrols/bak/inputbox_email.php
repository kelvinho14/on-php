
		<div class="input-icon left">
			<i class="icon-envelope"></i>
			<input type="text" class="m-wrap popovers" placeholder="<?php echo $ElementData['Placeholder']==''?$Lang['email']:$ElementData['Placeholder']?>" <?php echo $ElementData["Disabled"]?"disabled":""?> id="<?php echo $ElementData["ID"]?>" name="<?php echo $ElementData["Name"]?>" value="<?php echo ((trim($ElementData["Value"]) != "")? htmlspecialchars($ElementData["Value"],ENT_QUOTES):'');?>" data-original-title="<?php echo $ElementData["PopTitle"]?>" data-content="<?php echo $ElementData["PopContent"];?>" data-trigger="hover">
			<?php if($ElementData["Hint"]!=""){?>
			<span class="help-inline"><?php echo $ElementData["Hint"]?></span>
			<?php }?>    
		</div>
