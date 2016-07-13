<?php

class ObjectModel extends database {

    const ispublic = 1;
    const isprivate = 0;
    const isreport = -1;
    const isbannded = -2;

    const text = 1;
    const image = 2;
    const video = 3;
    const extvideo = 4;
    const event = 5;
    const song = 6;

    const bookmarked = 1;
    const unbookmarked = 0;


    private $ID = '';
    private $Type = '';
    private $Data = '';
    private $Status = '';
    private $UserID = '';
    private $IsFeatured = '';
    private $TimeInput    = '';
    private $TimeModified = '';
    private $ConstType = array(1=>'text',2=>'image',3=>'video',4=>'extvideo',5=>'event',6=>'song');
    private $Filter = array(
    		//'debutyear'=>array('tablealias'=>'oa','type'=>PARAM_INT,'value'=>0),
    						'state'=>array('tablealias'=>'oa','type'=>PARAM_TEXT,'value'=>'','format'=>'commadel'),
    						'gender'=>array('tablealias'=>'oa','type'=>PARAM_INT,'value'=>array()));
    private $ObjectLimit = '';
	private $SavedObj = '';    						
    
    function __construct(){
        $this->table = dbfield::getTables();
    }

    function isPublic(){
        return $this->Status==self::ispublic;
    }
    function isPrivate(){
        return $this->Status==self::isprivate;
    }
    function isReport(){
        return $this->Status==self::isreport;
    }
    function isBandded(){
        return $this->Status==self::isbannded;
    }
    function isText(){
    	return $this->Type==self::text;
    }
    function isImage(){
    	return $this->Type==self::image;
    }
    function isVideo(){
    	return $this->Type==self::video;
    }
    function isExtVideo(){
    	return $this->Type==self::extvideo;
    }
    function bookmarked(){
    	return self::bookmarked;
    }
	function unbookmarked(){
    	return self::unbookmarked;
    }
    
    function ID(){
        return $this->ID; 
    }
    function Type(){
        return $this->Type; 
    }
    function Data(){
        return $this->Data; 
    }
    function Status(){
        return $this->Status; 
    }
    function UserID(){
        return $this->UserID; 
    }
    function IsFeatured(){
    	return $this->IsFeatured;
    }
    function TimeInput(){
        return $this->TimeInput; 
    }
    function TimeModified(){
        return $this->TimeModified; 
    }
	
    function ConstType(){
        return $this->ConstType;
    }
    function SavedObj(){
    	return $this->SavedObj;
    }
    function Filter(){
    	return $this->Filter;
    }
    function ObjectLimit(){
    	return $this->ObjectLimit;
    }
    function RecordBefore(){
    	return $this->RecordBefore;
    }
	function setID($id){
        $this->ID = $id;
    }
    function setType($type){
        $this->Type = $type;
    }
    function setSavedObj(){
    	$this->SavedObj = 1;
    }
    function setData($data){
    	
    	switch($this->Type()){
    		case self::text:
    			$this->Data = $data['text'];
    			return true;
    		break;
    		case self::image:
    			$this->Data = $data;
    			return true;
    		break;
    		case self::extvideo:
    			//$this->Data = array('videolink'=>$data['link'],'title'=>'1');
    			if($info = $this->getVideoInfo($data['videolink'])){
    				$this->Data = array('videolink'=>$info['link'],'title'=>$info['title'],'desc'=>$info['desc'],'thumbnail'=>$info['thumbnail']);
    				return true;
    			}else{
    				return array('msg'=>$Lang['invalidvideoembedlink']);
    			}
    		break;
    		case self::notification:
    			$this->Data = '';
    		break;
    	}
        
    }
    function setObject(){
    	if($this->ID()!=''){
    		global $DB;
    		$sql = "SELECT UserID,Type,Data,Status,IsFeatured,TimeInput,TimeModified FROM ".$this->table['pobj']." WHERE ID = ?";
    		$para = array($this->ID());
    		
    		if($rec = $DB->returnVec($sql,$para)){
    		
    			$this->setUserID($rec['UserID']);
    			$this->setType($rec['Type']);
    			$this->setStatus($rec['Status']);
    			$this->setIsFeatured($rec['IsFeatured']);
    			$this->setTimeInput($rec['TimeInput']);
    			$this->setTimeModified($rec['TimeModified']);
    		}	
    	}
    }
    
