<?php
// silakan ganti password disini
$password = "admin";

if (isset($_POST['pass'])) {
	$pass = $_POST['pass'];
	$check = preg_match("/\b".$pass."\b/i",$password);
	if ($check) {
		$_SESSION['control_spam'] = $password;
	} else {
		$login_fail = 'Wrong password! Please try again.';
	}
}
?>