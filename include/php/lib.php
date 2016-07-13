<?php

/**
 * PARAM_ALPHA - contains only english ascii letters a-zA-Z.
 */
define ( 'PARAM_ALPHA', 'alpha' );

/**
 * PARAM_ALPHAEXT the same contents as PARAM_ALPHA plus the chars in quotes: "_-" allowed
 * NOTE: originally this allowed "/" too, please use PARAM_SAFEPATH if "/" needed
 */
define ( 'PARAM_ALPHAEXT', 'alphaext' );

/**
 * PARAM_ALPHANUM - expected numbers and letters only.
 */
define ( 'PARAM_ALPHANUM', 'alphanum' );

/**
 * PARAM_ALPHANUMEXT - expected numbers, letters only and _-.
 */
define ( 'PARAM_ALPHANUMEXT', 'alphanumext' );

/**
 * PARAM_AUTH - actually checks to make sure the string is a valid auth plugin
 */
define ( 'PARAM_AUTH', 'auth' );

/**
 * PARAM_BASE64 - Base 64 encoded format
 */
define ( 'PARAM_BASE64', 'base64' );

/**
 * PARAM_BOOL - converts input into 0 or 1, use for switches in forms and urls.
 */
define ( 'PARAM_BOOL', 'bool' );

/**
 * PARAM_CAPABILITY - A capability name, like 'moodle/role:manage'.
 * Actually
 * checked against the list of capabilities in the database.
 */
define ( 'PARAM_CAPABILITY', 'capability' );

/**
 * PARAM_CLEANHTML - cleans submitted HTML code.
 * Note that you almost never want
 * to use this. The normal mode of operation is to use PARAM_RAW when recieving
 * the input (required/optional_param or formslib) and then sanitse the HTML
 * using format_text on output. This is for the rare cases when you want to
 * sanitise the HTML on input. This cleaning may also fix xhtml strictness.
 */
define ( 'PARAM_CLEANHTML', 'cleanhtml' );

/**
 * PARAM_EMAIL - an email address following the RFC
 */
define ( 'PARAM_EMAIL', 'email' );

/**
 * PARAM_FILE - safe file name, all dangerous chars are stripped, protects against XSS, SQL injections and directory traversals
 */
define ( 'PARAM_FILE', 'file' );

/**
 * PARAM_FLOAT - a real/floating point number.
 *
 * Note that you should not use PARAM_FLOAT for numbers typed in by the user.
 * It does not work for languages that use , as a decimal separator.
 * Instead, do something like
 * $rawvalue = required_param('name', PARAM_RAW);
 * // ... other code including require_login, which sets current lang ...
 * $realvalue = unformat_float($rawvalue);
 * // ... then use $realvalue
 */
define ( 'PARAM_FLOAT', 'float' );

/**
 * PARAM_HOST - expected fully qualified domain name (FQDN) or an IPv4 dotted quad (IP address)
 */
define ( 'PARAM_HOST', 'host' );

/**
 * PARAM_INT - integers only, use when expecting only numbers.
 */
define ( 'PARAM_INT', 'int' );

define ( 'PARAM_DATE', 'date' );

/**
 * PARAM_LANG - checks to see if the string is a valid installed language in the current site.
 */
define ( 'PARAM_LANG', 'lang' );

/**
 * PARAM_LOCALURL - expected properly formatted URL as well as one that refers to the local server itself.
 * (NOT orthogonal to the
 * others! Implies PARAM_URL!)
 */
define ( 'PARAM_LOCALURL', 'localurl' );

/**
 * PARAM_NOTAGS - all html tags are stripped from the text.
 * Do not abuse this type.
 */
define ( 'PARAM_NOTAGS', 'notags' );

/**
 * PARAM_PATH - safe relative path name, all dangerous chars are stripped, protects against XSS, SQL injections and directory
 * traversals note: the leading slash is not removed, window drive letter is not allowed
 */
define ( 'PARAM_PATH', 'path' );

/**
 * PARAM_PEM - Privacy Enhanced Mail format
 */
define ( 'PARAM_PEM', 'pem' );

/**
 * PARAM_PERMISSION - A permission, one of CAP_INHERIT, CAP_ALLOW, CAP_PREVENT or CAP_PROHIBIT.
 */
define ( 'PARAM_PERMISSION', 'permission' );

/**
 * PARAM_RAW specifies a parameter that is not cleaned/processed in any way except the discarding of the invalid utf-8 characters
 */
define ( 'PARAM_RAW', 'raw' );

/**
 * PARAM_RAW_TRIMMED like PARAM_RAW but leading and trailing whitespace is stripped.
 */
define ( 'PARAM_RAW_TRIMMED', 'raw_trimmed' );

/**
 * PARAM_SAFEDIR - safe directory name, suitable for include() and require()
 */
define ( 'PARAM_SAFEDIR', 'safedir' );

/**
 * PARAM_SAFEPATH - several PARAM_SAFEDIR joined by "/", suitable for include() and require(), plugin paths, etc.
 */
define ( 'PARAM_SAFEPATH', 'safepath' );

/**
 * PARAM_SEQUENCE - expects a sequence of numbers like 8 to 1,5,6,4,6,8,9.
 * Numbers and comma only.
 */
define ( 'PARAM_SEQUENCE', 'sequence' );

/**
 * PARAM_TAG - one tag (interests, blogs, etc.) - mostly international characters and space, <> not supported
 */
define ( 'PARAM_TAG', 'tag' );

/**
 * PARAM_TAGLIST - list of tags separated by commas (interests, blogs, etc.)
 */
define ( 'PARAM_TAGLIST', 'taglist' );

/**
 * PARAM_TEXT - general plain text compatible with multilang filter, no other html tags.
 * Please note '<', or '>' are allowed here.
 */
define ( 'PARAM_TEXT', 'text' );

/**
 * PARAM_THEME - Checks to see if the string is a valid theme name in the current site
 */
define ( 'PARAM_THEME', 'theme' );

/**
 * PARAM_URL - expected properly formatted URL.
 * Please note that domain part is required, http://localhost/ is not accepted but
 * http://localhost.localdomain/ is ok.
 */
define ( 'PARAM_URL', 'url' );

/**
 * PARAM_USERNAME - Clean username to only contains allowed characters.
 * This is to be used ONLY when manually creating user
 * accounts, do NOT use when syncing with external systems!!
 */
define ( 'PARAM_USERNAME', 'username' );

/**
 * PARAM_STRINGID - used to check if the given string is valid string identifier for get_string()
 */
define ( 'PARAM_STRINGID', 'stringid' );

// DEPRECATED PARAM TYPES OR ALIASES - DO NOT USE FOR NEW CODE.
/**
 * PARAM_CLEAN - obsoleted, please use a more specific type of parameter.
 * It was one of the first types, that is why it is abused so much ;-)
 * 
 * @deprecated since 2.0
 */
define ( 'PARAM_CLEAN', 'clean' );

/**
 * PARAM_INTEGER - deprecated alias for PARAM_INT
 * 
 * @deprecated since 2.0
 */
define ( 'PARAM_INTEGER', 'int' );

/**
 * PARAM_NUMBER - deprecated alias of PARAM_FLOAT
 * 
 * @deprecated since 2.0
 */
define ( 'PARAM_NUMBER', 'float' );

/**
 * PARAM_ACTION - deprecated alias for PARAM_ALPHANUMEXT, use for various actions in forms and urls
 * NOTE: originally alias for PARAM_APLHA
 * 
 * @deprecated since 2.0
 */
define ( 'PARAM_ACTION', 'alphanumext' );

/**
 * PARAM_FORMAT - deprecated alias for PARAM_ALPHANUMEXT, use for names of plugins, formats, etc.
 * NOTE: originally alias for PARAM_APLHA
 * 
 * @deprecated since 2.0
 */
define ( 'PARAM_FORMAT', 'alphanumext' );

/**
 * PARAM_MULTILANG - deprecated alias of PARAM_TEXT.
 * 
 * @deprecated since 2.0
 */
define ( 'PARAM_MULTILANG', 'text' );

/**
 * PARAM_TIMEZONE - expected timezone.
 * Timezone can be int +-(0-13) or float +-(0.5-12.5) or
 * string separated by '/' and can have '-' &/ '_' (eg. America/North_Dakota/New_Salem
 * America/Port-au-Prince)
 */
define ( 'PARAM_TIMEZONE', 'timezone' );

/**
 * PARAM_CLEANFILE - deprecated alias of PARAM_FILE; originally was removing regional chars too
 */
define ( 'PARAM_CLEANFILE', 'file' );

/**
 * PARAM_COMPONENT is used for full component names (aka frankenstyle) such as 'mod_forum', 'core_rating', 'auth_ldap'.
 * Short legacy subsystem names and module names are accepted too ex: 'forum', 'rating', 'user'.
 * Only lowercase ascii letters, numbers and underscores are allowed, it has to start with a letter.
 * NOTE: numbers and underscores are strongly discouraged in plugin names!
 */
define ( 'PARAM_COMPONENT', 'component' );

/**
 * PARAM_AREA is a name of area used when addressing files, comments, ratings, etc.
 * It is usually used together with context id and component.
 * Only lowercase ascii letters, numbers and underscores are allowed, it has to start with a letter.
 */
define ( 'PARAM_AREA', 'area' );

/**
 * PARAM_PLUGIN is used for plugin names such as 'forum', 'glossary', 'ldap', 'radius', 'paypal', 'completionstatus'.
 * Only lowercase ascii letters, numbers and underscores are allowed, it has to start with a letter.
 * NOTE: numbers and underscores are strongly discouraged in plugin names! Underscores are forbidden in module names.
 */
define ( 'PARAM_PLUGIN', 'plugin' );


function print_error($reason){
	global $Lang;
	if($_SERVER['HTTP_X_REQUESTED_WITH']=='XMLHttpRequest' ){
		echo json_encode(array('status'=>'error','msg'=>$Lang[$reason]));		
		die;
	}else{
		die($Lang[$reason]);
	}
	
}

function lastDateOfMonth() {
	return date ( 't' );
}
function fmt_datetime($d, $time = false, $second = true) {
	return $d ? date ( ($time ? ($second ? 'Y-m-d H:i:s' : 'Y-m-d H:i') : 'Y-m-d'), strtotime ( $d ) ) : '';
}
function Gen_Notification_Sys($word, $val_arr) {
	for($a = 0; $a < sizeof ( $val_arr ); $a ++) {
		$word = str_replace ( '[%V' . ($a + 1) . '%]', $val_arr [$a], $word );
	}
	return $word;
}
function Display_Notification_Msg($title, $content, $class, $timeout = 0) {
	$return = "setTimeout(function () {
				$.gritter.add({
			    title: '<i class=\"" . $class . "\"></i>  <b>" . $title . "</b>',
			    text: '" . addslashes ( $content ) . "',
			    sticky: false,
				time: 4000,
			    class_name: 'my-sticky-class'
			});
	}, " . $timeout . ");\n";
	
	return $return;
}

