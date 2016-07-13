<?php
//modifying by:     
class AccessController extends Application
{
	function __construct($args)
	{
		$this->args = $args;
	}
	
	//check the user has the access right for the required controller and method
	//and called the error controller to raise error if necessary 
	/*function Check_Access_Right($controller, $method, $raiseError=true)
	{
		global $Lang;
		$this->Load_Model('access');
		$AccessControl = new AccessControlModel();
		//$AccessControl->Get_User_Custom_Language();
		
		if ($AccessControl->Check_Access_Right($controller, $method))
		{
			return true;
		}
		else
		{
			if ($raiseError)
			{
				if($_REQUEST["IsAjax"]){
					echo json_encode(array('status' => 'NO_ACCESS'));
					die;
				} 
				else
					MVC_Perform_Action("error", "Raise_Error", NULL, array($Lang['no_access_right']));
			}
			else
			{
				return false;
			}
		}
	}*/
	
	function Role_AccessView(){
		global $Lang,$CONFIG;
		
		$AccessControl = new AccessControlModel();
		$acc_obj = $AccessControl->Check_Access_Right(); 
		
		$AccessControl->Get_User_Custom_Language();
		
		$Data["function"] = $acc_obj;
		$Data['action'] = 'user';
		
		$this->Load_Model("user");
		$UserModel = new UserModel();
		
		
		
		$Data['AccessList'] = $AccessControl->Get_Access_Obj(array(array('Config',1)));
		$Data['all_role']	= $UserModel->Get_Role();
		
		if(sizeof($Data['all_role'])==0){
			MVC_Perform_Action("error", "Raise_Error", NULL, array($Lang['not_set_msg']['role'],true));
		}
		$Data['RoleID'] = $_REQUEST['RoleID']==''?$Data['all_role'][0]['RoleID']:$_REQUEST['RoleID'];
		
		
		for($a=0;$a<sizeof($Data['all_role']);$a++){
			$Data['RoleAccess'][$Data['all_role'][$a]['RoleID']] = explode(",",$Data['all_role'][$a]['Access']);
		}
		
		
		$this->Load_View('access/roleaccess_view', $Data);
	}
	
	function User_Accesslist(){
		global $Lang,$CONFIG;
		
		$AccessControl = new AccessControlModel();
		$acc_obj = $AccessControl->Check_Access_Right();
		
		$AccessControl->Get_User_Custom_Language();
		
		$Data["function"] = $acc_obj;
		
		$this->Load_Model("user");
		$UserModel = new UserModel();
		
		
		$Data['all_role'] 	= array_merge(array(array('',$Lang['please_choose'])),$UserModel->Get_Role());
		$Data['RoleID']		=	$_REQUEST['RoleID'];
		$para = $Data['RoleID']==''?array():array(array('r.RoleID',$Data['RoleID']));
		
		$Data['Column'] = array($Lang['username'],$Lang['email'],$Lang['status'],$Lang['created_time'],$Lang['last_login']);
		$Data['UserList']	= $UserModel->Get_User_Listing($para);
		
		
		$this->Load_View('access/useraccess_list', $Data);
	}
	
	function User_Accessview(){
		global $Lang,$CONFIG;
		
		$AccessControl = new AccessControlModel();
		$acc_obj = $AccessControl->Check_Access_Right('','',$_REQUEST['ID']);
		
		$AccessControl->Get_User_Custom_Language();
		
		$Data["function"] = $acc_obj;
		$Data['action'] = 'user';
		
		$this->Load_Model("user");
		$UserModel = new UserModel();
		$target_user = $UserModel->Get_User_Name($_REQUEST['ID']);
		$Data['UserName'] = $target_user[0];
		$Data['AccessList'] = $AccessControl->Get_Access_Obj(array(array('Config',1)));
		$Data['all_role']	= $UserModel->Get_Role();
		
		if(sizeof($Data['all_role'])==0){
			MVC_Perform_Action("error", "Raise_Error", NULL, array($Lang['not_set_msg']['role'],true));
		}
		$Data['RoleID'] = $_REQUEST['RoleID']==''?$Data['all_role'][0]['RoleID']:$_REQUEST['RoleID'];
		
		
		for($a=0;$a<sizeof($Data['all_role']);$a++){
			$Data['RoleAccess'][$Data['all_role'][$a]['RoleID']] = explode(",",$Data['all_role'][$a]['Access']);
		}
		
		$this->Load_View('access/useraccess_view', $Data);
	}
	
