<?php 
ini_set('memory_limit', '128M');
date_default_timezone_set('Hongkong');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
error_reporting(E_ERROR | E_WARNING | E_PARSE);

$CONFIG['home_http'] = 'http://localhost/~kelvin/maruon/dev/';
$CONFIG['home_path'] = '/Users/kelvin/Sites/maruon/dev/';
$CONFIG['theme'] = 'basic';
$CONFIG['asset'] = 'social';
$CONFIG['accessfile_path'] = $CONFIG['home_path'].'config/access.json';
$CONFIG['spacefolder'] = $CONFIG['home_path'].'spacex/';

if(is_file($CONFIG['accessfile_path'])==false||is_dir($CONFIG['spacefolder'])==false)
	die('please run setup');

$CONFIG['site_title']['jp'] = "Mauron";
$CONFIG['site_desc']['jp'] = "Mauron - みんなSNS音楽サイト";


$CONFIG['site_footer'] = "<strong>Mauron</strong> &copy; Copyright 2016";
$CONFIG['backend_site_title'] = "Mauron";
$CONFIG['backend_footer'] = 'Powered by <a href="mailto:enquiry@innobutton.com">Innobutton Creative Lab</a> &copy;';

$CONFIG['db_name'] = "kelvin_maruondev";
$CONFIG['db_login'] = "root";
$CONFIG['db_host'] 	= "localhost";
$CONFIG['db_password'] = 'kelhbb14';
$CONFIG['db_table_prefix'] = "PROJECT_";
//$CONFIG['recaptcha_publickey'] = '6LesY-kSAAAAAEEjUN5ZEteym8B6LOrgvil7aJnB';
//$CONFIG['recaptcha_privatekey'] = '6LesY-kSAAAAAOpHB2qtxrkLPg7Y0GwNN1Qibv3y ';
$CONFIG['googleapikey'] = 'AIzaSyCJU3lfQ1fwdJFOhNiK82rOa3qfVPB_mmY';
$CONFIG['default_lang'] = 'jp';

$CONFIG['postcommentpreload'] = 0;
$CONFIG['notificationmenurecord'] = 15;
$CONFIG['socket_secret'] = 'MySecretKey12345';
$CONFIG['auth_secret'] = 'MySecretKey12345';
$CONFIG['jwt_secret'] = '1234567890123456';


$CONFIG['img_mime_type'] = array('image/jpg','image/jpeg','image/gif','image/png');


/*$CONFIG['file_mime_type']['doc'] = array('application/msword');
$CONFIG['file_mime_type']['docx'] = array('application/vnd.openxmlformats-officedocument.wordprocessingml.document');
$CONFIG['file_mime_type']['pdf'] = array('application/pdf');
$CONFIG['file_mime_type']['ppt'] = array('application/powerpoint','application/mspowerpoint','application/mspowerpoint');
$CONFIG['file_mime_type']['xls'] = array('application/excel','application/vnd.ms-excel','application/x-excel','application/x-msexcel');
$CONFIG['file_mime_type']['txt'] = array('text/plain');
$CONFIG['file_mime_type']['zip'] = array('application/x-compressed','application/x-zip-compressed','application/zip','multipart/x-zip');
$CONFIG['file_mime_type']['css'] = array('application/x-pointplus','text/css');
$CONFIG['file_mime_type']['avi'] = array('application/x-troff-msvideo','video/avi','video/msvideo','video/x-msvideo');
$CONFIG['file_mime_type']['mov'] = array('video/quicktime');
$CONFIG['file_mime_type']['mp3'] = array('audio/mpeg3','audio/x-mpeg-3','video/mpeg','video/x-mpeg');
$CONFIG['file_mime_type']['asf'] = array('video/x-ms-asf');
$CONFIG['file_mime_type']['wmv'] = array('video/x-ms-asf');*/
$CONFIG['image_mime_type'] = array('image/jpg','image/jpeg','image/gif','image/png');


$CONFIG['allowstorage']['10gb'] = '10737418240';
$CONFIG['allowstorage']['2gb'] = '2147483648';
$CONFIG['allowstorage']['1gb'] = '1073741824';
$CONFIG['allowstorage']['500mb'] = '524288000';
$CONFIG['allowstorage']['10mb'] = '10485760';



$CONFIG['upload']['library']['maxsize'] = 20485760; //byte, 20 MB
$CONFIG['upload']['library']['folder'] = $CONFIG['spacefolder'].'library/';
$CONFIG['upload']['library']['url'] = $CONFIG['home_http'].'spacex/library/';
$CONFIG['upload']['library']['mime'] = $CONFIG['image_mime_type'];
/*foreach($CONFIG['file_mime_type'] as $mime=>$v){
	$CONFIG['upload']['library']['mime'] = array_merge($CONFIG['upload']['library']['mime'],$CONFIG['file_mime_type'][$mime]);
}*/

$CONFIG['imageresizewidth'] = '450';

$CONFIG['filestorage'] = $CONFIG['allowstorage']['10mb'];
//$CONFIG['filestorage'] = $CONFIG['allowstorage']['500mb'];


$CONFIG['indexfeed']['rpp'] = 12;

$CONFIG['upload']['post']['maxsize'] = 10485760; //byte, 10 MB
$CONFIG['upload']['post']['folder'] = $CONFIG['spacefolder'].'post/';
$CONFIG['upload']['post']['url'] = $CONFIG['home_http'].'spacex/post/';
$CONFIG['upload']['post']['mime'] = $CONFIG['image_mime_type'];
$CONFIG['upload']['post']['duration'] = 60;

$CONFIG['upload']['profileimage']['maxsize'] = 10485760; //byte, 10 MB
$CONFIG['upload']['profileimage']['folder'] = $CONFIG['spacefolder'].'profile/';
$CONFIG['upload']['profileimage']['url'] = $CONFIG['home_http'].'spacex/profile/';
$CONFIG['upload']['profileimage']['mime'] = $CONFIG['image_mime_type'];
$CONFIG['upload']['profileimage']['dimension'] = array('1'=>50,'2'=>70,'3'=>120,'4'=>200);
$CONFIG['upload']['profileimage']['placeholder'] = $CONFIG['home_http'].'theme/assets/'.$CONFIG['asset'].'/images/userplaceholder.jpg';

$CONFIG['postimageplaceholder'] = $CONFIG['home_http'].'theme/assets/'.$CONFIG['asset'].'/images/userplaceholder.jpg';

$CONFIG['post']['lentohide'] = 300;

$CONFIG['google_api_path'] = $CONFIG['home_path'].'include/tools/google-api-php-client-master/src/';


$CONFIG['youtube']['defaultimg'] = 'http://img.youtube.com/vi/<insert-youtube-video-id-here>/default.jpg';

//For the high quality version of the thumbnail use a url similar to this:
$CONFIG['youtube']['hdimg'] = 'http://img.youtube.com/vi/<!--id-->/hqdefault.jpg';

//There is also a medium quality version of the thumbnail, using a url similar to the HQ:
$CONFIG['youtube']['medimg'] = 'http://img.youtube.com/vi/<!--id-->/mqdefault.jpg';

//For the standard definition version of the thumbnail, use a url similar to this:
$CONFIG['youtube']['thumbtimg'] = 'http://img.youtube.com/vi/<!--id-->/sddefault.jpg';

//For the maximum resolution version of the thumbnail use a url similar to this:
$CONFIG['youtube']['maxtimg'] = 'http://img.youtube.com/vi/<!--id-->/maxresdefault.jpg';

$CONFIG['post_share'] = array(array('facebook','Facebook'),array('twitter','Twitter'));
?>