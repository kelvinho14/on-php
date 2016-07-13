<?php

/*define("USER_DELETED",-1);
define("USER_ACTIVE",1);
define("USER_DEACTIVE",0);

define("MALE_GENDER",1);
define("FEMALE_GENDER",2);

define("ROLE_ACTIVE",1);

define("STATUS_CLIENTACTIVE",1);

define("ROLE_SUPERADMIN",1);
define("ROLE_CLIENT",4);
define("ROLE_SUPERUSER",3);*/
/*define("ROLE_ADMIN",2);

*/

define("SIDEBAR_EXPAND",1);
define("SIDEBAR_COLLAPSE",0);

class UserModel extends database {

	const isactive = 1;
	const isdeactive = 0;
	const isdeleted = -1;
	
	const isfriend = 1;
	const ispendingfriend = 0;
	const isrejectedfriend = -2;
	const isunfriend = -1;
	
	const male = 1;
	const female = 2;
	
	const role_superadmin = 1;
	const role_admin = 2;
	const role_superuser = 3;
	const role_artist = 4;
	const role_fans = 5;
	
	/*const singer = 1;
	const idol = 2;
	const band = 3;
	const artist = 4;
	const organization = 5;*/
	
	private $UserName = '';
	private $ProfilePic = '';
	private $UserID = '';
	private $TypeID = '';
	private $ArtistType = array(1=>'singer',2=>'idol',3=>'band',4=>'artist',5=>'organization');
	
	
	function active(){
		return self::isactive;
	}
	static function deactived(){
		return self::isdeactive;
	}
	static function isFriend(){
		return self::isfriend;
	}
	static function isPendingFriend(){
		return self::ispendingfriend;
	}
	static function isRejectedFriend(){
		return self::isrejectedfriend;
	}
	static function isUnFriend(){
		return self::isunfriend;
	}
	
	static function deleted(){
		return self::isdeleted;
	}
	
	static function isActive(){
		return $this->Status==self::isactive;
	}
	static function isdeactive(){
		return $this->Status==self::isdeactive;
	}
	static function isdeleted(){
		return $this->Status==self::isdeleted;
	}
	
	static function ismale(){
		return $this->Gender==self::male;
	}
	static function female(){
		return $this->Gender==self::female;
	}
	
	function setUser(){
		if($this->UserID()!=''){
			if($user = $this->Get_User_Data()){
				$this->setUserName($user['UserName']);
				$this->setUserProfilepic($user['ProfilePic']);
			}	
		}
	}
	function setUserName($username){
		$this->UserName = $username;
	}
	function setUserProfilepic($pic){
		$this->ProfilePic = $pic;
	}
	function setUserID($userid){
		$this->UserID = $userid;
	}
	function setTypeID($typeid){
		$this->TypeID = $typeid;
	}
	function UserName(){
		return $this->UserName;
	}
	function ProfilePic(){
		return $this->ProfilePic;
	}
	function UserID(){
		return $this->UserID;
	}
	function TypeID(){
		return $this->TypeID;
	}
	function __construct($user_id='')
	{
		global $CONFIG;
		
		$this->table = dbfield::getTables();
	}
	
	function getUserFromUsername(){
		global $DB;
		$sql = "SELECT 
					UserName, ".dbfield::getFieldByLang('','','Bio').", UserID,Firstname,Middlename,Lastname,ProfilePic,UserEmail,TypeID,FriendsTotal,FansTotal,Level,DebutDate,Gender,Birthday
				FROM				
					".$this->table['user']." as u
				WHERE 
					UserName = ?		
			";
		
		return $DB->returnVec($sql,array($this->UserName()));
	}
	
	function getUserFromID(){
		global $DB;
		$sql = "SELECT
					UserName, ".dbfield::getFieldByLang('','','Bio').",UserID,Firstname,Middlename,Lastname,ProfilePic,UserEmail,TypeID,FriendsTotal,FansTotal,Level,DebutDate,Gender,Birthday
				FROM
					".$this->table['user']." as u
				WHERE
					UserID = ?
			";
	
		return $DB->returnVec($sql,array($this->UserID()));
	}
			
	function updatePermission($access=array()){
		//if(sizeof($access)>0 && $this->roleid>0){
		if($this->roleid>0){
			global $CONFIG;
		
			$file = $CONFIG['accessfile_path'];
			$permission = $this->getPermission();
		
// 			print_R($this->roleid);
// 			print_R($permission);
// 			print_R($access);
			foreach($permission as $module=>$val){
				foreach($val as $method=>$val2){
					// add
					if($access[$module][$method]==true && !in_array($this->roleid,$val2)){
						$permission[$module][$method][] = $this->roleid;
					}elseif(in_array($this->roleid,$val2) && $access[$module][$method]==false){ // remove
						foreach($val2 as $i=>$val3){
							if($val3==$this->roleid){
								unset($permission[$module][$method][$i]);
								//array_splice($permission[$module][$method],$i,0);
								
							}		
						}
						
					}
				}			
			}
		
			foreach($access as $module=>$val){
				foreach($val as $method=>$val2){
					if(!in_array($this->roleid,$permission[$module][$method])){
						$permission[$module][$method][] = $this->roleid;	
					}
				}
			}
			$fp = fopen($file, 'w');
			fwrite($fp, json_encode($permission));
			fclose($fp);
		}
	}
	static function getPermission(){
		global $CONFIG;
		$file = $CONFIG['accessfile_path'];
		if(is_file($file)==false){
			die('access file missing');
		}
		
		
		$handle = fopen($file, "r");
		$contents = fread($handle, filesize($file));
		fclose($handle);
		$access = json_decode($contents,true);

		/*$access['user'] = array('list'=>array(ROLE_ADMIN,ROLE_SUPERUSER),'add'=>array(ROLE_ADMIN,ROLE_SUPERUSER),'edit'=>array(ROLE_ADMIN,ROLE_SUPERUSER),'dashboard'=>array(0,ROLE_ADMIN,ROLE_SUPERUSER));
		$access['report'] = array('calendar'=>array(ROLE_ADMIN,ROLE_SUPERUSER));
		$access['setting'] = array('user'=>array(0));*/
		
		return $access;
	}
	