    function getVideoHoster($url){
    	if (strpos($url, 'youtube') > 0) {
    		return 'youtube';
    	} elseif (strpos($url, 'vimeo') > 0) {
    		return 'vimeo';
    	} else {
    		return 'unknown';
    	}
    	//https://vimeo.com/55073825
    	//https://www.youtube.com/watch?v=qfCgBi25E0o
    }
    function getVideoIDFromLink($link,$hoster){
    	
    	if($hoster=='youtube'){
	    	$link = explode("v=",$link);
	    	$part = $link[1];
	    	$part = explode("&",$part);
	    	$id = $part[0];
    	}elseif($hoster=='vimeo'){
    		$link = explode("/",$link);
	    	$id = $link[sizeof($link)-1];
	    }
    	
    	return $id;
    }
    function getVideoInfo($link){
    	global $CONFIG;
    	$hoster = $this->getVideoHoster($link);
    	if($id = $this->getVideoIDFromLink($link,$hoster)){
    		switch($hoster){
    			case 'youtube':
		    		$server = "https://www.googleapis.com/youtube/v3/videos?id=".$id."&key=".$CONFIG['googleapikey']."&part=snippet";
		    	break;
    			case'vimeo':
    				$server = 'http://vimeo.com/api/v2/video/'.$id.'.json';
    			break;
    		}
    		$curl_handle=curl_init();
    		curl_setopt($curl_handle,CURLOPT_URL,$server);
    		curl_setopt($curl_handle,CURLOPT_CONNECTTIMEOUT,2);
    		curl_setopt($curl_handle,CURLOPT_RETURNTRANSFER,1);
    		$buffer = curl_exec($curl_handle);
    		curl_close($curl_handle);
	    	if (empty($buffer)){
	    		return false;
	    	}
	    	else{
	    		try {
	    			$arr = json_decode($buffer);
	    			
	    			switch($hoster){
	    				case 'vimeo':
	    					return array('link'=>'https://player.vimeo.com/video/'.$id,'title'=>$arr[0]->title,'desc'=>$arr[0]->description,'thumbnail'=>$arr[0]->user_portrait_medium);
	    					break;
	    				case'youtube':
	    					return array('link'=>'https://www.youtube.com/embed/'.$id,'title'=>$arr->items[0]->snippet->title,'desc'=>$arr->items[0]->snippet->description,'thumbnail'=>$arr->items[0]->snippet->thumbnails->medium->url);
	    					break;
	    			}		
				} catch (Exception $e) {
    				return false;
				}
	    	}
    	}
    	return false;
    }
    function setStatus($status){
        $this->Status = $status;
    }
    function setUserID($userid){
        $this->UserID = $userid;
    }
    function setIsFeatured($isfeatured){
    	$this->IsFeatured = $isfeatured;
    }
    
    function setTimeInput($timeinput){
        $this->TimeInput = $timeinput;
    }
    function setTimeModified($timemodified){
        $this->TimeModified = $timemodified;
    }
    function setFilter($attr,$val){
    	
    	if(is_array($val)){
    		if(sizeof($val)==0){
    			return false;
    		}
    	}else{
    		if($val=='')
    			return false;
    	}
    	
    	if(is_array($this->Filter[$attr]['value'])){
    		if($this->Filter[$attr]['format']=='commadel')
    			$this->Filter[$attr]['value'] = explode(",",$val);
    		else
    			$this->Filter[$attr]['value'][] = $val;
    		
    	}else{
    		$this->Filter[$attr]['value'] = $val;
    		
    	}
    }
    /*function setObjectLimit($page,$rpp=''){
    	global $CONFIG;
    	$page = $page==''?1:$page;
    	$rpp = ($rpp=='')?$CONFIG['indexfeed']['rpp']:$rpp;
    	$offset = ($page -1) * $rpp;
    	$this->ObjectLimit = " LIMIT " . $offset . "," . $rpp;
    }*/
	function setObjectLimit(){
    	global $CONFIG;
    	$this->ObjectLimit = " LIMIT " . $CONFIG['indexfeed']['rpp'];
    }
    
    function setRecordBefore($oid){
    	if($oid>0)
    		$this->RecordBefore = array('cond'=>' AND o.ID < ? ','para'=>array($oid));
    }
    
    function applyFilter(){
    	$filter_attr = $this->Filter();
    	foreach($filter_attr as $key=>$attr){
    		if((is_array($_REQUEST['filter_'.$key]) && sizeof(($_REQUEST['filter_'.$key]))>0) || $_REQUEST['filter_'.$key]!='')
    			$Data['filterapplied'] = true;
    			
    		if(is_array($attr['type'])){
    			$Data['filter'][$key] = filter::optional_param_array('filter_'.$key,$attr['value'],$attr['type']);
    		}
    		else
    			$Data['filter'][$key] = filter::optional($_REQUEST,'filter_'.$key,$attr['value'],$attr['type']);
    		$this->setFilter($key,$Data['filter'][$key]);
    	}
    	
    	return array('Data'=>$Data);
    }

    function updateRedisPublicPostHTML($single){
        //$data[$post['id']] = Application::In_To_String('page/index_feed',$post);;
        //$this->setredis('PublicPostHtml',$data);
    }

    function getredis($type,$key){
        return false;
        //check redis online
        global $REDIS;

        /*$responses = $REDIS->client->transaction(function ($tx) {
        $tx->set('foo', 'bar');
        echo $tx->get('foo');
        });*/

        //$responses = $REDIS->client->transaction()->set('foo', 'bar2')->execute();
        switch($type){
            case 'get':
                $responses = $REDIS->client->transaction()->get($key)->execute();
                break;
            case 'hmget':
                $responses = $REDIS->client->transaction()->hgetall($key)->execute();
                break;
        }
        if($responses[0]!=''){
            //PublicPostHtml
            return $responses[0];
        }
    }

