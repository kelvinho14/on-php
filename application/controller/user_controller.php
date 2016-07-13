<?php
    
class UserController extends Application
{
	function __construct($args)
	{
		$this->args = $args;

	}	
	
	/* display the user listing db table page */
	function viewlist(){
		global $Admin_Lang;
		
		$classname = $this->Load_Model("access");
		$AccessControl = new $classname();
		$AccessControl->handleAccess('user','list');
		
		$classname = $this->Load_Model("user");
		$UserModel = new $classname($Vars);
			
		if($Data["UserList"] = $UserModel->Get_User_Listing()){
			$ct = sizeof($Data["UserList"]); 
			for($a=0;$a<$ct;$a++){
				$UserModel->userid = $Data["UserList"][$a]['UserID'];
				$Data["UserList"][$a]['ProfilePicSrc'] = $UserModel->renderProfilePicSrc($Data["UserList"][$a]['ProfilePic'],'',3); 
			}
		}
		
		//$Data['CanEdit'] = $AccessControl->Check_Access_Right('user','edit');
		
		
		//for($a=0;$a<sizeof($Data["UserList"]);$a++){
			//$Data["UserList"][$a]['AvatarImage'] = '<img src="'.$UserModel->Get_Avatar_Path($Data["UserList"][$a]['UserID'],'t_'.$Data["UserList"][$a]['Avatar']).'">';
			//$Data["UserList"][$a]['AvatarImage'] = $UserModel->Get_Avatar_Path($Data["UserList"][$a]['UserID'],$Data["UserList"][$a]['Avatar']);
		//}
		$this->Load_View('user/list', $Data, $ArrMenuBar, $ArrPath);
	}

	function viewclientlist(){
		global $Admin_Lang;
		
		$classname = $this->Load_Model("access");
		$AccessControl = new $classname();
		$AccessControl->handleAccess('client','list');
		
		$classname = $this->Load_Model("user");
		$UserModel = new $classname($Vars);
			
		if($Data["UserList"] = $UserModel->Get_Client_Listing()){
			$ct = sizeof($Data["UserList"]); 
			for($a=0;$a<$ct;$a++){
				$UserModel->userid = $Data["UserList"][$a]['UserID'];
				$Data["UserList"][$a]['ProfilePicSrc'] = $UserModel->renderProfilePicSrc($Data["UserList"][$a]['ProfilePic'],'',3); 
			}
		}
		
		//$Data['CanEdit'] = $AccessControl->Check_Access_Right('user','edit');
		
		$this->Load_View('user/clientlist', $Data);
	}
	
	
	
