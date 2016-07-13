<?php

if ($_SERVER['PHP_AUTH_USER'] != 'admin' or $_SERVER['PHP_AUTH_PW'] != 'kelhbb14') {
	$realm = "Administrator Login";
	Header("WWW-Authenticate: Basic realm=\"".$realm."\"");
	Header("HTTP/1.0 401 Unauthorized");
	echo "Unauthorized Access\n";
	exit;
}

//ini_set('display_errors',1);
//error_reporting(-1);
//bool checkdnsrr ( string $host [, string $type = "MX" ] )
//$result = dns_get_record("ronnieho.com"); 
//print_r($result);
//die;
session_start();
// if($_SERVER['HTTP_X_REQUESTED_WITH']!='XMLHttpRequest' ){
// $time = microtime();
// $time = explode(' ', $time);
// $time = $time[1] + $time[0];
// $start = $time;
// }

//include_once('include/php/error_handler.php');

//set_error_handler('nettuts_error_handler');



include_once('config/config.php');
//include_once('include/lang/admin_zh.php');
include_once('include/lang/jp.php');
include_once('application/controller/uielement_controller.php');

include_once('include/php/lib.php');
include_once('include/tools/predis/src/Autoloader.php');
include_once('include/php/libredis.php');
//if (!function_exists('json_encode')){
	//include_once('include/php/json_function.php');
//}
include_once('include/php/libdb.php');
include_once('application_base.php');

if(isLoggedIn()){
	setCookies();
}

$DB = new database();
$DB->open_db();

//$REDIS = new redis();
//$REDIS->open_redis();

/*$mkv = array(
    'uid:0001' => '1st user',
    'uid:0002' => '2nd user',
    'uid:0003' => '3rd user',
);

$REDIS->client->del('name');
$response = $REDIS->client->get('name');
print_R($response);
die;

Predis\Autoloader::register();
		    

$client = new Predis\Client();
$mkv = array(
    'uid:0001' => '1st user',
    'uid:0002' => '2nd user',
    'uid:0003' => '3rd user',
);
//$client->mset($mkv);
$response = $client->mget(array_keys($mkv));
print_r($response);
die;*/



$_SESSION['current_ip'] = get_ip();
$_SESSION['ua']			= get_ua();
if($_SESSION['current_ip']==''||$_SESSION['ua']=='')
	MVC_Perform_Action("error", "Raise_Error", NULL, array($Lang['no_access_right']));

Get_Application_Setting();

if($_GET['ctr']==''){
	$ctr = 'page/index';
}else{
	$ctr = str_replace('favicon.ico','',$_GET['ctr']);// strange behaviour, in chrome
}
$control_arr = explode("/",$ctr);
$args['controller'] = strtolower($control_arr[0]); 
$args['method'] = strtolower($control_arr[1]);

if($control_arr[1]!='mypage' && $control_arr[1]!='ajax_scrollpagination'){
	$args['args'][] = strtolower($control_arr[1]);
	$args['args'][] = strtolower($control_arr[2]);
}
switch($args['controller']){
	case 'login':
		$args['controller'] = 'user';
		if($args['method']==''){
			$args['method'] = 'login';
		}
		break;
	case 'logout':
			$args['controller'] = 'user';
			$args['method'] = 'logout';
		break;
	case 'setting':
			$args['controller'] = 'user';
			$args['method'] = 'setting';
		break;	
	case 'page':
		if($args['method']=='mypage'){
			$_MENU['mypage'] = true;
		}elseif($args['method']=='saved'){
			$_MENU['saved'] = true;
			$args['method'] = 'saved';
		}elseif($args['method']=='post'){
			$args['method'] = 'post';
		}elseif($args['method']=='notification'){
			$args['method'] = 'notification';
		}
		//elseif($args['method']!='index' && $args['method']!='ajax_scrollpagination'&& $args['method']!='ajax_viewpost'&& $args['method']!='ajax_getpostddmlist'){
		elseif($args['method']!='index' && substr($args['method'],0,5)!='ajax_'){
			$args['method'] = 'profile';
			$_MENU['mypage'] = true;
		}else{
			$_MENU['home'] = true;
		}
		
	break;
	case 'myfeed':
		$args['controller'] = 'page';
		$args['method'] = 'myfeed';
		$_MENU['myfeed'] = true;
	break;
	case 'qrcode':
		$args['controller'] = 'page';
		$args['method'] = 'qrcode';
	break;
	case 'library':
		$args['controller'] = 'page';
		$args['method'] = 'library';
		$_MENU['library'] = true;
	break;
	case 'action': // change to node.js
	break;
	case 'user':
	break;
	case 'event':
	break;
	case 'settings';
	break;
	default:
		header("location:/404.html");
	die;
	
}

$application = new Application($args);
	
	

if($args['controller']=='404'){
	MVC_Perform_Action("error", "Raise_Error", NULL, array($Lang['Corp']['Error']['PageNotExists']));
}

$application->Load_Controller();

/*
if(in_array($args['controller'],$CONFIG['backend_controller'])){
	
	$_SESSION['request'] = 'back';
	
	$method_to_skip = array('login','logout');
	
	if(!in_array($args['method'],$method_to_skip)){
		//validateToken();
		MVC_Perform_Action("access", "Check_Access_Right", NULL, array($args['controller'], $args['method'], true));
		
	}
}else{
	
	$_SESSION['request'] = 'front';
	
	$act_arr = explode("/",$_GET['ctr']);
	$site_name = array_shift($act_arr);
	
	if($site_info = MVC_Perform_Action("access", "Get_Site_Byname", NULL, array($site_name))){
	
		$_SESSION['site_id'] = $site_info['SiteID'];
		$args['controller'] = $act_arr[0];
		$args['method'] = $act_arr[1];
	}else{
		die('??');
	}
}
*/





//$a->close_db();

//if ($_REQUEST["IsAjax"] != "1")
//Debug_Get_Benchmark();

// if($_SERVER['HTTP_X_REQUESTED_WITH']!='XMLHttpRequest' ){
// 	$time = microtime();
// 	$time = explode(' ', $time);
// 	$time = $time[1] + $time[0];
// 	$finish = $time;
// 	$total_time = round(($finish - $start), 4);
// 	//echo 'Page generated in '.$total_time.' seconds.';
// }

$DB->close_db();
?>