	function Insert_Action_Log($type,$id){
		global $DB;
		$sql = "INSERT INTO 
					".$this->table['action_log']."
				SET
					UserID 		= ?,
					Type		= ?,
					ID			= ?,
					TimeInput 	= now()";
		$data_arr = array($_SESSION['user_id'],$type,$id);
		$DB->db_db_query($sql,$data_arr);
	}
	
	function Get_User_Listing($cond=array(),$show_delete=false) {
		global $DB;
		$sql = 'SELECT 
					u.*, '.dbfield::getUsername('u','Realname').', if(c.Name is null,r.Name,concat(r.Name," (",c.Name,")")) as RoleName, u2.UserName as Modifier
				FROM 
					'.$this->table['user'].' as u 
				INNER JOIN
					'.$this->table['userrole'].' as r
				ON
					u.RoleID = r.RoleID
				INNER JOIN
					'.$this->table['user'].' as u2
				ON
					u2.UserID = u.ModifiedBy		
				LEFT JOIN
					'.$this->table['client'].' as c
				ON
					c.ID = u.ClientID
				WHERE 1 
					AND
						r.RoleID not in (?,?)';
		$para[] = self::role_superadmin();
		$para[] = self::role_client();
		if($show_delete==false){
			$sql.=' AND u.Status != ?';
			$para[] = self::deleted();
		}
		return $DB->returnRes($sql,$para);
	}
	
	/*function Get_Client_Listing($cond=array(),$show_delete=false) {
		global $DB;
		$sql = 'SELECT
					u.*, '.dbfield::getUsername('u','Realname').', u2.UserName as Modifier
				FROM
					'.$this->table['user'].' as u
				INNER JOIN
					'.$this->table['userrole'].' as r
				ON
					u.RoleID = r.RoleID
				INNER JOIN
					'.$this->table['user'].' as u2
				ON
					u2.UserID = u.ModifiedBy
				WHERE 1
					AND
						r.RoleID=?';
		$para[] = self::role_client();
		if($show_delete==false){
			$sql.=' AND u.Status != ?';
			$para[] = self::deleted();
		}
		return $DB->returnRes($sql,$para);
	}
	
	function Get_Role_Selection($staffonly=true){
		global $DB;
		$para[] = self::role_active();
		
		$cond = ' AND RoleID != ?';
		$para[] = self::role_superadmin();
		
		if($staffonly){
			$cond .= ' AND RoleID != ?';
			$para[] = self::role_client();
		}
		
		if($this->canSeeAll()==false){
			list($c,$arr) = dbfield::in($this->canseeroleid,'RoleID in ');
			$cond.=$c;
			$para = array_merge($para,$arr);
		}
		
		$sql = 'SELECT
					*
				FROM
					'.$this->table['userrole'].'
				WHERE
					Status = ?
					'.$cond.'
				ORDER BY
					Name';
		
		return $DB->returnRes($sql,$para);
	}
	
	function Get_Client_Selection(){
		global $DB;
		return $this->getActiveClients('UserID,'.dbfield::getUsername('','Username'));
	}*/
	
	function isUniqueEmail(){
		global $DB;
		$sql = 'SELECT count(*) FROM '.$this->table['user'].' WHERE Usermail=?';
		if($res = $DB->returnVec($sql,array($this->useremail)))
			return false;
		else 
			return true;
	}
	
	function isMatchPassword(){
		return $this->password===$this->password2;
	}
	
	function isSA(){
		return $_SESSION ['role_id'] == self::role_superadmin;
	}
	
	function isAdmin(){
		return $_SESSION ['role_id'] == self::role_admin;
	}
	
	function isSuperuser(){
		return $_SESSION ['role_id'] == self::role_superuser;
	}
	
	static function isArtist($user_id=''){
		return $_SESSION ['role_id'] == self::role_artist;
	}
	
	function isViewArtist(){
		if($user = $this->Get_User_Data()){
			return $user['RoleID'] == self::role_artist;
		}
	}
	
	function isFans(){
		return $_SESSION ['role_id'] == self::role_fans;
	}
	
	static function canComment(){
		return self::isFans()||self::isArtist();
	}
	
	static function canLike(){
		return self::isFans()||self::isArtist();
	}
	
	function isUniqueUsername(){
		global $DB;
		$sql = 'SELECT UserID FROM '.$this->table['user'].' WHERE UserName=?';
		if($res = $DB->returnVec($sql,array($this->username)))
			return false;
		else
			return true;
	}
	
