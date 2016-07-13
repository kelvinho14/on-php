<?php 

class FileModel extends database {
	static protected $active = 1;
	static protected $draft = 0;
	static protected $deleted = -1;
	
	function __construct(){
		$this->table = dbfield::getTables();
	}
	
	static function active(){
		return self::$active;
	}
	static function deleted(){
		return self::$deleted;
	}
	static function draft(){
		return self::$draft;
	}
	
	function cron(){
		global $DB,$CONFIG;
		
		$sql = "SELECT f.ID as FileID, r.ChannelID,f.File,f.Filesize FROM ".$this->table['taskrecord_file']." as f INNER JOIN ".$this->table['taskrecord']." as r on r.ID =f.taskrecordid WHERE f.Status != ? ";
		$para[] = self::deleted();
		
		$obj = $DB->returnRes($sql,$para);
		
		
		//http://innobuttoncrm.com/aidsconcern/spacex/project/2/545ebe62123891a815f512a67c2f2094.jpg
		$org = $CONFIG['spacefolder'].'project/test.jpg';
		$dest = $CONFIG['spacefolder'].'project/test4.jpg';
		
		compress_image($org,$dest,20);
		die;
		
		
		for($a=0;$a<sizeof($obj);$a++){
			$file = $CONFIG['spacefolder'].'project/'.$obj[$a]['ChannelID'].'/'.$obj[$a]['File'];
				
			if(is_file($file)){
				$filesize = filesize($file);
				if($obj[$a]['Filesize']!=$filesize){
					$sql = "UPDATE ".$this->table['taskrecord_file']." SET FileSize = ? WHERE ID = ?";
					echo $sql.'<br/>';
					$para = array($filesize,$obj[$a]['FileID']);
					print_R($para);
					echo '<br/>';
					//echo $DB->db_db_query($sql,$para);
				} 
			}
			
			
		}
			
	}
	
	static function getFileExt($file){
		return pathinfo($file, PATHINFO_EXTENSION);
	}
	
