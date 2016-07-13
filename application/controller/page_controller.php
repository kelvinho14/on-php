<?php

class PageController extends Application
{
	function __construct($args){
		if($args['method']=='post'){
			list($dum,$this->objectid) = $args['args'];
		}else{
			list($this->username) = $args['args'];
		}
	}
	
	function index($lastid=''){
		global $Lang,$REDIS;
		
		
		$objclass = $this->Load_Model("object");
		$obj = new $objclass();
		$userclass = $this->Load_Model("user");
		$user = new $userclass();
		$this->Load_Model("file");
		
		
		/*$Data['filterapplied'] = false;
		$filter_attr = $obj->Filter();
		foreach($filter_attr as $key=>$attr){
			if((is_array($_REQUEST['filter_'.$key]) && sizeof(($_REQUEST['filter_'.$key]))>0) || $_REQUEST['filter_'.$key]!='')
				$Data['filterapplied'] = true; 
			
			if(is_array($attr['type'])){
				$Data['filter'][$key] = filter::optional_param_array('filter_'.$key,$attr['value'],$attr['type']);
			}
			else
				$Data['filter'][$key] = filter::optional($_REQUEST,'filter_'.$key,$attr['value'],$attr['type']);
			$obj->setFilter($key,$Data['filter'][$key]);
		}*/
		$filter = $obj->applyFilter();
		$Data = $filter['Data'];
		
		
		/*$pubsub = $REDIS->client->pubSubLoop();
		
		
		$channel = $_SESSION['user_id'];
		$REDIS->client->subscribe($channel);
		print_R($pubsub);die;*/
		
		/*insert into PROJECT_USER 
values(null,'supergirl','','','','','supergirl@mail.com','1dd367a66657f444bb92a6d49b3fb592cb98b84e5f448b168cac77b3870a5a43','a472355e6fb7316ac47f01b6c9a00c3f26e0e1f858d782e1a12c38af0cad6571',
4,'','','','',0,0,0,now(),1,now(),'','','','','',1,now(),now(),now(),1,1,'','',now());*/

		$obj->setObjectLimit();
		$obj->setRecordBefore($lastid);
		$Data['feed_display'] = $obj->getLatestPublicFeedHTML($Data['filter']);
		if($lastid>0){
			return $Data['feed_display'];
		}
		$Data['places'] = $user->getPlaces();
		$Data['places'] = toGroupOption($Data['places'],'State');
		$Data['artist_type'] = $user->getPublicArtistType();
		$Data['debutyear_option'] = $user->getDebutyearOption();
		
		$this->Load_View('page/index', $Data);
	}
	
	function myfeed($lastid=''){
		global $Lang;
		
		$userclass = $this->Load_Model("user");
		$objclass = $this->Load_Model("object");
		$obj = new $objclass();
		$this->Load_Model("file");
		
		$Data['postfullwidth'] = true;
		$obj->setObjectLimit();
		$obj->setRecordBefore($lastid);
		$Data['feed_display'] = $obj->getMyFeedHTML();
		if($lastid>0){
			return $Data['feed_display'];
		}
		$this->Load_View('page/myfeed', $Data);
	}
	
	function saved($lastid,$type='',$ajaxscroll=false){
		
		global $Lang;
		
		$classname = $this->Load_Model("user");
		$UserModel = new $classname();
		$objclass = $this->Load_Model("object");
		$obj = new $objclass();
		$this->Load_Model("file");
		
		$UserModel->setUserID($_SESSION['user_id']);
		$user = $UserModel->getUserFromID();
		
		if($user){
			$bytype = true;
			if($type==''||$type==ObjectModel::text)
				$type = array(ObjectModel::text,ObjectModel::image);
			
			$obj->setType($type);
			$obj->setSavedObj();
			$obj->setUserID($user['UserID']);
			$obj->setObjectLimit();
			$obj->setRecordBefore($lastid);
			$Data['feed_display'] = $obj->getMyPagePost($bytype);
			
			if($ajaxscroll){
			//if($type!=''){ 
				return $Data['feed_display'];
			}
			
			$Data['artist'] = $UserModel->getArtistPublicProfile();
			
			if($Data['self']==false)
				$Data['followed'] = $UserModel->isFollowed();
			
			$this->Load_View('page/saved', $Data);
		}
	}
	