	function isActiveRole(){
		global $DB;
		$sql = 'SELECT RoleID FROM '.$this->table['userrole'].' WHERE RoleID = ? AND Status = ?';
		if($res = $DB->returnVec($sql,array($this->roleid,self::role_active())))
			return true;
		else
			return false;
	}
	
	function isPossibleBirthday(){
		return strtotime($this->bday)<time();
	}
	
	/*function Get_Userrole_Listing() {
		global $DB;

		$sql = 'SELECT
					r.RoleID,u.UserID,u.UserName,r.Status,r.Timeinput,r.Timemodified,r.Name as Role,r.Description
				FROM
					'.$this->table['userrole'].' as r
				INNER JOIN
					'.$this->table['user'].' as u
				ON
					u.UserID = r.ModifiedBy
				WHERE
					u.Status != ?';
		return $DB->returnRes($sql,array(USER_ROLE_DELETED));
	
	}*/
	
	/*function Get_Position_Listing() {

		$sql = 'SELECT
					u.UserID,u.UserName,t.Status,t.Timeinput,t.Timemodified,t.Name as Position,t.Description,t.PositionID
				FROM
					'.$this->db_prefix.'POSITION as t
				INNER JOIN
					'.$this->db_prefix.'USER as u
				ON
					u.UserID = t.ModifiedBy
				WHERE
					t.Status != ?';
		return	$DB->returnRes($sql,array(POSITION_DELETED));
	
	}
	
	function Get_Position() {
	
		$sql = 'SELECT
					PositionID,Name,Status,Timeinput,Timemodified,Description
				FROM
					'.$this->db_prefix.'POSITION
				WHERE
					Status = ?';
		
		return $DB->returnRes($sql,array(POSITION_ACTIVE));
	
	}
	
	function Get_Team() {
	
		$sql = 'SELECT
					TeamID,Name,Status,Timeinput,Timemodified,Description
				FROM
					'.$this->db_prefix.'TEAM
				WHERE
					Status = ?';
	
		return $DB->returnRes($sql,array(TEAM_ACTIVE));
	
	}
	
	
	function Get_Team_Listing() {

		$sql = 'SELECT
					u.UserID,u.UserName,t.Status,t.Timeinput,t.Timemodified,t.Name as Team,t.Description,t.TeamID
				FROM
					'.$this->db_prefix.'TEAM as t
				INNER JOIN
					'.$this->db_prefix.'USER as u
				ON
					u.UserID = t.ModifiedBy
				WHERE
					t.Status != ?';
		return	$DB->returnRes($sql,array(TEAM_DELETED));
	
	}
	
	
	static function Get_User_Custom_Language($ReplaceLangVars=true) {
		global $Lang;		
		//include_once('include/lang/'.$_SESSION['language'].'.php');
		
	}*/
	
	function Is_Correct_Password($input,$password,$hash){
		return ($password==$this->Encrypt_Password($input,$hash));
	}
	
	function Gen_Password_N_Salt($password){
	
		$rand_str = Gen_Rand_Str(256);
		$salt = hash("sha256",$rand_str);
		return array($salt,$this->Encrypt_Password($password,$salt));
	}
	
	function Encrypt_Password($password,$hash){
		$salted_password = $hash.$password;
		return hash("sha256", $salted_password);
	}
	
	function Get_User_Data()
	{
		global $DB;
		$sql = "SELECT 
					u.*
				FROM
					".$this->table['user']." as u
				WHERE 1 ";
		
		$cond = '';
		if($this->UserID()!=''){
			$cond.= " AND u.UserID = ?";
			$data[] = $this->UserID();
		}
		if($this->password!=''){
			$cond.= " AND u.Password = ?";
			$data[] = $this->password;
		}
		if($this->useremail!=''){
			$cond.= " AND u.UserEmail = ?";
			$data[] = $this->useremail;
		}
		if($this->status!=''){
			$cond.= " AND u.Status = ?";
			$data[] = $this->status;
		}
		if($this->username!=''){
			$cond.= " AND u.UserName = ?";
			$data[] = $this->username;
		}
		
		if($cond==''){
			return false;
		}
		
		return $DB->returnVec($sql.$cond,$data);
	}
	
	function getUsersIDWithRole(){
		global $DB;
		$sql = "SELECT
				UserID
			FROM
				".$this->table['user']."
			WHERE Status = ?";
		$data[] = self::active();
		if($this->roleid!=''){
			$sql.= " AND RoleID = ?";
			$data[]=$this->roleid;
		}
		return $DB->returnRes($sql,$data);
	}
	
	function getUsersWithRole(){
		global $DB;
		$sql = "SELECT
				u.*,r.Name as Rolename
			FROM
				".$this->table['user']." as u
			INNER JOIN
				".$this->table['userrole']." as r
			ON
				u.RoleID = r.RoleID
			WHERE u.Status = ?";
		$data[] = self::active();
		if($this->roleid!=''){
			$sql.= " AND r.RoleID = ?";
			$data[]=$this->roleid;
		}
		return $DB->returnRes($sql,$data);
	}
	
	function getMyUserID(){
		return $_SESSION['user_id'];
	}
	
	function getMyRole(){
		return array($_SESSION['role_id'],'Rolename');
	}
	
	function canSeeAll(){
		//return $this->canseeroleid == 999;
		return true;
	}
	
