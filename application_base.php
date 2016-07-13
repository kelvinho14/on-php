<?php
// modifing : 
class Application
{
	protected $args;
	protected $model;

	function __construct($args='')
	{
		$this->args = $args;
	}

	/* load the controller */
	function Load_Controller()
	{
		global $Lang,$CONFIG;
		
		$file = "application/controller/".$this->args['controller']."_controller.php";
	
		if(!file_exists($file))
		{
			MVC_Perform_Action("error", "Raise_Error", NULL, array($Lang['Corp']['Error']['PageNotExists']));
			//die('Fatal error: controller not found!');
		}
		
		
		require_once($file);
		
		
		$class = str_replace("_", "", $this->args['controller'])."Controller";
		$controller = new $class($this->args);
		
		
		
		if(method_exists($controller, $this->args['method'])){
			
		 	$controller->{$this->args['method']}($this->args['vars']);
		}
		else
		{
			//print_r($controller).'<br/>';
			//print_r($this->args['method']);die;
			MVC_Perform_Action("error", "Raise_Error", NULL, array($Lang['Corp']['Error']['PageNotExists']));			
		}
		
	}

	/* extract the values stored in the associative array into individual variable for the page to use */
	function Load_View($view, $Data="", $PageContext=array(), $ArrPath=array(), $ReturnMsg='')
	{
		global $Lang, $CONFIG,$_ACCESS,$_MENU;
			
		if(!empty($ArrPath))
			$NavPath = $ArrPath;
		
		if(!empty($returnMsg)){
			$ArrReturnMsg['content'] = $ReturnMsg;
		}else{
			$ArrReturnMsg['content'] = '';
		}
				
		require('application/view/'.$view.'.php');
	}
	
	function In_To_String($view, $Data="", $PageContext=array(), $ArrPath=array(), $ReturnMsg='')
	{
		global $Lang, $CONFIG,$_MENU;
			
		if(!empty($ArrPath))
			$NavPath = $ArrPath;
		
		if(!empty($returnMsg)){
			$ArrReturnMsg['content'] = $ReturnMsg;
		}else{
			$ArrReturnMsg['content'] = '';
		}
		
		
		$FileName = 'application/view/'.$view.'.php';
		if (is_file($FileName))
		{
			ob_start();
			include $FileName;
			$Contents = ob_get_contents();
			ob_end_clean();
			return $Contents;
		}
	
		return false;
	}

	/* just include the model, as it may not need to be instantiated */
	static function Load_Model($model,$class='')
	{
		global $CONFIG;
		include_once('application/model/'.$model.'.php');
		
		if($class!=''){
			return UCFirst($class).'Model';
		}
		return $class = UCFirst($model).'Model';
		
	}
	
	/* for the controller to new an object if necessary */
	static function New_Model($model)
	{
		return new $model($this->args['vars']);
	}
}
?>