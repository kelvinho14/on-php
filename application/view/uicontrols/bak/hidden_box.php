<!--This is a searchbox:-->
<input type="hidden" 
	id="<?=$ElementData["ID"]?>" 
	name="<?=$ElementData["Name"]?>" 
	value="<?=((trim($ElementData["Value"]) != "")? htmlspecialchars($ElementData["Value"],ENT_QUOTES):'')?>" 
>