<?php
	include("header.php");
	include("nav.php");
	include("connect.php");
	require_once("common.php");
	(isset($_GET['bookid']) && $_GET['bookid'] != '') ? $bookid = $_GET['bookid'] : $bookid = '';
	
	$noShow = ['003', '004', '005', '006', '007', '008', '009', '010', '011', '012', '013', '014', '015', '016', '017', '018', '019', '051'];
	
	$query = "SELECT * FROM bookdetails WHERE id = '$bookid'";
	$result = $db->query($query);
	$num_rows = $result ? $result->num_rows : 0;
	if($num_rows > 0)
	{
		$row = $result->fetch_assoc();
	}
	else
	{
		echo "<div class=\"center\">No Result found. Please try again.</div>";
		echo "</main>";
		include("footer.php");
		exit();
	}
	
	$infoarray = json_decode($row['details'], true);
	$authors = json_decode($row['author']);
	$displayAuthor = '';
	
	foreach ($authors as $author)
	{
		if($author->name != '')
		{
			$displayAuthor .=  '<a href="javascript:void();">' . $author->name . '</a> | ';
			//~ $displayAuthor .=  '<a href="booksAuth.php?authorname=' . urlencode($author->name) . '&amp;bookid=' . $bookid . '">' . $author->name . '</a> | ';
		}
	}
	$info = '';
	if($infoarray[0]['volume'] != '')
	$info = 'ಆವೃತ್ತಿ  :'. $infoarray[0]['edition'] . ' | ';
	
	if($infoarray[0]['editor'] != '')
	$info .= 'ಸಂಪಾದಕರು  : '. $infoarray[0]['editor'] . ' | ';
	
	if($infoarray[0]['part'] != '')
	$info .= 'ಸಂಪುಟ  '. intval($infoarray[0]['volume']) . ' | ';
	
	if($infoarray[0]['part'] != '')
	$info .= 'ಭಾಗ  '. intval($infoarray[0]['part']) . ' | ';
	
	if($infoarray[0]['year'] != '')
	$info .= getKannadaNumbers($infoarray[0]['year']) . ' | ';
	
	if($infoarray[0]['page'] != '')
	$info .= intval($infoarray[0]['page']) . ' | ';
	