/*function is_sa() {
	return $_SESSION ['role_id'] == 1;
}*/







function get_ua(){
	return $_SERVER['HTTP_USER_AGENT'];	
}


function get_ip() {
	
	if (isset($_SERVER['HTTP_CLIENT_IP']) && is_real_ip ( $_SERVER['HTTP_CLIENT_IP'] )) {
		return $_SERVER ['HTTP_CLIENT_IP'];
	}
	if(isset($_SERVER ['HTTP_X_FORWARDED_FOR'])){
		foreach ( explode ( ',', $_SERVER ['HTTP_X_FORWARDED_FOR'] ) as $ip ) {
			$ip = trim ( $ip );
			if (is_real_ip ( $ip ))
				return $ip;
		}
	}
	if (isset($_SERVER ['HTTP_X_FORWARDED']) && is_real_ip ( $_SERVER ['HTTP_X_FORWARDED'] )) {
		return $_SERVER ['HTTP_X_FORWARDED'];
	} elseif (isset($_SERVER ['HTTP_X_CLUSTER_CLIENT_IP']) && is_real_ip ( $_SERVER ['HTTP_X_CLUSTER_CLIENT_IP'] )) {
		return $_SERVER ['HTTP_X_CLUSTER_CLIENT_IP'];
	} elseif (isset($_SERVER ['HTTP_FORWARDED_FOR']) && is_real_ip ( $_SERVER ['HTTP_FORWARDED_FOR'] )) {
		return $_SERVER ['HTTP_FORWARDED_FOR'];
	} elseif (isset($_SERVER ['HTTP_FORWARDED']) && is_real_ip ( $_SERVER ['HTTP_FORWARDED'] )) {
		return $_SERVER ['HTTP_FORWARDED'];
	} else {
		return $_SERVER ['REMOTE_ADDR'];
	}
}
function is_real_ip($ip) {
	if (! empty ( $ip ) && ip2long ( $ip ) != - 1 && ip2long ( $ip ) != false) {
		$private_ips = array (
				array (
						'0.0.0.0',
						'0.255.255.255' 
				),
				array (
						'10.0.0.0',
						'10.255.255.255' 
				),
				array (
						'127.0.0.0',
						'127.255.255.255' 
				),
				array (
						'169.254.0.0',
						'169.254.255.255' 
				),
				array (
						'172.16.0.0',
						'172.31.255.255' 
				),
				array (
						'192.0.2.0',
						'192.0.2.255' 
				),
				array (
						'192.168.0.0',
						'192.168.255.255' 
				),
				array (
						'255.255.255.0',
						'255.255.255.255' 
				) 
		);
		
		foreach ( $private_ips as $r ) {
			$min = ip2long ( $r [0] );
			$max = ip2long ( $r [1] );
			if (ip2long ( $ip ) >= $min && ip2long ( $ip ) <= $max)
				return false;
		}
		return true;
	} else {
		return false;
	}
}
function get_mime_type($filepath) {
	$mime_type = '';
	if (extension_loaded ( 'fileinfo' )) { // php 5.3
		$finfo = finfo_open ( FILEINFO_MIME_TYPE );
		$mime_type = finfo_file ( $finfo, $filepath );
		finfo_close ( $finfo );
	} else { // deprecated
		$mime_type = mime_content_type ( $filepath );
	}
	return $mime_type;
}
function sendmail($email_from, $email_to, $subject, $msg, $ishtml = false, $cc = null, $bcc = null) {
	global $_CONFIG, $_PAGE;
	
	require_once 'class.phpmailer.php'; // must use require_once, don't use require
	
	$mail = new PHPMailer ( true );
	$mail->IsSMTP ();
	$mail->CharSet = 'UTF-8';
	$mail->SMTPAuth = true;
	$mail->SMTPSecure = 'ssl';
	$mail->Host = 'smtp.gmail.com';
	$mail->Port = 465;
	$mail->Username = $_CONFIG ['smtp_user'];
	$mail->Password = $_CONFIG ['smtp_pw'];
	
	if ($ishtml)
		$mail->IsHTML ( true );
	
	if (is_array ( $email_from )) {
		$mail->SetFrom ( $email_from ['email'], $email_from ['name'] );
	} else {
		$mail->SetFrom ( $email_from, $_CONFIG ['mail_name'] );
	}
	if (is_array ( $email_to )) {
		$mail->AddAddress ( $email_to ['email'], $email_to ['name'] );
	} else {
		$mail->AddAddress ( $email_to );
	}
	if (! empty ( $cc )) {
		if (is_array ( $cc )) {
			$mail->AddCC ( $cc ['email'], $cc ['name'] );
		} else {
			$mail->AddCC ( $cc );
		}
	}
	if (! empty ( $bcc )) {
		if (is_array ( $bcc )) {
			$mail->AddBCC ( $bcc ['email'], $bcc ['name'] );
		} else {
			$mail->AddBCC ( $bcc );
		}
	}
	$mail->Subject = $subject;
	$mail->Body = $msg;
	
	$rtn = false;
	$max_retry = 2;
	$try = 0;
	while ( $try <= $max_retry ) {
		try {
			$try ++;
			if ($rtn = $mail->Send ())
				break;
		} catch ( Exception $e ) {
			if ($try > $max_retry) {
				if ($_PAGE ['interface'] == 'ai')
					echo $e->getMessage () . ' (retry=' . $try . ')';
					
					// log mail error
				writelog ( 'mail', $e->getMessage () );
			}
		}
	}
	return $rtn;
}

// utf8 sorting is not good in both PHP & MySQL, use this function to make it more realistic
function realsort($arr, $curr_encoding = "UTF-8") {
	require 'big5.php';
	
	$eng_arr = array ();
	$chi_arr = array ();
	
	foreach ( $arr as $k => $v ) {
		if (strtoupper ( $curr_encoding ) != "UTF-8") {
			// change the words to UTF-8 encoding anyway
			// we can use iconv to do it, but mb_convert_encoding seem gives a better encode result
			// (iconv may give an encode result have a question mark "?" for some chinese charater)
			$v ["name"] = mb_convert_encoding ( $v ["name"], 'UTF-8', $curr_encoding );
		}
		
		$firstChr = substr ( $v ["name"], 0, 1 );
		if (ord ( $firstChr ) < 128) { // character on the keyboard (alphabet,english char,symbol etc)
			$eng_arr [$k] = $v ["name"];
		} else {
			$chi_arr [$k] = $v ["name"]; // for utf-8 char, the 1st byte is usually with hex code > 191 && < 248
		}
	}
	asort ( $eng_arr );
	
	big5_sort ( $chi_arr, $chi_words, 'UTF-8' );
	
	$new_arr = array ();
	foreach ( $eng_arr as $k => $v ) {
		$new_arr [$k] = $v;
	}
	
	foreach ( $chi_arr as $k => $v ) {
		$new_arr [$k] = $v;
	}
	
	$return_arr = array ();
	foreach ( $new_arr as $k => $v ) {
		$return_arr [$k] = $arr [$k];
	}
	
	return $return_arr;
}
function MVC_Perform_Action($class, $method, $classVar = NULL, $methodVar = array()) {
	if($_SERVER['HTTP_X_REQUESTED_WITH']=='XMLHttpRequest' ){
		echo json_encode(array('result'=>'error','msg'=>$methodVar[0]));
		die;
	}
	
	$file = "application/controller/" . $class . "_controller.php";
	
	if (! file_exists ( $file ))
		return NULL;
	
	require_once ($file);
	
	$class = str_replace ( "_", "", $class ) . "Controller";
	$controller = new $class ( $classVar );
	
	if (method_exists ( $controller, $method )) {
		return call_user_func_array ( array (
				$controller,
				$method 
		), $methodVar );
	}
}

function getMonthLastday($anyday){
	return date("Y-m-t", strtotime($anyday));
}
function timeDiff($d2, $d1) {
	return (strtotime ( $d1 ) - strtotime ( $d2 ));
}
function dayDiff($d1,$d2){
	$d1 = strtotime($d1);
	$d2 = strtotime($d2);
	$datediff = $d2 - $d1;
	return floor($datediff/(60*60*24));
}



function addDay($date,$day,$dateonly=false){
	if($dateonly)
		$format = 'Y-m-d';
	else 
		$format = 'Y-m-d H:i:s';
	return date($format, strtotime($date." +".$day." days"));
}

