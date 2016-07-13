
<?php

class ActionController extends Application
{
	function __construct($args){
		list($this->artistname) = $args['args'];
	}
	
	function ajax_postobject(){
		global $Lang;
		
		$userclass = $this->Load_Model("user");
		$objclass = $this->Load_Model("object");
		$obj = new $objclass();
		$this->Load_Model("file");
		
		
		$obj->setType(filter::required_param('posttype',PARAM_INT));
		
		if($obj->isText()){
			$content = filter::required_param('content',PARAM_TEXT);
		}elseif($obj->isImage()){
			//$fileid = filter::required_param('fileid',PARAM_INT);
			$fileid = filter::required_param_array('fileid',PARAM_INT);
			$content = filter::required_param('content',PARAM_TEXT);
			
		}elseif($obj->isExtVideo()){
			$videolink = filter::required_param('videolink',PARAM_TEXT);
		}
		
		
		//fileid <- attach to post if upload within last 5 mins
		/*if(is_array($fileid) && sizeof($fileid)>0){
			$type = ObjectModel::image;	
		}else{
			$type = ObjectModel::text;
		}*/
		
		//https://www.googleapis.com/youtube/v3/videos?id=qfCgBi25E0o&key=AIzaSyCJU3lfQ1fwdJFOhNiK82rOa3qfVPB_mmY&part=snippet //all
		//https://www.googleapis.com/youtube/v3/videos?id=qfCgBi25E0o&key=AIzaSyCJU3lfQ1fwdJFOhNiK82rOa3qfVPB_mmY&fields=items(snippet(thumbnails))&part=snippet //thumbnail
		//https://www.googleapis.com/youtube/v3/videos?id=qfCgBi25E0o&key=AIzaSyCJU3lfQ1fwdJFOhNiK82rOa3qfVPB_mmY&fields=items(snippet(title))&part=snippet //title
		
		if($obj->setData(array('text'=>$content,'fileid'=>$fileid,'videolink'=>$videolink))){
			$obj->setStatus(ObjectModel::ispublic);
			$obj->setUserID($_SESSION['user_id']);
			
			if($oid = $obj->postObject()){
				$consttype = $obj->ConstType();
				$obj->setID($oid);
				$postobj = $obj->getObject();
				
				if(isPageCall('index')==false){
						$postobj[$oid]['postfullwidth'] = true;
						$para['fullwidth'] = 1;
						$para['container'] = $obj->Type().'container';
				}
				
				$html = Application::In_To_String('object/'.$consttype[$obj->Type()],$postobj[$oid]);
					
				$result = ui::getajaxResult(1,'',$html,$para);
					
			}else{
				$result = ui::getajaxResult(0,$Lang['action']['post_fail']);
			}	
		}else{
			$result = ui::getajaxResult(0,$Lang['action']['post_fail']);
		}
		
		echo json_encode($result);
		
	}
	
	function ajax_postasso(){
		
		$assoclass = $this->Load_Model("object","asso");
		$asso = new $assoclass();
		$objclass = $this->Load_Model("object");
		$obj = new $objclass();
		$userclass = $this->Load_Model("user");
		$this->Load_Model("file");

		
		$oid = filter::required_param('item',PARAM_INT);
		$assotype = filter::required_param('type',PARAM_INT);
		$modal = filter::optional_param('modal','',PARAM_INT);
		
		if($assotype==AssoModel::comment){
			$asso->setData(filter::required_param('content',PARAM_TEXT));
		}
		
		$asso->setObjectID($oid);
		$asso->setType($assotype);
		$asso->setStatus(ObjectModel::ispublic);
		$asso->setUserID($_SESSION['user_id']);
		
		$obj->setID($oid);
		if($asso->Type()==AssoModel::like){
			list($result,$neednotify) = $asso->toggleAsso();
		}else{
			$neednotify = true;
			$result = $asso->postAsso();
		}
		
		if($result){
			if($neednotify){
				$asso->setObjectID($oid);
				$obj->setObject();
				// notify the poster
				$asso->setObjectUserID($obj->UserID());
				$asso->setNotifyType($asso->assoNotification());
				$asso->setNotifyData();
				$asso->insertNotify();
			}
			if($modal){
				$o = $obj->getAjaxViewObject();
				$result = ui::getajaxResult(1,'',$o['html']);
			}else{
				if($postobj = $obj->getObject()){
					$consttype = $obj->ConstType();
					
					if(isPageCall('index')==false){
						$postobj[$oid]['postfullwidth'] = true;
						$para['fullwidth'] = 1;
					}
					
					$html = Application::In_To_String('object/'.$consttype[$postobj[$oid]['object']['OType']],$postobj[$oid]);
		//			$html = Application::In_To_String('object/asso_bar',$postobj[$asso->ObjectID()]);
				}
				$result = ui::getajaxResult(1,'',$html,$para);
			}
		}else{
			$result = ui::getajaxResult(0,$Lang['action']['post_fail']);
		}
		echo json_encode($result);
	}
	
