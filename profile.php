<?php
	include 'include/home.php';
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>My profile</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
  </head>

  <body>

    <?php include 'include/inc_header.php'; ?>

      <div class="container" style="margin-top:50px; padding:20px; border:1px solid grey; border-radius:10px">
			<h2>Welcome home, <?php echo $row['firstname']." ".$row['lastname'];?> !</h2>
			<hr/>
			<p>Yeah, it's quite not a lot of different stuff you can do over here so when you get bored - just press the logout button.</p>
      <hr/>
			<a class="btn btn-success"  href="include/logout.php">Logout</a>
			</div>
			<?php include 'include/inc_footer.php'; ?>
	</body>
</html>