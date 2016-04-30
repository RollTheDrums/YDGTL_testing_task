<?php
	session_start();
	require_once 'model_user.php';
	require_once 'constants.php';

	$user = new User();

	if(!$user->is_logged_in()) {
		$user->redirect(URL.'index.php');
	}

	if($user->is_logged_in()!="") {
		$user->logout();
		$user->redirect(URL.'index.php');
	}
?>