function Debug_Get_Benchmark() {
	global $CONFIG;
	if (! $CONFIG ['debug'])
		return;
	
	global $debug_time;
	
	$curTime = microtime_float ();
	echo "<br><br><div><hr />";
	echo "Time: " . $curTime . " - " . $debug_time . " = " . ($curTime - $debug_time);
	echo "<br>";
	echo "Memory: " . (memory_get_usage () / 1024) . " KB";
	echo "<hr /></div>";
	
	$debug_time = $curTime;
}
function microtime_float() {
	list ( $usec, $sec ) = explode ( " ", microtime () );
	return (( float ) $usec + ( float ) $sec);
}
function Get_Application_Setting() {
	global $CONFIG;
	if ($_SESSION ['language'] == '')
		$_SESSION ['language'] = $CONFIG ['default_lang'];
	
//	if ($_SESSION ['theme'] == '')
	//	$_SESSION ['theme'] = $CONFIG ['default_theme'];
}
function is_empty($var) {
	// return (((is_null($var)||trim($var)=='')&&$var!==false)||(is_array($var)&&empty($var)))?true:false;
	return is_array ( $var ) ? empty ( $var ) : (is_null ( $var ) || trim ( $var ) == '') && $var !== false;
}
function is_valid_email($email) {
	return preg_match ( "/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $email );
}
function Gen_Rand_Str($length) {
	$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()";
	$size = strlen ( $chars );
	$str = '';
	for($i = 0; $i < $length; $i ++) {
		$str .= $chars [rand ( 0, $size - 1 )];
	}
	
	return $str;
}
function addFieldLangPrefix() {
	return $_SESSION ['lang'] == 'en' || $_SESSION ['lang'] == '' ? '' : 'C';
}
function isValidReCaptcha() {
	global $CONFIG;
	// the response from reCAPTCHA
	$resp = null;
	// the error code from reCAPTCHA, if any
	$error = null;
	
	// was there a reCAPTCHA response?
	if ($_POST ["recaptcha_response_field"]) {
		$resp = recaptcha_check_answer ( $CONFIG ['recaptcha_privatekey'], $_SERVER ["REMOTE_ADDR"], $_POST ["recaptcha_challenge_field"], $_POST ["recaptcha_response_field"] );
		
		/*
		 * if ($resp->is_valid==false) {
		 * $this->action_message = $resp->error;
		 * $this->action_error 	= true;
		 * }
		 */
		return $resp->is_valid;
	}
}
function In_Mime_Type($file) {
	global $CONFIG;
	
	for($a = 0; $a < sizeof ( $CONFIG ['img_mime_type'] ); $a ++) {
		exec ( "file -bi " . $file, $out );
		$output_arr = explode ( " ", $out [0] );
		$output = str_replace ( ";", "", $output_arr [0] );
		
		if (trim ( $output ) == trim ( $CONFIG ['img_mime_type'] [$a] )) {
			return $output;
		}
	}
	
	foreach ( $CONFIG ['file_mime_type'] as $type => $type_arr ) {
		for($a = 0; $a < sizeof ( $type_arr ); $a ++) {
			exec ( "file -bi " . $file, $out );
			$output_arr = explode ( " ", $out [0] );
			$output = str_replace ( ";", "", $output_arr [0] );
			
			if (trim ( $output ) == trim ( $type_arr [$a] )) {
				return $output;
			}
		}
	}
}
function Size_Convert($size, $from, $to, $precision = 2) {
	switch ($from) {
		case 'b' :
			if ($to == 'mb') {
				return number_format ( $size / 1048576, $precision ) . ' MB';
				;
			}
			break;
	}
}
function Cal_Size_2_Unit($bytes, $precision = 2) {
	if ($bytes >= 1073741824) {
		$bytes = number_format ( $bytes / 1073741824, 2 ) . ' GB';
	} elseif ($bytes >= 1048576) {
		$bytes = number_format ( $bytes / 1048576, 2 ) . ' MB';
	} elseif ($bytes >= 1024) {
		$bytes = number_format ( $bytes / 1024, 2 ) . ' KB';
	} elseif ($bytes > 1) {
		$bytes = $bytes . ' bytes';
	} elseif ($bytes == 1) {
		$bytes = $bytes . ' byte';
	} else {
		$bytes = '0 bytes';
	}
	
	return $bytes;
}


function toGroupOption($arr,$title){
	$arrsize = sizeof($arr);
	for($a=0;$a<$arrsize;$a++){
		$gp[$arr[$a][$title]][] = $arr[$a];		
	}
	return $gp;
}
function datetimeToTime($datetime) {
	$arr = explode ( " ", $datetime );
	
	return fmt_dateNtime ( $arr [1] );
}
function datetimeToDate($datetime) {
	$arr = explode ( " ", $datetime );
	
	return fmt_dateNtime ( $arr [0] );
}
function fmt_dateNtime($datetime) {
	$is_24_hr = true;
	
	if (is_null ( $datetime ) || $datetime == '' || $datetime == '0000-00-00 00:00:00' || $datetime == '00:00:00' || $datetime == '0000-00-00')
		return '--';
	
	if ($is_24_hr == false) {
		$time_obj = explode ( ":", $datetime );
		$suffix = $time_obj [0] > 12 ? 'pm' : 'am';
		$datetime .= ' ' . $suffix;
	}
	return $datetime;
}
function validateToken() {
	// if($_REQUEST['token']
}
function token_register() {
	$hash = md5 ( rand () );
	$_SESSION ['form_token'] = $hash;
	return $hash;
}
function token_unregister() {
	$_SESSION ['form_token'] = '';
}
function Is_Valid_Date($date) {
	$date_arr = explode ( '-', $date );
	if (count ( $date_arr ) == 3) {
		if (checkdate ( $date_arr [1], $date_arr [2], $date_arr [0] )) {
			return true;
		}
	}
}
function checktime($time,$is24Hours=true,$seconds=false) {
    $pattern = "/^".($is24Hours ? "([1-2][0-3]|[01]?[1-9])" : "(1[0-2]|0?[1-9])").":([0-5]?[0-9])".($seconds ? ":([0-5]?[0-9])" : "")."$/";
    if (preg_match($pattern, $time)) {
        return true;
    }
    return false;
}

/*
function saveBtn() {
	$input ['attr'] = array (
			'class' => 'btn blue' 
	);
	$input ['value'] = '<i class="icon-save"></i> Save';
	UIElementController::render ( "button", $input );
}
function backBtn($input = '') {
	$input ['attr'] ['class'] = ' btn blue';
	$input ['value'] = '<i class="icon-arrow-left"></i> Back';
	UIElementController::render ( "button", $input );
}*/

function export2CSV($filename,$csvheading,$csvdata){
	
	header("Content-Type:application/csv");
	header("Content-Disposition:attachment;filename=".$filename.".csv");
	
	$output = fopen("php://output",'w') or die("Can't open php://output");
	fputs($output, $bom =( chr(0xEF) . chr(0xBB) . chr(0xBF) ));
	fputcsv($output, $csvheading);
	
	foreach($csvdata as $data) {
		fputcsv($output, $data);
	}
	fclose($output) or die("Can't close php://output");
}


function preventDA(){
	
	if($_SERVER['REQUEST_URI'] == $_SERVER['PHP_SELF']){
		die('404');
	}
}

function includeCustCss($file){
	if(is_array($file)){
		$size = sizeof($file);
		for($a=0;$a<$size;$a++){
			$return.= localCssFile($file[$a]);
		}
	}
	else{
		$return = localCssFile($file);
	}
	return $return;
		
}

function localCssFile($file){
	global $CONFIG;
	return '<link href="'.$CONFIG['home_http'].'theme/'.$file.'" rel="stylesheet" type="text/css"/>';
}



function includeCustJS($file){
	
	if(is_array($file)){
		$size = sizeof($file);
		for($a=0;$a<$size;$a++){
			$return.= localJSFile($file[$a]);
		}
	}
	else{
		$return = localJSFile($file);
	}
	return $return;
}

function localJSFile($file){
	global $CONFIG;
	if($file!=''){
		if(isset($CONFIG['local'])){
			if(is_file($CONFIG['home_path'].'include/js/local/'.$CONFIG['local'].'/'.$file)){
				$return = '<script src="'.$CONFIG['home_http'].'include/js/local/'.$CONFIG['local'].'/'.$file.'"></script>';
			}
		}else{
			if(is_file($CONFIG['home_path'].'include/js/'.$file)){
				$return = '<script src="'.$CONFIG['home_http'].'include/js/'.$file.'"></script>';
			}
		}
	}
	return $return;
}

class dbfield {
	
	static function timeToMin($field,$as,$sum=false){
		if($sum==true){
			$s = 'sum(UNIX_TIMESTAMP(concat("2016-02-16 ",'.$field.'))-UNIX_TIMESTAMP(concat("2016-02-16 00:00:00")))/60';
		}else{
			$s = '(UNIX_TIMESTAMP(concat("2016-02-16 ",'.$field.'))-UNIX_TIMESTAMP(concat("2016-02-16 00:00:00")))/60 ';
		}
		if($as!=''){
			$s.= ' as '.$as;
		}
		
		return $s;
	}
	
	static function getTables(){
		global $CONFIG;
		/*global $CONFIG;
		if(isset($CONFIG['db_table_cust'][$table]))
			return $CONFIG['db_table_prefix'].$CONFIG['db_table_cust'][$table];
		else
			return $CONFIG['db_table_prefix'].$table;*/
		
		$arr['artisttype'] = $CONFIG['db_table_prefix'].'ARTISTTYPE';
		$arr['artistuser'] = $CONFIG['db_table_prefix'].'ARTIST_USER';
		$arr['channel'] = $CONFIG['db_table_prefix'].'CHANNEL';
		$arr['channeltool'] = $CONFIG['db_table_prefix'].'CHANNELTOOL';
		$arr['client'] = $CONFIG['db_table_prefix'].'CLIENT';
		$arr['event'] = $CONFIG['db_table_prefix'].'EVENT';
		$arr['friendship'] = $CONFIG['db_table_prefix'].'FRIENDSHIP';
		$arr['genretype'] = $CONFIG['db_table_prefix'].'GENRETYPE';
		$arr['login_log'] = $CONFIG['db_table_prefix'].'LOGIN_LOG';
		/*$arr['milestone'] = $CONFIG['db_table_prefix'].'MILESTONE';
		$arr['milestonetask'] = $CONFIG['db_table_prefix'].'MILESTONETASK';
		$arr['milestonetaskassign'] = $CONFIG['db_table_prefix'].'MILESTONETASKASSIGN';
		$arr['milestonetaskpost'] = $CONFIG['db_table_prefix'].'MILESTONETASKPOST';
		$arr['mytask'] = $CONFIG['db_table_prefix'].'MYTASK';
		$arr['mytasklist'] = $CONFIG['db_table_prefix'].'MYTASKLIST';
		$arr['mytaskpost'] = $CONFIG['db_table_prefix'].'MYTASKPOST';*/
		$arr['notification'] = $CONFIG['db_table_prefix'].'NOTIFICATION';
		/*$arr['project'] = $CONFIG['db_table_prefix'].'PROJECT';
		$arr['task'] = $CONFIG['db_table_prefix'].'TASK';
		//$arr['taskrecord'] = dbfield::customTable('TASKRECORD');*/
		$arr['file'] = $CONFIG['db_table_prefix'].'FILE';
		$arr['pobj'] = $CONFIG['db_table_prefix'].'POSTOBJECT';
		$arr['passo'] = $CONFIG['db_table_prefix'].'POSTASSO';
		$arr['pbookmark'] = $CONFIG['db_table_prefix'].'POSTBOOKMARK';
		
		
		//$arr['project_staff'] = $CONFIG['db_table_prefix'].'PROJECT_STAFF';
		//$arr['project_taskcode'] = dbfield::customTable('PROJECT_TASKCODE');
		//$arr['task'] = $CONFIG['db_table_prefix'].'TASK';
		$arr['user'] = $CONFIG['db_table_prefix'].'USER';
		$arr['userrole'] = $CONFIG['db_table_prefix'].'USERROLE';
		
		return $arr;
	}
	
	static function customTable($table){
		global $CONFIG;
		if(isset($CONFIG['db_table_cust'][$table]))
			return $CONFIG['db_table_prefix'].$CONFIG['db_table_cust'][$table];
		else
			return $CONFIG['db_table_prefix'].$table;
		
	}
	
	static function in($string,$field){
		if(is_array($string))
			$arr = $string;
		else
			$arr = explode(",",$string);
		$cond = ' AND '.$field.' in(';
		for($a=0;$a<sizeof($arr);$a++){
			$q_arr[$a]= '?';
			$para[] = $arr[$a];
		}
		$cond.= implode(",",$q_arr);
		$cond.= ' )';
		return array($cond,$para);
	}
	
	static function getUsername($alias='', $as = 'Username',$extrafield='') {
		
		// return 'concat('.$alias.'.firstname,\' \','.$alias.'.lastname) as '.$as;
		$pre = $alias == '' ? '' : $alias . '.';
		switch (setting::getNameFormat()) {
			case 'fl' :
				//$q='concat(' . $pre . 'firstname,\' \',' . $pre . 'lastname'.$extrafield.') as ' . $as;
				$q='concat(if(' . $pre . 'firstname is null,\'\','.$pre.'firstname),\' \',if(' . $pre . 'lastname is null,\'\', '.$pre.'lastname)'.$extrafield.') as ' . $as;
				//echo $q;die;
			break;
			case 'fml' :
				$q='concat(' . $pre . 'firstname,\' \',' . $pre . 'middlename,\' \',' . $pre . 'lastname'.$extrafield.') as ' . $as;
			break;	
			case 'fl' :
				$q='concat(' . $pre . 'firstname,\' \','. $pre . 'lastname'.$extrafield.') as ' . $as;
			break;	
			case 'lm,f' :
				$q='concat(' . $pre . 'lastname,\' \',' . $pre . 'middlename,\', \',' . $pre . 'firstname'.$extrafield.') as ' . $as;
			break;	
		}
		return $q;
	}
	
	static function displayDate($field){
		switch (setting::getDateFormat()) {
			case 'yyyy-mm-dd' :
				return "date_format(".$field.",'%Y-%m-%d')";
			case 'dd-mm-yyyy' :
				return $d.'-'.$m.'-'.$y;
			case 'mm-dd-yyyy' :
				return $m.'-'.$d.'-'.$y;
			case 'yyyy/mm/dd' :
				return $y.'/'.$m.'/'.$d;
			case 'dd/mm/yyyy' :
				return $d.'/'.$m.'/'.$y;
			case 'mm/dd/yyyy' :
				return $m.'/'.$d.'/'.$y;
		}
	}
	
	static function displayDatetime($field,$as=''){
		if($as==''){
			
			$arr = explode(".",$field);
			$as = $arr[1]; 
		}
		
		switch (setting::getDateFormat()) {
			case 'yyyy-mm-dd' :
				return "date_format(".$field.",'%Y-%m-%d %H:%i') as ".$as;
			case 'dd-mm-yyyy' :
				return $d.'-'.$m.'-'.$y;
			case 'mm-dd-yyyy' :
				return $m.'-'.$d.'-'.$y;
			case 'yyyy/mm/dd' :
				return $y.'/'.$m.'/'.$d;
			case 'dd/mm/yyyy' :
				return $d.'/'.$m.'/'.$y;
			case 'mm/dd/yyyy' :
				return $m.'/'.$d.'/'.$y;
		}
	}
	
	static function getFieldByLang($alias='',$as='',$field=''){
		$field = $field==''?'Name':$field;
		switch($_SESSION['language']){
			case 'en':
				$lang='';
			break;
			case 'jp':
				$lang='JP';
			break;
			case 'zh':
				$lang='ZH';
			break;
			case 'cn':
			$lang='CN';
			break;
		}
		return ($alias==''?'':$alias.'.').$field.$lang.' as '.($as==''?$field:$as);
	}
}
class display {
	
	static function minutesToTime($time, $format = '%02d:%02d') {
		if ($time < 1) {
			return;
		}
		$hours = floor($time / 60);
		$minutes = ($time % 60);
		return sprintf($format, $hours, $minutes);
	}

	static function linkify($value){
		return preg_replace(
				"~[[:alpha:]]+://[^<>[:space:]]+[[:alnum:]/]~",
				"<a href=\"\\0\" target=\"_blank\">\\0</a>",
				$value);
	}
	
	static function inputValue($v){
		return htmlspecialchars_decode($v);	
	}
	
	static function datepickerToday(){
		switch (setting::getDateFormat()) {
			case 'yyyy-mm-dd' :
				return date('Y-m-d');
		}	
	}
	
	static function renderNotification($data,$isfull){
		global $Lang,$CONFIG;
		
		if($isfull)
			$len = 'full';
		else
			$len = 'simple';
		if($data['Data']!='' && $template = $Lang['notification_template'][$data['Type']][$len]){
			$d = json_decode($data['Data']);
			
			$message = $template;
			foreach($d as $key=>$val){
				$message = str_replace('[['.$key.']]',$val,$message);
			}
			$message = str_replace('[[sender]]','<b>'.$data['Sender'].'</b>',$message);
			$icon = $Lang['notification_template'][$data['Type']]['icon'];
			if($isfull)
				$icon = str_replace('class="fa ','class="fa fa-2x ',$icon);
			$time = display::dayAgo($data['TimeInput']);
			$title = str_replace('[[sender]]','<b>'.$data['Sender'].'</b>',$Lang['notification_template'][$data['Type']]['title']);
			$link = $CONFIG['home_http'].str_replace('[[id]]',$data['ID'],$Lang['notification_template'][$data['Type']]['link']);
			//'/message/viewlist/?id='.$data['ID'];
			return array($icon,$message,$time,$title,$link);
		}
	}
	
	static function plural($count,$noun,$es=false){
		if($_SESSION['language']=='en'){
			if($count>1){
				return $noun.($es?'es':'s');
			}else{
				return $noun;
			}
		}else{
			return $noun;
		}
	}
	static function displayDate($field){
		switch (setting::getDateFormat()) {
			case 'yyyy-mm-dd' :
				return substr($field,0,10);
			
		}
	}
	static function displayTime($field){
		switch (setting::getDateFormat()) {
			case 'yyyy-mm-dd' :
				return substr($field,11,5);
					
		}
	}
	static function displayDatetime($field){
		switch (setting::getDateFormat()) {
			case 'yyyy-mm-dd' :
				return substr($field,0,16);
			
		}
	}
	
	static function addSelectOption($arr){
		global $Lang;
		return array_merge(array(array('',$Lang['please_select'])),$arr);
	}
	
	static function addSelectAllOption($arr){
		global $Lang;
		return array_merge(array(array('',$Lang['selectall'])),$arr);
	}
	
	static function date($date) {
		
		if($date==''||substr($date,0,2)=='00')
			return false;
		if (strlen ( $date )>10) {
			list ( $date, $time ) = explode ( " ", $date );
		}
		list ($y, $m, $d) = explode ( '-', $date );
		switch (setting::getDateFormat()) {
			case 'yyyy-mm-dd' :
				return $date;
			case 'dd-mm-yyyy' :
				return $d.'-'.$m.'-'.$y;
			case 'mm-dd-yyyy' :
				return $m.'-'.$d.'-'.$y;
			case 'yyyy/mm/dd' :
				return $y.'/'.$m.'/'.$d;
			case 'dd/mm/yyyy' :
				return $d.'/'.$m.'/'.$y;
			case 'mm/dd/yyyy' :
				return $m.'/'.$d.'/'.$y;
		}
		
	}
	static function dayAgo($date) {
		if($date == ''||substr($date,0,4)=='0000')
			return '';
		
		global $Lang;
		$time = strtotime($date);
		$time = time() - $time; // to get the time since that moment
		$time = ($time<1)? 1 : $time;
		$tokens = array (
				31536000 => $Lang['year'],
				2592000 => $Lang['month'],
				604800 => $Lang['week'],
				86400 => $Lang['day'],
				3600 => $Lang['hour'],
				60 => $Lang['minute'],
				1 => $Lang['second']
		);
		
		foreach ($tokens as $unit => $text) {
			if ($time < $unit) continue;
			$numberOfUnits = floor($time / $unit);
			return $numberOfUnits.' '.$text.(($numberOfUnits>1&&$_SESSION['lang']=='en')?'s':'').$Lang['ago'];
		}
	}
	
	static function minutesToHr($time, $format='') {
		global $Lang;

		//$format=$format==''?'%d '.$Lang['hour']:$format;
		//'%02d : %02d'
	    if ($time < 1) {
	        return;
	    }
	    $hours = floor($time / 60);
	    $minutes = ($time % 60);
	    if($hours>0){
	    	$format = '%d'.$Lang['hour'];
	    	if($minutes>0){
	    		$format.= ' %d'.$Lang['minute'];
	    		return sprintf($format, $hours,$minutes);
	    	}else{
	    		return sprintf($format, $hours);
	    	}
	    }else{
	    	$format.= ' %d'.$Lang['minute'];
	    	return sprintf($format,$minutes);
	    }
	}
	
	static function getStrLen($str){
		return  mb_strlen($str, 'UTF-8');
	}
	
	static function subStrDisplay($str,$link=''){
		global $Lang,$CONFIG;
		if(self::getStrLen($str)>$CONFIG['post']['lentohide']){
			
			//<a href="'.($link==''?'javascript;':$link).'" class="fancyboxajax">'.ui::btn($Lang['showmore']).'</a>';
			return mb_substr($str,0,$CONFIG['post']['lentohide'],'UTF-8').'<br/><a data-toggle="modal" data-modalclass="modal-lx" href="'.($link==''?'javascript;':$link).'" data-target="#modal" class="modalbtn">'.$Lang['showmore'].'</a>';
		}else{
			return $str;
		}
	}
	
	static function artistColor($color){
		return explode("|",$color);
	}
	
	static function like(){
		global $CONFIG;
		return $CONFIG['home_http']."theme/assets/".$CONFIG['asset']."/images/asso/like_14px.png";
	}
	
	static function comment(){
		global $CONFIG;
		return $CONFIG['home_http']."theme/assets/".$CONFIG['asset']."/images/asso/comment_14px.png";
	}
	static function share(){
		global $CONFIG;
		return $CONFIG['home_http']."theme/assets/".$CONFIG['asset']."/images/asso/share_14px.png";
	}
	
	static function qrCode($link,$size=''){
		$size = $size==''?'100x100':'';
		global $CONFIG;
		//return '<img src="https://chart.googleapis.com/chart?chs='.$size.'&cht=qr&chl='.$link.'&choe=UTF-8"/>';
		return 'https://chart.googleapis.com/chart?chs='.$size.'&cht=qr&chl='.$link.'&choe=UTF-8';
	}
}

class setting{
	
	static function getDateFormat(){
		$display = 'yyyy-mm-dd';
		
		/*
		 case 'yyyy-mm-dd':
		 case 'dd-mm-yyyy':
		 case 'mm-dd-yyyy':
		 case 'yyyy/mm/dd':
		 case 'dd/mm/yyyy':
		 case 'mm/dd/yyyy':
		 */
		return $display;
	}
	
	static function useMName(){
		return trim(strpos(self::getNameFormat(),'m'))!='';
	}
	
	static function getNameFormat(){
		//$display = 'lm,f';
		$display = 'fl';
		/*
		 fml first middle last
		 fl first last
		 lm,f 
		 */
		return $display;
	}
	
	static function getDatetimeformat(){
		return self::getDateFormat()."  hh:ii";
	}
	
	static function installed($module){
		$installed['project'] = 1;
		$installed['mytask'] = 1;
		$installed['event'] = 1;
		
		
		return $installed[$module]; 
	}
}
class filter {
	static function optional($array, $index, $default, $type) {
		if (func_num_args () != 4 or ! is_array ( $array ) or empty ( $index ) or empty ( $type )) {
			throw new coding_exception ( 'optional_arg() requires specified params (parameter: ' . $array . ')' );
		}
		$data = self::ni ( $array, $index, false );
		if ($data !== false) {
			return self::clean_param ( $data, $type );
		} else {
			return $default;
		}
	}
	static function required($array, $index, $type) {
		if (func_num_args () != 3 or empty ( $array ) or empty ( $index ) or empty ( $type )) {
			throw new coding_exception ( 'required_arg() requires $parname and $type to be specified (parameter: ' . $parname . ')' );
		}
		$data = self::ni ( $array, $index, false );
		if ($data !== false) {
			return self::clean_param ( $data, $type );
		} else {
			print_error ( 'missingparam', '', '', $index );
		}
	}
	static function ni($a, $i, $y) {
		return isset ( $a [$i] ) ? $a [$i] : $y;
	}
	static function optional_param($parname, $default, $type) {
		if (func_num_args () != 3 or empty ( $parname ) or empty ( $type )) {
			die ( 'optional_param requires $parname, $default + $type to be specified (parameter: ' . $parname . ')' );
		}
		if (! isset ( $default )) {
			$default = null;
		}
		// POST has precedence.
		if (isset ( $_POST [$parname] )) {
			$param = $_POST [$parname];
		} else if (isset ( $_GET [$parname] )) {
			$param = $_GET [$parname];
		} else {
			return $default;
		}
		
		$param = self::myClean($param);
		
		if (is_array ( $param )) {
			die ( 'Invalid array parameter detected in required_param(): ' . $parname );
			// TODO: switch to $default in Moodle 2.3.
			return self::optional_param_array ( $parname, $default, $type );
		}
		
		return self::clean_param ( $param, $type );
	}
	static function required_param($parname, $type) {
		if (func_num_args () != 2 or empty ( $parname ) or empty ( $type )) {
			die ( 'required_param() requires $parname and $type to be specified (parameter: ' . $parname . ')' );
		}
		// POST has precedence.
		if (isset($_POST[$parname])) {
			$param = $_POST[$parname];
		} else if (isset($_GET[$parname])) {
			//$param = htmlentities($_GET[$parname]);
			$param = $_GET[$parname];
		} else {
			print_error('missingparam', '', '', $parname);
		}
		
		//kelvin fix, return error if it is nothing
		if (empty($param) && strlen($param) == 0) {
			print_error('missingparam', '', '', $parname);
		} 
		
		$param = self::myClean($param);
		
		if (is_array ( $param )) {
			die ( 'Invalid array parameter detected in required_param(): ' . $parname );
			// TODO: switch to fatal error in Moodle 2.3.
			return self::required_param_array ( $parname, $type );
		}
		
		return self::clean_param ( $param, $type );
	}
	
	static function myClean($text){
		/*$text = htmlspecialchars($text);
		return preg_replace('#&lt;(/?[biu])&gt;#', '<$1>', $text);*/
		

		$text = htmlspecialchars($text);
		
		$text = str_replace("&lt;h1&gt;", "<h1>", $text);
		$text = str_replace("&lt;/h1&gt;", "</h1>", $text);
		$text = str_replace("&lt;h2&gt;", "<h2>", $text);
		$text = str_replace("&lt;/h2&gt;", "</h2>", $text);
		$text = str_replace("&lt;h3&gt;", "<h3>", $text);
		$text = str_replace("&lt;/h3&gt;", "</h3>", $text);
		$text = str_replace("&lt;h4&gt;", "<h4>", $text);
		$text = str_replace("&lt;/h4&gt;", "</h4>", $text);
		$text = str_replace("&lt;h5&gt;", "<h5>", $text);
		$text = str_replace("&lt;/h5&gt;", "</h5>", $text);
		$text = str_replace("&lt;p&gt;", "<p>", $text);
		$text = str_replace("&lt;/p&gt;", "</p>", $text);
		$text = str_replace("&lt;b&gt;", "<b>", $text);
		$text = str_replace("&lt;/b&gt;", "</b>", $text);
		$text = str_replace("&lt;i&gt;", "<i>", $text);
		$text = str_replace("&lt;/i&gt;", "</i>", $text);
		$text = str_replace("&lt;u&gt;", "<u>", $text);
		$text = str_replace("&lt;/u&gt;", "</u>", $text);
		$text = str_replace("&lt;br&gt;", "<br>", $text);
		$text = str_replace("&lt;br /&gt;", "<br />", $text);
		$text = str_replace("&lt;br/&gt;", "<br/>", $text);
		return $text;
		
	}
	static function optional_param_array($parname, $default, $type) {
		if (func_num_args () != 3 or empty ( $parname ) or empty ( $type )) {
			die ( 'optional_param_array requires $parname, $default + $type to be specified (parameter: ' . $parname . ')' );
		}
		
		// POST has precedence.
		if (isset ( $_POST [$parname] )) {
			$param = $_POST [$parname];
		} else if (isset ( $_GET [$parname] )) {
			$param = $_GET [$parname];
		} else {
			return $default;
		}
		if (! is_array ( $param )) {
			die ( 'optional_param_array() expects array parameters only: ' . $parname );
			return $default;
		}
		
		$result = array ();
		foreach ( $param as $key => $value ) {
			if (! preg_match ( '/^[a-z0-9_-]+$/i', $key )) {
				die ( 'Invalid key name in optional_param_array() detected: ' . $key . ', parameter: ' . $parname );
				continue;
			}
			$result [$key] = self::clean_param ( $value, $type );
		}
		
		return $result;
	}
	static function required_param_array($parname, $type) {
		if (func_num_args () != 2 or empty ( $parname ) or empty ( $type )) {
			die ( 'required_param_array() requires $parname and $type to be specified (parameter: ' . $parname . ')' );
		}
		// POST has precedence.
		if (isset ( $_POST [$parname] )) {
			$param = $_POST [$parname];
		} else if (isset ( $_GET [$parname] )) {
			$param = $_GET [$parname];
		} else {
			print_error ( 'missingparam', '', '', $parname );
		}
		if (! is_array ( $param )) {
			print_error ( 'missingparam', '', '', $parname );
		}
		
		$result = array ();
		foreach ( $param as $key => $value ) {
			if (! preg_match ( '/^[a-z0-9_-]+$/i', $key )) {
				die ( 'Invalid key name in required_param_array() detected: ' . $key . ', parameter: ' . $parname );
				continue;
			}
			$result [$key] = self::clean_param ( $value, $type );
		}
		
		return $result;
	}
	static function clean_param($param, $type) {
		global $CFG;
		
		if (is_array ( $param )) {
			throw new coding_exception ( 'clean_param() can not process arrays, please use clean_param_array() instead.' );
		} else if (is_object ( $param )) {
			if (method_exists ( $param, '__toString' )) {
				$param = $param->__toString ();
			} else {
				throw new coding_exception ( 'clean_param() can not process objects, please use clean_param_array() instead.' );
			}
		}
		
		switch ($type) {
			case PARAM_RAW :
				
				// No cleaning at all.
				$param = self::fix_utf8 ( $param );
				return $param;
			
			case PARAM_RAW_TRIMMED :
				
				// No cleaning, but strip leading and trailing whitespace.
				$param = self::fix_utf8 ( $param );
				return trim ( $param );
			
			case PARAM_CLEAN :
				
				// General HTML cleaning, try to use more specific type if possible this is deprecated!
				// Please use more specific type instead.
				if (is_numeric ( $param )) {
					return $param;
				}
				$param = self::fix_utf8 ( $param );
				// Sweep for scripts, etc.
				return clean_text ( $param );
			
			case PARAM_CLEANHTML :
				
				// Clean html fragment.
				$param = self::fix_utf8 ( $param );
				// Sweep for scripts, etc.
				$param = clean_text ( $param, FORMAT_HTML );
				return trim ( $param );
			
			case PARAM_INT :
				
				// Convert to integer.
				return ( int ) $param;
			
			case PARAM_FLOAT :
				
				// Convert to float.
				return ( float ) $param;
			
			case PARAM_ALPHA :
				
				// Remove everything not `a-z`.
				return preg_replace ( '/[^a-zA-Z]/i', '', $param );
			
			case PARAM_ALPHAEXT :
				
				// Remove everything not `a-zA-Z_-` (originally allowed "/" too).
				return preg_replace ( '/[^a-zA-Z_-]/i', '', $param );
			
			case PARAM_ALPHANUM :
				
				// Remove everything not `a-zA-Z0-9`.
				return preg_replace ( '/[^A-Za-z0-9]/i', '', $param );
			
			case PARAM_ALPHANUMEXT :
				
				// Remove everything not `a-zA-Z0-9_-`.
				return preg_replace ( '/[^A-Za-z0-9_-]/i', '', $param );
			
			case PARAM_SEQUENCE :
				
				// Remove everything not `0-9,`.
				return preg_replace ( '/[^0-9,]/i', '', $param );
			
			case PARAM_BOOL :
				
				// Convert to 1 or 0.
				$tempstr = strtolower ( $param );
				if ($tempstr === 'on' or $tempstr === 'yes' or $tempstr === 'true') {
					$param = 1;
				} else if ($tempstr === 'off' or $tempstr === 'no' or $tempstr === 'false') {
					$param = 0;
				} else {
					$param = empty ( $param ) ? 0 : 1;
				}
				return $param;
			
			case PARAM_NOTAGS :
				
				// Strip all tags.
				$param = self::fix_utf8 ( $param );
				return strip_tags ( $param );
			
			case PARAM_TEXT :
				
				// Leave only tags needed for multilang.
				$param = self::fix_utf8 ( $param );
				// If the multilang syntax is not correct we strip all tags because it would break xhtml strict which is required
				// for accessibility standards please note this cleaning does not strip unbalanced '>' for BC compatibility reasons.
				/*do {
					if (strpos ( $param, '</lang>' ) !== false) {
						// Old and future mutilang syntax.
						$param = strip_tags ( $param, '<lang>' );
						if (! preg_match_all ( '/<.*>/suU', $param, $matches )) {
							break;
						}
						$open = false;
						foreach ( $matches [0] as $match ) {
							if ($match === '</lang>') {
								if ($open) {
									$open = false;
									continue;
								} else {
									break 2;
								}
							}
							if (! preg_match ( '/^<lang lang="[a-zA-Z0-9_-]+"\s*>$/u', $match )) {
								break 2;
							} else {
								$open = true;
							}
						}
						if ($open) {
							break;
						}
						return $param;
					} else if (strpos ( $param, '</span>' ) !== false) {
						// Current problematic multilang syntax.
						$param = strip_tags ( $param, '<span>' );
						if (! preg_match_all ( '/<.*>/suU', $param, $matches )) {
							break;
						}
						$open = false;
						foreach ( $matches [0] as $match ) {
							if ($match === '</span>') {
								if ($open) {
									$open = false;
									continue;
								} else {
									break 2;
								}
							}
							if (! preg_match ( '/^<span(\s+lang="[a-zA-Z0-9_-]+"|\s+class="multilang"){2}\s*>$/u', $match )) {
								break 2;
							} else {
								$open = true;
							}
						}
						if ($open) {
							break;
						}
						return $param;
					}
				} while ( false );
				// Easy, just strip all tags, if we ever want to fix orphaned '&' we have to do that in format_string().
				//return  strip_tags( $param );*/
				return $param;
			
			case PARAM_COMPONENT :
				
				// We do not want any guessing here, either the name is correct or not
				// please note only normalised component names are accepted.
				if (! preg_match ( '/^[a-z]+(_[a-z][a-z0-9_]*)?[a-z0-9]+$/', $param )) {
					return '';
				}
				if (strpos ( $param, '__' ) !== false) {
					return '';
				}
				if (strpos ( $param, 'mod_' ) === 0) {
					// Module names must not contain underscores because we need to differentiate them from invalid plugin types.
					if (substr_count ( $param, '_' ) != 1) {
						return '';
					}
				}
				return $param;
			
			case PARAM_PLUGIN :
			case PARAM_AREA :
				
				// We do not want any guessing here, either the name is correct or not.
				if (! is_valid_plugin_name ( $param )) {
					return '';
				}
				return $param;
			
			case PARAM_SAFEDIR :
				
				// Remove everything not a-zA-Z0-9_- .
				return preg_replace ( '/[^a-zA-Z0-9_-]/i', '', $param );
			
			case PARAM_SAFEPATH :
				
				// Remove everything not a-zA-Z0-9/_- .
				return preg_replace ( '/[^a-zA-Z0-9\/_-]/i', '', $param );
			
			case PARAM_FILE :
				
				// Strip all suspicious characters from filename.
				$param = self::fix_utf8 ( $param );
				$param = preg_replace ( '~[[:cntrl:]]|[&<>"`\|\':\\\\/]~u', '', $param );
				if ($param === '.' || $param === '..') {
					$param = '';
				}
				return $param;
			
			case PARAM_PATH :
				
				// Strip all suspicious characters from file path.
				$param = self::fix_utf8 ( $param );
				$param = str_replace ( '\\', '/', $param );
				
				// Explode the path and clean each element using the PARAM_FILE rules.
				$breadcrumb = explode ( '/', $param );
				foreach ( $breadcrumb as $key => $crumb ) {
					if ($crumb === '.' && $key === 0) {
						// Special condition to allow for relative current path such as ./currentdirfile.txt.
					} else {
						$crumb = clean_param ( $crumb, PARAM_FILE );
					}
					$breadcrumb [$key] = $crumb;
				}
				$param = implode ( '/', $breadcrumb );
				
				// Remove multiple current path (./././) and multiple slashes (///).
				$param = preg_replace ( '~//+~', '/', $param );
				$param = preg_replace ( '~/(\./)+~', '/', $param );
				return $param;
			
			case PARAM_HOST :
				
				// Allow FQDN or IPv4 dotted quad.
				$param = preg_replace ( '/[^\.\d\w-]/', '', $param );
				// Match ipv4 dotted quad.
				if (preg_match ( '/(\d{1,3})\.(\d{1,3})\.(\d{1,3})\.(\d{1,3})/', $param, $match )) {
					// Confirm values are ok.
					if ($match [0] > 255 || $match [1] > 255 || $match [3] > 255 || $match [4] > 255) {
						// Hmmm, what kind of dotted quad is this?
						$param = '';
					}
				} else if (preg_match ( '/^[\w\d\.-]+$/', $param ) && // Dots, hyphens, numbers.
! preg_match ( '/^[\.-]/', $param ) && // No leading dots/hyphens.
! preg_match ( '/[\.-]$/', $param )) // No trailing dots/hyphens.
{
					// All is ok - $param is respected.
				} else {
					// All is not ok...
					$param = '';
				}
				return $param;
			
			case PARAM_URL : // Allow safe ftp, http, mailto urls.
				$param = self::fix_utf8 ( $param );
				include_once ($CFG->dirroot . '/lib/validateurlsyntax.php');
				if (! empty ( $param ) && validateUrlSyntax ( $param, 's?H?S?F?E?u-P-a?I?p?f?q?r?' )) {
					// All is ok, param is respected.
				} else {
					// Not really ok.
					$param = '';
				}
				return $param;
			
			case PARAM_LOCALURL :
				
				// Allow http absolute, root relative and relative URLs within wwwroot.
				$param = clean_param ( $param, PARAM_URL );
				if (! empty ( $param )) {
					if (preg_match ( ':^/:', $param )) {
						// Root-relative, ok!
					} else if (preg_match ( '/^' . preg_quote ( $CFG->wwwroot, '/' ) . '/i', $param )) {
						// Absolute, and matches our wwwroot.
					} else {
						// Relative - let's make sure there are no tricks.
						if (validateUrlSyntax ( '/' . $param, 's-u-P-a-p-f+q?r?' )) {
							// Looks ok.
						} else {
							$param = '';
						}
					}
				}
				return $param;
			
			case PARAM_PEM :
				$param = trim ( $param );
				// PEM formatted strings may contain letters/numbers and the symbols:
				// forward slash: /
				// plus sign: +
				// equal sign: =
				// , surrounded by BEGIN and END CERTIFICATE prefix and suffixes.
				if (preg_match ( '/^-----BEGIN CERTIFICATE-----([\s\w\/\+=]+)-----END CERTIFICATE-----$/', trim ( $param ), $matches )) {
					list ( $wholething, $body ) = $matches;
					unset ( $wholething, $matches );
					$b64 = clean_param ( $body, PARAM_BASE64 );
					if (! empty ( $b64 )) {
						return "-----BEGIN CERTIFICATE-----\n$b64\n-----END CERTIFICATE-----\n";
					} else {
						return '';
					}
				}
				return '';
			
			case PARAM_BASE64 :
				if (! empty ( $param )) {
					// PEM formatted strings may contain letters/numbers and the symbols
					// forward slash: /
					// plus sign: +
					// equal sign: =.
					if (0 >= preg_match ( '/^([\s\w\/\+=]+)$/', trim ( $param ) )) {
						return '';
					}
					$lines = preg_split ( '/[\s]+/', $param, - 1, PREG_SPLIT_NO_EMPTY );
					// Each line of base64 encoded data must be 64 characters in length, except for the last line which may be less
					// than (or equal to) 64 characters long.
					for($i = 0, $j = count ( $lines ); $i < $j; $i ++) {
						if ($i + 1 == $j) {
							if (64 < strlen ( $lines [$i] )) {
								return '';
							}
							continue;
						}
						
						if (64 != strlen ( $lines [$i] )) {
							return '';
						}
					}
					return implode ( "\n", $lines );
				} else {
					return '';
				}
			
			case PARAM_TAG :
				$param = self::fix_utf8 ( $param );
				// Please note it is not safe to use the tag name directly anywhere,
				// it must be processed with s(), urlencode() before embedding anywhere.
				// Remove some nasties.
				$param = preg_replace ( '~[[:cntrl:]]|[<>`]~u', '', $param );
				// Convert many whitespace chars into one.
				$param = preg_replace ( '/\s+/', ' ', $param );
				$param = core_text::substr ( trim ( $param ), 0, TAG_MAX_LENGTH );
				return $param;
			
			case PARAM_TAGLIST :
				$param = self::fix_utf8 ( $param );
				$tags = explode ( ',', $param );
				$result = array ();
				foreach ( $tags as $tag ) {
					$res = clean_param ( $tag, PARAM_TAG );
					if ($res !== '') {
						$result [] = $res;
					}
				}
				if ($result) {
					return implode ( ',', $result );
				} else {
					return '';
				}
			
			case PARAM_CAPABILITY :
				if (get_capability_info ( $param )) {
					return $param;
				} else {
					return '';
				}
			
			case PARAM_PERMISSION :
				$param = ( int ) $param;
				if (in_array ( $param, array (
						CAP_INHERIT,
						CAP_ALLOW,
						CAP_PREVENT,
						CAP_PROHIBIT 
				) )) {
					return $param;
				} else {
					return CAP_INHERIT;
				}
			
			case PARAM_AUTH :
				$param = clean_param ( $param, PARAM_PLUGIN );
				if (empty ( $param )) {
					return '';
				} else if (exists_auth_plugin ( $param )) {
					return $param;
				} else {
					return '';
				}
			
			case PARAM_LANG :
				$param = clean_param ( $param, PARAM_SAFEDIR );
				if (get_string_manager ()->translation_exists ( $param )) {
					return $param;
				} else {
					// Specified language is not installed or param malformed.
					return '';
				}
			
			case PARAM_THEME :
				$param = clean_param ( $param, PARAM_PLUGIN );
				if (empty ( $param )) {
					return '';
				} else if (file_exists ( "$CFG->dirroot/theme/$param/config.php" )) {
					return $param;
				} else if (! empty ( $CFG->themedir ) and file_exists ( "$CFG->themedir/$param/config.php" )) {
					return $param;
				} else {
					// Specified theme is not installed.
					return '';
				}
			
			case PARAM_USERNAME :
				$param = self::fix_utf8 ( $param );
				$param = str_replace ( " ", "", $param );
				// Convert uppercase to lowercase MDL-16919.
				$param = core_text::strtolower ( $param );
				if (empty ( $CFG->extendedusernamechars )) {
					// Regular expression, eliminate all chars EXCEPT:
					// alphanum, dash (-), underscore (_), at sign (@) and period (.) characters.
					$param = preg_replace ( '/[^-\.@_a-z0-9]/', '', $param );
				}
				return $param;
			
			case PARAM_EMAIL :
				$param = self::fix_utf8 ( $param );
				if (self::validate_email ( $param )) {
					return $param;
				} else {
					return '';
				}
			
			case PARAM_STRINGID :
				if (preg_match ( '|^[a-zA-Z][a-zA-Z0-9\.:/_-]*$|', $param )) {
					return $param;
				} else {
					return '';
				}
			
			case PARAM_TIMEZONE :
				
				// Can be int, float(with .5 or .0) or string seperated by '/' and can have '-_'.
				$param = self::fix_utf8 ( $param );
				$timezonepattern = '/^(([+-]?(0?[0-9](\.[5|0])?|1[0-3](\.0)?|1[0-2]\.5))|(99)|[[:alnum:]]+(\/?[[:alpha:]_-])+)$/';
				if (preg_match ( $timezonepattern, $param )) {
					return $param;
				} else {
					return '';
				}
			case PARAM_DATE :
				global $CONFIG;
				if($param!=''){
					switch (setting::getDateFormat()) {
						case 'yyyy-mm-dd' :
							list ( $y, $m, $d ) = explode ( '-', $param );
							break;
						case 'dd-mm-yyyy' :
							list ( $d, $m, $y ) = explode ( '-', $param );
							break;
						case 'mm-dd-yyyy' :
							list ( $m, $d, $y ) = explode ( '-', $param );
							break;
						case 'yyyy/mm/dd' :
							list ( $y, $m, $d ) = explode ( '/', $param );
							break;
						case 'dd/mm/yyyy' :
							list ( $d, $m, $y ) = explode ( '/', $param );
							break;
						case 'mm/dd/yyyy' :
							list ( $m, $d, $y ) = explode ( '/', $param );
							break;
					}
					
					if (checkdate ( $m, $d, $y )) {
						return $param;
					} else {
						return '';
					}
			}
			case PARAM_TIME :
				global $CONFIG;
				if($param!=''){
					if (checktime ( $param )) {
						return $param;
					} else {
						return '';
					}
				}
				
		}
	}
	static function fix_utf8($value) {
		if (is_null ( $value ) or $value === '') {
			return $value;
		} else if (is_string ( $value )) {
			if (( string ) ( int ) $value === $value) {
				// Shortcut.
				return $value;
			}
			// No null bytes expected in our data, so let's remove it.
			$value = str_replace ( "\0", '', $value );
			
			// Note: this duplicates min_fix_utf8() intentionally.
			static $buggyiconv = null;
			if ($buggyiconv === null) {
				$buggyiconv = (! function_exists ( 'iconv' ) or iconv ( 'UTF-8', 'UTF-8//IGNORE', '100' . chr ( 130 ) . '??' ) !== '100??');
			}
			
			if ($buggyiconv) {
				if (function_exists ( 'mb_convert_encoding' )) {
					$subst = mb_substitute_character ();
					mb_substitute_character ( '' );
					$result = mb_convert_encoding ( $value, 'utf-8', 'utf-8' );
					mb_substitute_character ( $subst );
				} else {
					// Warn admins on admin/index.php page.
					$result = $value;
				}
			} else {
				$result = @iconv ( 'UTF-8', 'UTF-8//IGNORE', $value );
			}
			
			return $result;
		} else if (is_array ( $value )) {
			foreach ( $value as $k => $v ) {
				$value [$k] = self::fix_utf8 ( $v );
			}
			return $value;
		} else if (is_object ( $value )) {
			// Do not modify original.
			$value = clone ($value);
			foreach ( $value as $k => $v ) {
				$value->$k = self::fix_utf8 ( $v );
			}
			return $value;
		} else {
			// This is some other type, no utf-8 here.
			return $value;
		}
	}
	static function validate_email($address) {
		return (preg_match ( '#^[-!\#$%&\'*+\\/0-9=?A-Z^_`a-z{|}~]+' . '(\.[-!\#$%&\'*+\\/0-9=?A-Z^_`a-z{|}~]+)*' . '@' . '[-!\#$%&\'*+\\/0-9=?A-Z^_`a-z{|}~]+\.' . '[-!\#$%&\'*+\\./0-9=?A-Z^_`a-z{|}~]+$#', $address ));
	}
	
	static function isEmptyDate($date){
		return $date==''||$date=='0'||substr($date,0,4)=='0000'; 
	}
	
	/*static function islink($url){
		if (preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $url)) {
		  return true;
		}
		else {
		  return false;
		}
	}*/
}
class ui {
	
	static function cropBtn($word='',$attr=array()){
		global $Lang;
		$word = $word == '' ? $Lang['crop'] : $word;
		$attr['value'] = $word . '<i class="fa fa-crop"></i>';
		$attr['attr']['class'] .= ' btn btn-default ';
		return UIElementController::In_To_String ( "button", $attr );
	}
	
	static function modalHeader($word){
		return '<h3>'.$word.'</h3>';
	}
	static function displayGrowl() {
		
		if (isset($_SESSION['growl']['text'])){
			$return = "App.growl('".$_SESSION['growl']['text']."','".$_SESSION['growl']['type']."')\n";
			$_SESSION ['growl'] = '';
			return $return;
		}
	}
	
	static function blockUI($element=''){
		if($element!=''){
		return "App.blockUI({
			target: '#".$element."',
			boxed: true,
			message: 'Processing...'
		});";
		
		}else{
			return "App.blockUI();";
				
		}
	}
	
	static function unblockUI($element=''){
		if($element!=''){
			return "App.unblockUI('#".$element."');";
		}else{
			return "App.unblockUI();";
		}
	}
	
	static function setGrowl($text,$type){
		$_SESSION['growl'] = array('text'=>$text,'type'=>$type);
	}
	
	
	static function exportBtn($word = '', $attr = array()) {
		global $Lang;
		
		$word = $word == '' ? $Lang['export'] : $word;
		$attr['value'] = $word . '<i class="fa fa-file-excel-o"></i>';
		$attr['attr']['class'] .= 'btn purple-plum';
		return UIElementController::In_To_String ( "button", $attr );
	}
	static function addBtn($word = '', $attr = array()) {
		global $Lang;
		$word = $word == '' ? $Lang['add'].'<i class="fa fa-plus"></i>' : $word;
		$attr['value'] = $word;
		$attr['attr']['class'] .= ' btn blue';
		if($attr['attr']['tooltiptitle']!=''){
			$attr['attr']['class'] .= ' tooltips';
			$attr['attr']['data-placement'] = $attr['attr']['data-placement']==''?"top":$attr['attr']['data-placement'];
			$attr['attr']['data-original-title'] = $attr['attr']['tooltiptitle'];
		}
		return UIElementController::In_To_String ( "button", $attr );
	}
	static function closeBtn($word = '', $attr = array()) {
		global $Lang;
		$word = $word == '' ? $Lang['close'] : $word;
		$attr['value'] = $word;
		$attr['attr']['class'] .= ' btn default';
		return UIElementController::In_To_String ( "button", $attr );
	}
	static function activateBtn($word = '', $attr = array()) {
		global $Lang;
		$word = $word == '' ? $Lang['activate'] : $word;
		$attr ['value'] = $word . '<i class="fa fa-check"></i>';
		$attr ['attr'] ['class'] .= ' btn green';
		return UIElementController::In_To_String ( "button", $attr );
	}
	static function editBtn($word = '', $attr = array()) {
		global $Lang;
		$word = $word == '' ? $Lang['edit'] : $word;
		$attr ['value'] = $word . '<i class="fa fa-pencil"></i>';
		$attr ['attr'] ['class'] .= ' btn purple';
		if($attr['attr']['tooltiptitle']!=''){
			$attr['attr']['class'] .= ' tooltips';
			$attr['attr']['data-placement'] = $attr['attr']['data-placement']==''?"top":$attr['attr']['data-placement'];
			$attr['attr']['data-original-title'] = $attr['attr']['tooltiptitle'];
		}
		return UIElementController::In_To_String ( "button", $attr );
	}
	static function deactivateBtn($word = '', $attr = array()) {
		global $Lang;
		$word = $word == '' ? $Lang['deactivate'] : $word;
		$attr ['value'] = $word . '<i class="fa fa-times"></i>';
		$attr ['attr'] ['class'] .= ' btn grey';
		return UIElementController::In_To_String ( "button", $attr );
	}
	static function removeBtn($word = '', $attr = array()) {
		global $Lang;
		$word = $word == '' ? $Lang['remove'] : $word;
		$attr ['value'] = $word . '<i class="fa fa-trash-o"></i>';
		$attr ['attr'] ['class'] .= ' btn red';
		return UIElementController::In_To_String ( "button", $attr );
	}
	static function submitBtn($word = '', $attr = array()) {
		global $Lang;
		$word = $word == '' ? $Lang['submit'] : $word;
		$attr['value'] = $word;
		$attr['attr']['class'] .= 'btn green';
		return UIElementController::In_To_String ( "button", $attr );
	}
	static function backBtn($word = '', $attr = array()) {
		global $Lang;
		$word = $word == '' ? $Lang['back'] : $word;
		$attr ['value'] = $word;
		$attr ['attr'] ['class'] .= 'btn grey';
		return UIElementController::In_To_String ( "button", $attr );
	}
	static function btn($word,$attr = array()) {
		$attr ['value'] = $word;
		$attr ['class'] .= ' btn ';
		if($attr['attr']['tooltiptitle']!=''){
			$attr['attr']['class'] .= ' tooltips';
			$attr['attr']['data-placement'] = $attr['attr']['data-placement']==''?"top":$attr['attr']['data-placement'];
			$attr['attr']['data-original-title'] = $attr['attr']['tooltiptitle'];
		}
		return UIElementController::In_To_String ( "button", $attr );
	}
	
	static function postFA(){
		return self::fa('pencil');
	}
	
	static function extVideoFA(){
		return self::fa('youtube-play');
	}
	
	static function savedFA(){
		return self::fa('bookmark');
	}
	
	static function downloadBtn($word = '', $attr = array()) {
		global $Lang;
		
		$word = $word == '' ? $Lang['download'] : $word;
		$attr ['value'] = $word.ui::fa('download');
		$attr ['attr'] ['class'] .= ' btn blue ';
		return UIElementController::In_To_String ( "button", $attr );
	}
	static function viewlinkbtn($word = '', $attr = array()) {
		global $Lang;
	
		$word = $word == '' ? $Lang['downloadlink']: $word;
		$attr ['value'] = $word.ui::fa('link');
		$attr ['attr'] ['class'] .= ' btn yellow-gold ';
		return UIElementController::In_To_String ( "button", $attr );
	}
	static function viewBtn($word = '', $attr = array()) {
		global $Lang;
	
		$word = $word == '' ? $Lang['view'] : $word;
		$attr ['value'] = $word.ui::fa('search');
		$attr ['attr'] ['class'] .= ' btn yellow ';
		return UIElementController::In_To_String ( "button", $attr );
	}
	static function saveBtn($word = '', $attr = array()) {
		global $Lang;
		$word = $word == '' ? $Lang['save'] : $word;
		$attr ['value'] = $word;
		$attr ['attr'] ['class'] .= 'btn green';
		return UIElementController::In_To_String ( "button", $attr );
	}
	static function cancelbtn($word,$attr = array()) {
		global $Lang;
		$word = $word == '' ? $Lang['cancel'] : $word;
		$attr ['value'] = $word;
		$attr ['attr']['class'] .= 'btn default';
		return UIElementController::In_To_String ( "button", $attr );
	}
	static function clearbtn($word,$attr = array()) {
		global $Lang;
		$word = $word == '' ? $Lang['clear'] : $word;
		$attr ['value'] = $word;
		$attr ['attr']['class'] .= 'btn default';
		return UIElementController::In_To_String ( "button", $attr );
	}
	static function expandbtn($word,$attr = array()) {
		global $Lang;
		$word = $word == '' ? $Lang['expand'] : $word;
		$attr ['value'] = $word;
		$attr ['attr']['class'] .= 'btn blue-madison';
		return UIElementController::In_To_String ( "button", $attr );
	}
	static function collapsebtn($word,$attr = array()) {
		global $Lang;
		$word = $word == '' ? $Lang['collapse'] : $word;
		$attr ['value'] = $word;
		$attr ['attr']['class'] .= 'btn blue-madison';
		return UIElementController::In_To_String ( "button", $attr );
	}
	static function closeModalbtn($word='',$attr = array(),$closeall=false) {
		global $Lang;
		$word = $word == '' ? $Lang['close'] : $word;
		$attr['value'] = $word;
		$attr['attr']['class'] .= 'btn default';
		$attr['attr']['data-dismiss'] = 'modal';
		if($closeall)
		$attr['attr']['onClick'] = '$(\'.modal\').modal(\'hide\');';
		return UIElementController::In_To_String ( "button", $attr );
	}
	
	static function fa($fa,$attr=array()){
		$attr['fa'] = $fa;
		return UIElementController::In_To_String ( "fa", $attr );
	}
	static function input($id,$value,$class,$attr=array()){
		$input['id'] = $id;
		$input['name'] = $id;
		$input['value'] = $value;
		$input['attr'] = $attr;
		$input['attr']['class'] = $class;
		return UIElementController::In_To_String ( "input", $input );
	}
	static function checkbox($id,$value,$checked,$class,$attr=array()){
		$input['id'] = $id;
		$input['name'] = $id;
		$input['value'] = $value;
		$input['checked'] = $checked;
		$input['attr'] = $attr;
		$input['attr']['class'] = $class;
		return UIElementController::In_To_String ( "checkbox", $input );
	}
	static function removecolor(){
		return 'red';
	}
	static function archivecolor(){
		return 'bg-grey-steel';
	}
	
	static function unarchivecolor(){
		return 'bg-grey-steel';
	}
	static function successcolor(){
		return 'bg-green';
	}
	static function tt($pos,$tt){
		return UIElementController::In_To_String("tt",array('pos'=>$pos,'tt'=>$tt));
	}
	
	static function textarea($text,$id,$name,$class,$attr=array()){
		return UIElementController::In_To_String("textarea",array('class'=>$class,'id'=>$id,'name'=>$name,'attr'=>($attr)));
	}
	
	/*static function div_s($args=array()){
		$id = $args['id'];
		$name = $args['name'];
		$class = $args['class'];
		$attr = $args['attr'];
		$size = $args['size'];
		UIElementController::render("div_s",array('size'=>$size,'class'=>$class,'id'=>$id,'name'=>$name,'attr'=>($attr)));
		
	}
	static function div_e(){
		UIElementController::render("div_e");
	}*/
	static function getajaxResult($result,$msg='',$html='',$attr=array()){
		$return = array();
		$return['status'] = $result?'success':'fail';
		if($msg!='')
			$return['msg'] = $msg;
		if($html!='')
			$return['html'] = $html;
		if(sizeof($attr)>0){
			foreach($attr as $k=>$v){
				$return[$k] = $v;
			}
		}	
		return $return;
		
	}
	
	static function unfollowBtn(){
		
		$input['value'] = ui::fa('check').' Following';
		$input['id'] = 'unfollowbtn';
		$input['class'] = "btn-success";
		
		return UIElementController::In_To_String( "button", $input );
	}
	
	static function followBtn(){
	
 		$input['value'] =  'Follow now';
		$input['id'] = 'followbtn';
		$input['class'] = "btn-default";

		return UIElementController::In_To_String( "button", $input );
	}
}

