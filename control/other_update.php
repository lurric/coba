<?php
if (isset($_POST['saveother'])) {
    set_time_limit(30000); 
    if (isset($_POST['addpost'])) {
	    $addnewpost = array_filter(array_unique(explode("\n", $_POST['title'])));
	    $put = file_put_contents("../data/addnewpost.txt", implode("\n", $addnewpost));
	    $put = file_put_contents("../data/url.txt", $url);
	    if ($put) {
	        $success1 = 'Berhasil menyimpan.';
	    } else {
	        $fail1 = 'Gagal menyimpan! Silakan dicek kembali...';
	    }
	}
}
?>