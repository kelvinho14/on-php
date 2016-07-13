<?php

class BlogController extends Application
{
	function __construct($args){
		list($this->blogname) = $args['args'];
	}

	function blog(){
		
		global $Admin_Lang;
		
		$arr['blogname'] = $this->blogname;
		
		
		$blogname = filter::required($arr,'artistname',PARAM_TEXT);
		
		
		$classname = $this->Load_Model("blog");
		$BlogModel = new $classname();
		
		$classname = $this->Load_Model("access");
		$AccessControl = new $classname();
		//$AccessControl->handleAccess('artist','view');
		$BlogModel->setBlogName($blogname);
		
		
		$Data['blog'] = $BlogModel->getBlogPublicList();
		
		$this->Load_View('blog/profile', $Data);
	}
}
?>