	function getActiveStaffs(){
		global $DB;
		$sql = "SELECT
				u.*
			FROM
				".$this->table['user']." as u
			WHERE Status = ?";
		$para[] = self::active();
		
		return $DB->returnRes($sql,$para);
	}
	
	function getUsers(){
		global $DB;
		$sql = "SELECT
				u.*
			FROM
				".$this->table['user']." as u
			WHERE Status != ?";
		$para[] = self::deleted();
		
		if($this->canSeeAll()==false){
			list($cond,$arr) = dbfield::in($this->canseeroleid,'u.RoleID in ');
			$sql.=$cond;
			$para = array_merge($para,$arr);
		}
		
		return $DB->returnRes($sql,$para);
	}
	
	function getActiveClientsOption(){
		//return $this->getActiveClients('UserID,'.dbfield::getUsername('','ClientName',",' (',UniqueString,')'"));
		return $this->getActiveClients('UserID,'.dbfield::getUsername('','ClientName'));
	}
	
	function getActiveClients($field=''){
		global $DB;
		$field = $field==''?'*':$field;
		$sql = "SELECT
				".$field."
			FROM
				".$this->table['user']."
			WHERE Status = ?
			AND
				RoleID = ?";
		$para[] = self::active();
		$para[] = self::role_client();
		
		
		
		return $DB->returnRes($sql,$para);
	}
	
	
	
	function Get_User_Name($user_id='',$username='',$useremail='',$status=''){
		global $DB;
		$sql = "SELECT 
					UserName 
				FROM
					".$this->table['user']."
					
				WHERE 1 ";
		if($user_id!=''){
			$sql.= " AND UserID = ?";
			$data[] = $user_id;
		}
		if($username!=''){
			$sql.= " AND UserName = ?";
			$data[] = $username;
		}
		if($useremail!=''){
			$sql.= " AND UserEmail = ?";
			$data[] = $useremail;
		}
		if($status!=''){
			$sql.= " AND Status = ?";
			$data[] = $status;
		}
			
		return $DB->returnVec($sql,$data);
	}
	
	function Get_Marital_Status($status){
		global $Lang;
		switch($status){
			case MARITAL_SINGLE:
				$return = $Lang['single'];
			break;
			case MARITAL_MARRIED:
				$return = $Lang['married'];
			break;
			case MARITAL_WIDOWED:
				$return = $Lang['widowed'];
			break;
			case MARITAL_DIVORCED:
				$return = $Lang['divorce'];
			break;
		}
		return $return;
	}
	
	function Get_All_Marital_Status(){
		global $Lang;
		
		return array(array(MARITAL_SINGLE,$Lang['single']),array(MARITAL_MARRIED,$Lang['married']),array(MARITAL_WIDOWED,$Lang['widowed']),array(MARITAL_DIVORCED,$Lang['divorce']));
	}
	
	function Get_All_GENDER(){
		global $Lang;
	
		return array(array(self::male(),$Lang['male']),array(self::female(),$Lang['female']));
	}
	
	
	
	
	function Get_Role($cond=array()){
		global $DB;
		$sql = "SELECT
					RoleID,Name,Description,Access
				FROM
					".$this->table['userrole']."
				WHERE
					Status = ?";
			
		$para[] = USER_ROLE_ACTIVE;
		if(sizeof($cond)>0){
			for($a=0;$a<sizeof($cond);$a++){
				$sql .= " AND ".$cond[$a][0]." = ?";
				$para[] = $cond[$a][1];
			}
		}
		
		return $DB->returnRes($sql,$para);
	}

	/*function Is_Contract_Staff($type){
		return $type==EMPLOYEE_CONTRACT||$type==EMPLOYEE_INTERN;
	}

	function Get_Avatar_Path($userid,$filename){
		$filepath = 'spacex/avatar/'.$userid.'/'.$filename;
		
		if(is_file($filepath))
			return $filepath;
	}
	*/
	function Update_User_Setting($arr){
		global $DB;
		$sql = "UPDATE
					".$this->table['user']."
				SET";
					
		for($a=0;$a<sizeof($arr);$a++){
			$sql.= " ".$arr[$a][0]." = ?,";
			$data_arr[] = $arr[$a][1];
		}			
		
		$sql.="	TimeModified= now()
			WHERE
				UserID = ?";
		$data_arr[] = $_SESSION['user_id'];
		
		return $DB->db_db_query($sql,$data_arr);
	}
	
	function Validate_Login($login,$password){
		$this->status = self::isactive;
		$this->username = $login;
		
		$user_obj = $this->Get_User_Data();
		
		if($this->Is_Correct_Password($password,$user_obj['Password'],$user_obj['PasswordHash'])){
			return $user_obj;
		}else{
			return false;
		}
	}
	
	function Record_Login_Log($arr){
		global $DB;
		$sql = "INSERT INTO 
					".$this->table['login_log']."
				SET
					UserID 		= ?,
					UA			= ?,
					IP			= ?,
					Status		= ?,
					TimeInput 	= now()";
		$data_arr = array($arr['user_id'],$_SESSION['ua'],$_SESSION['current_ip'],$arr['status']);
		$log_id = $DB->db_db_query($sql,$data_arr,1);
		
		$this->Update_User_Setting(array(array('LastIP',$_SESSION['current_ip']),array('LastLogin',date("Y-m-d H:i:s"))));
		
		return $log_id;
	}
	
