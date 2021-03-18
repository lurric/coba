<?php
require '../vendor/autoload.php';
use Buchin\GoogleImageGrabber\GoogleImageGrabber;

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
if (isset($_POST['savepost'])) {
    if (isset($_POST['refresh'])) {
    ?>
    <script type="text/javascript">
        window.onload = Scrolldown;
    </script>
    <?php 
    }
    if (isset($_POST['editpost']) && !empty($_POST['editpost'])) {
        $title = $_POST['title'];
        $newslug = FilterPermalink($title);
        $imgurl = $_POST['imgurl'];
        $directoryold = "../data/post/".$_POST['editpost'];
        $imgtitle = file_get_contents($directoryold."/titleimg.txt");
        $listpost = explode("\n", $get_post);
        $duplicate = 0;
        if ($newslug != $_POST['editpost']) {            
            foreach ($listpost as $posts) {
                if ($newslug == $posts) {
                    $duplicate = 1;
                }
            }
        }
        if ($duplicate == 0) {
            $del = delete_directory($directoryold);
            $newfolder = "../data/post/".$newslug;
            mkdir($newfolder);
            fopen($newfolder."/urlimg.txt", "w"); 
            fopen($newfolder."/titleimg.txt", "w");
            file_put_contents($newfolder."/urlimg.txt", $imgurl);
            file_put_contents($newfolder."/titleimg.txt", $imgtitle);
            $titlepost = ucwords($title);
            $datepost = date("d-m-Y");
            $timepost = date("h:i:s");   
            fopen($newfolder."/data.txt", "w");
            $put = file_put_contents($newfolder."/data.txt", $titlepost."\n".$datepost."\n".$timepost);
            $newlistpost = array($newslug);
            foreach ($listpost as $posts) {
                if ($posts != $_POST['editpost']) {
                    $newlistpost[] = $posts;
                } 
            }
            file_put_contents("../data/post.txt", implode("\n", $newlistpost));
            file_put_contents("../data/url.txt", $url);
            if ($put) {
                $success1 = 'Berhasil mengedit <strong>'.$titlepost.'</strong>.';
                // create daftar post csv
                $getpost = file_get_contents($filelistpost);
                $getpost = array_filter(explode("\n", $getpost));
                $arraycsv = array(array("Title","Url"));
                foreach ($getpost as $getposts) {
                    $get = explode("\n", file_get_contents($url."/data/post/".$getposts."/data.txt"));
                    $list = array($get[0]); // title post
                    $list[] = $url."/".$getposts; // url post
                    $arraycsv[] = $list;
                }
                $filecsv = "../data/post.csv";
                ftruncate(fopen($filecsv, "a+"),0);
                fclose(fopen($filecsv, "w" ));
                $fp = fopen($filecsv, 'w'); 
                foreach ($arraycsv as $fields) { 
                    fputcsv($fp, $fields); 
                }              
                fclose($fp);
                ?>
                <script type="text/javascript">
                    window.onload = Scrolldown;
                </script>
                <?php 
            } else {
                $fail1 = 'Gagal mengedit post! Coba periksa kembali.';
            }
        } else {            
            $fail1 = 'Gagal mengedit post! Title tidak boleh sama dengan title lain.';
        }
    }
    if (isset($_POST['deletepost']) && !empty($_POST['deletepost'])) {
        $titlepost = explode("\n", file_get_contents("../data/post/".$_POST['deletepost']."/data.txt"));
        $del = delete_directory("../data/post/".$_POST['deletepost']);
        file_put_contents("../data/url.txt", $url);
        if ($del) {
            $success1 = 'Berhasil menghapus '.$titlepost[0].'.';
            // save list post
            $newlistpost = array();
            $listpost = explode("\n", $get_post);
            foreach ($listpost as $posts) {
                if ($posts != $_POST['deletepost']) {
                    $newlistpost[] = $posts;
                } 
            }
            file_put_contents("../data/post.txt", implode("\n", $newlistpost));
            // create daftar tamu csv
            $getpost = file_get_contents($filelistpost);
            $getpost = array_filter(explode("\n", $getpost));
            $arraycsv = array(array("Title","Url"));
            foreach ($getpost as $getposts) {
                $get = explode("\n", file_get_contents($url."/data/post/".$getposts."/data.txt"));
                $list = array($get[0]); // title post
                $list[] = $url."/".$getposts; // url post
                $arraycsv[] = $list;
            }
            $filecsv = "../data/post.csv";
            ftruncate(fopen($filecsv, "a+"),0);
            fclose(fopen($filecsv, "w" ));
            $fp = fopen($filecsv, 'w'); 
            foreach ($arraycsv as $fields) { 
                fputcsv($fp, $fields); 
            }              
            fclose($fp); 
            ?>
            <script type="text/javascript">
                window.onload = Scrolldown;
            </script>
            <?php 
        } else {
            $fail1 = 'Gagal menghapus '.$titlepost[0].'.';
        }
    }
}
?>