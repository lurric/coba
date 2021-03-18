<?php
require '../vendor/autoload.php';
use Buchin\GoogleImageGrabber\GoogleImageGrabber;
set_time_limit(30);
function isSecure() {
  return
    (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
    || $_SERVER['SERVER_PORT'] == 443;
}
if (isSecure()) {
    $url = "https://".$_SERVER['SERVER_NAME']; 
} else { 
    $url = "http://".$_SERVER['SERVER_NAME']; 
}
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
if (isset($_POST['kw'])) {
    $title = $_POST['kw'];
    $posts = array_filter(array_unique(explode("\n", file_get_contents("../data/post.txt"))));
    $fail_title = array();
	$badword = explode("\n", file_get_contents("../data/badword.txt"));
    $bad = "no";
    $duplicate = 0;
    foreach ($badword as $badwords) {
        if (preg_match("/\b$badwords\b/i", $title)) {
            $bad = "yes";
        }
    }
    if ($bad != "yes") {
        $newslug = FilterPermalink($title);
        foreach ($posts as $getpost) {
            if ($newslug == $getpost) {
                $duplicate = 1;
                $newslug = 0;
            }
        }
        if ($newslug) {    
            $fileposts = array_diff(scandir("../data/post"), array('..', '.'));
            foreach ($fileposts as $filepost) {            
                if (preg_match("/\b$newslug\b/i", $filepost)) {
                    delete_directory("../data/post/".$newslug);
                }
            }     

            // grab google
            $keyword = strtolower($title);
            $google = GoogleImageGrabber::grab($keyword);
            if (!$google) {
                die('google');
            }
            $array_urlimg = array();
            $array_titleimg = array();
            $num = 0;
            foreach ($google as $googles) {
                $num++;
                if (getimagesize($googles['url'])) {
                    if ($num != 50) {
                        $array_urlimg[] = $googles['url'];
                        $array_titleimg[] = ucwords($googles['title']);
                    } else {
                        break;
                    }
                }
            }
            $array_urlimg = array_unique(array_filter($array_urlimg));
            $array_titleimg = array_unique(array_filter($array_titleimg));

            if ($array_urlimg && $array_titleimg) {
                // new directory
                $newfolder = "../data/post/".$newslug;
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
                file_put_contents("../data/url.txt", $url); 

                $get_tmp = file_get_contents("../data/post.txt");
                if (strlen($get_tmp) > 2) {
                    file_put_contents("../data/post.txt", $newslug."\n".$get_tmp);
                } else {
                    file_put_contents("../data/post.txt", $newslug);
                }
                file_put_contents("../data/post.txt", implode("\n", array_unique(array_filter(explode("\n", file_get_contents("../data/post.txt"))))));
			    // create daftar post csv
			    $filelistpost = "../data/post.txt";
			    $getpost = file_get_contents($filelistpost);
			    $getpost = array_filter(explode("\n", $getpost));
			    $arraycsv = array(array("Title","Url"));
			    foreach ($getpost as $getposts) {
			        $get = explode("\n", file_get_contents("../data/post/".$getposts."/data.txt"));
			        $list = array($get[0]); // title post
			        $list[] = $url."/".$getposts; // url post
			        $arraycsv[] = $list;
			    }
			    $arraycsv = array_unique($arraycsv);
			    $filecsv = "../data/post.csv";
			    ftruncate(fopen($filecsv, "a+"),0);
			    fclose(fopen($filecsv, "w" ));
			    $fp = fopen($filecsv, 'w'); 
			    foreach ($arraycsv as $fields) { 
			        fputcsv($fp, $fields); 
			    }              
			    fclose($fp);
            } else {
                $fail_title[] = $title;
            }
        } else {
            $fail_title[] = $title;
        }
    }
    if ($bad == 'yes') {
        die('bad');
    } elseif ($duplicate) {
        die('duplicate');
    } elseif ($fail_title) {
        die('no');
    } else {
        die('ok');
    }
}
?>