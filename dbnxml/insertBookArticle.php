<?php
	echo "Books Article Insertion.......\n";
	include("../php/connect.php");
	
	$result = $db->query("SELECT id FROM bookdetails order by id");
	
	while($row = $result->fetch_assoc())
	{
		$bookID = $row['id'];
		file_exists('books/book-' . $bookID . '.xml') ?  $xmlString = file_get_contents('books/book-' . $bookID . '.xml') : exit("Failed to open books/book-" . $bookID . ".xml. \n");
		
		$lines = preg_split('/\n/' , $xmlString);
		for($i = 0; $i < sizeof($lines); $i++)
		{
			$line = $lines[$i];
			if(preg_match("/\<book id=\"(.*)\">/", $line, $matches))
			{
				$bookID = $matches[1];
			}
			elseif(preg_match("/\<s(.*) page=\"(.*)\" title=\"(.*)\" author=\"(.*)\">/", $line, $matches))
			{
				$level = $matches[1];
				$page = $matches[2];
				$title = addslashes($matches[3]);
				$author = addslashes($matches[4]);
				$query = "INSERT INTO books VALUES('$bookID', '$level', '$page', '$title', '$author')";
				$db->query($query);
			}
			
		}	
	}
?>