	function Get_RoleaccessID(){
		global $Lang,$CONFIG;
		
		$this->Load_Model("user");
		$UserModel = new UserModel();
		$UserModel->Get_User_Custom_Language();
		
		$right_obj = $UserModel->Get_Role(array(array('RoleID',$_POST['RoleID'])));
		$access_id = array();
		for($a=0;$a<sizeof($right_obj);$a++)
			$access_id[] = $right_obj[$a]['Access'];
		
		if(sizeof($access_id)>0){
			echo json_encode(array('status' => 'OK', 'id' => implode(",",$access_id)));
		}else{
			echo json_encode(array('status' => 'ERROR', 'message' => $Lang['no_right_for_this_role']));
		}
		
	}
	
	function User_AccessEdit(){
		global $Lang,$CONFIG;		
		
		$this->Load_Model("access");
		$AccessControl = new AccessControlModel();
		$AccessControl->Get_User_Custom_Language();
		
		if($_REQUEST['ID']!=''){
			$access_id = array();
			foreach($_POST as $key=>$value){
				if(substr($key,0,strlen('cb_'))=='cb_'){
					$access_id[] = str_replace('cb_','',$key);
				}
			}
			if(sizeof($access_id)>0)
				$access_id = implode(',',$access_id);
			
			$this->Load_Model("user");
			$UserModel = new UserModel();
			$target_user = $UserModel->Get_User_Name($_REQUEST['ID']);
			$Data['UserName'] = $target_user[0];
			
			if($AccessControl->Update_User_Access($_REQUEST['ID'],$access_id)){
					
				$action_title = UIElementController::In_To_String("action_success").str_replace("%NAME%",$Data['UserName'],$Lang['user_access_update']);
				$msg = ' ';
			}
			else{
				$msg = str_replace("%NAME%",$Data['UserName'],$Lang['user_access_update_failed']);
			}
			
			$_SESSION['action_title'] = $action_title;
			$_SESSION['action_msg'] = $msg;
			header("location:?ctr=access_user_accessview&ID=".$_REQUEST['ID']);
			die;
			
		}
	}
	
	function Role_AccessEdit(){
		
		global $Lang,$CONFIG;		
		
		$this->Load_Model("access");
		$AccessControl = new AccessControlModel();
		$AccessControl->Get_User_Custom_Language();
		
		if($_POST['RoleID']!=''){
			$access_id = array();
			foreach($_POST as $key=>$value){
				if(substr($key,0,strlen('cb_'))=='cb_'){
					$access_id[] = $value;
				}
			}
			if(sizeof($access_id)>0)
				$access_id = implode(',',$access_id);
			if($AccessControl->Update_Role_Access($_POST['RoleID'],$access_id)){
					
				$action_title = UIElementController::In_To_String("action_success").$Lang['role_access_update'];
				$msg = ' ';
			}
			else{
				$msg = $Lang['role_access_update_failed'];
			}
			
			$_SESSION['action_title'] = $action_title;
			$_SESSION['action_msg'] = $msg;
			header("location:?ctr=access_role_accessview&RoleID=".$_POST['RoleID']);
			die;
			
		}
	}
	
	function Check_License(){
		global $Lang,$CONFIG;		
		
		$this->Load_Model("access");
		$AccessControl = new AccessControlModel();
		$AccessControl->Get_User_Custom_Language();
		
		if($AccessControl->Is_Valid_License()==false){
			MVC_Perform_Action("error", "Raise_Error", NULL, array($Lang['license_expired']));
		}
	}
}