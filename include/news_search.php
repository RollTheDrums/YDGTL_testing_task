<?php
	session_start();
	include 'include/model_article.php';

	$news = new ArticleModel();

	if(isset($_POST['submit']) && (!empty($_POST['search-text']) || !empty($_POST['category']) || !empty($_POST['date-from']) || !empty($_POST['date-to']))) {	

		$text = ($_POST['search-text']);
		$category = ($_POST['category']);
		$from = ($_POST['date-from']);
		$to = ($_POST['date-to']);
		
		$text = trim($_POST['search-text']);
		$category = trim($_POST['category']);
		$from = trim($_POST['date-from']);
		$to = trim($_POST['date-to']);

		if($text == "") $text = NULL;
		if($category == "") $category = NULL;
		if($from == "") $from = NULL;
		if($to == "") $to = NULL;



		$stmt = $news->runQuery("SELECT *, STR_TO_DATE(date, '%d/%m/%y') AS new_date FROM news WHERE (:search_text IS NULL OR (title LIKE :search_text) OR (bodytext LIKE :search_text) OR (annot LIKE :search_text)) AND (:search_cat IS NULL OR category=:search_cat) AND ((:search_from IS NULL OR STR_TO_DATE(date, '%d/%m/%y') >= STR_TO_DATE(:search_from, '%d/%m/%y')) AND (:search_to IS NULL OR STR_TO_DATE(date, '%d/%m/%y') <= STR_TO_DATE(:search_to, '%d/%m/%y'))) ORDER BY new_date DESC LIMIT 0, 10");
		$stmt->bindParam(":search_cat", $category);
		$stmt->bindValue(":search_text", '%' . $text . '%', PDO::PARAM_STR);
		$stmt->bindParam(":search_from", $from);
		$stmt->bindParam(":search_to", $to);
		$stmt->execute();
		if($stmt->rowCount() == 0) echo '<div class="panel panel-default" id="no-news"><div class="panel-body">No news were found matching your query.</div></div>';
		$articles = $stmt->fetchAll(PDO::FETCH_ASSOC);


	} elseif((isset($_POST['submit']) && empty($_POST['search-text']) && empty($_POST['category']) && empty($_POST['date-from']) && empty($_POST['date-to'])) || !isset($_POST['submit'])) { 
		$stmt = $news->runQuery("SELECT *, STR_TO_DATE(date, '%d/%m/%y') AS new_date FROM news ORDER BY new_date DESC LIMIT 0, 10");
		$stmt->execute();
		if($stmt->rowCount() == 0) echo '<div class="panel panel-default"><div class="panel-body">No news were found matching your query.</div></div>';
		$articles = $stmt->fetchAll(PDO::FETCH_ASSOC);	}

?>
