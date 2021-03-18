<?php 
set_time_limit(30);
if (isset($_POST['pg']) && isset($_POST['fn'])) {
	$url = file_get_contents("../data/url.txt");
	$path = '../export';
	if ($_POST['pg'] == $url && $_POST['fn'] == "index.html") {
    	$files = array_diff(scandir($path), array('..', '.'));
		foreach($files as $file){ // iterate files
			if(is_file($path."/".$file)) {
				unlink($path."/".$file); // delete file
			}
		}
	}
	$get = str_replace($url, "", str_replace($url."/p/", "", file_get_contents($_POST['pg'])));
	$put = file_put_contents($path."/".$_POST['fn'], $get);
	if ($put) {
		die("ok");
	} else {
		die("no");
	}
} 
?>