<footer>
	<div class="flexBox">
		<section id="app" class="flexBox">
			<div>
				<div><h2><?php echo $core['app_name']; ?></h2></div>
				<div><h5><?php echo $core['version_type']; ?>&nbsp;v.&nbsp;<?php echo $core['version_number']; ?></h5></div>
			</div>
		</section>
		
		<section id="creator" class="flexBox">
			<div>Copyright by <strong>Maycrawer</strong>
				<?php
					// Years of production
					$year_creation = $core['creation_year'];
					$year_current  = date("Y");
					
					if ($year_current - $year_creation > 0)
						echo $year_creation."-".$year_current;
					else echo $year_creation;
				?></div>
		</section>
	</div>
</footer>