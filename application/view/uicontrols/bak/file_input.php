<!-- File Input -->
<input type="file" 
	id="<?=$ElementData["ID"]?>" 
	name="<?=$ElementData["Name"]?>"  
	class="<?=(($ElementData["Class"] != "")? $ElementData["Class"]:"textfield2")?>"
	<?=(($ElementData["Size"] != "")? ' size="'.$ElementData["Size"].'"':'')?> 
	<?=(($ElementData["Type"] != "")? ' style="display:none;"':'')?>
>