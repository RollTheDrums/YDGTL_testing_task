<?php
	include 'include/reset_pass.php';
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Reset password</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
  </head>

  <body>
  <?php include 'include/inc_header.php'; ?>

    <div class="container">
        <form method="post" class="form validate">
        <h3>Greetings, <?php echo $rows['firstname'] . " " . $rows['lastname']; ?>, please create a new password.</h3><hr/>
        <?php
        	if(isset($msg)) {
   				echo $msg;
  			}
  		?>
      <div class="form-group">
        <input type="password" placeholder="New Password" name="newpass" id="newpass" class="form-control" />
      </div>
      <div class="form-group">
        <input type="password" placeholder="Confirm New Password" name="conf_newpass" id="conf_newpass" class="form-control" />
      </div>
      <hr />
        <button type="submit" name="submitReset" id="submitReset" class="btn btn-success">Reset Your Password</button>
      </form>
    </div>



    <div hidden>
    <form method="post" class="form login-now" action="index.php">
      <div class="form-group">
        <input type="email" placeholder="E-mail" name="emailLog" class="form-control" value="<?php echo $rows['email']; ?>">
      </div>
      <div class="form-group">
        <input type="password" placeholder="Password" name="passLog" class="form-control" value="<?php echo $pass; ?>">
      </div>
      <div class="form-group">
        <input type="text" name="loginButton" class="form-control" value="">
      </div>
        <button type="submit" class="btn btn-success">Sign In</button>
    </form>
    </div>

    <?php include 'include/inc_footer.php'; ?>
    <script type="text/javascript">
      $(document).ready(function() {
        if ( $( "#needToLogin" ).length ) {
            setTimeout(
              function() 
              {
                $(".login-now").submit();
              }, 2000);
         
        }
        $(".validate").validate({
          rules: {
            newpass: {
              required : true,
              minlength: 6
            },
            conf_newpass : {
              required : true,
              minlength: 6,
              equalTo : "#newpass"
            }
          },
          messages : {
            newpass: {
              required: "Please provide a password",
              minlength: "Your password must be at least 6 characters long"
            },
            conf_newpass: {
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