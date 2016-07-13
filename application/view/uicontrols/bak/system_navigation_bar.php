<?
global $Lang;

$ElementData = (isset($ElementData))? $ElementData:$Data;

$content = '<span id="navigator">';
$TempNavSize = sizeof($ElementData);
for($i=0; $i< $TempNavSize; $i++)
{
	if($ElementData[$i][0] != ""){
		$content .= '<a href="'.$ElementData[$i][0].'">'.$ElementData[$i][1].'</a>';
	}else{
		$content .= '<span>'.$ElementData[$i][1].'</span>';
	}
}
unset($TempNavSize);
$content .= '</span>';
echo $content;
?>