	function Add(){
		global $Admin_Lang,$CONFIG;
		
		$classname = $this->Load_Model("access");
		$AccessControl = new $classname();
		$AccessControl->handleAccess('user','add');
		
		$classname = $this->Load_Model("user");
		$UserModel = new $classname($Vars);
		
		if(sizeof($_POST)>0){
			
			$classname = $this->Load_Model("file");
			$FileModel = new $classname();
			
			$error = false;
			
			$UserModel->username = filter::required_param('username',PARAM_TEXT);
			$UserModel->useremail = filter::required_param('email',PARAM_EMAIL);
			$UserModel->password = filter::required_param('password',PARAM_TEXT);
			$UserModel->password2 = filter::required_param('password2',PARAM_TEXT);
			$UserModel->roleid = filter::required_param('roleid',PARAM_INT);
			$UserModel->firstname = filter::required_param('firstname',PARAM_TEXT);
			
			if(setting::useMName()){
				$UserModel->middlename = filter::optional_param('middlename','',PARAM_TEXT);
			}
			$UserModel->lastname = filter::required_param('lastname',PARAM_TEXT);
			$UserModel->birthday = filter::optional_param('birthday','',PARAM_DATE);
			$UserModel->phone = filter::optional_param('phone','',PARAM_TEXT);
			$UserModel->note = filter::optional_param('note','',PARAM_TEXT);
			$UserModel->gender = filter::optional_param('gender','',PARAM_INT);
			
			if (preg_match('/[^A-Za-z0-9_]/', $UserModel->username)){
				ui::setGrowl($Admin_Lang['growl']['invalid_username'],'danger');
				$error = true;
				// string contains only english letters & digits
			}
			elseif($UserModel->isUniqueUsername()==false){
				ui::setGrowl($Admin_Lang['growl']['duplicated_user'],'danger');
				$error = true;
			}
			elseif($UserModel->isUniqueEmail()==false){
				ui::setGrowl($Admin_Lang['growl']['invalid_email'],'danger');
				$error = true;
			}elseif($UserModel->isMatchPassword()==false){
				ui::setGrowl($Admin_Lang['growl']['password_notmatch'],'danger');
				$error = true;
			}elseif($UserModel->isPossibleBirthday()==false){
				ui::setGrowl($Admin_Lang['growl']['invalid_birthday'],'danger');
				$error = true;
			}/*elseif($UserModel->isActiveRole()==false){
				MVC_Perform_Action("error", "Raise_Error", NULL, array($Lang['invalidrole']));
			}elseif($UserModel->roleid==ROLE_CLIENT){
				$UserModel->clientid = filter::required_param('clientid',PARAM_INT);
			}*/
			if($error){
				header("location:".$CONFIG['home_http']."user/add");
				die;
			}
			
			if(list($file,$mime) =  $FileModel->doupload('profilepic','profilepic')){
				$UserModel->profilepic = $file;
			}
			list($UserModel->passwordhash,$UserModel->password) = $UserModel->Gen_Password_N_Salt($UserModel->password);
			
			
			if($new_userid = $UserModel->Add_User()){
				//ui::setGrowl($Admin_Lang['growl']['user_added'],'success');
				if($UserModel->profilepic==''){
					ui::setGrowl($Admin_Lang['growl']['user_added'],'success');
					header("location:".$CONFIG['home_http']."user/viewlist/");
				}else{
					ui::setGrowl($Admin_Lang['growl']['user_added_cropnow'],'success');
					header("location:".$CONFIG['home_http']."user/cropprofilepic/?id=".$new_userid);
				}
			}else{
				ui::setGrowl($Admin_Lang['growl']['user_addfailed'],'danger');
				header("location:".$CONFIG['home_http']."user/add");
			}
			die;
			
			
		}else{
		
// 			$Data['form_title'] 		= $Lang['add_user'];
// 			$Data['all_role']			= $UserModel->Get_Role();
// 			$Data['all_employeetype'] 	= array(array(0,$Lang['please_choose']),array(EMPLOYEE_PERM,$Lang['employee_perm']),array(EMPLOYEE_CONTRACT,$Lang['employee_contract']),array(EMPLOYEE_INTERN,$Lang['employee_intern']));
// 			$Data['all_jobtitle'] 		= array_merge(array(array(0,$Lang['please_choose'])),$UserModel->Get_Position());
// 			$Data['all_jobteam']		= array_merge(array(array(0,$Lang['please_choose'])),$UserModel->Get_Team());
			$Data['userrole'] = $UserModel->Get_Role_Selection();
			//$Data['userrole'] = array_merge(array(array('',$Admin_Lang['pleaseselect'])),$Data['userrole']);
			$Data['userrole'] = display::addSelectOption($Data['userrole']);
			
			$Data['clientlist'] = $UserModel->Get_Client_Selection();
			//$Data['clientlist'] = array_merge(array(array('',$Admin_Lang['pleaseselect'])),$Data['clientlist']);
			$Data['clientlist'] = display::addSelectOption($Data['clientlist']);
			
			//$Data['genderoption'] = array_merge(array(array('',$Admin_Lang['pleaseselect'])),$Admin_Lang['genderoption']);
			$Data['genderoption'] = display::addSelectOption($Admin_Lang['genderoption']);
			
			$this->Load_View('user/add', $Data);
		}
	}
	
	function ajax_addclient(){
		global $Admin_Lang;
		$classname = $this->Load_Model("access");
		$AccessControl = new $classname();
		$AccessControl->handleAccess('client','add');
	
		$classname = $this->Load_Model("user");
		$UserModel = new $classname($Vars);
		$UserModel->firstname = filter::required_param('firstname',PARAM_TEXT);
		//$UserModel->lastname = filter::required_param('lastname',PARAM_TEXT);
		//$UserModel->uniquestring = filter::required_param('uniquestring',PARAM_TEXT);
		$UserModel->roleid = ROLE_CLIENT; 
		
		if($new_userid = $UserModel->Add_Client()){
			//echo json_encode(array('msg'=>$Admin_Lang['growl']['client_added'],'newoption'=>$UserModel->firstname.' '.$UserModel->lastname.' ('.$UserModel->uniquestring.')','newoptionid'=>$new_userid));
			echo json_encode(array('msg'=>$Admin_Lang['growl']['client_added'],'newoption'=>$UserModel->firstname,'newoptionid'=>$new_userid));
		}else{
			echo json_encode(array('msg'=>$Admin_Lang['growl']['client_addfailed']));
		}
	}
	