	function ajax_unfollow(){
		$path = filter::required_param('path',PARAM_TEXT);
		$patharr = getActionFromUrl($path);
		$action = $patharr['action'];
		
		if($action=='page'){
			$classname = $this->Load_Model("user");
			$UserModel = new $classname();
			
			$UserModel->setUserName($patharr['sec']);
			if($user = $UserModel->getUserFromUsername()){
				$UserModel->setUserID($user['UserID']);
				if($UserModel->unFollow()){
					echo json_encode(ui::getajaxResult(1,'',ui::followBtn()));
				}
			}
		}
	}
	
	function ajax_follow(){
		$path = filter::required_param('path',PARAM_TEXT);
		$patharr = getActionFromUrl($path);
		$action = $patharr['action'];
	
		if($action=='page'){
			$classname = $this->Load_Model("user");
			$UserModel = new $classname();
				
			$UserModel->setUserName($patharr['sec']);
			if($user = $UserModel->getUserFromUsername()){
				$UserModel->setUserID($user['UserID']);
				if($UserModel->follow()){
					echo json_encode(ui::getajaxResult(1,'',ui::unfollowBtn()));
				}
			}
		}
	}
	
	function ajax_uploadfile(){
		//print_R($_FILES);
		//die;
		global $CONFIG;
		$classname = $this->Load_Model("file");
		$FileModel = new $classname();
		$type = 'post';
		$targetdir = $CONFIG['upload'][$type]['folder'].$_SESSION['user_id'].'/';
		$field = 'postimage';
		if(list($filename,$file_mime) = $FileModel->doupload($field,$type,array('targetdir'=>$targetdir))){
			$real_name = $_FILES[$field]["name"];
			$originalfile = $CONFIG['upload'][$type]['folder'].$_SESSION['user_id'].'/'.$filename;
					//resizeImage($CONFIG['imageresizewidth'], $originalfile, $originalfile);
			$filesize = filesize($originalfile);
			if($new_file_id = $FileModel->Insert_File($filename,$real_name,$filesize,$file_mime)){
				$url = $FileModel->getAttachmentUrl($type,$filename);
				$arr['files'][] = array('type'=>'image/jpeg','url'=>$url,'id'=>$new_file_id);
				echo json_encode($arr);		
			}			
		}
	}
	
	function ajax_uploadprofileimage(){
		global $CONFIG;
		$classname = $this->Load_Model("file");
		$FileModel = new $classname();
		$classname = $this->Load_Model("user");
		$UserModel = new $classname();
		
		$type = 'profileimage';
		$targetdir = $CONFIG['upload'][$type]['folder'].$_SESSION['user_id'].'/';
		$field = 'profileimageupload';
		
		if(list($filename,$file_mime) = $FileModel->doupload($field,$type,array('targetdir'=>$targetdir))){
			
			$originalfile = $CONFIG['upload'][$type]['folder'].$_SESSION['user_id'].'/'.$filename;
			$needcrop = $FileModel->notSquareImage($originalfile);
			if($needcrop==false){
				$FileModel->resizeImage($originalfile,$type);
			}
			
			if($UserModel->updateProfileImage($filename)){
				$_SESSION['profilepic'] = $filename;
				$url = $FileModel->getAttachmentUrl($type,$filename);
				echo json_encode(ui::getajaxResult(1,'',$url,array('crop'=>$needcrop?1:0)));
			}
		}
	}
	
	function ajax_acuser(){
		
		$search = filter::required_param('s',PARAM_TEXT);
		$userclass = $this->Load_Model("user");
		$UserModel = new $userclass();
		echo $UserModel->getUserSearchAC($search);
	}
	