    function setredis($type,$key,$data){
        global $REDIS;
        //check redis online

return false;
        switch($type){
            case 'set':
                $responses = $REDIS->client->transaction()->set($key, $data)->execute();
                break;
            case 'hmset':
                $responses = $REDIS->client->transaction()->hmset($key, $data)->execute();
                break;
                //hset('user',"username","gafitescu");
        }
        return $responses;
    }

    function updateRedisPublicObjJson($post){
        //$data[$post['id']] = $post;
        //$this->setredis('PublicPostJson',$data);
    }

    function packData(){
        $type = $this->Type();
        $arr = array();
        switch($type){
            case self::text:
                $arr['Text'] = $this->Data(); 
                break;
            case self::image:
                $data = $this->Data();
                
                $arr['Text'] = $data['text'];
                if($files = $this->isRecentPostPhoto($data['fileid'])){
                	foreach($files as $file){
                		//if($url = $FileModel->getAttachmentUrl('post',$file['File'])){
                			$arr['Src'][] = $file['File'];
                		//}
                	}
                }
                //foreach($data['fileid'] as $fileid)
                //$arr['Src']
                break;
            case self::video:

                break;
            case self::extvideo:
                $arr = $this->Data(); 
                break;
            case self::event:
                $arr['Place'] = '';
                $arr['Date'] = '';
                $arr['Name'] = '';
                $arr['Desc'] = '';
                break;
            case self::song:
                $arr['Name'] = '';
                $arr['Date'] = '';
                $arr['Genre'] = '';
                $arr['Image'] = '';
                break;
        }
        return json_encode($arr);
    }
    
    function isRecentPostPhoto($fileid,$userid=''){
    	global $DB,$CONFIG;
    	$userid = $userid==''?$_SESSION['user_id']:$userid;
    	$sql = "SELECT File,ID FROM ".$this->table['file']." WHERE UserID = ? AND timeinput>=date_sub(now(), interval ".$CONFIG['upload']['post']['duration']." minute) ";
    	$para = array();
    	$para[] = $userid;
    
    	if(is_array($fileid)){
    		list($q,$par) = dbfield::in($fileid,'ID');
    		$sql.=$q;
    		$para = array_merge($para,$par);
    	}else{
    		$sql.=" AND FileID = ?";
    		$para[] = $userid;
    	}
    	if($res = $DB->returnRes($sql,$para)){
    		return $res;
    	}
    }

    function postObject(){
        global $DB;
        //$this->updateRedisLastObjID();
        $data = $this->packData();
        $sql = 'INSERT INTO 
        '.$this->table['pobj'].'
        SET
        
        Type = ?,
        Data = ?,
        Status = ?,
        UserID = ?,
        Timeinput    = now(),
        Timemodified = now()
        ';

        $para = array($this->Type(),$data,$this->Status(),$this->UserID());

        return $DB->db_db_query($sql,$para,1);

        //$this->updateRedisPublicObjJson($post);

        $this->setRedis('PublicPostHtml',$Data);
    }

    function getLatestPublicFeedHTML($filter=array()){

        if($redis=$this->getRedis('hmget','PublicPostHtml')){
            $Data = '';
            foreach($redis as $v)
                $Data.=$v;
        }else{
        	
            if($content['feeds'] = $this->getLatestPublicFeed(false,$filter)){
                $redisdata = array();
                foreach($content['feeds'] as $pid=>$v){
                    $html = Application::In_To_String('object/'.$this->ConstType[$v['object']['OType']],$v);
                    $Data.=$html; 
                    $redisdata[] = $html;
                }
                $this->setRedis('hmset','PublicPostHtml',$redisdata);
            }

        }
        return $Data;
    }
    
    function getViewSinglePostHtml(){
    	$html = '';
    	if($post = $this->getObject()){
    		$post = $post[$this->ID()];
    		$post['postfullwidth'] = true;
    		$html = Application::In_To_String('object/'.$this->ConstType[$post['object']['OType']],$post);
    		return array('html'=>$html,'obj'=>$post);
    	}
    }

    function getMyFeedHTML(){
        /*if($redis=$this->getRedis('MyFeedPostHtml')){
        $Data = $redis;
        }else*/
        {

        	if($content['feeds'] = $this->getMyPublicFeed()){ // to change
                foreach($content['feeds'] as $pid=>$v){
                    //$v['myfeed'] = true;
                    $v['postfullwidth'] = true;
                    $Data .= Application::In_To_String('object/'.$this->ConstType[$v['object']['OType']],$v);
                }
            }
        }
        return $Data;
    }
    
