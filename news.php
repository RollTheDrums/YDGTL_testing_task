

<!DOCTYPE HTML>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>News</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
    <link href="css/style.css"  rel="stylesheet">

    
  </head>

  <body>

    <?php include 'include/inc_header.php'; ?>
    
      <div class="container newspage">
        <form method="post">
          <div class="search">
            <label class="input-label">Search:</label>
            <input type="text" class="form-control search-field" id="search-text" name="search-text" style="width:20%">

            <label class="input-label">Category:</label>
            <select class="form-control search-field" name="category" id="category" style="width:20%">
              <option label=""></option>
              <option value="Ужгород">Ужгород</option>
              <option value="Мукачево">Мукачево</option>
              <option value="Політика">Політика</option>
              <option value="Економіка">Економіка</option>
              <option value="Правопорушення">Правопорушення</option>
            </select>

            <label for="search-text" class="input-label">From:</label>
            <input type="text" class="form-control search-field" id="date-from" name="date-from">
            <label for="search-text" class="input-label">To:</label>
            <input type="text" class="form-control search-field" id="date-to" name="date-to">

            <button type="submit" class="btn btn-success" style="display: inline;" name="submit" id="submit">Search</a>
          </div>
        </form>
        <div id="news">
        <?php include 'include/news_search.php'; ?>
        <?php foreach($articles as $item) { ?>
        <div class="panel panel-default">
              <div class="panel-heading">
                <h3 style="font-weight: bold"><?php echo $item['title']; ?></h3>
              </div>
              <div class="panel-body">
                <p><?php echo $item['annot']; ?></p>
                <p><a href=<?php echo "\"article.php?id=" . $item['id'] . "\""; ?>>Read more...</a></p>
                <p style="color:grey">Category: <span style="font-weight:bold"><?php echo $item['category'] . "\t\t" ?></span></p>
                <p style="color:grey">Date: <?php echo $item['date']; ?></p>
              </div>
            </div>
          <?php } ?>
        </div>
        <p id="loader" style="text-align: center"><img src="images/loading.gif" width="200" height="150"></p>
      </div>

    <?php include 'include/inc_footer.php'; ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
    <script>
      $("#date-from").datepicker({ dateFormat: 'dd/mm/yy' });
      $("#date-to").datepicker({ dateFormat: 'dd/mm/yy' });
      
      $('#loader').hide();

      var is_loading = false;
      var limit = 10;
      $(function() {
        $("#search-text").val("<?php if(!isset($_POST['search-text'])) echo ""; else echo $_POST['search-text']; ?>");
        $("#category").val("<?php if(!isset($_POST['category'])) echo ""; else echo $_POST['category']; ?>");
        $("#date-from").val("<?php if(!isset($_POST['date-from'])) echo ""; else echo $_POST['date-from']; ?>");
        $("#date-to").val("<?php if(!isset($_POST['date-to'])) echo ""; else echo $_POST['date-to']; ?>");
        $(window).scroll(function() {
          if($(window).scrollTop() + $(window).height() == $(document).height()) {
              if (is_loading == false) {
                  is_loading = true;
                  $('#loader').show();
                  $.ajax({
                      url: 'include/load_more_news.php',
                      type: 'POST',
                      data: {limit:limit, text:$("#search-text").val(), category:$("#category").val(), date_f:$("#date-from").val(), date_t:$("#date-to").val()},
                      success:function(data){
                          $('#loader').hide();
                          limit += 10;
                          $('#news').append(data);
                          is_loading = false;
                      }
                  });
              }
         }
      });
});
    </script>

  </body>
</html>