function isloggedin(){
	return $_SESSION['user_id']!='';
}

function getActionFromUrl($path){
	$arr = explode("/",$path);
	$first = $arr[1];
	$sec = $arr[2];
	$sec = explode("?",$sec);
	$sec = $sec[0];
	return array('action'=>$first,'sec'=>$sec); 
}

function is_image($path)
{
	$a = getimagesize($path);
	$image_type = $a[2];
	 
	if(in_array($image_type , array(IMAGETYPE_GIF , IMAGETYPE_JPEG ,IMAGETYPE_PNG , IMAGETYPE_BMP)))
	{
		//return true;
		return $a['mime'];
	}
	return false;
}

function setCookies(){
	$authcode = genAuthCode();
	$sockettoken = genSocketToken();
	setcookie("authcode",$authcode, time()+3600);  /* expire in 1 hour */
	
	//setcookie("sockettoken",$sockettoken, time()+3600);  /* expire in 1 hour */
	//unset($_COOKIE['authcode']);
}
 
    
function genSocketToken(){
	global $CONFIG;
	
	$crypto = new Crypto();
 	$crypto->secret = $CONFIG['socket_secret'];
 	$crypto->key = $CONFIG['jwt_secret'];
 	$arr = array($_SESSION['user_id'],$_SESSION['user_name'],$_SESSION['user_email'],$_SESSION['role_id'],$_SESSION['ua']);
	$str = implode("||##||",$arr);
	return $crypto->encrypt($str);
}

