<?php 
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

$setting = explode("\n", file_get_contents($url."/data/setting.txt"));
$blog_title = $setting[0];
$tagline = $setting[1];
$home = $setting[2];
$single = $setting[3];
$randsingle = $setting[4];
$randsidebar = $setting[5];
$meta = explode("\n", file_get_contents($url."/data/meta.txt"));
$filelistpost = $url."/data/post.txt";
$get_post = file_get_contents($filelistpost);
$ads1 = file_get_contents($url."/data/ads-code-1.txt");
$ads2 = file_get_contents($url."/data/ads-code-2.txt");
$counter = file_get_contents($url."/data/counter.txt");
$addpost = file_get_contents($url."/data/addnewpost.txt");
$badword = explode("\n", file_get_contents($url."/data/badword.txt"));
?>