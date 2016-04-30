<?php
	session_start();
	require_once 'include/model_user.php';
	require_once 'include/constants.php';

	$reg_user = new User();

	if($reg_user->is_logged_in()!="") {
		$reg_user->redirect("profile.php");
	}

	if(isset($_POST['submitButton'])) {
		$firstname = trim($_POST['firstname']);
		$lastname = trim($_POST['lastname']);
		$email = trim($_POST['email']);
		$confEmail = trim($_POST['conf_email']);
		$password = trim($_POST['pass']);
		$confPassword = trim($_POST['conf_pass']);
		$code = md5(uniqid(rand()));

		
			$stmt = $reg_user->runQuery("SELECT * FROM users WHERE email=:email_id");
			$stmt->execute(array(":email_id"=>$email));
			$row = $stmt->fetch(PDO::FETCH_ASSOC);


			if($stmt->rowCount() > 0) {
				$msg = "<div class=\"alert alert-danger\" role=\"alert\">
					<button class='close' data-dismiss='alert'>&times;</button>User with such e-mail already exists!</div>";
			} else {
				if($reg_user->register($firstname, $lastname, $email, $password, $code)) {
					$id = $reg_user->lastId();
					$key = base64_encode($id);
					$id = $key;

					$message = "
						Hello $firstname $lastname,<br/><br/>
						You are trying to register on the website.
						To confirm registration click the link below<br/><br/>
						<a href='". HOME ."/register-confirm.php?id=$id&code=$code'>Go to THIS link to finish registration</a><br/>
						See you soon!";

						$subject = "Confirm registration";

						$reg_user->send_mail($email, $message, $subject);
						$msg = "<div class=\"alert alert-success\" role=\"alert\">
					<button class='close' data-dismiss='alert'>&times;</button>An email was sent to $email. Check your mailbox and click on the confirmation link to complete the registration!</div>";
				} else {
					echo "Sorry, query gone wrong.";
				}
			}
		
	}
?>
