<?php

header('Content-type: application/xml');
include "data.php";
$post = explode("\n", $get_post);

echo "<?xml version='1.0' encoding='UTF-8'?>"."\n";
echo "<urlset xmlns='http://www.sitemaps.org/schemas/sitemap/0.9'>"."\n";

foreach($post as $posts) {
	$data = explode("\n", file_get_contents("data/post/".$posts."/data.txt"));
 echo "<url>";
 echo "<loc>".$url."/".$posts.".html</loc>";
 echo "<lastmod>".$data[1]." ".$data[2]."</lastmod>";
 echo "<changefreq>weekly</changefreq>";
 echo "</url>";
}

echo "</urlset>";

?>