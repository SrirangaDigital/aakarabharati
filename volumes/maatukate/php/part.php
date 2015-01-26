<?php include('header.php'); ?>
<?php include('nav.php'); ?>
		<div id="about_sakshi">
			<?php

												include("connect.php");
												require_once("common.php");

												if(isset($_GET['vol'])){$volume = $_GET['vol'];}else{$volume = '';}

												if(!(isValidVolume($volume)))
												{
													exit(1);
												}

												$query = "select distinct year,part,month from article_maatukate where volume='$volume' order by part";
												$result = $db->query($query); 
												$num_rows = $result ? $result->num_rows : 0;
												
												echo '<div class="page_title"><i class="fa fa-book"></i>&nbsp;&nbsp;ಸಂಪುಟ&nbsp;'.intval($volume).'</div>';
											?>
			<div class="archive_holder_maatukate">
				<div id="volumes_maatukate">
				
											<?php
												echo '<ul class="dot">';

												if($num_rows > 0)
												{
													$isFirst = 1;
													while($row = $result->fetch_assoc())
													{
														echo '<a href="toc.php?vol='.$volume.'&amp;part='.$row['part'].'">';
														echo '<li class="button alt">';
														echo getMonth_part($row['month']);
														echo "</li>";
														echo "</a>";
														$isFirst = 0;
													}
												}
													echo '</ul>';

												if($result){$result->free();}
												$db->close();

												?>
						</div>
					</div>
				</div>	
			</div>					
			
		<?php include("footer.php"); ?>