	function Register_Login_Session($login_obj){
		
		
		$_SESSION['user_id'] 		= $login_obj['UserID'];
		$_SESSION['user_name'] 		= $login_obj['UserName'];
		$_SESSION['user_email'] 	= $login_obj['UserEmail'];
		$_SESSION['client_id'] 		= $login_obj['ClientID'];
		$_SESSION['role_id'] 		= $login_obj['RoleID'];
		$_SESSION['theme_color']	= $login_obj['ThemeColor'];
		$_SESSION['profilepic']     = $login_obj['ProfilePic'];
		if($this->isArtist()){
			$_SESSION['artisttype_id'] = $login_obj['TypeID'];
			$this->setTypeID($login_obj['TypeID']);
			$obj = $this->getArtistType();
			$_SESSION['artisttype'] = $obj['Name'];
		}
		
		/*if($login_obj['RoleID']==self::role_artist){
			if($artistobj=$this->getArtistByUserID($login_obj['UserID'])){ //todo: handle multiple
				$_SESSION['user_name'] = $artistobj['Name'];
				$_SESSION['artist_id'] = $artistobj['ID'];
				$_SESSION['profilepic'] = $artistobj['ProfilePic'];
			}
		}*/
	}
	
	/*function getArtistByUserID($UserID){
		global $DB;
		$sql = "SELECT 
					a.* 
				FROM 
					".$this->table['artist']." as a
				INNER JOIN
					".$this->table['artistuser']." as au
				ON
					a.ID = au.ArtistID
				WHERE
					au.UserID = ?";
		return $DB->returnVec($sql,array($UserID));
	}*/
	
	function Register_Right_Session($acc_obj){
		
		foreach($acc_obj as $key=>$value){
			$_SESSION['access'][$key] = $value;
		}
	}
	
	function Is_Email_Ava($email){
		global $Lang,$DB;
		if(is_valid_email($email)){
			$sql = "SELECT
					1 as used
				FROM
					".$this->table['user']."
				WHERE
					UserEmail = ?";
			$obj = $DB->returnVec($sql,array($email));
			if($obj['used'])
				return array('ERROR',$Lang['email_is_used']);
			else
				return array('OK',$Lang['email_is_ava']);
		}else{
			return array('ERROR',$Lang['invalid_email_format']); 
		}
	}
	
	function Add_Client(){
		global $DB;
		//Lastname 	= ?,
		//UniqueString= ?,
		$sql = "INSERT INTO
					".$this->table['user']."
				SET
					Username	= ?,	
					Firstname 	= ?,
					Middlename 	= ?,
					
					
					RoleID		= ?,
					Gender		= ?,
					Birthday	= ?,
					Phone		= ?,
					Note		= ?,
					ModifiedBy	= ?,
					TimeInput   = now(),
					TimeModified= now()";
		
		$data_arr[] = time();
		$data_arr[] = $this->firstname;
		$data_arr[] = $this->middlename;
		//$data_arr[] = $this->lastname;
		//$data_arr[] = $this->uniquestring;
		$data_arr[] = $this->roleid;
		$data_arr[] = $this->gender;
		$data_arr[] = $this->birthday;
		$data_arr[] = $this->phone;
		$data_arr[] = $this->note;
		$data_arr[] = $_SESSION['user_id'];
		
		$new_userid = $DB->db_db_query($sql,$data_arr,1);
		
		return $new_userid;
	}
	
	function Add_User(){
		global $DB;
		$sql = "INSERT INTO
					".$this->table['user']."
				SET
					UserName 	= ?,
					Firstname 	= ?,
					Middlename 	= ?,
					Lastname 	= ?,
					UserEmail	= ?,
					Password= ?,
					PasswordHash= ?,
					ProfilePic	= ?,
					RoleID		= ?,
					ClientID	= ?,
					Gender		= ?,
					Birthday	= ?,
					Note			= ?,
					Address		= ?,
					Phone   = ?,
					ModifiedBy	= ?,
					TimeInput   = now(),
					TimeModified= now()";
	
		$data_arr[] = $this->username;
		$data_arr[] = $this->firstname;
		$data_arr[] = $this->middlename;
		$data_arr[] = $this->lastname;
		$data_arr[] = $this->useremail;
		$data_arr[] = $this->password;
		$data_arr[] = $this->passwordhash;
		$data_arr[] = $this->profilepic;
		$data_arr[] = $this->roleid;
		$data_arr[] = $this->clientid;
		$data_arr[] = $this->gender;
		$data_arr[] = $this->birthday;
		$data_arr[] = $this->note;
		$data_arr[] = $this->address;
		$data_arr[] = $this->phone;
		$data_arr[] = $_SESSION['user_id'];
	
		$new_userid = $DB->db_db_query($sql,$data_arr,1);
		
		return $new_userid;
	}
	
	function Update_User(){
		global $DB;
		$fields_arr = array('firstname','middlename','lastname','useremail','password','passwordhash','roleid','clientid','gender','birthday','note','address','phone');
		
		foreach($fields_arr as $key=>$val){
			if(trim($this->$val)!=''){
				$fields.= $val." = ?,";
				$para[] = $this->$val;
			}	
		}
		
		$fields.= " profilepic = ?,";
		$para[] = $this->profilepic;
		
		$sql = "UPDATE
					".$this->table['user']."
				SET
					".$fields."
					ModifiedBy = ?,
					TimeInput   = now(),
					TimeModified= now()
				WHERE
					UserID = ?";
		$para[] = $_SESSION['user_id'];
		$para[] = $this->userid;
		
		return $DB->db_db_query($sql,$para);
	}
	