	function ajax_cropprofilepic(){
		global $CONFIG;
		
		$x = filter::required_param('x',PARAM_INT);
		$y = filter::required_param('y',PARAM_INT);
		$h = filter::required_param('h',PARAM_INT);
		$w = filter::required_param('w',PARAM_INT);
		$userclass = $this->Load_Model("user");
		$UserModel = new $userclass();
		
		$profilepicsrc = $UserModel->renderProfilePicSrc('','','',1);
		
		foreach($CONFIG['upload']['profileimage']['dimension'] as $version=>$width){
			
			$parts = pathinfo($profilepicsrc);
			
			$thumb_file = $parts['dirname'].'/'.$parts['filename'].'_'.$version.'.'.$parts['extension'];
			
			copy ($profilepicsrc, $thumb_file);
			$src = $profilepicsrc;
			
			if(strtolower($parts['extension'])=='jpg' || strtolower($parts['extension'])=='jpeg')
				$img_r = imagecreatefromjpeg($src);
			else if(strtolower($parts['extension'])=='gif')
				$img_r = imagecreatefromgif($src);
			else if(strtolower($parts['extension'])=='png')
				$img_r = imagecreatefrompng($src);
			
			$dst_r = ImageCreateTrueColor( $width, $width );
			
			imagecopyresampled($dst_r,$img_r,0,0,intval($_POST['x']),intval($_POST['y']), $width,$width, intval($_POST['w']),intval($_POST['h']));
			
			if(strtolower($parts['extension'])=='jpg' || strtolower($parts['extension'])=='jpeg')
				imagejpeg($dst_r,$thumb_file,100);
			else if(strtolower($parts['extension'])=='gif')
				imagegif($dst_r,$thumb_file,100);
			else if(strtolower($parts['extension'])=='png')
				imagepng($dst_r,$thumb_file,9);
			
		}
		
		echo json_encode(ui::getajaxResult(1));
	}
	
	function ajax_bookmarkpost(){
		global $Lang;
		
		$objclass = $this->Load_Model("object");
		$obj = new $objclass();
		$id = filter::required_param('id',PARAM_INT);
		$obj->setID($id);
		
		$status = $obj->handlBookmarkAction();
		
		$Data['bookmarked'] = $status;
		$Data['OID'] = $id; 
		$html = $this->In_To_String('object/postmenu', $Data);
		
		echo json_encode(ui::getajaxResult(1,'',$html));
	}
	