    function getMyPagePost($bytype=false){
    	
    	$para = array();
    	    	
    	$type = $this->Type();
    	
    	if(is_array($type)){
    		list($q,$par) = dbfield::in(implode(",",$type),'o.Type');
    		$cond.=$q;
    		$para = array_merge($para,$par);
    		if($this->savedObj()==false){
    			$cond .= ' AND oa.UserID = ?';
    			$para[] = $this->UserID;
    		}
    	}elseif($type!=''){
    		$cond = ' AND o.Type = ? ';
    		$para[] = $type;
    		if($this->savedObj()==false){
    			$cond .= ' AND oa.UserID = ?';
    			$para[] = $this->UserID;
    		}
    	}elseif($type==''){
    		if($this->savedObj()==false){
    			$cond = ' AND oa.UserID = ?';
    			$para[] = $this->UserID;
    		}
    	}
    	
    	if($content['feeds'] = $this->getObject(array(),array($cond,$para))){
	    	foreach($content['feeds'] as $pid=>$v){
	        	//$v['myfeed'] = true;
	        	$v['postfullwidth'] = true;
	        	if($bytype){
	        		$type = $v['object']['OType'];
	        		// merge image post with text post
	        		if($type==self::image)
	        			$type = self::text;
	        		$Data[$type] .= Application::In_To_String('object/'.$this->ConstType[$v['object']['OType']],$v);
	        	}
	        	else
	            	$Data .= Application::In_To_String('object/'.$this->ConstType[$v['object']['OType']],$v);
	        }
			return $Data;
    	}
    }

