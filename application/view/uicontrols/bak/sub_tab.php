<div class="content_top_tool">
	<!-- Start of subtab -->                      
	<div class="subtab">
		<ul>
<?
	$NumberOfSubTab = sizeof($ElementData['SubTabElemnt']);
	for ($i=0; $i< $NumberOfSubTab; $i++) {
		list($TabDetail,$IsCurrent) = $ElementData['SubTabElemnt'][$i];
?>
		<li <?=(($IsCurrent)? 'class="current"':"")?>><?=$TabDetail?></li>
<?
	}
	unset($NumberOfSubTab);
?>
		</ul>
	</div>
	<!-- End of subtab -->     
	<br style="clear: both;">
</div>