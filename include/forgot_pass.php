<?php
	session_start();
	require_once 'include/model_user.php';
	require_once 'include/constants.php';

	
	$user = new USER();

	if($user->is_logged_in()!="") {
		$user->redirect('profile.php');
	}

	if(isset($_POST['submitForgot'])) {
		$email = $_POST['email'];

		$stmt = $user->runQuery("SELECT id FROM users WHERE email=:email LIMIT 1");
		$stmt->execute(array(":email"=>$email));
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		if($stmt->rowCount() == 1) {
			$id = base64_encode($row['id']);
			$code = md5(uniqid(rand()));

			$stmt = $user->runQuery("UPDATE users SET code=:token WHERE email=:email");
			$stmt->execute(array(":token"=>$code, ":email"=>$email));

			$message = "Hi. You might want to reset your password. If not - just ignore this message. If you do then click the link below<br/><br/>
			<a href='". HOME ."get-new-pass.php?id=$id&code=$code'>Get my new password</a>";

			$subject = "Password reset";

			$user->send_mail($email, $message, $subject);

			$msg = "<div class=\"alert alert-success\" role=\"alert\">
					<button class='close' data-dismiss='alert'>&times;</button>A mail was sent to your e-mail. Check your spambox just in case and click the link in the mail to change the password.</div>";
		} else {
			$msg = "<div>It's <strong>NOT FOUND</strong><br/> Try again. Maybe.</div>";
		}
	}
?>
