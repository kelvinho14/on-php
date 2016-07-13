<!-- this is a menu bar -->
<?
//modifying by:
global $CONFIG;

//find the first item in the sub menu first, then decide the top menu link
$topMenu[] = array(	"name" => "MyCourse",
					"rightName" => "MyCourse",
					"displayName" => $Lang['Corp']['Menu']['MyCourse'], 
					"link" => "/error"
					);
$topMenu[] = array(	"name" => "Company", 
					"rightName" => "Company",
					"displayName" => $Lang['Corp']['Menu']['Company'], 
					"link" => "/error"
					);
$topMenu[] = array(	"name" => "Staff", 
					"rightName" => "Staff",
					"displayName" => $Lang['Corp']['Menu']['Staff'], 
					"link" => "/error"
					);
$topMenu[] = array(	"name" => "CourseMgmt", 
					"rightName" => "Course",
					"displayName" => $Lang['Corp']['Menu']['CourseMgmt'], 
					"link" => "/error"
					);

switch ($ElementData["CurrentMainMenu"])
{
	case "MyCourse":
		if ($_SESSION["UserAccessRight"]["MyCourse-MyCourse"]) $SubMenu[] = array($Lang['Corp']['Menu']['MyCourse'],"/course/My_Course_List",($ElementData["CurrentSubMenu"] == "MyCourse"));
		break;
	case "Company":
		if ($_SESSION["UserAccessRight"]["Company-GeneralSetting"]) $SubMenu[] = array($Lang['Corp']['SubMenu']['Company']['GeneralSetting'],"/company/General_Setting_Form",($ElementData["CurrentSubMenu"] == "GeneralSetting"));
		if ($_SESSION["UserAccessRight"]["Company-Level"]) $SubMenu[] = array($Lang['Corp']['SubMenu']['Company']['CompanyStructure'],"/company/Company_Structure_Listing",($ElementData["CurrentSubMenu"] == "CompanyStructureMgmt"));
		if ($_SESSION["UserAccessRight"]["Company-Department"]) $SubMenu[] = array($Lang['Corp']['SubMenu']['Company']['DepartmentMgmt'],"/company/Department_List",($ElementData["CurrentSubMenu"] == "DepartmentMgmt"));
		if ($_SESSION["UserAccessRight"]["Company-Position"]) $SubMenu[] = array($Lang['Corp']['SubMenu']['Staff']['PositionMgmt'],"/company/Position_Group_List",($ElementData["CurrentSubMenu"] == "PositionMgmt"));
		if ($_SESSION["UserAccessRight"]["Company-CustomField"]) $SubMenu[] = array($Lang['Corp']['SubMenu']['Company']['CustomFieldMgmt'],"/company/Customize_User_Field",($ElementData["CurrentSubMenu"] == "CustomFieldMgmt"));		
		break;
	case "Staff":
		if ($_SESSION["UserAccessRight"]["Staff-User"]) $SubMenu[] = array($Lang['Corp']['SubMenu']['Staff']['UserMgmt'],"/user/User_List",($ElementData["CurrentSubMenu"] == "UserMgmt"));
		if ($_SESSION["UserAccessRight"]["Staff-Role"]) $SubMenu[] = array($Lang['Corp']['SubMenu']['Staff']['RoleMgmt'],"/role/Role_List",($ElementData["CurrentSubMenu"] == "RoleMgmt"));
		break;
	case "CourseMgmt":
		if ($_SESSION["UserAccessRight"]["Course-Category"]) $SubMenu[] = array($Lang['Corp']['SubMenu']['Course']['CourseCategory'],"/course/Course_Category_List",($ElementData["CurrentSubMenu"] == "CourseCat"));
		if ($_SESSION["UserAccessRight"]["Course-Course"]) $SubMenu[] = array($Lang['Corp']['SubMenu']['Course']['CourseMgmt'],"/course/Course_List",($ElementData["CurrentSubMenu"] == "CourseMgmt"));
		break;	
	default:
		break;
}			
		
	$i = 0;
	if ($_SESSION["UserAccessRight"]["MyCourse-MyCourse"]) $topMenu[$i]["link"] = ($topMenu[$i]["link"] == "/error") ? "/course/My_Course_List" : $topMenu[$i]["link"];

	$i = 1;
	if ($_SESSION["UserAccessRight"]["Company-GeneralSetting"]) $topMenu[$i]["link"] = ($topMenu[$i]["link"] == "/error") ? "/company/General_Setting_Form" : $topMenu[$i]["link"];
	if ($_SESSION["UserAccessRight"]["Company-Level"]) $topMenu[$i]["link"] = ($topMenu[$i]["link"] == "/error") ? "/company/Company_Structure_Listing" : $topMenu[$i]["link"];
	if ($_SESSION["UserAccessRight"]["Company-Department"]) $topMenu[$i]["link"] = ($topMenu[$i]["link"] == "/error") ? "/company/Department_List" : $topMenu[$i]["link"];
	if ($_SESSION["UserAccessRight"]["Company-Position"]) $topMenu[$i]["link"] = ($topMenu[$i]["link"] == "/error") ? "/company/Position_Group_List" : $topMenu[$i]["link"];
	if ($_SESSION["UserAccessRight"]["Company-CustomField"]) $topMenu[$i]["link"] = ($topMenu[$i]["link"] == "/error") ? "/company/Customize_User_Field" : $topMenu[$i]["link"];

	$i = 2;
	if ($_SESSION["UserAccessRight"]["Staff-User"]) $topMenu[$i]["link"] = ($topMenu[$i]["link"] == "/error") ? "/user/User_List" : $topMenu[$i]["link"];
	if ($_SESSION["UserAccessRight"]["Staff-Role"]) $topMenu[$i]["link"] = ($topMenu[$i]["link"] == "/error") ? "/role/Role_List" : $topMenu[$i]["link"];

	$i = 3;
	if ($_SESSION["UserAccessRight"]["Course-Category"]) $topMenu[$i]["link"] = ($topMenu[$i]["link"] == "/error") ? "/course/Course_Category_List" : $topMenu[$i]["link"];
	if ($_SESSION["UserAccessRight"]["Course-Course"]) $topMenu[$i]["link"] = ($topMenu[$i]["link"] == "/error") ? "/course/Course_List" : $topMenu[$i]["link"];

