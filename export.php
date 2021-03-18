<?php 
	$url = file_get_contents("data/url.txt");
	$path = "export";
	$files = array_diff(scandir($path), array('..', '.')); // get all file names
	foreach($files as $file){ // iterate files
		if(is_file($path."/".$file)) {
			unlink($path."/".$file); // delete file
		}
	}
	// export home
	$homecontent = str_replace($url, "", file_get_contents($url));
	$puthome = file_put_contents($path."/index.html", $homecontent);
	// expost single
	$posts = explode("\n", file_get_contents("data/post.txt"));
	foreach ($posts as $getpost) {
		$file = $path."/".$getpost.".html";
		$open = fopen($file, "w");
		$postcontent = str_replace($url, "", file_get_contents($url."/".$getpost.".html"));
		$putsingle = file_put_contents($file, $postcontent);
		fclose($open);
	}
	// export page
	$list_page = array_diff(scandir("data/page"), array('..', '.'));
	foreach ($list_page as $page) {
		$page = str_replace(".txt", "", $page);
		$file = $path."/".$page.".html";
		$open = fopen($file, "w");
		$pagecontent =str_replace($url, "",  str_replace($url."/p/", "", file_get_contents($url."/p/".$page.".html")));
		$putpage = file_put_contents($file, $pagecontent);
		fclose($open);
	}
	if ($puthome && $putsingle && $putpage) {
		echo "sukses kaka  :*";
	} else {
		echo "gagal! coba dicek kembali.";
	}
?>