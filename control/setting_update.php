<?php
if (isset($_POST['savesetting'])) {
    set_time_limit(30000);
    file_put_contents("../data/meta.txt", $_POST['metades']."\n".$_POST['metakw']);
    file_put_contents("../data/counter.txt", str_replace("&lt;", "<", str_replace("&gt;", ">", ($_POST['counter']))));
    file_put_contents("../data/ads-code-1.txt", str_replace("&lt;", "<", str_replace("&gt;", ">", ($_POST['ads1']))));
    file_put_contents("../data/ads-code-2.txt", str_replace("&lt;", "<", str_replace("&gt;", ">", ($_POST['ads2']))));
    file_put_contents("../data/url.txt", $url);
    $put = file_put_contents("../data/setting.txt", ucwords($_POST['title'])."\n".$_POST['tagline']."\n".$_POST['home']."\n".$_POST['single']."\n".$_POST['randsingle']."\n".$_POST['randsidebar']."\n".$_POST['bg']);
    if ($put) {
        $success1 = 'Berhasil menyimpan data setting.';
    } else {
        $fail1 = 'Gagal menyimpan data setting! Silakan dicek kembali...';
    }
}
?>