<?php
    
class SettingController extends Application
{
	function __construct($args)
	{
		$this->args = $args;

	}	
	
	/* display the user listing db table page */
	function access(){
		global $CONFIG,$Admin_Lang;
		
		$classname = $this->Load_Model("access");
		$AccessControl = new $classname();
		$AccessControl->handleAccess('setting','access');
		
		$classname = $this->Load_Model("user");
		$UserModel = new $classname($Vars);
		
		$Data['selecteduserrole'] = filter::optional_param('roleid','',PARAM_INT);
		$submit = filter::optional_param('issubmit','',PARAM_TEXT);
		
		if($submit){
			$UserModel->roleid = filter::required_param('roleid',PARAM_INT);
			foreach($_POST as $key=>$val){
				if($key!='roleid'&&$key!='issubmit'){
					list($module,$method) = explode("_",$key);
					$access[$module][$method] = 1;
				}
			}
			$UserModel->updatePermission($access);
			ui::setGrowl($Admin_Lang['growl']['access_updated'],'success');
			header("location:".$CONFIG['home_http']."setting/access/?roleid=".$UserModel->roleid);
			die;
		}
		
		$Data['userrole'] = $UserModel->Get_Role_Selection();
		$Data['userrole'] = display::addSelectOption($Data['userrole']);
		$Data['permission'] = UserModel::getPermission();
		
		//print_r($Data['permission']);
		//die;
		
		
		$this->Load_View('setting/access', $Data, $ArrMenuBar, $ArrPath);
		
	}	
}
?>