    function getObject($filter=array(),$cond='',$presenttype=''){
        global $DB,$CONFIG;

        // get post and asso count first
        $sql = 'SELECT
			        o.ID as OID,
			        oa.UserID as OUserID,
			        oa.UserName as OAName,
			        oa.ProfilePic as OAPic,
			        oa.Level as OALevel,
			        oa.FansTotal as OAFansTotal,
			        oa.FriendsTotal as OAFriendsTotal,
			        o.Type as OType,
			        o.data as OData,
			        o.Timeinput as OTime,
        			a.Type as AType,
        			count(if(a.type=?,1,null)) as LikeTotal, 
					count(if(a.type=?,1,null)) as CommentTotal,
        			count(if(a.UserID=? and a.Type=?,1,null)) as YourComment,
        			'.dbfield::getFieldByLang('at','OArtistType').',
        			at.ID as ArtistTypeID,
        			at.Color
			    FROM
		      	  '.$this->table['pobj'].' as o
		        INNER JOIN
		      		  '.$this->table['user'].' as oa on oa.UserID = o.UserID
		      	INNER JOIN
		      		  '.$this->table['artisttype'].' as at ON at.ID = TypeID	  
		      		  ';
       			
        $para[] = AssoModel::like;
        $para[] = AssoModel::comment;
        $para[] = $_SESSION['user_id']==''?0:$_SESSION['user_id'];
        $para[] = AssoModel::comment;
        if($presenttype=='mypublicfeed'){
        	$sql.=' INNER JOIN '.$this->table['friendship'].' as f ON f.UserID = ? AND oa.UserID = f.FUserID AND f.Status=?';
        	$para[] = $_SESSION['user_id'];  
        	$para[] = UserModel::isFriend();
        }
        
		$sql.=' LEFT JOIN
		       	 	  '.$this->table['passo'].' as a ON o.ID = a.ObjectID AND a.Status= ?';
		$para[] = self::ispublic;
		if($this->SavedObj()){
			$sql.= ' INNER JOIN '.$this->table['pbookmark'].' as b ON b.PostID = o.ID AND b.USerID = ? AND b.Status=?';
			$para[] = $_SESSION['user_id'];
			$para[] = 1;
		}
		$sql.=' WHERE
      			  o.Status=?';
        
        $para[] = AssoModel::ispublic;
        
        $oid = $this->ID();
        
        if($oid!=''){
        	$sql.= ' AND o.ID = ?';
        	$para[] = $oid;
        }
        
        $filters = $this->Filter();
        
        foreach($filters as $attr=>$val){
        	$value = $val['value'];
        	if(is_array($value)){
        		foreach($value as $val2){
        			if(trim($val2)!=''){
        				//$sql.= " AND ".$val['tablealias'].".".$attr."= ?";
        				//$para[] = $val2;
        				list($c,$p) = dbfield::in($val2,$val['tablealias'].".".$attr);
        				$sql.=$c;
        				$para = array_merge($para,$p); 
        			}
        		}
        	}else{
        		if(trim($value)!=''){
        			if($val['format']=='commadel'){
        				list($c,$p) = dbfield::in($value,$val['tablealias'].".".$attr);
        				$sql.=$c;
        				$para = array_merge($para,$p);
        			}else{
        				$sql.= " AND ".$val['tablealias'].".".$attr."= ?";
        				$para[] = $value;
        			}
        		}
        	}
        }
        //print_r($cond);
     	if(is_array($cond) && sizeof($cond)>0){
     		$sql.=$cond[0];
     		$para = array_merge($para,$cond[1]);
     	}
     	
     	if($recordb4 = $this->RecordBefore()){
     		$sql.= $recordb4['cond'];
     		$para = array_merge($para,$recordb4['para']);
     	}
     	
        
        $sql.=' Group By 
        			o.ID
        		ORDER BY
        			o.Timeinput Desc';
        if($this->objectlimit()!=''){
        	$sql.= $this->objectlimit(); 
        }
//echo $sql;
//print_r($para);
        if($feeds = $DB->returnRes($sql,$para)){
      	//print_R($feeds);
        	//die;
        	$commenttoget = array();
        	foreach($feeds as $feed){
            	$return[$feed['OID']]['object'] = array('OID'=>$feed['OID'],'OUserID'=>$feed['OUserID'],'OAName'=>$feed['OAName'],'OAPic'=>$feed['OAPic'],'OALevel'=>$feed['OALevel'],
            	'OAFansTotal'=>$feed['OAFansTotal'],'OAFriendsTotal'=>$feed['OAFriendsTotal'],'OType'=>$feed['OType'],'OData'=>$feed['OData'],'OTime'=>$feed['OTime'],'LikeTotal'=>$feed['LikeTotal'],
            	'CommentTotal'=>$feed['CommentTotal'],'OArtistType'=>$feed['OArtistType'],'OArtistColor'=>$feed['Color'],'OArtistTypeID'=>$feed['ArtistTypeID']);
            	
            	//if($feed['CommentTotal']<=$CONFIG['postcommentpreload']){// || $feed['YourComment']>0
            		$commenttoget[] = $feed['OID'];
            	//}
            }
            
            
            // get comments
            list($cond,$p) = dbfield::in(implode(",",$commenttoget),'ObjectID ');
            $param = array();
            $param[] = AssoModel::comment;
            $param[] = AssoModel::active();
            $param[] = $CONFIG['postcommentpreload'];
            $param[] = AssoModel::active();
            $param[] = AssoModel::comment;
            
            
            $param = array_merge($param,$p);
            
            //comments
            $sql = 'SELECT  
            			g.*,au.Username,au.UserId as AUserID,au.username as AUser,au.ProfilePic as AUPic,'.dbfield::getFieldByLang('at','OArtistType').', at.Color,au.RoleID as ARoleID
			        FROM 
            			'.$this->table['pobj'].' o 
            		INNER JOIN 
            			(SELECT * FROM '.$this->table['passo'].' as a WHERE (SELECT COUNT(*) FROM '.$this->table['passo'].' b WHERE b.objectid = a.objectid AND b.id >= a.id AND b.Type in (?) AND b.status = ?  ) <= ? AND a.status = ?) g 
            		ON 
            			o.id = g.objectid 
            		INNER JOIN
            			'.$this->table['user'].' as au on au.UserID = g.UserID
            		INNER JOIN
		      		  '.$this->table['artisttype'].' as at ON at.ID = au.TypeID	  
		    		WHERE 
            			g.Type = ?
            			'.$cond.'
            		ORDER BY
            			 objectid, g.Timeinput';
            if($assos = $DB->returnRes($sql,$param)){
            	
            	foreach($assos as $asso){
            		//if($asso['Type']==AssoModel::comment){
            			$return[$asso['ObjectID']]['comment'][] = array('AID'=>$asso['ID'],'AUserID'=>$asso['AUserID'],'AUPic'=>$asso['AUPic'],'AUser'=>$asso['AUser'],'AType'=>$asso['Type'],'AData'=>$asso['Data'],'ATime'=>$asso['TimeInput'],'OArtistType'=>$asso['OArtistType'],'OArtistColor'=>$asso['Color'],'ARoleID'=>$asso['ARoleID']);
            		//}elseif($asso['Type']==AssoModel::like){
            			//$return[$asso['ObjectID']]['like'][] = $asso['AUserID'];
            		//}
            	}
            }
            
            //likes
            $sql = 'SELECT
            			a.ObjectID,a.UserID
			        FROM
            			'.$this->table['passo'].' a
            		WHERE
            			a.Type = ? AND a.Status=?
            			'.$cond;
            $param = array();
            $param[] = AssoModel::active();
            $param[] = AssoModel::like;
            $param = array_merge($param,$p);
             
            if($assos = $DB->returnRes($sql,$param)){
            	
            	foreach($assos as $asso){
					$return[$asso['ObjectID']]['like'][] = $asso['UserID'];
            	}
            }
            
            
            
            
            if($isapi){
                $return = json_encode($return);
            }
           
            return $return;
        }
        /*$sql = 'SELECT
         o.ID as OID,
         oa.Name as OAName,
         oa.ProfilePic as OAPic,
         oa.Level as OALevel,
         oa.FansTotal as OAFansTotal,
         oa.FriendsTotal as OAFriendsTotal,
         o.Type as OType,
         o.data as OData,
         o.Timeinput as OTime,
         a.ID as AID,
         au.UserId as AUserID,
         au.username as AUser,
         a.Type as AType,
         a.data as AData,
         a.Timeinput as ATime,
         if((a.timeinput is not null and a.timeinput>o.timeinput and a.type!=1),a.timeinput,o.timeinput) as OrderTime
         FROM
         '.$this->table['pobj'].' as o
         LEFT JOIN
         '.$this->table['passo'].' as a ON o.ID = a.ObjectID AND a.Status=?';
         $para[] = self::ispublic;
         $sql.=' LEFT JOIN
         '.$this->table['user'].' as au on au.UserID = a.UserID
         INNER JOIN
         '.$this->table['artist'].' as oa on oa.ID = o.ArtistID
         WHERE
         o.Status=?';
         $para[] = AssoModel::ispublic;
         $oid = $this->ID();
         if($oid!=''){
         $sql.= ' AND o.ID = ?';
         $para[] = $oid;
         }
         $sql.=' ORDER BY
         OrderTime Desc';
         if($feeds = $DB->returnRes($sql,$para)){
         foreach($feeds as $feed){
         $return[$feed['OID']]['object'] = array('OID'=>$feed['OID'],'OAName'=>$feed['OAName'],'OAPic'=>$feed['OAPic'],'OALevel'=>$feed['OALevel'],'OAFansTotal'=>$feed['OAFansTotal'],'OAFriendsTotal'=>$feed['OAFriendsTotal'],'OType'=>$feed['OType'],'OData'=>$feed['OData'],'OTime'=>$feed['OTime']);
         if($feed['AID']>0){
         switch($feed['AType']){
         case AssoModel::like:
         //$return[$feed['OID']]['like'][$feed['AID']] = array('AUser'=>$feed['AUser'],'AType'=>$feed['AType'],'AData'=>$feed['AData'],'ATime'=>$feed['ATime']);
         $return[$feed['OID']]['like'][$feed['AUserID']] = array('AUser'=>$feed['AUser']);
         break;
         case AssoModel::comment:
         $return[$feed['OID']]['comment'][$feed['AID']] = array('AUserID'=>$feed['AUserID'],'AUser'=>$feed['AUser'],'AType'=>$feed['AType'],'AData'=>$feed['AData'],'ATime'=>$feed['ATime']);
         break;
         }
        
         }
         //$this->updateRedisPublicObjJson(json_encode($return[$feed['OID']]));
         }
        
         if($isapi){
         $return = json_encode($json);
         }
         return $return;
         }
         */
        
        /*$sql = 'SELECT
         o.ID as OID, a.ID
         FROM PROJECT_POSTOBJECT as o
         LEFT JOIN PROJECT_POSTASSO as a ON o.ID = a.ObjectID AND a.Status=1
        
         and
         a.ID>
         (select ID from PROJECT_POSTASSO
         where ObjectID=o.ID
         order by ID DESC LIMIT 2,1)';*/
    }

