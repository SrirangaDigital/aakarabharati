<?php
	echo "Books Detail Insertion.......\n";
	include("../php/connect.php");
	
	$db->query("DROP TABLE IF EXISTS bookdetails");
	$db->query("CREATE TABLE bookdetails (id varchar(5), title varchar(100),sstitle varchar(500), author varchar(200), details varchar(300), publisher varchar(300), primary key(id)) ENGINE=MyISAM character set utf8 collate utf8_general_ci");
	file_exists('books/book-details.xml') ? $xmlObj = simplexml_load_file('books/book-details.xml') : exit("Failed to open books/book-details.xml");
	
	foreach($xmlObj->book as $book)
	{
		$bookid = $book['id'];
		$sstitle = $book['sstitle'];
		$title = addslashes($book->title);
		$i = 0 ;
		$array = $authors = array();
		$authorJson = '[';
		
		foreach($book->authors->author as $author)
		{
			if((string)$author != '')
			{
				$authorJson .= '{"name":' . '"' . (string)$author . '"} , ';
			}
		}
		
		$authorJson = preg_replace('/ , $/', '', $authorJson);
		$authorJson = $authorJson . ']';
		
		$detailsJson = '[{"year":"' . (string)$book->details->year . '",';
		$detailsJson .= '"edition":"' . (string)$book->details->edition . '",';
		$detailsJson .= '"editor":"' . (string)$book->details->editor . '",';
		$detailsJson .= '"volume":"' . (string)$book->details->volume . '",';
		$detailsJson .= '"part":"' . (string)$book->details->part . '",';
		$detailsJson .= '"page":"' . (string)$book->details->pages . '"}]';
		
		$publisher = (string)$book->publisher;
		$query = "INSERT INTO bookdetails VALUES('$bookid', '$title', '$sstitle', '$authorJson', '$detailsJson' , '$publisher')";
		$db->query($query);
	}
?>
