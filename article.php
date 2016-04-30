<?php
  session_start();
  include 'include/model_article.php';

  $news = new ArticleModel();

  $articles = array();
  $count = 0;
  if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $news->runQuery("SELECT * FROM news WHERE id=:article_id");
    $stmt->execute(array("article_id"=>$id));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
  }
 
  
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>News</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
  </head>

  <body>

    <?php include 'include/inc_header.php'; ?>
    
      <div class="container article-container">
        <h3 style="font-weight: bold; padding: 10px 10px 20px 10px"><?php echo $row['title']; ?></h3>
        <hr style="border-top:1px solid grey">
        <p style="font-size: 16px"><?php echo $row['bodytext']; ?></p>
        <hr style="border-top:1px solid grey">
        <p class="inline" style="color:black">Category: <?php echo $row['category']; ?></p>
        <p class="inline" style="color:black">Date:  <?php echo $row['date']; ?></p>
        <p style="margin:20px"></p>
        <a class="btn btn-primary" id="back-button" href="news.php"><< Back</a>
      </div>
    <?php include 'include/inc_footer.php'; ?>
  </body>
</html>