    function getLatestPublicFeed($isapi=false,$filter=array()){
        global $DB;

        /*if($return = $this->getredis('PublicPostJson')){
        if($isapi==false){
        $return = json_decode($return);
        }
        return $return;
        }else*/
        {
            return $this->getObject($filter);
        }
    }
    
    function getMyPublicFeed($isapi=false){
    	global $DB;
    
    	/*if($return = $this->getredis('PublicPostJson')){
    	 if($isapi==false){
    	 $return = json_decode($return);
    	 }
    	 return $return;
    	 }else*/
    	{
    		return $this->getObject($filter,'','mypublicfeed');
    	}
    }
    
    function getAjaxViewObject(){
    	$obj = $this->getObject();
    	foreach($obj as $pid=>$v){
    		$v['ajaxview'] = true;
    		//$v['postfullwidth'] = true;
    		$return = Application::In_To_String('object/'.$this->ConstType[$v['object']['OType']],$v);
    	}
    	return array('html'=>$return,'object'=>$obj[$this->ID()]['object']);
    }
    
    function handlBookmarkAction(){
    	global $DB;
    	$status = $this->getPostBookmarkStatus();
    	
    	if(is_array($status)&&isset($status['status'])){
    		$sql = "UPDATE ".$this->table['pbookmark']." SET Status = ? WHERE PostID = ? AND UserID = ?";
    		$status = $status['status']==self::unbookmarked()?self::bookmarked():self::unbookmarked();
    		$para[] = $status;
    		$para[] = $this->ID();
    		$para[] = $_SESSION['user_id'];
    		
    	}else{
    		$sql = "INSERT INTO ".$this->table['pbookmark']." SET PostID = ?, UserID=?, TimeInput = now()";
    		$para = array($this->ID(),$_SESSION['user_id']);
    		$status = self::bookmarked();
    	}
    	
    	
    	if($DB->db_db_query($sql,$para)){
    		return $status;
    	}
    }
    
    
    
    function getPostBookmarkStatus(){
    	global $DB;
    	$sql = "SELECT Status FROM ".$this->table['pbookmark']." WHERE PostID = ? AND UserID = ?";
    	$para = array($this->ID(),$_SESSION['user_id']);
    	if($rec = $DB->returnVec($sql,$para)){
    		return array('status'=>$rec['Status']);
    	}
    }
    
    static function getText($data){
    	$json = json_decode($data);
    	return $json->Text;
    }
    
    static function getImageSrc($data){
    	$json = json_decode($data);
    	return $json->Src;
    }
    
	static function getDesc($data){
    	$json = json_decode($data);
    	return $json->desc;
    }
    static function getThumbnail($data){
    	$json = json_decode($data);
    	return $json->thumbnail;
    }
}

class AssoModel extends ObjectModel {

    const ispublic = 1;
    const isprivate = 0;
    const isreport = -1;
    const isbannded = -2;

    const like = 1;
    const comment = 2;
    const notification = 3;
    
    const active = 1;
    const inactive = 0;
    
    const objnotifyoff = 0;
    const objnotifyon = 1;
    
    const unreadnotify = 1;
    const readnotifiy = 2;
    
    const assonotification = 1;
    const systemeventnotification = 2;
    
    const deletednotification = -1;
    

    private $ID = '';
    private $ObjectID = '';
    private $Type = '';
    private $Data = '';
    private $Status = '';
    private $UserID = '';
    private $TimeInput    = '';
    private $TimeModified = '';
    