	function AddClient(){
		global $Admin_Lang,$CONFIG;
	
		$classname = $this->Load_Model("access");
		$AccessControl = new $classname();
		$AccessControl->handleAccess('client','add');
	
		$classname = $this->Load_Model("user");
		$UserModel = new $classname($Vars);
	
		if(sizeof($_POST)>0){
			
			$error = false;
			$UserModel->roleid = ROLE_CLIENT;
			$UserModel->firstname = filter::required_param('firstname',PARAM_TEXT);
				
			if(setting::useMName()){
				$UserModel->middlename = filter::optional_param('middlename','',PARAM_TEXT);
			}
			//$UserModel->lastname = filter::required_param('lastname',PARAM_TEXT);
			//$UserModel->uniquestring = filter::required_param('uniquestring',PARAM_TEXT);
			$UserModel->birthday = filter::optional_param('birthday','',PARAM_DATE);
			$UserModel->phone = filter::optional_param('phone','',PARAM_TEXT);
			$UserModel->note = filter::optional_param('note','',PARAM_TEXT);
			$UserModel->gender = filter::optional_param('gender','',PARAM_INT);
				
			if($UserModel->isPossibleBirthday()==false){
				ui::setGrowl($Admin_Lang['growl']['invalid_birthday'],'danger');
				$error = true;
			}
			if($error){
				header("location:".$CONFIG['home_http']."user/addclient");
				die;
			}
				
			if($new_userid = $UserModel->Add_Client()){
				ui::setGrowl($Admin_Lang['growl']['client_added'],'success');
				header("location:".$CONFIG['home_http']."user/viewclientlist");
			}else{
				ui::setGrowl($Admin_Lang['growl']['client_addfailed'],'danger');
				header("location:".$CONFIG['home_http']."user/addclient");
			}
			die;
				
				
		}else{
	
			// 			$Data['form_title'] 		= $Lang['add_user'];
			// 			$Data['all_role']			= $UserModel->Get_Role();
			// 			$Data['all_employeetype'] 	= array(array(0,$Lang['please_choose']),array(EMPLOYEE_PERM,$Lang['employee_perm']),array(EMPLOYEE_CONTRACT,$Lang['employee_contract']),array(EMPLOYEE_INTERN,$Lang['employee_intern']));
			// 			$Data['all_jobtitle'] 		= array_merge(array(array(0,$Lang['please_choose'])),$UserModel->Get_Position());
			// 			$Data['all_jobteam']		= array_merge(array(array(0,$Lang['please_choose'])),$UserModel->Get_Team());
			$Data['userrole'] = $UserModel->Get_Role_Selection();
			//$Data['userrole'] = array_merge(array(array('',$Admin_Lang['pleaseselect'])),$Data['userrole']);
			$Data['userrole'] = display::addSelectOption($Data['userrole']);
				
			$Data['clientlist'] = $UserModel->Get_Client_Selection();
			//$Data['clientlist'] = array_merge(array(array('',$Admin_Lang['pleaseselect'])),$Data['clientlist']);
			$Data['clientlist'] = display::addSelectOption($Data['clientlist']);
				
			//$Data['genderoption'] = array_merge(array(array('',$Admin_Lang['pleaseselect'])),$Admin_Lang['genderoption']);
			$Data['genderoption'] = display::addSelectOption($Admin_Lang['genderoption']);
				
			$this->Load_View('user/addclient', $Data);
		}
	}
	
