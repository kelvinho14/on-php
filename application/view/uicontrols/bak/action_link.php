<!-- Action Link -->
<a 
	id="<?=$ElementData["ID"]?>" 
	name="<?=$ElementData["Name"]?>"
	href="<?=(isset($ElementData["Href"])? $ElementData["Href"]:'javascript:void(0)')?>" 
	target="<?=(isset($ElementData["Target"])? $ElementData["Target"]:'')?>"
	title="<?=$ElementData["Title"]?>" 
	<?=(isset($ElementData["OnClick"])?'onclick="'.$ElementData["OnClick"].'"':'')?> 
	class="<?=$ElementData["Class"]?>" 

	<?//=(($ElementData["Class"] == "")? 'style="background:none; padding-left:10px;"':'')?>
	<?=(($ElementData["Class"] == "")? 'style="background:none;"':'')?>
>
	<?=$ElementData["Text"]?>
</a> 