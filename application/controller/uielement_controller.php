<?php
//modifying by: 
/* load user controls into views */
class UIElementController
{
	public static function Render($UserControl, $ElementData=array())
	{
		global $Admin_Lang,$CONFIG;
		
		//print_r(get_defined_vars());		// debug
		include 'application/view/uicontrols/'.$UserControl.'.php';
	}
	
	public static function In_To_String($UserControl, $ElementData=array())
	{
		global $Admin_Lang;
		$FileName = 'application/view/uicontrols/'.$UserControl.'.php';
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
}
?>