	function Update_Userpassword(){
		global $DB;
		$sql = "UPDATE
					".$this->table['user']."
				SET
					password = ?,
					passwordhash = ?,
					ModifiedBy = ?,
					TimeModified= now()
				WHERE
					UserID = ?";
		
		$para[] = $this->password;
		$para[] = $this->passwordhash;
		$para[] = $_SESSION['user_id'];
		$para[] = $this->userid;
		
		return $DB->db_db_query($sql,$para);
	}
	
	function Update_Client(){
		global $DB;
		//uniquestring
		$fields_arr = array('firstname','middlename','lastname','gender','birthday','note','address','phone');
	
		foreach($fields_arr as $key=>$val){
			if(trim($this->$val)!=''){
				$fields.= $val." = ?,";
				$para[] = $this->$val;
			}
		}
	
		$sql = "UPDATE
					".$this->table['user']."
				SET
					".$fields."
					ModifiedBy = ?,
					TimeInput   = now(),
					TimeModified= now()
				WHERE
					UserID = ?";
		$para[] = $_SESSION['user_id'];
		$para[] = $this->userid;
	
		return $DB->db_db_query($sql,$para);
	}
	
	function getUserName($id){
		global $DB;
		$sql = 'SELECT
					u.UserID, '.dbfield::getUsername('u','Realname').'
				FROM
					'.$this->table['user'].' as u
				WHERE u.UserID = ?';
		
		$para[] = $id;
		return $DB->returnVec($sql,$para);
		
	}
	
	function Activate_User(){
		global $DB;
		$sql = "UPDATE ".$this->table['user']." SET Status = ? , TimeModified = now() , ModifiedBy = ? WHERE UserID = ? ";
		$para[] = self::active();
		$para[] = $_SESSION['user_id'];
		$para[] = $this->userid;
		return $DB->db_db_query($sql,$para);
	}
	
	function Deactivated_User(){
		global $DB;
		$sql = "UPDATE ".$this->table['user']." SET Status = ? , TimeModified = now() , ModifiedBy = ? WHERE UserID = ? ";
		$para[] = self::deactive();
		$para[] = $_SESSION['user_id'];
		$para[] = $this->userid;
		return $DB->db_db_query($sql,$para);
	}
	
	function Remove_User(){
		global $DB;
		$sql = "UPDATE ".$this->table['user']." SET Status = ? , TimeModified = now() , ModifiedBy = ? WHERE UserID = ? ";
		$para[] = self::deleted();
		$para[] = $_SESSION['user_id'];
		$para[] = $this->userid;
		return $DB->db_db_query($sql,$para);
	}
	
	function Get_Notification($type){
		global $DB;
		$sql = 'SELECT
					NoteID, Value
				FROM
					'.$this->table['user_notification'].'
				WHERE
					Seen = ?
				AND
					Target = ?
				AND
					Type = ?';
		$para[] = 0;
		$para[] = $_SESSION['user_id'];
		$para[] = $type;
		
		return $DB->returnRes($sql,$para);
	}
	
	function User_Reminder_Read($notice_id){
		global $DB;
		$sql = "UPDATE
					".$this->table['user_notification']."
				SET
					ReadTime 	= now(),
					Seen		= 1
				WHERE
					NoteID		= ?
				AND
					Target		= ?";
		
		$data_arr[] = $notice_id;
		$data_arr[] = $_SESSION['user_id'];
		
		return $DB->db_db_query($sql,$data_arr);
	}
	
	function Update_Role($id,$name,$desc){
		global $DB;
		$sql = "UPDATE
					".$this->table['userrole']."
				SET
					Name		= ?,
					Description = ?,
					Timemodified= now(),
					ModifiedBy  = ?
				WHERE
					RoleID		= ?";
		
		$data_arr[] = $name;
		$data_arr[] = $desc;
		$data_arr[] = $_SESSION['user_id'];
		$data_arr[] = $id;
		
		return $DB->db_db_query($sql,$data_arr);
	}
	
	function Add_Role($name,$desc){
		global $DB;
		$sql = "INSERT INTO
					".$this->table['userrole']."
				SET
					Name	= ?,
					Description 	= ?,
					Status		= 1,
					TimeInput   = now(),
					TimeModified = now(),
					ModifiedBy = ?";
		
	
		$data_arr[] = $name;
		$data_arr[] = $desc;
		$data_arr[] = $_SESSION['user_id'];
		
		return $DB->db_db_query($sql,$data_arr);
	}
	
	function Get_My_ActionLog(){
		global $DB;
		$sql = 'SELECT
					Type,ID,Timeinput
				FROM
					'.$this->table['action_log'].'
				WHERE
					UserID = ?
				ORDER BY
					Timeinput desc';
		
		$para[0] = $_SESSION['user_id'];
		return $DB->returnRes($sql,$para);
	}
	
