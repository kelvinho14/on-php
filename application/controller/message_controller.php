<?php
    
class MessageController extends Application
{
	function __construct($args){
		$this->args = $args;
	}
	
	function ajax_allmessageread(){
		$classname = $this->Load_Model("access");
		$AccessControl = new $classname();
		
		$classname = $this->Load_Model("message");
		$MessageControl = new $classname();
		
		$classname = $this->Load_Model("user");
		$UserControl = new $classname();
		
		$MessageControl->markAllRead();
	}
	
	function viewlist(){
		global $Admin_Lang;
	
		$classname = $this->Load_Model("access");
		$AccessControl = new $classname();
		
		$classname = $this->Load_Model("message");
		$MessageControl = new $classname();
		
		$classname = $this->Load_Model("user");
		$UserControl = new $classname();
		
	
		list($unread,$notification) = $MessageControl->getNotification();
		if($Data['notification'] = $notification){
			
			$count = sizeof($Data['notification']);
			for($a=0;$a<$count;$a++){
				$Data['notification'][$a]['SenderProfilePic'] = $UserControl->renderProfilePicSrc('',$Data['notification'][$a]['SenderID'],4); 
			}
		}
		$MessageControl->markAllRead();
		$this->Load_View('message/notificationlist', $Data);
	}
}	