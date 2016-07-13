<!-- for general db table, provide sorting and paging capability -->
<div class="board_left">
	<div class="board_right">
	<form name="DBTableForm" id="DBTableForm" method="POST" action="" onsubmit="return false;">
	<!-- ************ Main Content Start ************  -->
<?
	if (sizeof($ElementData["SubTab"]) > 0) {
		$ElementStyle["SubTabElemnt"] = $ElementData["SubTab"];
		UIElementController::Render('sub_tab',$ElementStyle);
		unset($ElementStyle);
	}
?>
		<div class="content_top_tool">
<?
	$NumberOfToolRight = sizeof($ElementData["ToolsRight"]);
	for ($i=0; $i< $NumberOfToolRight; $i++) {
?>
		<div class="Conntent_search">
		<?=$ElementData["ToolsRight"][$i]?>
		</div>
<?
	}
	unset($NumberOfToolRight);

	$NumberOfToolLeft = sizeof($ElementData["ToolsLeft"]);
	for ($i=0; $i< $NumberOfToolLeft; $i++) {
?>
		<div class="Content_tool">
		<?=$ElementData["ToolsLeft"][$i]?>
		</div>
<?
	}
	unset($NumberOfToolLeft);
?>
			<br style="clear:both" />
		</div>
		<div class="table_board">
			<div class="table_left">
				<div class="table_right">				
					<div id='DBTableLayer'>
						<table class="common_table_list" style="border-bottom:0px;">
							<tr>
<?
	$NoOfHeader = sizeof($ElementData["Header"]);
	for ($i=0; $i< $NoOfHeader; $i++) {
		list($Title,$AllowSort,$CurrentSorting,$SortOrder,$Width,$DataField,$SortField) = $ElementData["Header"][$i];
		
		$SortField = ($SortField == "")? $DataField:$SortField;
		$DataOrder[] = $DataField;
		
		if ($AllowSort) {
			if ($CurrentSorting) {
				$ElementStyle["Class"] = ($SortOrder == 0)? "sort_asc":"sort_dec";
				$HiddenCurrentSortingField = $DataField;
				$HiddenCurrentSortingOrder = $SortOrder;
			}
			$ElementStyle["ID"] = "DBTableHeader-".$i;
			$ElementStyle["Name"] = "DBTableHeader";
			$ElementStyle["OnClick"] = "ChangeSortingOrder(this,'".$SortField."');";
			$ElementStyle["Text"] = $Title;
			$Content = UIElementController::In_To_String('action_link',$ElementStyle);
			unset($ElementStyle);
		}
		else {
			$Content = $Title;
		}
		?>
		<th width="<?=$Width?>"><?=$Content?></th>
		<?
	}
	unset($NoOfHeader);
?>
							</tr>
<?
$NumberOfData = sizeof($ElementData["Data"]);
for ($i=0; $i< 100; $i++) {
	$RowStyle = ($i%2 == 0)? "normal record_bottom":"draft record_bottom";
	if ($i >= $NumberOfData) { // hide the row that is not used in current Record Per Page setting
		$HiddenRow = "display:none";
	}
	else {
		$HiddenRow = "";
	}
	$TableContent .= '<tr class="'.$RowStyle.'" id="DBTableRow['.$i.']" name="DBTableRow" style="'.$HiddenRow.'">';
	
	$NumberOfColumn = sizeof($DataOrder);
	for ($j=0; $j< $NumberOfColumn; $j++) {
		$TableContent .= '<td id="DBTableCell['.$i.']['.$j.']">';
		
			if ($ElementData["DataIsCheckBox"][$j]) {
				$ElementStyle["Name"] = $DataOrder[$j].'[]';
				$ElementStyle["Class"] = $DataOrder[$j];
				if ($i < $NumberOfData) {
					$ElementStyle["ID"] = $DataOrder[$j].'['.$ElementData["Data"][$i][$DataOrder[$j]].']';
					$ElementStyle["Value"] = $ElementData["Data"][$i][$DataOrder[$j]];
				}
				else {
					$ElementStyle["ID"] = $DataOrder[$j].'[-1]';
					$ElementStyle["Value"] = -1;
				}
				
				## henry yuen 2011-05-19: no check box, if no left tools
				if(sizeof($ElementData["ToolsLeft"]) > 0){
					$TableContent .= UIElementController::In_To_String('checkbox',$ElementStyle);
				}
				
				unset($ElementStyle);
			}
			else {
				if ($i < $NumberOfData) {
					$TableContent .= $ElementData["Data"][$i][$DataOrder[$j]];
				}
				else {
					$TableContent .= "&nbsp;";
				}
			}
		$TableContent .= '&nbsp;</td>';
	}
	$TableContent .= '</tr>';
	unset($NumberOfColumn);
}
$TableContent .= '<tr id="NoRecordRow" class="normal record_bottom" style="display:'.(($NumberOfData > 0)? "none":"").'">';
$TableContent .= '<td style="text-align:center" colspan="'.sizeof($DataOrder).'">'.$Lang['Corp']['General']['NoRecordAtThisMoment'].'</td>';
$TableContent .= '</tr>';
unset($NumberOfData);

