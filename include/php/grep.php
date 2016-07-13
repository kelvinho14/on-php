<?php 

if ($_SERVER['PHP_AUTH_USER'] != 'admin' or $_SERVER['PHP_AUTH_PW'] != 'kelhbb14') {
	$realm = "Administrator Login";
	Header("WWW-Authenticate: Basic realm=\"".$realm."\"");
	Header("HTTP/1.0 401 Unauthorized");
	echo "Unauthorized Access\n";
	exit;
}

//$path_to_check = '../../application/view/calendar';
//$searchword = 'div';

$path_to_check = $_GET['p'];
$searchword = $_GET['s'];



$file = '';

if($file!='' && is_file($file)){
	echo '<table border="1">';
	searchInFile($file,$searchword);
	echo '</table>';
}else{
	echo '<table border="1">';
	loopFolderAndSearch($path_to_check,$searchword);
	echo '</table>';
}

function loopFolderAndSearch($path_to_check,$searchword){
	foreach(glob($path_to_check . '*') as $filename){
		if(is_dir($filename)){
			loopFolderAndSearch($filename.'/',$searchword);
		}else{
			searchInFile($filename,$searchword);
		}
	}
}


function searchInFile($filename,$searchword){
	
	foreach(file($filename) as $fli=>$fl){
		if(strpos($fl, $searchword)!==false){
			if($filename!=$loopfilename){
				echo '<tr><td>'.$filename.'</td><td></td></tr>';
			}
			echo '<tr><td></td><td>line'.($fli+1).': '. htmlspecialchars($fl).'</td></tr>';
			$loopfilename = $filename;
		}
	}
}


/*
 // get the file contents, assuming the file to be readable (and exist)
$contents = file_get_contents($file);
// escape special characters in the query
$pattern = preg_quote($searchfor, '/');
// finalise the regular expression, matching the whole line
$pattern = "/^.*$pattern.*\$/m";
// search, and store all matching occurences in $matches
if(preg_match_all($pattern, $contents, $matches)){
   echo "Found matches:\n";
   echo implode("\n", $matches[0]);
}
else{
   echo "No matches found";
}*/

?>