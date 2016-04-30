<?php
	include 'model_article.php';

	$news = new ArticleModel();
	
	$limit = 11; // default value
	if (isset($_POST['limit'])) {
		$limit = intval($_POST['limit']);
	}
	
	$text = ($_POST['text']);
	$category = ($_POST['category']);
	$from = ($_POST['date_f']);
	$to = ($_POST['date_t']);

	
	$text = trim($_POST['text']);
	$category = trim($_POST['category']);
	$from = trim($_POST['date_f']);
	$to = trim($_POST['date_t']);

	if($text == "") $text = NULL;
	if($category == "") $category = NULL;
	if($from == "") $from = NULL;
	if($to == "") $to = NULL;

	if((!empty($_POST['text']) || !empty($_POST['category']) || !empty($_POST['date_f']) || !empty($_POST['date_t']))) {	
		$stmt = $news->runQuery("SELECT *, STR_TO_DATE(date, '%d/%m/%y') AS new_date FROM news WHERE (:search_text IS NULL OR (title LIKE :search_text) OR (bodytext LIKE :search_text) OR (annot LIKE :search_text)) AND (:search_cat IS NULL OR category=:search_cat) AND ((:search_from IS NULL OR STR_TO_DATE(date, '%d/%m/%y') >= STR_TO_DATE(:search_from, '%d/%m/%y')) AND (:search_to IS NULL OR STR_TO_DATE(date, '%d/%m/%y') <= STR_TO_DATE(:search_to, '%d/%m/%y'))) ORDER BY new_date DESC LIMIT :lim, 10");
		$stmt->bindParam(":search_cat", $category);
		$stmt->bindValue(":search_text", '%' . $text . '%', PDO::PARAM_STR);
		$stmt->bindParam(":search_from", $from);
		$stmt->bindParam(":search_to", $to);
		
		$stmt->bindParam(':lim', $limit, PDO::PARAM_INT);
		$stmt->execute();
		if($stmt->rowCount() > 0) {
			
			$articles = $stmt->fetchAll(PDO::FETCH_ASSOC);

			foreach ($articles as $item) {
		    echo '<div class="panel panel-default">';
	        echo '<div class="panel-heading">';
	        echo '<h3 style="font-weight: bold">' . $item['title'] . '</h3>';
	        echo '</div>';
	        echo '<div class="panel-body">';
	        echo '<p>' . $item['annot'] . '</p>';
	        echo '<p><a href="article.php?id=' . $item['id'] . '">Read more...</a></p>';
	        echo '<p style="color:grey">Category: <span style="font-weight:bold">' . $item['category'] . '</span></p>';
	        echo '<p style="color:grey">Date: ' . $item['date'] . '</p>';
	        echo '</div>';
	        echo '</div>';
			}
			sleep(1);
		} else exit;
	} else {
		$stmt = $news->runQuery("SELECT *, STR_TO_DATE(date, '%d/%m/%y') AS new_date FROM news ORDER BY new_date DESC LIMIT :lim, 10");
		$stmt->bindParam(':lim', $limit, PDO::PARAM_INT);
		$stmt->execute();
		if($stmt->rowCount() > 0) {
			
			$articles = $stmt->fetchAll(PDO::FETCH_ASSOC);

			foreach ($articles as $item) {
		    echo '<div class="panel panel-default">';
	        echo '<div class="panel-heading">';
	        echo '<h3 style="font-weight: bold">' . $item['title'] . '</h3>';
	        echo '</div>';
	        echo '<div class="panel-body">';
	        echo '<p>' . $item['annot'] . '</p>';
	        echo '<p><a href="article.php?id=' . $item['id'] . '">Read more...</a></p>';
	        echo '<p style="color:grey">Category: <span style="font-weight:bold">' . $item['category'] . '</span></p>';
	        echo '<p style="color:grey">Date: ' . $item['date'] . '</p>';
	        echo '</div>';
	        echo '</div>';
			}
			sleep(1);
		} else exit;
	}
?>
	