	function profile($lastid,$type='',$ajaxscroll=false){
		
		global $Lang;
		
		$classname = $this->Load_Model("user");
		$UserModel = new $classname();
		$objclass = $this->Load_Model("object");
		$obj = new $objclass();
		$this->Load_Model("file");
		
		$Data['isprofile'] = true;
		
		if($this->username==''){ //&& UserModel::isArtist()==false
			$UserModel->setUserID($_SESSION['user_id']);
			$user = $UserModel->getUserFromID();
			$UserModel->setUserName($user['UserName']);
		}else{
			$arr['username'] = $this->username;
			$artistname = filter::required($arr,'username',PARAM_TEXT);
			$UserModel->setUserName($artistname);
			$user = $UserModel->getUserFromUsername();
		}
		//$arr['viewsection'] = 'blog';
		if($user){
			
			$UserModel->setUserID($user['UserID']);
			$Data['self'] = $UserModel->isViewingSelf();
			
			if($Data['isviewartist'] = $UserModel->isViewArtist()){
				
				$obj->setUserID($user['UserID']);
				$obj->setObjectLimit();
				$obj->setRecordBefore($lastid);
					
				// show text and image first
				if($type==''||$type==ObjectModel::text)
					$type = array(ObjectModel::text,ObjectModel::image);
				$obj->setType($type);
				
				/*if($type=='saved'){
					$bytype=false;
				}else{*/
					$bytype=true;
				//}
				$Data['feed_display'] = $obj->getMyPagePost($bytype);
			}elseif($Data['self']){
				$bytype = true;
				//$obj->setType('saved');
				$Data['feed_display'] = $obj->getMyPagePost($bytype);
			}
			
			
			
			if($ajaxscroll){
			//if($type!=''){ 
				return $Data['feed_display'];
			}
			
			$Data['artist'] = $UserModel->getArtistPublicProfile();
			
			
			if($Data['self']==false)
				$Data['followed'] = $UserModel->isFollowed();
			
			$this->Load_View('page/profile', $Data);
		}else{
			MVC_Perform_Action("error", "Raise_Error");
		}
	}
	
	function ajax_scrollpagination(){
		global $CONFIG,$Lang;
	
		$objclass = $this->Load_Model("object");
		$obj = new $objclass();
		$userclass = $this->Load_Model("user");
		$user = new $userclass();
	
		//$page = filter::optional_param('page',1,PARAM_INT);
		//$page += 1;
		$lastid = filter::optional_param('lastid',0,PARAM_INT);
		
		$path = filter::optional_param('path','',PARAM_TEXT);
		$type = filter::optional_param('type','',PARAM_TEXT);
		if($type=='allpost')
			$type = '';
		/*if(strpos($type,",")>0){
			$type = explode(",",$type);
		}*/
		
		
		$filter = $obj->applyFilter();
		$Data = $filter['Data'];
	
		/*$patharr = getActionFromUrl($path);
		$action = $patharr['action'];
		
		switch($action){
			case 'myfeed':
				$Data['feed_display'] = $this->myfeed($lastid);
				break;
			case 'page':
				if($patharr['sec']!='mypage'){
					$this->username = $patharr['sec'];
				}
				$feed = $this->profile($lastid,$type,1);
				//if($type!='saved')
					//$Data['feed_display'] = $feed[$type];
				//else
					$Data['feed_display'] = $feed;
				break;
			case 'saved':
				$feed = $this->saved($lastid,$type,1);
				
				$Data['feed_display'] = $feed[$type];
				
				break;	
			default:
				$Data['feed_display'] = $this->index($lastid);
				
		}*/
		if(isPageCall('','myfeed')){
			$Data['feed_display'] = $this->myfeed($lastid);
		}elseif(isPageCall('page','saved')){
			$feed = $this->saved($lastid,$type,1);
			$Data['feed_display'] = $feed[$type];
		}elseif(isPageCall('page')){
			$patharr = getActionFromUrl($path);
			$action = $patharr['action'];
			if($patharr['sec']!='mypage'){
				$this->username = $patharr['sec'];
			}
			$feed = $this->profile($lastid,$type,1);
			$Data['feed_display'] = $feed[$type];
		}else{	
			$Data['feed_display'] = $this->index($lastid);
		}
	
			
		if($Data['feed_display']=='')
			$page = 0;
		if(isPageCall('index')==false){
			$para['fullwidth'] = 1;
		}	
		$para['page'] = $page;
		//echo json_encode(array('html'=>$Data['feed_display'],'page'=>$page));
		
		echo json_encode(ui::getajaxResult(1,'',$Data['feed_display'],$para));
	}
	
	/*function blog(){
		global $Admin_Lang;
		
		$artistname = filter::required_param('artistname',PARAM_TEXT);

		$classname = $this->Load_Model("access");
		$AccessControl = new $classname();
		
 		$classname = $this->Load_Model("user");
		$UserModel = new $classname();
		
		$classname = $this->Load_Model("blog");
		$BlogModel = new $classname();

		$BlogModel->setArtistName($artistname);
//		$Data['blog'] = $BlogModel->getBlogPublicList();

		echo json_encode(array('html'=>$this->In_To_String('artist/bloglist', $Data)));
	}*/
	