	function ajax_togglePostNotification(){
		global $Lang;
		$objclass = $this->Load_Model("object");
		$obj = new $objclass(); 
		$assoclass = $this->Load_Model("object","asso");
		$asso = new $assoclass();
		$id = filter::required_param('id',PARAM_INT);
		
		$asso->setObjectID($id);
		$asso->handleNotificationToggle();
		
		
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
	
	function ajax_morecomment(){
		$html = '<li class="media" id="comment_999">
					<div class="media-left">
						<a href=""><img src="http://dev.maruon.net/spacex/profile/2/924d0db28f91d2d22708759960ab03ef_1.jpg" class="media-object"></a>
					</div>
					<div class="media-body">
						<div class="pull-right dropdown" data-show-hover="li" style="display: none;">
					    	<a href="#" data-toggle="dropdown" class="toggle-button">
					        	<i class="fa fa-pencil"></i>
							</a>
							<ul class="dropdown-menu" role="menu">
					        	<li><a href="#">Edit</a></li>
					            <li><a href="#">Delete</a></li>
					        </ul>
						</div>
					    <a href="http://dev.maruon.net/page/leon" class="comment-author pull-left">leon</a>
							<span>999</span>
					    <div class="comment-date">14 分前</div>
					</div>
				</li>
				<li class="media" id="comment_998">
					<div class="media-left">
						<a href=""><img src="http://dev.maruon.net/spacex/profile/2/924d0db28f91d2d22708759960ab03ef_1.jpg" class="media-object"></a>
					</div>
					<div class="media-body">
						<div class="pull-right dropdown" data-show-hover="li" style="display: none;">
					    	<a href="#" data-toggle="dropdown" class="toggle-button">
					        	<i class="fa fa-pencil"></i>
							</a>
							<ul class="dropdown-menu" role="menu">
					        	<li><a href="#">Edit</a></li>
					            <li><a href="#">Delete</a></li>
					        </ul>
						</div>
					    <a href="http://dev.maruon.net/page/leon" class="comment-author pull-left">leon</a>
							<span>998</span>
					    <div class="comment-date">14 分前</div>
					</div>
				</li>';
		echo json_encode(ui::getajaxResult(1,'',$html));
	}
	/*function youtubeupload(){
		global $CONFIG;
		//set_include_path(get_include_path() . PATH_SEPARATOR . '/path/to/google-api-php-client/src');
		set_include_path($CONFIG['google_api_path']);
		
		require_once $CONFIG['google_api_path'].'Google/autoload.php';
		//require_once $CONFIG['google_api_path'].'Google/Client.php';
		//require_once $CONFIG['google_api_path'].'Google/Service/YouTube.php';
		$OAUTH2_CLIENT_ID = 'maruon_youtube';
		$OAUTH2_CLIENT_SECRET = 'AIzaSyCJU3lfQ1fwdJFOhNiK82rOa3qfVPB_mmY';
		
		$client = new Google_Client();
		$client->setClientId($OAUTH2_CLIENT_ID);
		$client->setClientSecret($OAUTH2_CLIENT_SECRET);
		$client->setScopes('https://www.googleapis.com/auth/youtube');
		$redirect = filter_var('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'],
				FILTER_SANITIZE_URL);
		$client->setRedirectUri($redirect);
		
		// Define an object that will be used to make all API requests.
		$youtube = new Google_Service_YouTube($client);
		
		if (isset($_GET['code'])) {
			if (strval($_SESSION['state']) !== strval($_GET['state'])) {
				die('The session state did not match.');
			}
		
			$client->authenticate($_GET['code']);
			$_SESSION['token'] = $client->getAccessToken();
			header('Location: ' . $redirect);
		}
		
		if (isset($_SESSION['token'])) {
			$client->setAccessToken($_SESSION['token']);
		}
		
		// Check to ensure that the access token was successfully acquired.
		if ($client->getAccessToken()) {
			try{
				// REPLACE this value with the path to the file you are uploading.
				$videoPath = "/path/to/file.mp4";
		
				// Create a snippet with title, description, tags and category ID
				// Create an asset resource and set its snippet metadata and type.
				// This example sets the video's title, description, keyword tags, and
				// video category.
				$snippet = new Google_Service_YouTube_VideoSnippet();
				$snippet->setTitle("Test title");
				$snippet->setDescription("Test description");
				$snippet->setTags(array("tag1", "tag2"));
		
				// Numeric video category. See
				// https://developers.google.com/youtube/v3/docs/videoCategories/list
				$snippet->setCategoryId("22");
		
				// Set the video's status to "public". Valid statuses are "public",
				// "private" and "unlisted".
				$status = new Google_Service_YouTube_VideoStatus();
				$status->privacyStatus = "public";
		
				// Associate the snippet and status objects with a new video resource.
				$video = new Google_Service_YouTube_Video();
				$video->setSnippet($snippet);
				$video->setStatus($status);
		
				// Specify the size of each chunk of data, in bytes. Set a higher value for
				// reliable connection as fewer chunks lead to faster uploads. Set a lower
				// value for better recovery on less reliable connections.
				$chunkSizeBytes = 1 * 1024 * 1024;
		
				// Setting the defer flag to true tells the client to return a request which can be called
				// with ->execute(); instead of making the API call immediately.
				$client->setDefer(true);
		
				// Create a request for the API's videos.insert method to create and upload the video.
				$insertRequest = $youtube->videos->insert("status,snippet", $video);
		
				// Create a MediaFileUpload object for resumable uploads.
				$media = new Google_Http_MediaFileUpload(
						$client,
						$insertRequest,
						'video/*',
						null,
						true,
						$chunkSizeBytes
				);
				$media->setFileSize(filesize($videoPath));
		
		
				// Read the media file and upload it chunk by chunk.
				$status = false;
				$handle = fopen($videoPath, "rb");
				while (!$status && !feof($handle)) {
					$chunk = fread($handle, $chunkSizeBytes);
					$status = $media->nextChunk($chunk);
				}
		
				fclose($handle);
		
				// If you want to make other calls after the file upload, set setDefer back to false
				$client->setDefer(false);
		
		
				$htmlBody .= "<h3>Video Uploaded</h3><ul>";
				$htmlBody .= sprintf('<li>%s (%s)</li>',
						$status['snippet']['title'],
						$status['id']);
		
				$htmlBody .= '</ul>';
		
			} catch (Google_Service_Exception $e) {
				$htmlBody .= sprintf('<p>A service error occurred: <code>%s</code></p>',
						htmlspecialchars($e->getMessage()));
			} catch (Google_Exception $e) {
				$htmlBody .= sprintf('<p>An client error occurred: <code>%s</code></p>',
						htmlspecialchars($e->getMessage()));
			}
		
			$_SESSION['token'] = $client->getAccessToken();
		} else {
			// If the user hasn't authorized the app, initiate the OAuth flow
			$state = mt_rand();
			$client->setState($state);
			$_SESSION['state'] = $state;
		
			$authUrl = $client->createAuthUrl();
			$htmlBody = <<<END
  <h3>Authorization Required</h3>
  <p>You need to <a href="$authUrl">authorize access</a> before proceeding.<p>
END;
		}
		
	}*/
}
?>