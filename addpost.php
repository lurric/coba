<?php
require 'vendor/autoload.php';
use Buchin\GoogleImageGrabber\GoogleImageGrabber;

set_time_limit(0);
function FilterPermalink($link){
    // replace non letter or digits by -
    $link = preg_replace('~[^\pL\d]+~u', '-', $link);
    // trim
    $link = trim($link, '-');
    // remove duplicate -
    $link = preg_replace('~-+~', '-', $link);
    // lowercase
    $link = strtolower($link);
    if (empty($link)) {
        return '0';
    }
    return $link;
}
function delete_directory($dirname) {
    if (is_dir($dirname))
        $dir_handle = opendir($dirname);
    if (!$dir_handle)
        return false;
    while($file = readdir($dir_handle)) {
        if ($file != "." && $file != "..") {
            if (!is_dir($dirname."/".$file))
                 unlink($dirname."/".$file);
            else
                 delete_directory($dirname.'/'.$file);
        }
     }
     closedir($dir_handle);
     rmdir($dirname);
     return true;
}
$badword = explode("\n", file_get_contents("data/badword.txt"));
$url = file_get_contents("data/url.txt");
$listtitle = array_unique(array_filter(explode("\n", file_get_contents("data/addnewpost.txt"))));
if ($listtitle) {
    $fail_title = array();
    $bads = 0;
    $duplicate = 0;
    $success = 0;
    $google = 0;
    foreach ($listtitle as $title) {
        $bad = "no";
        foreach ($badword as $badwords) {
            if (preg_match("/\b$badwords\b/i", $titles)) {
                $bad = "yes";
                $bads++;
	            $fail_title[] = $title;
	            continue;
            }
        }
        if ($bad != "yes") {
	        $newslug = FilterPermalink($title);
	        $posts = explode("\n", file_get_contents("data/post.txt"));
	        foreach ($posts as $getpost) {
	            if ($newslug == $getpost) {
	                $duplicate++;
	                $newslug = 0;
	                $fail_title[] = $title;
	            	continue;
	            }
	        }
	        if ($newslug) { 
	            $fileposts = array_diff(scandir("data/post"), array('..', '.'));
	            foreach ($fileposts as $filepost) {            
	                if (preg_match("/\b$newslug\b/i", $filepost)) {
	                    delete_directory("data/post/".$newslug);
	                }
	            }

	            // grab google
	            $keyword = strtolower($title);
	            $google = GoogleImageGrabber::grab($keyword);
	            if ($google) {
	            	$google++;
	                $fail_title[] = $title;
	            	continue;
	            }
	            $array_urlimg = array();
	            $array_titleimg = array();
	            foreach ($google as $googles) {
	                if (getimagesize($googles['url'])) {
	                    $array_urlimg[] = $googles['url'];
	                    $array_titleimg[] = ucwords($googles['title']);
	                }
	            }
	            $array_urlimg = array_unique(array_filter($array_urlimg));
	            $array_titleimg = array_unique(array_filter($array_titleimg));

	            if ($array_urlimg && $array_titleimg) {
	                // new directory
	                $newfolder = "data/post/".$newslug;
	                mkdir($newfolder);  
	                // save url & title image
	                fopen($newfolder."/urlimg.txt", "w"); 
	                fopen($newfolder."/titleimg.txt", "w");
	                file_put_contents($newfolder."/urlimg.txt", implode("\n", $array_urlimg));
	                file_put_contents($newfolder."/titleimg.txt", implode("\n", $array_titleimg));
	                // save post
	                $titlepost = ucwords($title);
	                $datepost = date("d-m-Y");
	                $timepost = date("h:i:s");   
	                fopen($newfolder."/data.txt", "w");
	                $put = file_put_contents($newfolder."/data.txt", $titlepost."\n".$datepost."\n".$timepost);  

	                $get_tmp = file_get_contents("data/post.txt");
	                if (strlen($get_tmp) > 2) {
	                    file_put_contents("data/post.txt", $newslug."\n".$get_tmp);
	                } else {
	                    file_put_contents("data/post.txt", $newslug);
	                }
	                $success++;
	            } else {
	                $fail_title[] = $title;
	            }
	        } else {
	            $fail_title[] = $title;
	        }
	    }
    }
    // create daftar post csv
    $getpost = file_get_contents("data/post.txt");
    $getpost = array_filter(explode("\n", $getpost));
    $arraycsv = array(array("Title","Url"));
    foreach ($getpost as $getposts) {
        $get = explode("\n", file_get_contents("data/post/".$getposts."/data.txt"));
        $list = array($get[0]); // title post
        $list[] = $url."/".$getposts; // url post
        $arraycsv[] = $list;
    }
    $filecsv = "data/post.csv";
    ftruncate(fopen($filecsv, "a+"),0);
    fclose(fopen($filecsv, "w" ));
    $fp = fopen($filecsv, 'w'); 
    foreach ($arraycsv as $fields) { 
        fputcsv($fp, $fields); 
    }              
    fclose($fp);
    $file = "data/addnewpost.txt";
    ftruncate(fopen($file, "a+"),0);
    fclose(fopen($file, "w" ));
} 
echo "==================================================================\n"
echo "Selesai Posting!\n";
echo "------------------------------------------------------------------\n"
echo "Success = ".$success." keyword\n";
echo "Badword = ".$bads." keyword\n";
echo "Duplicate = ".$duplicate." keyword\n";
echo "Can't access google = ".$google." keyword\n";
echo "------------------------------------------------------------------\n"
if ($fail_title) {
	$f = 0;
	foreach ($fail_title as $fail) {
		$f++;
		echo $f.". ".$fail."\n";
	}
}
echo "=================================================================="
?>