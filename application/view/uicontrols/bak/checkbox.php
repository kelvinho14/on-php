<!--For radio button-->
<input type="checkbox" 
	id="<?=$ElementData["ID"]?>" 
	name="<?=$ElementData["Name"]?>" 
	<?=(($ElementData["OnClick"]!="")? 'onclick="'.$ElementData["OnClick"].'"':"")?> 
	value="<?=((trim($ElementData["Value"]) != "")? htmlspecialchars($ElementData["Value"],ENT_QUOTES):'')?>" 
	class="<?=(($ElementData["Class"] != "")? $ElementData["Class"]:"")?>"
	<?=(($ElementData["Rel"])? 'rel="'.$ElementData["Rel"].'"':"")?> 
	<?=(($ElementData["Checked"])? 'checked="checked"':"")?>/>
<? if ($ElementData["Title"] != "") {?>
<label <?=(($ElementData["ID"] != "")? 'for="'.$ElementData["ID"].'"':'')?> >
	<?=$ElementData["Title"]?>
</label>
<? } ?>