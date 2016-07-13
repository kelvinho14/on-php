<?php

define("MODULE_ACTIVE",1);
define("MODULE_DELETE",-1);

class AccessModel extends database {


	function __construct()
	{
		global $CONFIG;
		
		$this->db_prefix = $CONFIG['db_table_prefix'];
		
	}
	
	//check if the user has the right to access the required page/functions 
	public function Check_Access_Right($module='', $method='',$user_id=''){
		global $CONFIG;
		if($_SESSION['user_id']==''){
			if($_SERVER['HTTP_X_REQUESTED_WITH']=='XMLHttpRequest' ){
				echo json_encode(array('error'=>'logout'));
				die;
			}
			
			$request = substr($_SERVER['QUERY_STRING'],4);
			//$request = substr($_SERVER['REQUEST_URI'],1);
			//print_r($_SERVER);
			
			list($controller,$method) = explode('/',$request);
			
			$method = explode("?",$method);
			$method = $method[0];
			
			$method = explode("#",$method);
			$method = $method[0];
			
			$controller .= 'Controller'; 
			print_r($controller);
			$app = new Application(array('controller'=>$controller));
			$control = new $controller('');
			
			if(method_exists($control, $method)){
				$_SESSION['loginredirect'] =  $_SERVER['REQUEST_URI'];
			}
				
			header("location:".$CONFIG['home_http']."user/login/");
			die;
		}
		elseif($_SESSION['user_id']!='' &&  $_SESSION['user_name']!='' && $_SESSION['role_id']!=''){
			$this->updateUserLast();
			if($this->checkRoleAccessPage($module,$method)){
				return true;
			}else{
				return false;
			}	
			
		}else
			return false;
	}
	
	function handleAccess($module='', $method=''){
		global $CONFIG;
		if($this->Check_Access_Right($module,$method)==false){
			
			if($_SERVER['HTTP_X_REQUESTED_WITH']=='XMLHttpRequest' ){
				echo json_encode(array('error'=>'logout'));
				die;
			}else{
				header("location:".$CONFIG['home_http']."404");
			}
		}
		
	}
	
	function checkRoleAccessPage($module,$method,$roleid=''){
		if($module=='')
			return false;
		
		Application::Load_Model("user");
		$access = UserModel::getPermission();
		
		$roleid = $roleid==''?$_SESSION['role_id']:$roleid;
		
		if($roleid<=0)
			return false;
		elseif($roleid==UserModel::role_superadmin()){
			return true;
		}
		
		if($method!=''){
			return sizeof($access[$module][$method])>0 && (in_array($roleid,$access[$module][$method])||in_array(0,$access[$module][$method]));
		}/*elseif($method==''){
			foreach($access[$module] as $key=>$val){
				
				if(in_array($roleid,$val)||in_array(0,$val))
					return true;
			}
		}*/
	}
	
	function Get_Access_Obj($cond=array()){
		$sql = 'SELECT
					ModuleID,Name,Section,Position,Action
				FROM
					'.$this->db_prefix.'MODULES
				WHERE
					Status != ?';
		$para[] = MODULE_DELETE;
		if(sizeof($cond)>0){
			for($a=0;$a<sizeof($cond);$a++){
				$sql .= " AND ".$cond[$a][0]." = ?";
				$para[] = $cond[$a][1];
			}
		}
		$sql.=' ORDER BY
					Name, Section, Position';
		
		$obj = $this->returnRes($sql,$para);
		
		$return_arr = array();
		for($a=0;$a<sizeof($obj);$a++){
			$return_arr[$obj[$a]['Name']][$obj[$a]['Section']][$obj[$a]['Position']] = array($obj[$a]['ModuleID'],$obj[$a]['Action']); 
		}
		return $return_arr;
	}
	
	function Update_Role_Access($role_id,$access_id){
		$sql = "UPDATE
					".$this->db_prefix."USERROLE
				SET
					Access 	= ?, 
					ModifiedBy	= ?,
					TimeModified= now()
				WHERE
					RoleID = ?";
		
		$data_arr[] = $access_id;
		$data_arr[] = $_SESSION['user_id'];
		$data_arr[] = $role_id;
		
		return $this->db_db_query($sql,$data_arr);
	}
	
	function updateUserLast(){
		global $DB;	
		$sql = "UPDATE
					".$this->db_prefix."USER
				SET
					LastUA 	= ?,
					LastIP	= ?,
					LastSeen = now()
				WHERE
					UserID = ?";
		
		$para[] = get_ua();
		$para[] = get_ip();
		$para[] = $_SESSION['user_id'];
			
		return $DB->db_db_query($sql,$para);
	}
	
	function Is_Valid_License(){
		$sql = 'SELECT Value FROM 	'.$this->db_prefix.'SITE_ACCESS WHERE Name = ?';
		$lic_obj = $this->returnVec($sql,array('LICENSE'));
		list($start,$end) = explode(" ",$lic_obj[0]);

		if(Time_Diff($start,$end)>0)
			return true;
	}	
}