	function Update_User_SidebarStatus($status){
		global $DB;
		$data_arr = array();
		
		$sql = "UPDATE
					".$this->table['user']."
				SET 
					SidebarSTatus = ?,
					TimeModified= now()
				WHERE
				UserID = ?";
		$data_arr[] = $status;
		$data_arr[] = $_SESSION['user_id'];
		
		$_SESSION['sidebar'] = $status; 
		
		return $DB->db_db_query($sql,$data_arr);
	}
	
	function Get_Clientlist(){
		global $DB;
		$sql = 'SELECT
					*
				FROM
					'.$this->table['client'].'
				WHERE
					Status = ?
				ORDER BY
					Name';
		
		$para[] = STATUS_CLIENTACTIVE;
		
		return $DB->returnRes($sql,$para);
	}
	
	static function renderProfilePicSrc($imagename='',$id='',$version='',$folder=false){
		global $CONFIG;
		if($imagename==''||$id==''){
			$id = $_SESSION['user_id'];
			$imagename = $_SESSION['profilepic'];
		}
		/*if($imagename==''){
			$userid = $_SESSION['user_id'];
			$data = $this->Get_User_Data($userid);
			$imagename = $data['ProfilePic'].'/'.$data['UserID'];
		}else{*/
			$imagename = $id.'/'.$imagename;
		//}
		if($version!=''){
			$ext = pathinfo($imagename, PATHINFO_EXTENSION);
			
			$imagename = substr($imagename,0,(strlen($ext)+1)*-1);
			$imagename .= '_'.$version.'.'.$ext;
		}
		
		if(is_file($CONFIG['upload']['profileimage']['folder'].$imagename)){
			if($folder)
				return $CONFIG['upload']['profileimage']['folder'].$imagename;
			else
				return $CONFIG['upload']['profileimage']['url'].$imagename;
		}else{
			return $CONFIG['upload']['profileimage']['placeholder'];
		}
	}
	
	function removePhyProfilePic(){
		global $CONFIG;
		
		if($profilepic = $this->renderProfilePicSrc('','','',1)){
			unlink($CONFIG['upload']['profileimage']['folder'].$pic);
			foreach($CONFIG['upload']['profileimage']['dimension'] as $type=>$width){
				$parts = pathinfo($profilepic);
				$file = $parts['dirname'].'/'.$type.'_'.$parts['filename'].'.'.$parts['extension'];
				unlink($file);
			}
		}
	}
	
	
	function getRoleSetting(){
		global $DB;
		$sql = "SELECT RoleID, Name, CanSeeRoleID FROM ".$this->table['userrole']." WHERE Status = ?";
		return $DB->returnRes($sql,array(self::role_active()));
	}
	/*static function getArtistProfilePic($UserID){
		global $CONFIG;
		
		//redis
		return $CONFIG['home_http'].'theme/assets/'.$CONFIG['asset'].'/images/people/50/guy-5.jpg';
	}*/
	
	function getArtistType(){
		global $DB;
	
		$sql = 'SELECT
					'.dbfield::getFieldByLang().'
				FROM
					'.$this->table['artisttype'].'
				WHERE
					ID = ?
				AND	
					Status= ?';
	
		$para[] = $this->TypeID();
		$para[] = $this->active();
		
		return $DB->returnVec($sql,$para);
		
	}
	
	function getPublicArtistType(){
		global $DB;
	//Alias, '.dbfield::getFieldByLang().'
		$sql = 'SELECT
					ID, '.dbfield::getFieldByLang().',Color 
				FROM
					'.$this->table['artisttype'].'
				WHERE
					Status= ?
				ORDER BY
					Position ASC';
	
		$para[] = self::active();
		
		return $DB->returnRes($sql,$para);
	}
	
	function getDebutyearOption(){
		$number = 10;
		$year = date('Y')-$number;
		for($a=0;$a<=$number;$a++){
			$index = $year+$a;
			$return[$index] = array($index,$index);
		}
		return $return;
	}
	
	function getPublicGenreType(){
		global $DB;
	
		$sql = 'SELECT
					ID,'.dbfield::getFieldByLang().'
				FROM
					'.$this->table['genretype'].'
				WHERE
					Status= ?
				ORDER BY
					Position ASC';
	
		$para[] = self::active();
		return $DB->returnRes($sql,$para);
	}
	
	function getMenu(){
		global $DB,$CONFIG;
	
		$sql = 'SELECT
					t.ID,'.dbfield::getFieldByLang('t','Type','Type').','.dbfield::getFieldByLang('a','Name').'
				FROM
					'.$this->table['artisttype'].' as t
				INNER JOIN
					'.$this->table['artist'].' as a
				ON
					a.TypeID = t.ID
				WHERE
					a.Status= ?';
	
		$para[] = self::active();
		if($rec = $DB->returnRes($sql,$para)){
			$return = array();
			foreach($rec as $v){
				$return['item'][$v['Type']][] = array('Name'=>$v['Name'],'Url'=>$CONFIG['home_http'].'artist/profile/'.strtolower($v['Name']));
			}
			$returnsize = sizeof($return['item']);
			if(12%$returnsize==0){
				$return['block'] = 12/$returnsize;
			}
				
			return $return;
		}
		return false;
	}
	