	function ajax_viewpost(){
		global $CONFIG;
		
		
		$objclass = $this->Load_Model("object");
		$obj = new $objclass();
		$userclass = $this->Load_Model("user");
		$fileclass = $this->Load_Model("file");
		
		
		$obj->setID(filter::required($_REQUEST,'id',PARAM_INT));
		
		
		$object = $obj->getAjaxViewObject();
		
		$Data['posthtml'] = $object['html'];
		$Data['object'] = $object['object'];
		
		echo $this->In_To_String('page/ajaxviewpost', $Data);
	}
	
	function ajax_getpostddmlist(){
		global $Lang;
		
		$objclass = $this->Load_Model("object");
		$obj = new $objclass();
		
		$assoclass = $this->Load_Model("object","asso");
		$asso = new $assoclass();
		
		$id = filter::required_param('id',PARAM_INT);
		$obj->setID($id);
		
		$status = $obj->getPostBookmarkStatus();
		
		$asso->setObjectID($id);
		if($asso->willBeNotified()){
			$Data['notifyon'] = true;
		}
		
		$Data['bookmarked'] = $status['status'];
		$Data['OID'] = $id; 
		$html = $this->In_To_String('object/postmenu', $Data);
		
		echo json_encode(ui::getajaxResult(1,'',$html));
	}
	
	
	function ajax_getnotificationmenu(){
		global $Lang,$CONFIG;
		
		$assoclass = $this->Load_Model("object","Asso");
		$asso = new $assoclass();
		$userclass = $this->Load_Model("user");
		$user = new $userclass();
		
		if($notification = $asso->getNotificationItem()){
			$maxid = '';
			
			foreach($notification as $notify){
				if($maxid=='')
					$maxid = $notify['ID'];
				$user->setUserID($notify['Issuer']);
				$user->setUser();
				
				$avatar = '<img src="'.$user->renderProfilePicSrc($user->ProfilePic(),$user->UserID(),1).'"/> ';
				
				switch($notify['Data']){
					case AssoModel::like:
						$word = $notify['RealName'];
						$word .= $_SESSION['user_id']==$notify['ObjectUserID']?$Lang['likeyourpost']:$Lang['likeapostyoufollow'];
					break;
					case AssoModel::comment:
						$word = $notify['RealName'];
						$word.=$_SESSION['user_id']==$notify['ObjectUserID']?$Lang['commentyourpost']:$Lang['commentapostyoufollow'];
						
					break;
				}
				$class = $notify['Status']==AssoModel::unreadNotify()?'unread':'';		
				$Data['notification'][] = array('avatar'=>$avatar,'word'=>$word,'link'=>$CONFIG['home_http'].'page/post/'.$notify['ObjectID'],'time'=>display::dayAgo($notify['TimeInput']),'class'=>$class);
			}
		}
		$html = $this->In_To_String('object/notificationmenu', $Data);
		echo json_encode(ui::getajaxResult(1,'',$html));
		$asso->readAllNotification($maxid);
	}
	
	function mypage(){
		return $this->profile('');
	}
	
	function post(){
		global $Lang;
		
		$this->Load_Model("user");
		$this->Load_Model("file");
		$objclass = $this->Load_Model("object");
		$obj = new $objclass();
		
		$arr = (array)$this;
		$id = filter::required($arr,'objectid',PARAM_INT);
		$obj->setID($id);
		if($post = $obj->getViewSinglePostHtml()){
			$Data['post'] = $post['html'];
			
			$obj->setType($post['obj']['object']['OType']);
			
			if($obj->isText()||$obj->isImage()){ 
				$text = ObjectModel::getText($post['obj']['object']['OData']);
				if($obj->isImage()){
					$src = ObjectModel::getImageSrc($post['obj']['object']['OData']);
				}	
			}elseif($obj->isExtVideo()){
				$desc = ObjectModel::getDesc($post['obj']['object']['OData']);
				$text = $desc;
				$imageurl = FileModel::getAttachmentUrl('post',$src[0],$post['obj']['object']['OUserID']);
				$imageurl = ObjectModel::getThumbnail($post['obj']['object']['OData']);
				
			}
			
			
			
			//>Kevin Chan - Kevin Chan shared HK Green Vision 香港綠識願景&#039;s video.
			$Data['og']['desc'] = $desc;
			$Data['og']['title'] = $text;
			$Data['og']['image'] = $imageurl;
			$this->Load_View('page/post', $Data);
		}else{
			MVC_Perform_Action("error", "Raise_Error");
		}
		
	}
	function ajax_countnotification(){

		$assoclass = $this->Load_Model("object","Asso");
		$asso = new $assoclass();
		if($total = $asso->getUnreadNotification()){ 
			echo json_encode(ui::getajaxResult(1,'',$total));
		}else{
			echo json_encode(ui::getajaxResult(1));
		}
	}
	
	function qrcode(){
		global $CONFIG;
		
		$link = $CONFIG['home_http'].'page/'.$this->username;
		$Data['qrcode'] = display::qrCode($link);
		echo $this->In_To_String('page/qrcode', $Data);
	}
}
?>