function genAuthCode() {
	global $CONFIG;
	
 	
 	$crypto = new Crypto();
 	$crypto->secret = $CONFIG['auth_secret'];
 	$crypto->key = $CONFIG['jwt_secret'];
 	$arr = array($_SESSION['user_id'],$_SESSION['user_name'],$_SESSION['user_email'],$_SESSION['role_id'],$_SESSION['ua']);
	$str = implode("||##||",$arr);
	return $crypto->encrypt($str);

	/*echo "Encrypted: ".$encrypted."\n";
	$decrypted = $crypto->decrypt($encrypted);
	echo "Decrypted: $decrypted\n";
	 	die;*/
 	

}

 class Crypto
{
    private $blocksize = 16;
    public function decrypt($data)
    {
    	global $CONFIG;
        return $this->unpad(mcrypt_decrypt(MCRYPT_RIJNDAEL_128, 
            $this->secret, 
            hex2bin($data),
            MCRYPT_MODE_CBC, $this->key), $this->blocksize);
    }
    public function encrypt($data)
    {
    	global $CONFIG;
        //don't use default php padding which is '\0'
        $pad = $this->blocksize - (strlen($data) % $this->blocksize);
        $data = $data . str_repeat(chr($pad), $pad);
        return bin2hex(mcrypt_encrypt(MCRYPT_RIJNDAEL_128,
            $this->secret,
            $data, MCRYPT_MODE_CBC, $this->key));
    }
    private function unpad($str, $blocksize)
    {
        $len = mb_strlen($str);
        $pad = ord( $str[$len - 1] );
        if ($pad && $pad < $blocksize) {
            $pm = preg_match('/' . chr($pad) . '{' . $pad . '}$/', $str);
            if( $pm ) {
                return mb_substr($str, 0, $len - $pad);
            }
        }
        return $str;
    }
}

