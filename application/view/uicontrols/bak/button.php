<!-- Button -->
<?
switch ($ElementData["ButtonType"]) {
	case "Submit":
		$ElementData["Class"] = "formbutton";
		break;
	case "Normal":
		$ElementData["Class"] = "formsubbutton";
		break;
	default:
		$ElementData["Class"] = "formbutton";
		break;
} 
?>
<input 
	onmouseover="this.className='<?=$ElementData["Class"]?>on'" onmouseout="this.className='<?=$ElementData["Class"]?>'"
	type="<?=strtolower($ElementData["ButtonType"])=="reset"?"reset":"button"?>" 
	id="<?=$ElementData["ButtonType"]?>" 
	name="<?=$ElementData["ButtonType"]?>" 
	<?=(($ElementData["OnClick"]!="")? 'onclick="'.$ElementData["OnClick"].'"':"")?> 
	value="<?=((trim($ElementData["DisplayTitle"]) != "")? htmlspecialchars($ElementData["DisplayTitle"],ENT_QUOTES):'')?>" 
	class="<?=$ElementData["Class"]?>" 
	<?=($ElementData["Disabled"])? "disabled=\"true\"":"" ?> />