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
?>