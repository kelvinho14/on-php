<input type="text"  placeholder="<?php echo $ElementData["Placeholder"]?>" <?php echo $ElementData["Disabled"]?"disabled":""?> id="<?php echo $ElementData["ID"]?>" name="<?php echo $ElementData["Name"]?>" data-original-title="<?php echo $ElementData["PopTitle"]?>" data-content="<?php echo $ElementData["PopContent"];?>" data-trigger="hover" class="<?php echo ($ElementData['Class']==''?'':$ElementData['Class'])?> m-wrap popovers" value="<?php echo ((trim($ElementData["Value"]) != "")? htmlspecialchars($ElementData["Value"],ENT_QUOTES):'');?>">
<?php if($ElementData["Hint"]!=""){?>
<span class="help-inline"><?php echo $ElementData["Hint"]?></span>
<?php }?>