$TableContent .= '</table>';
echo $TableContent;
unset($TableContent);

$ElementStyle["ID"] = "DBTableSortField";
$ElementStyle["Name"] = "DBTableSortField";
$ElementStyle["Value"] = $HiddenCurrentSortingField;
UIElementController::Render('hidden_box',$ElementStyle);
unset($ElementStyle);

$ElementStyle["ID"] = "DBTableSortOrder";
$ElementStyle["Name"] = "DBTableSortOrder";
$ElementStyle["Value"] = $HiddenCurrentSortingOrder;
UIElementController::Render('hidden_box',$ElementStyle);
unset($ElementStyle);


$StartRecordNumber = ($ElementData["TotalRecordCount"] > 0)? ($_SESSION["UserPerference"]["DBTableNoPerPage"]*($ElementData["PageInfo"]["PageNo"]-1)) + 1:0;
$EndRecordNumber = $StartRecordNumber + $_SESSION["UserPerference"]["DBTableNoPerPage"] - 1;
$EndRecordNumber = ($ElementData["TotalRecordCount"] < $EndRecordNumber)? $ElementData["TotalRecordCount"]:$EndRecordNumber;
$TotalNumberOfPage = ceil($ElementData["TotalRecordCount"]/$_SESSION["UserPerference"]["DBTableNoPerPage"]);

$PageContent .= '<div class="record_no">
									'.$Lang['Corp']['General']['Record(s)'].' 
									<span id="DBTableRecordInfo">'.$StartRecordNumber.' - '.$EndRecordNumber.'</span>
									, '.$Lang['Corp']['General']['Total'].'
									<span id="DBTableTotalRecord">'.$ElementData["TotalRecordCount"].'</span>
								</div>';
$PageContent .= '<div class="page_no">';
if ($ElementData["PageInfo"]["PageNo"] == 1) {
	$StyleDisplay = 'display:none;';
}
else {
	$StyleDisplay = '';
}
$PageContent .= '<span id="DBTableBackwardNavigation" style="'.$StyleDisplay.'">';
$ElementStyle["Class"] = "first";
$ElementStyle["Title"] = $Lang['Corp']['General']['FirstPage'];
$ElementStyle["OnClick"] = "document.getElementById('DBTablePage').value = 1; DB_Table_Refresh();";
$PageContent .= UIElementController::In_To_String("action_link",$ElementStyle);
unset($ElementStyle);

$ElementStyle["Class"] = "prev";
$ElementStyle["Title"] = $Lang['Corp']['General']['PreviousPage'];
$ElementStyle["OnClick"] = "document.getElementById('DBTablePage').value--; DB_Table_Refresh();";
$PageContent .= UIElementController::In_To_String("action_link",$ElementStyle);
unset($ElementStyle);
$PageContent .= '</span>';
$PageContent .= '<span> '.$Lang['Corp']['General']['Page'].' </span>';

for ($i=0; $i< $TotalNumberOfPage; $i++) {
	$ElementStyle["Data"][] = array(($i+1),($i+1));
}
$ElementStyle["ID"] = "DBTablePage";
$ElementStyle["Name"] = "DBTablePage";
$ElementStyle["Selected"] = $ElementData["PageInfo"]["PageNo"];
$ElementStyle["OnChange"] = "DB_Table_Refresh()";
$PageContent .= '<span id="DBTablePageSelection">'.UIElementController::In_To_String("selection_box",$ElementStyle).'</span>';
unset($ElementStyle);

