<?php session_start(); ?>
<?php
include 'login.php';
if (isset($_SESSION['control_spam'])) {
    include '../data.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/ico" href="../favicon.ico">

    <!-- Title Page-->
  <title>Control Panel - Integrated Control System</title>

    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">

    <?php if (isset($_POST['allpost']) || (isset($_POST['menu']) && $_POST['menu'] == 'Page')){ ?>
    <!-- TABLE STYLES-->
    <link href="css/bootstrap.css" rel="stylesheet" />
    <link href="css/dataTables.bootstrap.css" rel="stylesheet" />
    <!-- TABLE STYLES-->
    <?php } ?>

    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script src= "https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- ajax-->
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
    
    <script type="text/javascript">
    function Scrolldown() {
      window.scroll(0,550); 
    }
    </script>
    <style>
    html {scroll-behavior: smooth;}
    </style>

    <!-- Auto Hide Notif-->
    <link rel="stylesheet" type="text/css" href="css/notice.css" />
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script type="text/javascript" src="js/jquery.notice.js"></script>

    <!-- CKEditor-->
    <link type="text/css" href="sample/css/sample.css" rel="stylesheet" media="screen" />

    <!-- Main CSS-->
    <link href="css/main.css" rel="stylesheet" media="all">

    <style>
    body {
      font-family: "Open Sans", "Arial", "Helvetica Neue", sans-serif;
      font-weight: 400;
      font-size: 14px;
      background: url("<?php echo $setting[6]; ?>") no-repeat fixed center;
    }
    /* The Modal (background) */
    .modal {
      display: none; /* Hidden by default */
      position: fixed; /* Stay in place */
      z-index: 1; /* Sit on top */
      padding-top: 100px; /* Location of the box */
      left: 0;
      top: 0;
      width: 100%; /* Full width */
      height: 100%; /* Full height */
      overflow: auto; /* Enable scroll if needed */
      background-color: rgb(0,0,0); /* Fallback color */
      background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
    }

    /* Modal Content */
    .modal-content {
      background-color: #fefefe;
      margin: auto;
      padding: 20px;
      border: 1px solid #888;
      width: 60%;
    }

    /* The Close Button */
    .close {
      color: #aaaaaa;
      float: right;
      font-size: 28px;
      font-weight: bold;
    }

    .close:hover,
    .close:focus {
      color: #000;
      text-decoration: none;
      cursor: pointer;
    }
    </style>
    
</head>

<body>
    <div class="page-wrapper p-t-100 p-b-50">
        <div class="wrapper wrapper--w900">
            <div class="card card-6" style="opacity: 0.9;">
                <div class="card-heading">
                    <form method="POST">
                        <?php if ((isset($_POST['menu']) && ($_POST['menu'] != "Other" && $_POST['menu'] != "Setting" && $_POST['menu'] != "Page")) || !isset($_POST['menu'])) { ?>
                        <button style="float: left; padding: 0 10px; margin: 0 3px; font-size: 18px; color: #F14E95; background-color: #ffffff; border-radius: 3px;-webkit-text-stroke: 0.5px #F14E95;" type="submit" class="title btn" name="menu" value="Post">Post</button>
                        <?php } else { ?>
                        <button style="float: left; padding: 0; margin: 0 15px; font-size: 18px;-webkit-text-stroke: 0.5px #F14E95;" type="submit" class="title btn" name="menu" value="Post">Post</button>
                        <?php } ?>
                    </form>
                    <form method="POST">
                        <?php if (isset($_POST['menu']) && $_POST['menu'] == "Page") { ?>
                        <button style="float: left; padding: 0 10px; margin: 0 3px; font-size: 18px; color: #F14E95; background-color: #ffffff; border-radius: 3px;-webkit-text-stroke: 0.5px #F14E95;" type="submit" class="title btn" name="menu" value="Page">Page</button>
                        <?php } else { ?>
                        <button style="float: left; padding: 0; margin: 0 15px; font-size: 18px;-webkit-text-stroke: 0.5px #F14E95;" type="submit" class="title btn" name="menu" value="Page">Page</button>
                        <?php } ?>
                    </form>
                    <form method="POST">
                        <?php if (isset($_POST['menu']) && $_POST['menu'] == "Setting") { ?>
                        <button style="float: left; padding: 0 10px; margin: 0 3px; font-size: 18px; color: #F14E95; background-color: #ffffff; border-radius: 3px;-webkit-text-stroke: 0.5px #F14E95;" type="submit" class="title btn" name="menu" value="Setting">Setting</button>
                        <?php } else { ?>
                        <button style="float: left; padding: 0; margin: 0 15px; font-size: 18px;-webkit-text-stroke: 0.5px #F14E95;" type="submit" class="title btn" name="menu" value="Setting">Setting</button>
                        <?php } ?>
                    </form>
                    <form method="POST">
                        <?php if (isset($_POST['menu']) && $_POST['menu'] == "Other") { ?>
                        <button style="float: left; padding: 0 10px; margin: 0 3px; font-size: 18px; color: #F14E95; background-color: #ffffff; border-radius: 3px;-webkit-text-stroke: 0.5px #F14E95;" type="submit" class="title btn" name="menu" value="Other">Other</button>
                        <?php } else { ?>
                        <button style="float: left; padding: 0; margin: 0 15px; font-size: 18px;-webkit-text-stroke: 0.5px #F14E95;" type="submit" class="title btn" name="menu" value="Other">Other</button>
                        <?php } ?>
                    </form>
                    &nbsp;
                </div>
                <?php 
                if (isset($_POST['menu']) && $_POST['menu'] == "Other") {
                    include 'other_update.php';
                    include 'other.php';
                } elseif (isset($_POST['menu']) && $_POST['menu'] == "Page") {
                    include 'page_update.php';
                    include 'page.php';
                } elseif (isset($_POST['menu']) && $_POST['menu'] == "Setting") {
                    include 'setting_update.php';
                    include 'setting.php';
                }  else {
                    include 'post_update.php';
                    include 'post.php';
                }
                ?>
            </div>
        </div>
    </div>

    <!-- Loading-->
    <script type="text/javascript">                        
        document.getElementById("load").addEventListener("click", myFunctions);
        function myFunctions() {
          document.getElementById("load").innerHTML = '<i class="fa fa-circle-o-notch fa-spin"></i> Tunggu bentar...';
        }
    </script>

    <!-- Jquery JS-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <!-- copy button -->
    <script src="js/copy.js"></script>
    <!-- end copy button -->


    <!-- Main JS-->
    <script src="js/global.js"></script>

    <!-- TABLE STYLES-->
    <?php if (isset($_POST['allpost']) || (isset($_POST['menu']) && $_POST['menu'] == 'Page')) { ?>
    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/jquery.dataTables.js"></script>
      <!-- Bootstrap Js -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/dataTables.bootstrap.js"></script>
    <script>
            $(document).ready(function () {
                $('#dataTables-example').dataTable();
            });
    </script>
    <?php } ?>
    <!-- TABLE STYLES-->

    <!-- CKEditor-->
    <script src="ckeditor.js"></script>

    <script>
      ClassicEditor
        .create( document.querySelector( '#editor' ), {
          // toolbar: [ 'heading', '|', 'bold', 'italic', 'link' ]
        } )
        .then( editor => {
          window.editor = editor;
        } )
        .catch( err => {
          console.error( err.stack );
        } );
    </script>

</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>
<!-- end document-->

<?php } else { ?>

<!DOCTYPE html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]> <html class="lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]> <html class="lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>Login Panel - Integrated Control System</title>
  <link rel="stylesheet" href="css/style.css">
  <!--[if lt IE 9]><script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
</head>
<body>
    <form method="post" action="" class="login" enctype="multipart/form-data">
        <div class="login-input">
          <label for="password">Password:</label>
          <input autofocus type="password" name="pass" id="password" value="">
        </div>

        <div class="login-submit">
          <button type="submit" class="login-button">Login</button>
        </div>
        <?php if(isset($login_fail)) { ?>
        <p style="color:#F73535;text-align:center;"><?php echo $login_fail; ?></p>
        <?php } ?>
  </form>
</body>
</html>
<?php } ?>