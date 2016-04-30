<?php
	require_once 'include/model_user.php';
	
	$user = new User();

	if(empty($_GET['id']) && empty($_GET['code'])) {
		$user->redirect('index.php');
	}

	if(isset($_GET['id']) && isset($_GET['code'])) {
		$id = base64_decode($_GET['id']);
		$code = $_GET['code'];

		$stmt = $user->runQuery("SELECT * FROM users WHERE id=:uid AND code=:code");
		$stmt->execute(array(":uid"=>$id, ":code"=>$code));
		$rows = $stmt->fetch(PDO::FETCH_ASSOC);

		if($stmt->rowCount() == 1) {
			if(isset($_POST['submitReset'])) {
				$pass = $_POST['newpass'];
				$cpass = $_POST['conf_newpass'];
				$cpass = md5($cpass);

					$stmt = $user->runQuery("UPDATE users SET password=:upass WHERE id=:uid");
					$stmt->execute(array("upass"=>$cpass, ":uid"=>$rows['id']));

					$msg = "<div id=\"needToLogin\" class=\"alert alert-success\" role=\"alert\">
					<button class='close' data-dismiss='alert'>&times;</button>Password was successfully changed. You will be redirected to you profile in a moment.</div>";
			}

		} else exit;

	}

?>
