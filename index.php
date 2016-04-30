<?php
	include 'include/login.php';
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Sign In</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
  </head>
  <body>

    <?php include 'include/inc_header.php'; ?>

      <div class="container">
        <form method="post" class="form validate">
		
			<?php if(isset($_GET['errorPass'])) { ?>
				<div class="alert alert-danger" role="alert">
					<button class='close' data-dismiss='alert'>&times;</button>
					<strong>Wrong password! Enter the valid one!</strong>
				</div>
			<?php } ?>

      <?php if(isset($_GET['errorNope'])) { ?>
        <div class="alert alert-danger" role="alert">
          <button class='close' data-dismiss='alert'>&times;</button>
          <strong>No user with such email was registered!</strong>
        </div>
      <?php } ?>

			<h2>Sign In</h2>
			<div class="form-group">
				<input type="email" placeholder="E-mail" name="emailLog" class="form-control">
			</div>
			<div class="form-group">
				<input type="password" placeholder="Password" name="passLog" class="form-control">
			</div>
			<div class="form-group">
				<button type="submit" name="loginButton" class="btn btn-success">Sign In</button>
			</div>
			<br/><br/>
			<div class="inline-blocks">Don't have an account? Sign in right now >> <a class="btn btn-primary" href="sign-up.php">SIGN UP</a></div><br/>
			<div class="inline-blocks">Forgot your password? Reset it here >> <a class="btn btn-primary" href="forget-password.php">Reset password</a></div>
		</form>
      </div>

    <?php include 'include/inc_footer.php'; ?>

    <script type="text/javascript">
      $(document).ready(function() {
        $(".validate").validate({
          rules: {
            emailLog: {
              required : true,
              email : true
            },
            passLog : {
              required : true,
              minlength: 6
            }
          },
          messages : {
            passLog: {
              required: "Please enter your password",
              minlength: "Your password must be at least 6 characters long"
            }
          }
        });
      });
    </script>
  </body>
</html>