function isPageCall($page,$met=''){
	global $CONFIG;
	list($dum,$ctr,$method) = explode("/",$_SERVER['REQUEST_URI']);
	//if($ctr=='action'){ 
	if(substr($method,0,4)=='ajax'){	//ajax call
		list($ctr,$method) = explode("/",substr($_SERVER['HTTP_REFERER'],strlen($CONFIG['home_http'])));
	} 
	//echo 'ctr: '.$ctr.'<br/>';
	//echo 'method: '.$method.'<br/>';
	if($page==''){
		return $ctr==$met;
	}
	switch($page){
		case 'index':
			return $ctr==''&&$method=='';
		break;
		case 'page':
			if($met=='')
				return $ctr=='page';
			else
				return $ctr=='page' && $met==$method;
		break; 
		case 'feed':
			if($met=='')
				return $ctr=='myfeed';
			else
				return $ctr=='myfeed' && $met==$method;
		break; 
		case 'post':
			if($met=='')
				return $ctr=='post';
			else
				return $ctr=='post' && $met==$method;
	}
}

function share2Facebook($link){
	global $CONFIG;
	return array('link'=>'http://www.facebook.com/sharer/sharer.php?u='.$CONFIG['home_http'].$link);
}

function share2Twitter($link){
	global $CONFIG;
	//return array('link'=>'https://twitter.com/intent/tweet?text='.$text.'&url='.$link);
	return array('link'=>'https://twitter.com/intent/tweet?url='.$CONFIG['home_http'].$link);
}

