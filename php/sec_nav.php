		<div class="container">
		<div id="sec_nav">
					<ul class="actions">
						<li><a href="Journals/<?php echo $journalID; ?>/index.php" class="button button-outline">ಮುಖಪುಟ</a></li>
						<li><a href="volumes.php?journalid=<?php echo $journalID; ?>" class="button button-outline">ಸಂಪುಟ</a></li>
						<li><a href="articles.php?journalid=<?php echo $journalID; ?>" class="button button-outline">ಲೇಖನ</a></li>
						<li><a href="authors.php?journalid=<?php echo $journalID; ?>" class="button button-outline">ಲೇಖಕ</a></li>
						<li><a href="search.php?journalid=<?php echo $journalID; ?>" class="button button-outline">ಹುಡುಕು</a></li>
						<?php if($journalID == '012') {?>
							<li><a href="https://www.vanithasadana.org/" class="button button-outline" target="_blank">ವನಿತಾ ಸದನ</a></li>
						<?php } ?>	
					</ul>
		</div>
	</div>
