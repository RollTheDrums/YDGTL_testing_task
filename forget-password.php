<?php 
	include 'include/forgot_pass.php';
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Forget password</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
  </head>

	<body>
	<?php include 'include/inc_header.php'; ?>

		<div class="container">
			<form method="post" class="form validate">
				<h2>Get new password</h2>
				<hr/>

				<?php if(isset($msg)) {
					echo $msg;
				} else {
				?>
				<h3>Enter your email here: </h3>
				<?php
				}
				?>
				<input type="email" placeholder="E-mail" name="email" class="form-control">
				<hr/>
				<button type="submit" name="submitForgot" class="btn btn-success">Generate new password</button>
			</form>	
		</div>

		<?php include 'include/inc_footer.php'; ?>
		<script type="text/javascript">
      $(document).ready(function() {
        $(".validate").validate({
          rules: {
            email: {
              required : true,
              email : true
            }
          }
        });
      });
    </script>
	</body>
</html>