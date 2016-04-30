<?php
	session_start();
	require_once 'include/model_user.php';

	$user_home = new User();

	if(!$user_home->is_logged_in()) {
		$user_home->redirect('index.php');
	}

	$stmt = $user_home->runQuery("SELECT * FROM users WHERE id=:uid");
	$stmt->execute(array(":uid"=>$_SESSION['userSession']));
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
?>

