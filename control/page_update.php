<?php
if (isset($_POST['savepage'])) {
    set_time_limit(30000);
    $put = file_put_contents("../data/page/".$_POST['editpage'], str_replace("&lt;", "<", str_replace("&gt;", ">", ($_POST['page']))));
    file_put_contents("../data/url.txt", $url);
    if ($put) {
        $success1 = 'Berhasil menyimpan '.strtoupper(str_replace(".txt", "", $_POST['editpage']));
    } else {
        $fail1 = 'Gagal menyimpan '.strtoupper(str_replace(".txt", "", $_POST['editpage'])).'! Silakan dicek kembali...';
    }
}
?>