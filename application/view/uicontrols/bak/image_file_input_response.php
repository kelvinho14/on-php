<script>
	var Par = window.parent;
<?
if ($Data["Success"] == "1") {
	if (is_array($Data["ExtraPara"])) {
		foreach ($Data["ExtraPara"] as $Key => $Var) {
			$ExtraPara .= '/'.$Key.'-'.$Var;
		}
	}
?>
	Par.document.getElementById('<?=$Data["FileInputID"]?>ImageLayer').src = "/systemaction/Get_Image/Type-<?=$Data['Type'].$ExtraPara?>/IsTemp-1/RandomStr-<?=time()?>";
	Par.document.getElementById('<?=$Data["FileInputID"]?>PreviewLayer').style.display = "";
	Par.document.getElementById('<?=$Data["FileInputID"]?>').style.display = "none";
	Par.document.getElementById('<?=$Data["FileInputID"]?>').value = "";
	Par.document.getElementById('<?=$Data["FileInputID"]?>Hidden').value = "/systemaction/Get_Image/Type-<?=$Data['Type'].$ExtraPara?>/IsTemp-1/RandomStr-<?=time()?>";
	Par.document.getElementById('<?=$Data["FileInputID"]?>Warning').innerHTML = "";
<?
}
else {
?>
	Par.document.getElementById('<?=$Data["FileInputID"]?>').value = "";
	Par.document.getElementById('<?=$Data["FileInputID"]?>Warning').innerHTML = '<?=$Data["Warning"]?>';
<?	
}
?>
</script>