    private $NotifyData = '';
    private $NotifyType = '';
    
    private $ObjectUserID = '';

    function __construct(){
        $this->table = dbfield::getTables();
    }

	function active(){
		return self::active;
	}
	
	function inactive(){
		return self::inactive;
	}
	
	function objNotifyOff(){
		return self::objnotifyoff;
	}
    function objNotifyOn(){
		return self::objnotifyon;
	}
	
	function unreadNotify(){
		return self::unreadnotify;
	}
	
	function readNotify(){
		return self::readnotifiy;	
	}
	function assoNotification(){
		return self::assonotification;
	}
    function deletedNotification(){
    	return self::deletednotification;
    }
    function ID(){
        return $this->ID;
    }
    function ObjectID(){
        return $this->ObjectID;
    }
    function notifyData(){
    	return $this->NotifyData;
    }
	function notifyType(){
    	return $this->NotifyType;
    }
    
    function Type(){
        return $this->Type;
    }
    function Data(){
        return $this->Data;
    }
    function Status(){
        return $this->Status;
    }
    function UserID(){
        return $this->UserID;
    }
    function TimeInput(){
        return $this->TimeInput;
    }
    function TimeModified(){
        return $this->TimeModified;
    }
    function ObjectUserID(){
    	return $this->ObjectUserID;
    }

    function setID($id){
        $this->ID = $id;
    }
    function setObjectID($objectid){
        $this->ObjectID = $objectid;
    }
    
    function setType($type){
        $this->Type = $type;
    }
    function setData($data){
        $this->Data = $data;
    }
    function setStatus($status){
        $this->Status = $status;
    }
    function setUserID($userid){
        $this->UserID = $userid;
    }
    function setObjectUserID($userid){
    	$this->ObjectUserID = $userid;
    }
    function setTimeInput($timeinput){
        $this->TimeInput = $timeinput;
    }
    function setTimeModified($timemodified){
        $this->TimeModified = $timemodified;
    }
    function setNotifyData(){
    	//return $this->NotifyData = json_encode(array('type'=>$this->Type()));
    	return $this->NotifyData = $this->Type();
    }
	function setNotifyType($type){
    	return $this->NotifyType = $type;
    }
    function packData(){
        $type = $this->Type();
        $arr = array();
        switch($type){
            case self::comment:
                $arr['Text'] = $this->Data();
                break;
            case self::like:
                $arr['Text'] = '';
                break;
        }
        return json_encode($arr);
    }

    function postAsso(){
        global $DB;
        //$this->updateRedisLastObjID();
        $data = $this->packData();

        $sql = 'INSERT INTO
       				'.$this->table['passo'].'
        		SET
        			ObjectID = ?,
			        Type = ?,
			        Data = ?,
			        Status = ?,
			        UserID = ?,
			        Timeinput    = now(),
			        Timemodified = now()';

        $para = array($this->ObjectID(),$this->Type(),$data,$this->Status(),$this->UserID());

        return $DB->db_db_query($sql,$para);

        //$this->updateRedisPublicObjJson($post);
        $this->setRedis('PublicPostHtml',$Data,1);
    }
    
    function hasSuchAssoType(){
    	global $DB;
    	
    	$sql = 'SELECT ID,Status FROM '.$this->table['passo'].' WHERE ObjectID = ? AND Type = ? AND UserID = ?';
    	$para = array($this->ObjectID(),$this->Type(),$this->UserID());
    	return $DB->returnVec($sql,$para);
    		
    }
    
    function toggleAsso(){
    	global $DB;
    	if($rec = $this->hasSuchAssoType()){
			$sql = 'UPDATE
       					'.$this->table['passo'].'
        			SET
	        			Status = ?,
				        Timemodified = now()
       				WHERE
       					ID =? AND UserID = ? AND Type = ?';
			$para = array();
			if($rec['Status']==self::active())
				$para[] = self::inactive();
			else{
				$para[] = self::active();
				$notify=true;
			}
			
			$para[] = $rec['ID'];
        	$para[] = $this->UserID();
        	$para[] = $this->Type();
        	
			return array($DB->db_db_query($sql,$para),$notify);
    	}else{
    		return array($this->postAsso(),true);
    	}
    }
    
    function hasSuchNotification(){
    	global $DB;
    	$sql = "SELECT ID FROM ".$this->table['notification']." WHERE ObjectID = ? AND Data = ? AND Type = ? AND UserID = ?";
    	$para[] = $this->ObjectID();
    	$para[] = $this->notifyData();
    	$para[] = $this->notifyType();
    	$para[] = $this->UserID();
    	return $DB->returnVec($sql,$para); 
    }
    