if ($ElementData["PageInfo"]["PageNo"] == $TotalNumberOfPage) {
	$StyleDisplay = 'display:none;';
}
else {
	$StyleDisplay = '';
}
$PageContent .= '<span id="DBTableForwardNavigation" style="'.$StyleDisplay.'">';
$ElementStyle["Class"] = "next";
$ElementStyle["Title"] = $Lang['Corp']['General']['NextPage'];
$ElementStyle["OnClick"] = "document.getElementById('DBTablePage').value++; DB_Table_Refresh();";
$PageContent .= UIElementController::In_To_String("action_link",$ElementStyle);
unset($ElementStyle);

$ElementStyle["Class"] = "last";
$ElementStyle["Title"] = $Lang['Corp']['General']['LastPage'];
$ElementStyle["OnClick"] = "document.getElementById('DBTablePage').value = document.getElementById('DBTablePage').length; DB_Table_Refresh();";
$PageContent .= UIElementController::In_To_String("action_link",$ElementStyle);
unset($ElementStyle);
$PageContent .= '</span>';
$PageContent .= '<span> | '.$Lang['Corp']['General']['Display'].' </span>';

$ElementStyle["Data"][] = array(10,10);
$ElementStyle["Data"][] = array(20,20);
$ElementStyle["Data"][] = array(50,50);
$ElementStyle["Data"][] = array(100,100);
$ElementStyle["Name"] = "DBTableNoPerPage";
$ElementStyle["ID"] = "DBTableNoPerPage";
$ElementStyle["Selected"] = $_SESSION["UserPerference"]["DBTableNoPerPage"];
$ElementStyle["OnChange"] = "DB_Table_Refresh()";
$PageContent .= '<span>';
$PageContent .= UIElementController::In_To_String("selection_box",$ElementStyle);
$PageContent .= '</span>
								<span>/ '.$Lang['Corp']['General']['Page'].'</span>';
$PageContent .= '</div>';
unset($ElementStyle);
echo $PageContent;
unset($PageContent);
?>
					</div> <!-- div_staff_list_content -->
					
				</div><!-- [CLOSE - table_right] -->
			</div><!-- [CLOSE - table_left] -->
		</div> <!-- [CLOSE - table_board] -->
		<!-- ********* Main  Content end ************ -->
		<p class="spacer"></p>
	</form>
	</div>
</div>
<script>
var DBTableColType = new Array(<?=implode(',',$ElementData["DataIsCheckBox"])?>);
var DBTableColName = new Array();
<?
$NumberOfColumn = sizeof($DataOrder);
for ($j=0; $j< $NumberOfColumn; $j++) {
?>
	DBTableColName[<?=$j?>] = "<?=$DataOrder[$j]?>";
<?
}
?>