	function getArtistPublicProfile(){
		global $DB;
		$sql = 'SELECT
					ao.UserID ,t.ID,'.dbfield::getFieldByLang('t','Type').',ao.UserName,ao.DebutDate,ao.ProfilePic,'.dbfield::getFieldByLang('ao','Bio','Bio').',ao.DebutDate,ao.State as StateID,ao.Level,t.Color,'.dbfield::getFieldByLang('t','ArtistType').'
				FROM
					'.$this->table['artisttype'].' as t
				INNER JOIN
					'.$this->table['user'].' as ao
				ON
					ao.TypeID = t.ID
				WHERE
					ao.UserName = ?
				AND
					ao.Status= ?';
		
		$para[] = $this->UserName();
		$para[] = self::active();
	
		if($res = $DB->returnVec($sql,$para)){
			
			$place = $this->getPlaces(array('StateID'=>$res['StateID']));
			$res['Place'] = $place['Place'];
			$res['State'] = $place['State'];
			return $res;
		}
	}
	
	function isFollowed(){
		global $DB;
		if($userid=$this->UserID()){
			
			$sql = "SELECT 1 FROM ".$this->table['friendship']." WHERE UserID = ? AND FUserID = ? AND Status = ?";
			$para = array($_SESSION['user_id'],$userid,self::isFriend());
			if($DB->returnVec($sql,$para))
				return true;
		}
	}
	
	function getPlaces($arr=array()){
		global $Lang;
		//toGroupOption($Data['channeltooloption'],'ChannelName')
	
		//$state_size = sizeof($Lang['state']);
		$place_ct = 0;
		$state_val = 1;
		foreach($Lang['state'] as $state){
			$size = sizeof($state);
			for($a=0;$a<$size;$a++){
				$return[] = array($state_val,$state[$a],'State'=>$Lang['place'][$place_ct]);
				if(sizeof($arr)>0 && $arr['StateID']==$state_val){
					return array('Place'=>$state[$a],'State'=>$Lang['place'][$place_ct]);
				}
				$state_val++;
			}
			$place_ct++;
		}
	
		return $return;
	}
	
	static function renderBadge($level){
		return '<i class="fa fa-certificate cert'.$level.'"></i>';
	}
	
	function isViewingSelf(){
		return $this->UserID() == $_SESSION['user_id'];
	}
	
	function unFollow(){
		global $DB;
		if($userid = $this->UserID()){
			$sql = "UPDATE ".$this->table['friendship']." SET Status = ?, TimeModified = now() WHERE UserID =? AND FUserID = ?";
			$para = array(self::isUnFriend(),$_SESSION['user_id'],$userid);
			return $DB->db_db_query($sql,$para);
		}
	}
	
	function hasFollowRecord(){
		global $DB;
		if($userid = $this->UserID()){
			$sql = "SELECT ID FROM ".$this->table['friendship']."  WHERE (UserID =? AND FUserID = ?) OR (UserID =? AND FUserID = ?)";
			$para = array($_SESSION['user_id'],$userid,$userid,$_SESSION['user_id']);
			if($res = $DB->returnRes($sql,$para)){
				return sizeof($res)==2;
			}
		}
	}
	
	function createFollowRecord(){
		global $DB;
		if($userid = $this->UserID()){
			$sql = "INSERT INTO 
							".$this->table['friendship']."
					SET
							UserID = ?,
							FUserID = ?,
							IUserID = ?,
							Status = ?,
							TimeInput = now(),
							TimeModified = now()	
			";
			$para = array($_SESSION['user_id'],$userid,$_SESSION['user_id'],self::isFriend());
			$DB->db_db_query($sql,$para);
			
			$para = array($userid,$_SESSION['user_id'],$_SESSION['user_id'],self::isPendingFriend());
			$DB->db_db_query($sql,$para);
		}
	}
	
	function follow(){
		global $DB;
		if($userid = $this->UserID()){
			if($this->hasFollowRecord()){
				$sql = "UPDATE ".$this->table['friendship']." SET Status = ?, TimeModified = now() WHERE UserID =? AND FUserID = ?";
				$para = array(self::isFriend(),$_SESSION['user_id'],$userid);
				return $DB->db_db_query($sql,$para);
			}else{
				$this->createFollowRecord();
			}
		}
	}
	
	function updateProfileImage($file){
		global $DB;
		$sql = "UPDATE
						".$this->table['user']."
					SET
						ProfilePic		= ?,
						Timemodified= now(),
						ModifiedBy		= ?
				WHERE
					UserID = ?";
		
		$para[] = $file;
		$para[] = $_SESSION['user_id'];
		$para[] = $_SESSION['user_id'];
		
		return $DB->db_db_query($sql,$para);
	}
	
	function getUserSearchAC($search){
		global $DB;
		$sql = "SELECT UserID, UserName, ProfilePic,Level,FansTotal,FriendsTotal FROM ".$this->table['user']." WHERE RoleID = ? AND UserName like ? ";
		$para = array(self::role_artist,"%".$search."%");
		
		if($users = $DB->returnRes($sql,$para)){
			foreach($users as $user){
				$label = $user['UserName'].' '.self::renderBadge($user['Level']);
				$label .= '<span class="profilestats">
						 	<i class="fa fa-hand-o-left"></i> '.$user['FansTotal'].' 
						 	<i class="fa fa-group"></i> '.$user['FriendsTotal'].'</span>';
				$arr[] = array("label"=>$label,"profilepic"=>self::renderProfilePicSrc($user['ProfilePic'],$user['UserID'],1),"value"=>$user['UserName']); 
			}
			echo json_encode($arr);
		}
	}
}
?>