<!--This is a searchbox:-->
<input type="text" 
	id="<?=$ElementData["ID"]?>" 
	name="<?=$ElementData["Name"]?>" 
	onkeyup="<?=$ElementData["KeyUp"]?>" 
	value="<?=htmlspecialchars($ElementData["Value"],ENT_QUOTES)?>" />