?>
	<main class="cd-main-content">
		<section id="about">
			<h2><br/><?php echo $row['title']; ?></h2>
			<?php if($displayAuthor != ''):?>
			<h4><br/><?php echo '<span class="bookauthorspan">' . preg_replace('/\ \|\ $/', '', $displayAuthor) . '</span>'; ?></h4>
			<?php endif; ?>
			<?php if($info != ''):?>
			<h4><br/><?php echo '<span class="bookauthorspan">(' . preg_replace('/\ \|\ $/', '', $info) . ')</span>'; ?></h4>
			<?php endif; ?>
			<div id="about_p">
			<?php
			
				if(in_array($bookid, $noShow)) echo '<p style="text-align: center">ಈ ಪುಸ್ತಕದ ಹಕ್ಕುಗಳನ್ನು ಕಾಯ್ದಿರಿಸಲಾಗಿರುವದರಿಂದ ಇಲ್ಲಿ ಕೇವಲ ಪುಸ್ತಕದ ಪರಿವಿಡಿಯನ್ನು ನೀಡಲಾಗಿದೆ</p>';
			
				$plus_link = "<img class=\"bpointer\" title=\"Expand\" src=\"img/plus.gif\" alt=\"Expand or Collapse\" onclick=\"display_block_inside(this)\" />";
				$bullet = "";
				$stack = array();
				$p_stack = array();
				$first = 1;
				$li_id = 0;
				$ul_id = 0;
				$i =1;
				$query = "SELECT * FROM books WHERE bookid = '$bookid'";
				$result = $db->query($query); 
				$num_rows = $result ? $result->num_rows : 0;
				
				if($num_rows > 0)
				{
					while($row = $result->fetch_assoc())
					{
						$level = $row['level'];
						$title = $row['title'];
						$page = preg_split('/-/',$row['page']);

						$title = '<span class="aTitle"><a target="_blank" href="bookReader.php?bookid=' . $bookid . '&page=' . $page[0] . '">' . $row['title'] . '</a></span>';
					
						if(in_array($bookid, $noShow)) {
							
							$title = '<span class="aTitle"><a href="#">' . $row['title'] . '</a></span>';
						}
					
						if($row['authorname'] != '')
						{
							$title .= '<br/>';
							$authors = preg_split('/;/',$row['authorname']);
							for($i = 0; $i < count($authors); $i++)
							{
								//~ $title .= '&nbsp;-&nbsp;<span class="aAuthor itl"><a href="booksAuth.php?authorname=' . urlencode($authors[$i]) . '&amp;bookid=' . $bookid . '">' . $authors[$i] . '</a></span> | ';
								$title .= '&nbsp;-&nbsp;<span class="aAuthor itl"><a href="javascript:void();">' . $authors[$i] . '</a></span> | ';
							}
							$title = preg_replace('/\ \|\ $/', '', $title);
						}
						
						if($first)
						{
							array_push($stack,$level);
							$ul_id++;
							echo "<ul id=\"ul_id$ul_id\">\n";
							array_push($p_stack,$ul_id);
							$li_id++;
							if($level > 1)
							{
								$deffer = display_tabs($level) . "<li id=\"li_id$li_id\"><div class=\"article1\">:rep:$title";
							}
							else
							{
								$deffer = display_tabs($level) . "<li id=\"li_id$li_id\"><div class=\"article\">:rep:$title";								
							}
							$first = 0;
						}
						elseif($level > $stack[sizeof($stack)-1])
						{
							$deffer = preg_replace('/:rep:/',"$plus_link",$deffer);
							echo $deffer;			
							$ul_id++;
							$li_id++;			
							array_push($stack,$level);
							array_push($p_stack,$ul_id);
							$deffer = "\n" . display_tabs(($level-1)) . "<ul class=\"dnone\" id=\"ul_id$ul_id\">\n";
							if($level > 1)
							{
								$deffer = $deffer . display_tabs($level) ."<li id=\"li_id$li_id\"><div class=\"article1\">:rep:$title";
							}
							else
							{
								$deffer = $deffer . display_tabs($level) ."<li id=\"li_id$li_id\"><div class=\"article\">:rep:$title";								
							}
						}
						elseif($level < $stack[sizeof($stack)-1])
						{
							$deffer = preg_replace('/:rep:/',"$bullet",$deffer);
							echo $deffer;
							
							for($k=sizeof($stack)-1;(($k>=0) && ($level != $stack[$k]));$k--)
							{
								echo "</li>\n". display_tabs($level) ."</ul>\n";
								$top = array_pop($stack);
								$top1 = array_pop($p_stack);
							}
							$li_id++;
							$deffer = display_tabs($level) . "</div></li>\n";
							if($level > 1)
							{
								$deffer = $deffer . display_tabs($level) ."<li id=\"li_id$li_id\"><div class=\"article1\">:rep:$title";
							}
							else
							{
								$deffer = $deffer . display_tabs($level) ."<li id=\"li_id$li_id\"><div class=\"article\">:rep:$title";
							}
						}
						elseif($level == $stack[sizeof($stack)-1])
						{
							$deffer = preg_replace('/:rep:/',"$bullet",$deffer);
							echo $deffer;
							$li_id++;
							$deffer = "</div></li>\n";
							if($level > 1)
							{
								$deffer = $deffer . display_tabs($level) ."<li id=\"li_id$li_id\"><div class=\"article1\">:rep:$title";
							}
							else
							{
								$deffer = $deffer . display_tabs($level) ."<li id=\"li_id$li_id\"><div class=\"article\">:rep:$title";								
							}
						}
					}
					$deffer = preg_replace('/:rep:/',"$bullet",$deffer);
					echo $deffer;

					for($i=0;$i<sizeof($stack);$i++)
					{
						echo "</div></li>\n". display_tabs($level) ."</ul>\n";
					}
				}
			?>
	
		</div>
	</div>
</div>
			</div>
	  </main>
	<div id="cd-search" class="cd-search">
		<form>
			<input type="search" placeholder="Coming soon...">
		</form>
	</div>
<?php include("footer.php"); ?>
	
<?php
function display_tabs($num)
{
	$str_tabs = "";
	if($num != 0)
	{
		for($tab=1;$tab<=$num;$tab++)
		{
			$str_tabs = $str_tabs . "\t";
		}
	}
	return $str_tabs;
}
?>