	function Edit(){
		global $Admin_Lang,$CONFIG;
		
		$classname = $this->Load_Model("access");
		$AccessControl = new $classname();
		$AccessControl->handleAccess('user','edit');
		
		$classname = $this->Load_Model("user");
		$UserModel = new $classname();
		
		$classname = $this->Load_Model("file");
		$FileModel = new $classname();
		

		$UserModel->userid = filter::required_param('id',PARAM_INT);
		
		if(sizeof($_POST)>0){
			$location = $CONFIG['home_http'].'/user/viewlist';
			$oldprofilepic = filter::optional_param('oldprofilepic','',PARAM_TEXT);
			if(list($file,$mime) = $FileModel->doupload('profilepic','profilepic')){
				$UserModel->profilepic = $file;
				$UserModel->removePhyProfilePic();
				$location = $CONFIG['home_http'].'/user/cropprofilepic/?id='.$UserModel->userid;
			}else{
				if($oldprofilepic==''){
					$UserModel->profilepic = '';
					$UserModel->removePhyProfilePic();
				}else{
					$UserModel->profilepic = $oldprofilepic;
				}
			}
			
			$UserModel->password = filter::optional_param('password','',PARAM_TEXT);
			$UserModel->password2 = filter::optional_param('password2','',PARAM_TEXT);
			$UserModel->roleid = filter::required_param('roleid',PARAM_INT);
			$UserModel->firstname = filter::required_param('firstname',PARAM_TEXT);
			if(setting::useMName()){
				$UserModel->middlename = filter::optional_param('middlename','',PARAM_TEXT);
			}
			$UserModel->useremail = filter::required_param('email',PARAM_EMAIL);
			$UserModel->lastname = filter::required_param('lastname',PARAM_TEXT);
			$UserModel->birthday = filter::optional_param('birthday','',PARAM_DATE);
			$UserModel->phone = filter::optional_param('phone','',PARAM_TEXT);
			$UserModel->note = filter::optional_param('note','',PARAM_TEXT);
			$UserModel->gender = filter::optional_param('gender','',PARAM_INT);
			
			if($UserModel->isPossibleBirthday()==false){
				MVC_Perform_Action("error", "Raise_Error", NULL, array($Lang['invalidbirthday']));
			}elseif($UserModel->isActiveRole()==false){
				MVC_Perform_Action("error", "Raise_Error", NULL, array($Lang['invalidrole']));
			}elseif($UserModel->roleid==ROLE_CLIENT){
				$UserModel->clientid = filter::required_param('clientid',PARAM_INT);
			}
			
			//unset clientid if role is not client
			if($UserModel->roleid!=ROLE_CLIENT){
				$UserModel->clientid = 0;
			}
			
			if($UserModel->password!=''){
				if($UserModel->isMatchPassword()==false){
					MVC_Perform_Action("error", "Raise_Error", NULL, array($Lang['passwordnotmatch']));
				}
				list($UserModel->passwordhash,$UserModel->password) = $UserModel->Gen_Password_N_Salt($UserModel->password);
			}
			$new_userid = $UserModel->Update_User();
			ui::setGrowl($Admin_Lang['growl']['user_updated'],'success');
			header("location:".$location);
			die;
		}else{
			
			$Data['user'] = $UserModel->Get_User_Data();
			$Data['userrole'] = $UserModel->Get_Role_Selection();
			$Data['userrole'] = display::addSelectOption($Data['userrole']);
			
			$Data['clientlist'] = $UserModel->Get_Client_Selection();
			$Data['clientlist'] = display::addSelectOption($Data['clientlist']);

			$Data['genderoption'] = display::addSelectOption($Admin_Lang['genderoption']);
			$Data['profilepicsrc'] = $UserModel->renderProfilePicSrc($Data['user']['ProfilePic'],'',3);
				
			$this->Load_View('user/edit', $Data);
			die;
		}
	}	
	
