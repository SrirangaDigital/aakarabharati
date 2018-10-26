<?php
	echo "Journal Details Insertion.......\n";
	include("../php/connect.php");
	
	$db->query("DROP TABLE IF EXISTS journaldetails");
	$db->query("CREATE TABLE journaldetails (id varchar(5), title varchar(100), period varchar(20), details varchar(300), primary key(id)) ENGINE=MyISAM character set utf8 collate utf8_general_ci");
	
	file_exists('journal/journals_details.xml') ? $xmlObj = simplexml_load_file('journal/journals_details.xml') : exit("Failed to open journals_details.xml");
	
	foreach($xmlObj->journal as $journal)
	{
		$id = $journal['id'];
		$title = addslashes($journal->title);
		$period = $journal->period;
		$details = addslashes($journal->details);
		$query = "INSERT INTO journaldetails VALUES('$id', '$title', '$period', '$details')";
		$db->query($query);
	}
?>
