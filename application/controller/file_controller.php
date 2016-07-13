<?php
    
class FileController extends Application
{
	function __construct($args){
		$this->args = $args;
	}
	
	function library(){
		$classname = $this->Load_Model("access");
		$AccessControl = new $classname();
		$AccessControl->handleAccess('file','view');
		
		$classname = $this->Load_Model("file");
		$FileControl = new $classname();
		
		$Data['canupload'] = $FileControl->getRemainStorage()>0;
		
		$this->Load_View('file/library', $Data);
	}
	function remove(){
		global $CONFIG;
		$classname = $this->Load_Model("access");
		$AccessControl = new $classname();
		$AccessControl->handleAccess('file','view');
		
		$classname = $this->Load_Model("file");
		$FileControl = new $classname();
		
		$ids = filter::required_param_array('FileID',PARAM_INT);
		$size = sizeof($ids);
		for($a=0;$a<$size;$a++){
			$FileControl->id = $ids[$a];
			if($FileControl->canDeleteFile()){
				$FileControl->deleteFile();
			}
		}
		ui::setGrowl($Admin_Lang['growl']['file_deleted'],'success');
		header("location:".$CONFIG['home_http']."file/library");
		die;
	}
	function download(){
		global $CONFIG;
		
		//no access checking here so guess can download file
		
		$classname = $this->Load_Model("file");
		$FileControl = new $classname();
		
		$FileControl->id = filter::required_param('id',PARAM_INT);
		$FileControl->filehash = filter::optional_param('h','',PARAM_TEXT);
		
		if($FileControl->canDownloadFile()){
			$FileControl->downloadFile();
		}else{
			MVC_Perform_Action("error", "Raise_Error");
		}
		
		exit;
		
	}
	function upload(){
		global $CONFIG,$Admin_Lang;
		
		$classname = $this->Load_Model("access");
		$AccessControl = new $classname();
		$AccessControl->handleAccess('file','upload');
		
		$classname = $this->Load_Model("file");
		$FileControl = new $classname();
		
		if (!empty($_FILES)) {
			
			$FileControl->status = filter::optional_param('uploadstatus',0,PARAM_INT);
			
			$file = $_FILES['file'];
			$real_name = $file["name"];
			$filesize = $file['size'];
			if($FileControl->getRemainStorage()<=0){
				MVC_Perform_Action("error", "Raise_Error", NULL, array($Admin_Lang['no_space_left']));
			}else{
				if(list($file,$file_mime) = $FileControl->doupload('file','library',array('targetdir'=>$CONFIG['upload']['library']['folder']))){
					$originalfile = $CONFIG['upload']['library']['folder'];
					//resizeImage($CONFIG['imageresizewidth'], $originalfile, $originalfile);
					if($new_file_id = $FileControl->insertFile($file,$real_name,$filesize,$file_mime)){
						$returnarr = array('result'=>'ok','msg'=>$Admin_Lang['file_uploaded']);
						echo json_encode($returnarr);
					}
					else{
						echo json_encode(array('result'=>'error','msg'=>$Admin_Lang['failed_to_upload']));
					}
				}
			}
		}
	}
	
	function ajax_getfilelist(){
		
		$classname = $this->Load_Model("access");
		$AccessControl = new $classname();
		$AccessControl->handleAccess('file','view');
		
		$classname = $this->Load_Model("file");
		$FileControl = new $classname();
		$Data['activestatus'] = $FileControl->active();
		$Data['FileList'] = $FileControl->getFileList();
		echo json_encode(array('html'=>$this->In_To_String('file/libraryfilelist', $Data)));
	}
	
	function ajax_updatefilestatus(){
		global $Admin_Lang;
		
		$classname = $this->Load_Model("access");
		$AccessControl = new $classname();
		$AccessControl->handleAccess('file','view');

		$classname = $this->Load_Model("file");
		$FileControl = new $classname();
		
		$FileControl->id = filter::required_param('id',PARAM_INT);
		$ispublic = filter::required_param('ispublic',PARAM_INT);
		
		
		if($FileControl->canEditFile()){
			$FileControl->status = $ispublic?$FileControl::active():$FileControl::draft();
			if($FileControl->updateFile()){
				echo json_encode(array('status'=>'ok','msg'=>$Admin_Lang['status_updated']));
			}else{
				echo json_encode(array('status'=>'error','msg'=>$Admin_Lang['failed_to_update_status']));
			}
		}else{
			echo json_encode(array('status'=>'error','msg'=>$Admin_Lang['file_no_access']));
		}
	}
}	