	function EditClient(){
		global $Admin_Lang,$CONFIG;
	
		$classname = $this->Load_Model("access");
		$AccessControl = new $classname();
		$AccessControl->handleAccess('client','edit');
	
		$classname = $this->Load_Model("user");
		$UserModel = new $classname();
	
		$classname = $this->Load_Model("file");
		$FileModel = new $classname();
	
	
		$UserModel->userid = filter::required_param('id',PARAM_INT);
	
		if(sizeof($_POST)>0){
				
			$location = $CONFIG['home_http'].'user/viewclientlist';

			$UserModel->firstname = filter::required_param('firstname',PARAM_TEXT);
			if(setting::useMName()){
				$UserModel->middlename = filter::optional_param('middlename','',PARAM_TEXT);
			}
			//$UserModel->lastname = filter::required_param('lastname',PARAM_TEXT);
			$UserModel->birthday = filter::optional_param('birthday','',PARAM_DATE);
			$UserModel->phone = filter::optional_param('phone','',PARAM_TEXT);
			$UserModel->note = filter::optional_param('note','',PARAM_TEXT);
			//$UserModel->uniquestring = filter::optional_param('uniquestring','',PARAM_TEXT);
			$UserModel->gender = filter::optional_param('gender','',PARAM_INT);
				
			if($UserModel->isPossibleBirthday()==false){
				MVC_Perform_Action("error", "Raise_Error", NULL, array($Lang['invalidbirthday']));
			}
			
			$new_userid = $UserModel->Update_Client();
			ui::setGrowl($Admin_Lang['growl']['client_updated'],'success');
			header("location:".$location);
			die;
		}else{
			$Data['user'] = $UserModel->Get_User_Data();
			$Data['userrole'] = $UserModel->Get_Role_Selection();
			$Data['genderoption'] = display::addSelectOption($Admin_Lang['genderoption']);
			
	
			$this->Load_View('user/editclient', $Data);
			die;
		}
	}
		
	
	function profile(){
		global $Admin_Lang,$CONFIG;
		
		$classname = $this->Load_Model("access");
		$AccessControl = new $classname();
		$AccessControl->handleAccess('user','edit');
			
		$classname = $this->Load_Model("user");
		$UserModel = new $classname($Vars);
		
		if(sizeof($_POST)>0){
			$redirect = $CONFIG['home_http']."user/profile/";
			
			$currpassword = filter::required_param('passwordc',PARAM_TEXT);
			
			if($UserModel->Validate_Login($_SESSION['user_name'],$currpassword)==false){
				ui::setGrowl($Admin_Lang['growl']['currentpassword_notmatch'],'danger');
				header("location:".$redirect);
				die;
			}
			$UserModel->password = filter::required_param('password1',PARAM_TEXT);
			$UserModel->password2 = filter::required_param('password2',PARAM_TEXT);
			
			if($UserModel->isMatchPassword()==false){
				ui::setGrowl($Admin_Lang['growl']['password_notmatch'],'danger');
				header("location:".$redirect);
				die;
			}else{
				list($UserModel->passwordhash,$UserModel->password) = $UserModel->Gen_Password_N_Salt($UserModel->password);
				if($UserModel->Update_Userpassword()){
					ui::setGrowl($Admin_Lang['growl']['user_passwordupdated'],'success');
					header("location:".$location);
					die;
				}else{
					ui::setGrowl($Admin_Lang['growl']['user_passwordupdatfailed'],'danger');
					header("location:".$redirect);
					die;
				}
			}
			
		}
		$this->Load_View('user/editprofile', $Data);
	}
	
	function Username_Checker(){
		
		$username = $_REQUEST["UserName"];
		if ($username == 'user1' || $username == 'user2') {
			echo json_encode(array('status' => 'OK', 'message' => 'Username <b>' . $username . '</b> is available. You can just pick it up!'));
		} else {
			echo json_encode(array('status' => 'ERROR', 'message' => 'Username <b>' . $username . '</b> is not available. Please choose another one.'));
		}
		
	}
	
	function Useremail_Checker(){
	
		global $Lang,$CONFIG;
		
		$useremail = $_REQUEST["UserEmail"];
		
			
		$classname = $this->Load_Model("user");
		$UserModel = new $classname();
		
		
		
		list($result,$msg) = $UserModel->Is_Email_Ava($useremail);
		
		echo json_encode(array('status' => $result, 'message' => $msg));
	}
	
	function UserRole_List(){
		global $Lang;
		
		$classname = $this->Load_Model("user");
		$UserModel = new $classname();
		
		
		$AccessControl = new AccessControlModel();
		$acc_obj = $AccessControl->handleAccess();
		$Data["function"] = $acc_obj;
		
			
		$Data["RoleList"] = $UserModel->Get_Userrole_Listing();
		$Data['Column'] = array($Lang['role'],$Lang['description'],$Lang['status'],$Lang['created_time'],$Lang['last_modified'],$Lang['modified_by']);
		
		$this->Load_View('role/list', $Data);
	}
	
	
	
