<?php
/* 
 * the error controller to handle errors like: 404, 
 * can be called by MVC_PerformAction() 
 */
class ErrorController extends Application
{
	function __construct($args)
	{
		$this->args = $args;
	}
	
	function Raise_Error($ErrorMessage='',$Hide_back=false)
	{
		global $CONFIG;
		/* not implemented yet
		$this->Load_Model("error");
		$Error = new ErrorModel($Vars);
		$Error->Log_Error();
		*/
		$classname = $this->Load_Model("access");
		$AccessControl = new $classname();
		if($_SESSION['user_id']==''){
			header("location:".$CONFIG['home_http']);
			die;
		}
		$this->Load_View('error', $Data);
		exit;
	}
}
?>