$content = '<div class="topleft">
						<div style="float:left; height:60px; width:150px;"><img src="/systemaction/Get_Image/Type-CompanyLogo" border="0" style="height:60px; width:150px;"></div>
						<div id="blue">
							<div class="topmenu">          
								<ul>';
foreach($topMenu as $menuItem)
{
	$content .= $_SESSION["UserAccessRight"][$menuItem["rightName"]] ? '<li '.(($ElementData["CurrentMainMenu"] == $menuItem["name"])? 'class="current"':'').'><a href="javascript:void(0)" onClick="window.location.href=\''.$menuItem["link"].'\'"><span>'.$menuItem["displayName"].'</span></a></li>' : '';	
}
$content .=						'</ul>
							</div>
	
							<div class="topmenu_sub">
								<div class="topmenu_sub_left">
									<div class="topmenu_sub_right">';
if(in_array($ElementData["CurrentMainMenu"],array("MyCourse","Company","Staff","CourseMgmt"))) {
	$content .= '<ul>';
	
	$NumberOfSubMenu = sizeof($SubMenu);
	for ($i=0; $i< $NumberOfSubMenu; $i++) {
		list($SubMenuTitle,$Path,$IsCurrent) = $SubMenu[$i];
		
		if($IsCurrent){
			$content .= '<li class="current"><a href="javascript:void(0)"><span>'.$SubMenuTitle.'</span></a></li>';
		}else{
			$content .= '<li><a href="javascript:void(0)" onClick="window.location.href=\''.$Path.'\'"><span>'.$SubMenuTitle.'</span></a></li>';
		}
	}
	$content .= '</ul>';
}
$content .= '			</div>
								</div>
        			</div>
        
    				</div>
					</div>';
echo $content;
?>