	function Position_List(){
		global $Lang;
	
		$classname = $this->Load_Model("user");
		$UserModel = new $classname();
	
		
		$Data["PositionList"] = $UserModel->Get_Position_Listing();
		$Data['Column'] = array($Lang['position_name'],$Lang['position_description'],$Lang['status'],$Lang['created_time'],$Lang['last_modified'],$Lang['modified_by']);
		
		$this->Load_View('user/positionlist', $Data);
	}
	
	function Change_Color(){
		global $Lang;
		
		$classname = $this->Load_Model("user");
		$UserModel = new $classname();
		
		$UserModel->UserID = $_SESSION['user_id'];
		
		if($UserModel->Update_User_Setting(array(array('ThemeColor',$_REQUEST['color'])))){
			$_SESSION['theme_color'] = $_REQUEST['color'];
		}
	}
	
	function login(){
		global $Lang,$CONFIG;
		
		$classname = $this->Load_Model("user");
		$UserModel = new $classname();
		
//		$_SESSION['loginredirect'] = str_replace('favicon.ico','',$_SESSION['loginredirect']);//strange behaviour...in chrome
		
		# do login auth
		if(sizeof($_POST)>0){
			
			$forgotemail = filter::optional_param('forgotemail','',PARAM_TEXT);
			
			if($forgotemail!=''){
				print_R($_POST);
				die;
			}
			$login_obj = $UserModel->Validate_Login($_POST['username'],$_POST['password']);
			
			if($login_obj>0){
				
				$UserModel->setUserID($login_obj['UserID']);
				$log_arr['user_id'] = $login_obj['UserID'];
				$log_arr['status'] 	= 1;
				
				$UserModel->Register_Login_Session($login_obj);

				/*include_once("application/model/access.php");
				
				$AccessControl = new AccessControlModel();
				$acc_obj = $AccessControl->handleAccess();

				$UserModel->Register_Right_Session($acc_obj);*/
				
				if($_SESSION['loginredirect']!=''){
					$redirect = $_SESSION['loginredirect'];
					unset($_SESSION['loginredirect']);
				}
				else
					$redirect = $CONFIG['home_http'];//."myfeed";
					
			}else{
				$log_arr['user_id'] = '0';
				$log_arr['status'] 	= 0;
				
				$redirect = $CONFIG['home_http']."login";
			}
			
			$log_id = $UserModel->Record_Login_Log($log_arr);
			
			if($_SESSION['redirect']!=''){
				$redirect = $_SESSION['redirect'];
				$_SESSION['redirect'] = '';
			} 
			header("location:".$redirect);
			die;
			
		}else{ # load login form
			$this->Load_View('page/login', $Data);
		}
	}
	
	function dashboard(){
		global $Admin_Lang,$CONFIG;
		
		$classname = $this->Load_Model("access");
		$AccessControl = new $classname();
		$AccessControl->handleAccess('user','edit');
		
		
		// task
		$classname = $this->Load_Model("task");
		$TaskModel = new $classname();
		$classname = $this->Load_Model("access");
		$AccessControl = new $classname();
		$AccessControl->handleAccess('task','mytask');

		$Data['widget'] = array('calendar','task');
		
		$this->Load_View('user/dashboard', $Data);	
	}
	
	function logout(){
		global $CONFIG;
		session_destroy();
		header("location:".$CONFIG['home_http']);
		die;
	}
	
	
	
	function Reminder_Read(){
		if($_POST['id']!=''){
			
			global $Lang;
			$classname = $this->Load_Model("user");
			$UserModel = new $classname();
			
			
			if($UserModel->User_Reminder_Read($_POST['id']))
				echo json_encode(array('status' => 'OK', 'message' => $Lang['stop_reminder_ok']));
		}
	}
	
	
	
