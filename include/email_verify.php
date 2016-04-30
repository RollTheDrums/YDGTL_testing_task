<?php
require_once 'include/model_user.php';

$user = new User();

if(empty($_GET['id']) && empty($_GET['code'])) {
	$user->redirect('index.php');
}

if(isset($_GET['id']) && isset($_GET['code'])) {
	$id = base64_decode($_GET['id']);
	$code = $_GET['code'];

	$stmt = $user->runQuery("SELECT id, email, password FROM users WHERE id=:userID and code=:code LIMIT 1");
	$stmt->execute(array(":userID"=>$id,":code"=>$code));
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	if($stmt->rowCount() > 0) {

		$stmt = $user->runQuery("UPDATE users SET activated=1 WHERE id=:uid");
		$stmt->execute(array(":uid"=>$id));

		$msg = "<h2>Congratulations, now your account is activated!</h2>
				<h3>You will be redirected in a moment.</h3>";
		
		header("refresh:3;url=index.php");
	} else {
		$msg = "<h2>Account was not found!</h2>
				<h3>You will be redirected in a moment.</h3>";
		header("refresh:3;url=index.php");
	}
}
?>
