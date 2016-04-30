<?php
	session_start();
	require_once 'include/model_user.php';

	$user_login = new User();

	if($user_login->is_logged_in() != "") {
		$user_login->redirect('profile.php');
	}

	if(isset($_POST['loginButton'])) {
		$email = trim($_POST['emailLog']);
		$pass = trim($_POST['passLog']);

		if($user_login->login($email, $pass)) {
			$user_login->redirect("profile.php");
		}
	}
?>