	function Userrole_Add(){
		global $Lang;
		
		$classname = $this->Load_Model("user");
		$UserModel = new $classname();
		
		
		if(sizeof($_POST)>0){
			if($_POST['Name']!=''){
				$role_name = htmlspecialchars($_POST['Name']);
				$desc = htmlspecialchars($_POST['Description']);
				if($UserModel->Add_Role($role_name,$desc)){
					$action_title = UIElementController::In_To_String("action_success").GEN_NOTIFICATION_SYS($Lang['role_added'],array($role_name));
					$msg = ' ';
				}else{
					$action_title = UIElementController::In_To_String("action_fail").$Lang['role_add_failed'];
					$msg = ' ';
				}
				$_SESSION['action_title'] = $action_title;
				$_SESSION['action_msg'] = $msg;
				header("location:?ctr=user_userrole_list");
				die;
			}else{
				MVC_Perform_Action("error", "Raise_Error", NULL, array($Lang['field_missing']));
			}
		
		}else{
			
				
			$AccessControl = new AccessControlModel();
			$acc_obj = $AccessControl->handleAccess();
			$Data["function"] = $acc_obj;
			
			
		
		}
		
		$this->Load_View('role/add', $Data);
	}
	
	function Get_Actionlog_Translation($date_time,$type,$ID,$is_self){
		global $Lang;
		
		$classname = $this->Load_Model("user");
		$UserModel = new $classname();
		
		
		
		switch($type){
			case ACTION_LOG_CLOUD_UPLOAD_PRIVATE:
				
				$this->Load_Model("cloud");
				$CloudModel = new CloudModel();
				$file_obj = $CloudModel->Get_Cloud_File(array(array('f.FileID',$ID)),'',1);
				
				if($is_self)
					$var_arr[] = $Lang['you'];
				$var_arr[] = $file_obj[0]['FileName'];
				
				$title = Gen_Notification_Sys('<i class="icon-upload"></i> '.$Lang['timeline']['user_upload_mycloud_file'],$var_arr);
				$icon = 'icon-cloud';
				$color = 'blue';
				break;
				
			case ACTION_LOG_CLOUD_UPLOAD_PUBLIC:
				
				$this->Load_Model("cloud");
				$CloudModel = new CloudModel();
				$file_obj = $CloudModel->Get_Cloud_File(array(array('f.FileID',$ID)),'',1);
				
				if($is_self)
					$var_arr[] = $Lang['you'];
				$var_arr[] = $file_obj[0]['FileName'];
				
				$title = Gen_Notification_Sys('<i class="icon-upload"></i> '.$Lang['timeline']['user_upload_thecloud_file'],$var_arr);
				$color = 'blue';
				$icon = 'icon-cloud';
				break;
					
			case ACTION_LOG_CLOUD_DELETE_PRIVATE_FILE:
				
				$this->Load_Model("cloud");
				$CloudModel = new CloudModel();
				$file_obj = $CloudModel->Get_Cloud_File(array(array('f.FileID',$ID)),'',1);
				
				if($is_self)
					$var_arr[] = $Lang['you'];
				$var_arr[] = $file_obj[0]['FileName'];
				if($is_self)
					$var_arr[] = $Lang['your'];
				
				$title = Gen_Notification_Sys('<i class="icon-trash"></i> '.$Lang['timeline']['user_delete_mycloud_file'],$var_arr);
				
				$color = 'blue';
				$icon = 'icon-cloud';
				break;
					
			case ACTION_LOG_CLOUD_DELETE_PUBLIC_FILE:
				
				$this->Load_Model("cloud");
				$CloudModel = new CloudModel();
				$file_obj = $CloudModel->Get_Cloud_File(array(array('f.FileID',$ID)),'',1);
				
				if($is_self)
					$var_arr[] = $Lang['you'];
				$var_arr[] = $file_obj[0]['FileName'];
				
				
				$title = Gen_Notification_Sys('<i class="icon-trash"></i> '.$Lang['timeline']['user_delete_thecloud_file'],$var_arr);
				
				$color = 'blue';
				$icon = 'icon-cloud';
				break;

			case ACTION_LOG_USER_LOGIN:
				
				if($is_self)
					$var_arr[] = $Lang['you'];
				
				$title = Gen_Notification_Sys('<i class="icon-signin"></i> '.$Lang['successfully_logged_in'],$var_arr);
				
				$color = 'green';
				$icon = 'icon-user';
			break;
			
			case ACTION_LOG_USER_UPDATE:
				$edited_user = $UserModel->Get_User_Name($ID);
				
				if($is_self)
					$var_arr[] = $Lang['you'];
				$var_arr[] = $edited_user['UserName'];
				
				$title 		= Gen_Notification_Sys('<i class="icon-edit"></i>'.$Lang['timeline']['user_edited_user_profile'],$var_arr);
				$color 		= 'green';
				$icon 		= 'icon-user';
			break;	
		}
		list($date,$time) = explode(" ",$date_time);
		$time = substr($time,0,5);
		return array('color'=>$color,'title'=>$title,'icon'=>$icon,'date'=>$date,'time'=>$time,'desc'=>$desc);
	}
	