function renderOgMeta($Data){
	global $CONFIG;
	/*<meta content="Karen Walker - MI Luxury" property="og:title">';
	<meta content="website" property="og:type">
	<meta content="http://www.mi-luxury.com//zh/karen-walker/729-karen-walker.html" property="og:url">
	<meta content="http://www.mi-luxury.com/3066-large_default/karen-walker.jpg" property="og:image">
	<meta content="Harvest Black Silver黑银色" property="og:description">
	<link href="/img/favicon.ico?1459829420" type="image/vnd.microsoft.icon" rel="icon">
	<link href="/img/favicon.ico?1459829420" type="image/x-icon" rel="shortcut icon">*/
	if(isPageCall('index')||isPageCall('feed')){
		$pagedesc = $CONFIG['site_desc'][$_SESSION['language']];
		$ogtitle = $CONFIG['site_title'][$_SESSION['language']];
		$ogimage = $CONFIG['home_http'].'theme/assets/social/images/header_logo.png';
		$ogdesc = $CONFIG['site_title'][$_SESSION['language']];
	}elseif(isPageCall('page','post')){
		$pagedesc = $Data['desc']==''?$CONFIG['site_desc'][$_SESSION['language']]:$Data['desc'];
		$ogtitle = $Data['title']==''?$CONFIG['site_title'][$_SESSION['language']]:$Data['title'];
		$ogimage = $Data['image']==''?$CONFIG['home_http'].'theme/assets/social/images/header_logo.png':$Data['image'];
		$ogdesc = $Data['desc']==''?$CONFIG['site_desc'][$_SESSION['language']]:$Data['desc'];
		
	}
	$url = $CONFIG['home_http'].substr($_SERVER['REQUEST_URI'],1);

	return '<meta name="description" content="'.$pagedesc.'">
<meta content="'.$ogtitle.'" property="og:title">
<meta content="'.$url.'" property="og:url">
<meta content="'.$ogimage.'" property="og:image">
<meta content="'.$ogdesc.'" property="og:description">';
	
}
?>