    function insertNotify(){
    	global $DB;
    	
    	if($this->notifyData()==self::like){ // if it's like, check existance, don't notify again
    		if($this->hasSuchNotification()){
    			return false;
    		}
    	}
    	
    	$sql = "INSERT INTO 
    				".$this->table['notification']."
    			SET
    				ObjectID = ?,
    				ObjectUserID = ?,
    				Data = ?,
    				Type = ?,
    				Status = ?,
    				UserID = ?,
    				Issuer = ?,
    				Timeinput = now()
				";
    	// don't notify myself
    	if($this->ObjectUserID()!=$_SESSION['user_id']){
	    	$para[] = $this->ObjectID();
	    	$para[] = $this->ObjectUserID();
	    	$para[] = $this->notifyData();
	    	$para[] = $this->notifyType();
	    	$para[] = self::unreadNotify();
	    	$para[] = $this->ObjectUserID();
	    	$para[] = $this->UserID();
	    	if($DB->db_db_query($sql,$para)){
	    		//do redis publish
	    	}
    	}
    	if($assouser = $this->getPostAssoUser4Notify()){
    		foreach($assouser as $user){
    			$para = array();
    			$para[] = $this->ObjectID();
		    	$para[] = $this->ObjectUserID();
		    	$para[] = $this->notifyData();
		    	$para[] = $this->notifyType();
		    	$para[] = self::unreadNotify();
		    	$para[] = $user['UserID'];
		    	$para[] = $this->UserID();
		    	if($DB->db_db_query($sql,$para)){
	    		//do redis publish
    			}		
    		}
    	}
    	
    }
    
    function getPostAssoUser4Notify(){
    	global $DB;
    	
    	$sql = "SELECT distinct UserID FROM ".$this->table['passo']." WHERE ObjectID = ? AND Type != ? AND UserID !=? AND UserID!=? AND Notify = ?";
    	$para = array($this->ObjectID(),self::like,$this->ObjectUserID(),$_SESSION['user_id'],self::objNotifyOn());
    	return $DB->returnRes($sql,$para);
    }
    
    function getNotificationItem(){
    	global $DB,$CONFIG;
    	$sql = "SELECT 
    				n.ID,n.ObjectID,".dbfield::getUsername('u','RealName').", n.Data,n.Type,n.Issuer,n.TimeInput,n.Status,n.ObjectUserID 
    			FROM 
    				".$this->table['notification']." as n
    			INNER JOIN
    				".$this->table['user']." as u
    			ON
    				  u.UserID = n.Issuer 
    			 WHERE n.UserID = ? AND n.Status != ? ORDER BY n.TimeInput DESC LIMIT ".$CONFIG['notificationmenurecord'];
    	
    	$para[] = $_SESSION['user_id'];
    	$para[] = $this->deletedNotification();
    	
    	return $DB->returnRes($sql,$para);
    }
    
    function getUnreadNotification(){
    	global $DB;
    	$sql = "SELECT count(*) as total FROM ".$this->table['notification']." WHERE UserID = ? AND Status=?";
    	
    	$para[] = $_SESSION['user_id'];
    	$para[] = $this->unreadNotify();
    	if($rec = $DB->returnVec($sql,$para)){
    		return $rec['total']; 
    	}
    }
    
    function readAllNotification($maxid){
    	global $DB;
    	
    	$sql = "UPDATE ".$this->table['notification']." SET Status = ? WHERE UserID = ? AND Status=? AND ID<=?";
    	$para[] = $this->readNotify();
    	$para[] = $_SESSION['user_id'];
    	$para[] = $this->unreadNotify();
    	$para[] = $maxid;
    	
    	return $DB->db_db_query($sql,$para);
    }
    
    function willBeNotified(){
    	global $DB;
    	if($this->ObjectID()){
    		//in this object, any asso set to notified
    		//$sql = "SELECT ID FROM ".$this->table['passo']." WHERE ObjectID = ? AND UserID = ? And Status = ? AND ((Type= ?  AND Notify = ?) or (Type=?))";
    		//$para = array($this->ObjectID(),$_SESSION['user_id'],self::active(),self::comment,self::objNotifyOn(),self::notification);
    		
    		$sql = "SELECT ID,Type,Notify FROM ".$this->table['passo']." WHERE ObjectID = ? AND UserID = ? And Status = ? AND Type in (?,?)";
    		$para = array($this->ObjectID(),$_SESSION['user_id'],self::active(),self::comment,self::notification);
    		if($recs = $DB->returnRes($sql,$para)){
    			
    			foreach($recs as $rec){
    				if($rec['Notify']==self::objNotifyOn()){
	    				return true;
    				}
    			}
    			return false;
    		}else{
    			return 'norecord';
    		}
    	}
    }
    
	function handleNotificationToggle(){
		global $DB;
		$sql = "UPDATE ".$this->table['passo']." SET Notify = ? WHERE ObjectID = ? AND UserID = ? And Status = ?";
		$para = array();
		$notify = $this->willBeNotified(); 
		
    	if($notify==='norecord'){

    		//$this->ObjectID(),$this->Type(),$data,$this->Status(),$this->UserID()
    		$this->setType(self::notification);
    		$this->setStatus(ObjectModel::ispublic);
    		$this->setUserID($_SESSION['user_id']);
    		return $this->postAsso();
    	}elseif($notify==true){
    		$para[] = self::objNotifyOff();
    	}else{
    		$para[] = self::objNotifyOn();
    	}
    	$para[] = $this->ObjectID();
    	$para[] = $_SESSION['user_id'];
    	$para[] = self::active();
    	
    	return $DB->db_db_query($sql,$para);
    }
}
?>