function DB_Table_Refresh() {
	var DBTableNoPerPage = parseInt($('#DBTableNoPerPage').val());
	var DBTablePageNo = ($('#DBTablePage').val() == null)? 1:parseInt($('#DBTablePage').val());
	//alert(DBTablePageNo);
	PostVar = {
		"IsAjax":"1",
		"NumberPerPage":DBTableNoPerPage,
		"PageNo":DBTablePageNo,
		"SortField":$('#DBTableSortField').val(),
		"SortOrder":$('#DBTableSortOrder').val()
	};
	
	Block_Element('DBTableLayer');
	
	$.post('<?=$ElementData["PageRefreshPath"]?>',PostVar,
		function (data) {
			if (data == "die") {
				window.top = "/";
			}
			else {
				JSONObj = jQuery.parseJSON(data);
				// update Table Count Info
				TotalRecordCount = JSONObj.TotalCount;
				
				// Hide No record row
				if (TotalRecordCount > 0) {
					$('#NoRecordRow').css('display','none');
				}
				else {
					$('#NoRecordRow').css('display','');
				}
				
				// check is New total number of page has changed
				TotalNumberOfPage = Math.ceil(TotalRecordCount/DBTableNoPerPage);
				PageNumberSelection = document.getElementById('DBTablePage');
				NeedReload = false;
				// remove if less then before
				for (var i=(PageNumberSelection.length-1); i>=TotalNumberOfPage ; i--) {
					if (PageNumberSelection.options[i].selected) {
						NeedReload = true;
					}
					PageNumberSelection.options[i] = null;
				}
				if (NeedReload) {
					PageNumberSelection.selectedIndex = (PageNumberSelection.length-1);
				}
				
				// add if more then before
				for (var i=PageNumberSelection.length; i< TotalNumberOfPage; i++) {
					PageNumberSelection.options[PageNumberSelection.length] = new Option((i+1), (i+1), false, false);
				}
				
				// toggle the page naviagtion link
				if (PageNumberSelection.selectedIndex > 0) {
					$('#DBTableBackwardNavigation').css('display','');
				}
				else {
					$('#DBTableBackwardNavigation').css('display','none');
				}
				
				if (PageNumberSelection.selectedIndex < (PageNumberSelection.length-1)) {
					$('#DBTableForwardNavigation').css('display','');
				}
				else {
					$('#DBTableForwardNavigation').css('display','none');
				}
				
				// update record info
				StartRecordNumber = (TotalRecordCount > 0)? ((DBTableNoPerPage*PageNumberSelection.selectedIndex) + 1):0;
				EndRecordNumber = StartRecordNumber + DBTableNoPerPage - 1;
				EndRecordNumber = (TotalRecordCount < EndRecordNumber)? TotalRecordCount:EndRecordNumber;
				$('#DBTableRecordInfo').html(StartRecordNumber+' - '+EndRecordNumber);
				$('#DBTableTotalRecord').html(TotalRecordCount);
				
				// update table content
				if (TotalRecordCount > 0) {
					ReturnDataList = JSONObj.DataList;
					CheckBoxCell = -1;
					for(Row in ReturnDataList) {
						for (Cell in ReturnDataList[Row]) {
							if (DBTableColType[Cell] == 1) { // is check box
								CheckBoxCell = Cell;
								$('#DBTableCell\\['+Row+'\\]\\['+Cell+'\\]').children().attr('value',ReturnDataList[Row][Cell]).attr('id',DBTableColName[Cell]+'['+ReturnDataList[Row][Cell]+']');
							}
							else {
								$('#DBTableCell\\['+Row+'\\]\\['+Cell+'\\]').html(ReturnDataList[Row][Cell]+'&nbsp;');
							}
						}
	        }
				}
				else {
					Row = -1;
					
					for (var i = 0; i < DBTableColType.length; i++) {
					  if (DBTableColType[i] == 1) {
					    CheckBoxCell = i;
					    break;
					  }
					}
				}
				// show/ hide data row
        $('tr[name="DBTableRow"]').each(function() {
					var ElementID = $(this).attr('id');
					ElementID = ElementID.replace("DBTableRow[","");
					ElementID = ElementID.replace("]","");
					if (parseInt(ElementID) < parseInt(DBTableNoPerPage) && parseInt(ElementID) < (parseInt(Row)+1)) {
						$(this).css('display','');
						$('#DBTableCell\\['+ElementID+'\\]\\['+CheckBoxCell+'\\]').children().attr('checked',false);
					}
					else {
						$(this).css('display','none');
						$('#DBTableCell\\['+ElementID+'\\]\\['+CheckBoxCell+'\\]').children().attr('value',"-1").attr('id',DBTableColName[0]+'[-1]').attr('checked',false);
					}
				});
				
				UnBlock_Element('DBTableLayer');
			}
		}
	);
}

function ChangeSortingOrder(HeaderLinkObj,HeaderField) {
	var ElementClass = HeaderLinkObj.className;
	ElementClass = (ElementClass == "sort_asc")? "sort_dec":"sort_asc";
	HiddenOrder = (ElementClass == "sort_asc")? "0":"1";
	$('a[name="DBTableHeader"]').attr('class','').attr('style','background: none repeat scroll 0 0 transparent;');
	$(HeaderLinkObj).attr('class',ElementClass).attr('style','');
	
	$('#DBTableSortField').val(HeaderField);
	$('#DBTableSortOrder').val(HiddenOrder);
	
	DB_Table_Refresh();
}
</script>