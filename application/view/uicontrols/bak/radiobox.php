<!--For radio button-->
<input type="radio" 
	id="<?=$ElementData["ID"]?>" 
	name="<?=$ElementData["Name"]?>" 
	<?=(($ElementData["OnClick"]!="")? 'onclick="'.$ElementData["OnClick"].'"':"")?> 
	value="<?=((trim($ElementData["Value"]) != "")? htmlspecialchars($ElementData["Value"],ENT_QUOTES):'')?>" 
	class="<?=(($ElementData["Class"] != "")? $ElementData["Class"]:"")?>" 
	<?=(($ElementData["Checked"])? 'checked="checked"':"")?>>
<label <?=(($ElementData["ID"] != "")? 'for="'.$ElementData["ID"].'"':'')?> >
	<?=$ElementData["Title"]?>
</label>