	static function resizeImage($originalFile,$type='',$newWidth='',$newHeight='',$targetFile='') {
		global $CONFIG;
		
		if(is_file($originalFile)==false)
			return false;
		$info = getimagesize($originalFile);
		$mime = $info['mime'];
	
		$ext = self::getFileExt($originalFile);
	
		switch ($mime) {
			case 'image/jpeg':
				$image_create_func = 'imagecreatefromjpeg';
				$image_save_func = 'imagejpeg';
				//$new_image_ext = 'jpg';
				break;
	
			case 'image/png':
				$image_create_func = 'imagecreatefrompng';
				$image_save_func = 'imagepng';
				//$new_image_ext = 'png';
				break;
	
			case 'image/gif':
				$image_create_func = 'imagecreatefromgif';
				$image_save_func = 'imagegif';
				//$new_image_ext = 'gif';
				break;
	
			default:
				throw new Exception('Unknown image type.');
		}
	
		$img = $image_create_func($originalFile);
		list($width, $height) = getimagesize($originalFile);
		
		if(sizeof($CONFIG['upload'][$type]['dimension'])>0){
			foreach($CONFIG['upload'][$type]['dimension'] as $version=>$newWidth){
				$newHeight = ($height / $width) * $newWidth;
				$tmp = imagecreatetruecolor($newWidth, $newHeight);
				imagecopyresampled($tmp, $img, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
				$targetFile = substr($originalFile,0,(strlen($ext)+1)*-1);
				$targetFile .= '_'.$version.'.'.$ext;
				if (file_exists($targetFile)) {
					unlink($targetFile);
				}
				$image_save_func($tmp, $targetFile);
			}
		}
		return true;
	}
	
	function notSquareImage($image){
		
		if(is_file($image)){
			list($width, $height) = getimagesize($image);
			return $width!=$height;		
		}
		
	}
	function doupload($fieldname,$type,$parm=array()){
		global $Admin_Lang,$CONFIG;
		
		$content = $_FILES[$fieldname];
		
		/*switch($type){
			case 'profilepic':
				$mime_type = $CONFIG['upload'][$type]['mime'];
				$max_size = $CONFIG['upload'][$type]['maxsize'];
				$targetdir = $CONFIG['upload'][$type]['folder'];
				$filename = md5(uniqid('').time());
			break;
		}*/
		
		$mime_type = $CONFIG['upload'][$type]['mime'];
		$max_size = $CONFIG['upload'][$type]['maxsize'];
		$targetdir = $parm['targetdir']==''?$CONFIG['upload'][$type]['folder']:$parm['targetdir'];
		$filename = md5(uniqid('').time());
		
		if($content['tmp_name']!=''){
			
			if ($content["error"] !== UPLOAD_ERR_OK) {
				MVC_Perform_Action("error", "Raise_Error", NULL, array($Admin_Lang['failed_to_upload']));
			}
				
		
			if($content['size']>=$max_size){
				MVC_Perform_Action("error", "Raise_Error", NULL, array($Admin_Lang['upload_too_big']));
			}
		
			// verify the file extension
			$fileinfo = getimagesize($content["tmp_name"]);
			$filetype = $fileinfo['mime'];
			if(!in_array($filetype,$mime_type)){
				MVC_Perform_Action("error", "Raise_Error", NULL, array($Admin_Lang['upload_image_incorrect_format']));
			}
		
			// ensure a safe filename
			$content_file = preg_replace("/[^A-Z0-9._-]/i", "_", $content["name"]);
		
			// don't overwrite an existing file
			$parts = pathinfo($content_file);
			if (file_exists($content["tmp_name"])) {
				$content_file = $filename. "." . $parts["extension"];
		
				$target_dir = $targetdir;
		
				if(is_dir($target_dir)==false){
					mkdir($target_dir);
				}
				$target_file = $target_dir.$content_file;
				// preserve file from temporary directory
				$success = move_uploaded_file($content["tmp_name"],$target_file);
				if (!$success) {
					MVC_Perform_Action("error", "Raise_Error", NULL, array($Admin_Lang['failed_to_upload']));
				}
				$this->fixOrientation($target_file);
				 
			}else{
				MVC_Perform_Action("error", "Raise_Error", NULL, array($Admin_Lang['failed_to_upload']));
			}
		
			// set proper permissions on the new file
			chmod($target_file, 0644);
			return array($content_file,$filetype);
		}
	}
	
	function fixOrientation($target_file){
		if($mime = is_image($target_file)){
			switch ($mime) {
				case 'image/jpeg':
					$image_create_func = 'imagecreatefromjpeg';
					$image_save_func = 'imagejpeg';
					break;
		
				case 'image/png':
					$image_create_func = 'imagecreatefrompng';
					$image_save_func = 'imagepng';
					break;
		
				case 'image/gif':
					$image_create_func = 'imagecreatefromgif';
					$image_save_func = 'imagegif';
					break;
		
				default:
					throw new Exception('Unknown image type.');
			}
			if(is_file($target_file)){
				$exif = @exif_read_data($target_file);
				if(!empty($exif['Orientation'])) {
					$image = $image_create_func($target_file);
					switch($exif['Orientation']) {
						case 8:
							$createdImage = imagerotate($image,90,0);
							break;
						case 3:
							$createdImage = imagerotate($image,180,0);
							break;
						case 6:
							$createdImage = imagerotate($image,270,0);
							break;
					}
					if($createdImage){
						$image_save_func($createdImage, $target_file);
					}
				}
			}
		}
	}
	
	function Insert_File($file,$real_name,$filesize,$file_mime){
		global $DB;
		$sql = "INSERT INTO 
					".$this->table['file']."
				SET
					File			= ?,
					UserID			= ?,
					Realname		= ?,
					Filesize		= ?,
					Mime			= ?,
					Status			= ?,
					TimeInput 	= now(),
					Timemodified= now(),
					Modifier		= ?";
		
		$para[] = $file;
		$para[] = $_SESSION['user_id'];
		$para[] = $real_name;
		$para[] = $filesize;
		$para[] = $file_mime;
		$para[] = self::active();
		$para[] = $_SESSION['user_id'];
		
		return $DB->db_db_query($sql,$para,1);
	}
	
	static function getAttachmentUrl($type,$filename,$userid=''){
		global $CONFIG;
		
		$userid = $userid==''?$_SESSION['user_id']:$userid;
		$filepath = $CONFIG['upload'][$type]['folder'].$userid.'/'.$filename;
		
		if(is_file($filepath))
			return $CONFIG['upload'][$type]['url'].$userid.'/'.$filename;
		else 
			return $CONFIG['postimageplaceholder'];
		
	}
	
	function getAllowStorage(){
		global $CONFIG;
		return $CONFIG['filestorage'];
	}
	
	function getRemainStorage(){
		global $CONFIG;
		return $this->getAllowStorage()-$this->getUsedStorage();
	}
	
	function getStorageStats(){
		$return['allow'] = $this->getAllowStorage();
		$return['used'] = $this->getUsedStorage();
		$return['usedper'] = round($return['used']/$return['allow']*100,2);
		
		return $return;
	}
	
	function getUsedStorage(){
		global $DB;
		
		$sql = "SELECT sum(Filesize) as used FROM ".$this->table['taskrecord_file']." WHERE Status != ? ";
		$para[] = self::deleted();
		$obj = $DB->returnVec($sql,$para);
		return $obj['used'];
	}
}


?>