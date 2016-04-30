<?php
	include 'include/signup.php';
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Sign Up</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    
  </head>

  <body>

    <?php include 'include/inc_header.php'; ?>

      <div class="container">
		<?php if(isset($msg)) echo $msg; ?>
			<form method="post" id="sign-up-valid" class="form validate">
				<h2>Sign Up</h2>
				<div class="form-group">
					<label for="firstname">Firstname</label>
					<input class="form-control" type="text" placeholder="Firstname" id="firstname" name="firstname">
				</div>
				<div class="form-group">
					<label for="lastname">Lastname</label>
					<input class="form-control" type="text" placeholder="Lastname" id="lastname" name="lastname">
				</div>
				<div class="form-group">
					<label for="email">E-mail</label>
					<input class="form-control" type="email" placeholder="E-mail" id="email" name="email">
				</div>
				<div class="form-group">
					<label for="conf_email">E-mail confirmation</label>
					<input class="form-control" type="email" placeholder="Confirm E-mail" id="conf_email" name="conf_email">
				</div>
				<div class="form-group">
					<label for="pass">Password</label>
					<input class="form-control" type="password" placeholder="Password" id="pass" name="pass">
				</div>
				<div class="form-group">
					<label for="conf_pass">Password confirmation</label>
					<input class="form-control" type="password" placeholder="Confirm Password" id="conf_pass" name="conf_pass">
				</div>
				<hr/>
				<button type="submit" class="btn btn-success" name="submitButton">Sign Up</button>
				<a class="btn btn-primary" href="index.php">Sign In</a>
			</form>
		</div>
		<?php include 'include/inc_footer.php'; ?>
		<script type="text/javascript">
			$(document).ready(function() {
				$(".validate").validate({
					rules: {
						firstname : {
							required : true
						},
						lastname : {
							required : true
						},
						email : {
							required : true,
							email : true
						},
						conf_email : {
							required : true,
							email : true,
							equalTo : "#email"
						},
						pass : {
							required : true,
							minlength: 6
						},
						conf_pass : {
							required : true,
							minlength: 6,
							equalTo: "#pass"
						}
					},
					messages : {
						firstname: "Please enter your firstname",
						lastname: "Please enter your lastname",
						conf_email: {
							equalTo: "E-mails do not match"
						},
						pass: {
							required: "Please provide a password",
							minlength: "Your password must be at least 6 characters long"
						},
						conf_pass: {
							required: "Please provide a password",
							minlength: "Your password must be at least 6 characters long",
							equalTo: "Passwords do not match"
						}
					}
				});
			});
		</script>
		
	</body>

	
</html>