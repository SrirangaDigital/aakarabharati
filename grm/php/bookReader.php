<?php
	$url ="";
	if(isset($_GET['bookID']) && $_GET['bookID'] != ''){$bookID = $_GET['bookID']; $url = "bookID=".$bookID;}
	if(isset($_GET['page']) && $_GET['page'] != ''){$page = $_GET['page']; $url .= "&pagenum=".$page;}
	if(isset($_GET['text']) && $_GET['text'] != ''){$text = $_GET['text']; $url .= "&searchText=".$text;}
	if(isset($_GET['bookreaderTitle'])){$bookreaderTitle = $_GET['bookreaderTitle']; $url .= "&bookreaderTitle=".$bookreaderTitle;}
	
	header("Location: bookreader/templates/book.php?".$url);
	
?>
