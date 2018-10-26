<?php
	echo "Journals Article Insertion.......\n";
	include("../php/connect.php");
	
	$result = $db->query("SELECT id FROM journaldetails order by id");
	
	while($row = $result->fetch_assoc())
	{
		$journalID = $row['id'];
		file_exists('journal/journal-' . $journalID . '.xml') ? $xmlObj = simplexml_load_file('journal/journal-' . $journalID . '.xml') : exit("Failed to open journal/journal-" . $journalID . ".xml. \n");
	
		foreach($xmlObj->volume as $volume)
		{
			$vnum = $volume['vnum'];
			foreach($volume->part as $part)
			{
				$prevPage = '';
				$count = 0;
				$pnum = $part['pnum'];
				$year = $part['year'];
				$month = $part['month'];
				$info = $part['info'];
				foreach($part->entry as $entry)
				{
					$title = addslashes($entry->title);
					$feature = addslashes($entry->feature);
					$page = $entry->page;
					$array = $authors = array();
					$authorJson = '[';
				
					foreach($entry->allauthors->author as $author)
					{
						
						if((string)$author != '')
						{
							//~ $array['name'] = (string)$author;
							//~ $array['type'] = (string)$author['type'];
							//~ array_push($authors, $array);
							$authorJson .= '{"name":' . '"' . (string)$author . '" ,' . '"type":' . '"' . (string)$author['type'] . '"} , ';
						}
						
					}
					
					$authorJson = preg_replace('/ , $/', '', $authorJson);
					$authorJson = $authorJson . ']';
					
					//~ $authorJson = json_encode($authors);
					(strcmp($page, $prevPage) == 0 ) ? ($titleid = 'id_' . $journalID . '_' . $vnum . '_' .$pnum . '_' . $page . '_' . ++$count) : ($titleid = 'id_' . $journalID . '_' . $vnum . '_' .$pnum . '_' . $page . '_0' AND $count = 0);
					$prevPage =  $page;
					$query = "INSERT INTO journals VALUES('$journalID', '$vnum', '$pnum', '$year', '$month', '$title', '$feature', '$page', '$authorJson', '$info', '$titleid')";
					$db->query($query);
				}
			}
		}
	}
?>
