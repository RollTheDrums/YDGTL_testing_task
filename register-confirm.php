<?php
	include 'include/email_verify.php';
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Confirm registration</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
  </head>

  <body>

    <?php include 'include/inc_header.php'; ?>

      <div class="container">
		<?php if(isset($msg)) echo $msg; ?>
		</div>
		<?php include 'include/inc_footer.php'; ?>
	</body>
</html>