	function mytimeline(){
		global $Lang;
		
		$this->Load_Model("user");
		$UserModel = new UserModel();
		//
		
		$AccessControl = new AccessControlModel();
		$acc_obj = $AccessControl->handleAccess();
		$Data["function"] = $acc_obj;
		
		$timeline_obj = $UserModel->Get_My_ActionLog();
		$timeline_size = sizeof($timeline_obj);
		$Data['timeline_arr'] = array();
		
		for($a=0;$a<$timeline_size;$a++){
			$Data['timeline_arr'][$a] = $this->Get_Actionlog_Translation($timeline_obj[$a]['Timeinput'],$timeline_obj[$a]['Type'],$timeline_obj[$a]['ID'],1);
		}
		
		$this->Load_View('user/timeline', $Data);
	}
	
	function Toggle_Sidebar(){
		$sidebar_status = $_REQUEST['expand']=='true'?1:0;
		
		$this->Load_Model("user");
		$UserModel = new UserModel();
		
		$UserModel->Update_User_SidebarStatus($sidebar_status);
	}
	
	function activate(){
		global $Admin_Lang,$CONFIG;
		
		$classname = $this->Load_Model("access");
		$AccessControl = new $classname();
		$AccessControl->handleAccess('user','edit');
		
		$classname = $this->Load_Model("user");
		$UserModel = new $classname();
		$user = filter::required_param_array('UserID',PARAM_INT);
		foreach($user as $key=>$val){
			$UserModel->userid = $val;
			$UserModel->Activate_User();
		}
		ui::setGrowl($Admin_Lang['growl']['user_activated'],'success');
		header("location:".$CONFIG['home_http']."user/viewlist");
	}
	
	function deactivate(){
		global $Admin_Lang,$CONFIG;
		
		$classname = $this->Load_Model("access");
		$AccessControl = new $classname();
		$AccessControl->handleAccess('user','edit');
		
		$classname = $this->Load_Model("user");
		$UserModel = new $classname();
		$user = filter::required_param_array('UserID',PARAM_INT);
		foreach($user as $key=>$val){
			$UserModel->userid = $val;
			$UserModel->Deactivated_User();
		}
		ui::setGrowl($Admin_Lang['growl']['user_deactivated'],'success');
		header("location:".$CONFIG['home_http']."user/viewlist");
	}
	
	function remove(){
		global $Admin_Lang,$CONFIG;
		
		$classname = $this->Load_Model("access");
		$AccessControl = new $classname();
		$AccessControl->handleAccess('user','edit');
		
		$classname = $this->Load_Model("user");
		$UserModel = new $classname();
		$user = filter::required_param_array('UserID',PARAM_INT);
		foreach($user as $key=>$val){
			$UserModel->userid = $val;
			$UserModel->Remove_User();
		}
		ui::setGrowl($Admin_Lang['growl']['user_removed'],'success');
		header("location:".$CONFIG['home_http']."user/viewlist");
	}
	
	function cropprofilepic(){
		global $Admin_Lang,$CONFIG;
		
		$classname = $this->Load_Model("user");
		$UserModel = new $classname();
		
		
		$Data['profilepicsrc'] = $UserModel->renderProfilePicSrc();
		$this->Load_View('user/cropprofilepic', $Data);
		
	}
	
	function setting(){
		global $Lang,$CONFIG;
		
		
		$userclass = $this->Load_Model("user");
		$user = new $userclass();
		
		
		$Data['places'] = $user->getPlaces();
		$Data['places'] = toGroupOption($Data['places'],'State');
		$Data['artist_type'] = $user->getPublicArtistType();
		$Data['debutyear_option'] = $user->getDebutyearOption();
		
		
		$this->Load_View('user/setting', $Data);
	}
}
?>