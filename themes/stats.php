<div class="<?php echo $this->plugin_name; ?>_page">
	<h1>Polcode User Info Stats</h1>
	<p>User registered: <?php  echo sizeof($users); ?></p>
	<p>&nbsp;</p>
	<p>Stores registered: <?php  echo sizeof($stores); ?></p>
	<p>Stores visit: <?php  echo $visitstores; ?></p>
	<p>&nbsp;</p>
	<p>Brands registered: <?php  echo sizeof($brands); ?></p>
	<p>Brands visit: <?php  echo $visitbrands; ?></p>
	<p>&nbsp;</p>
	<p>Sales registered: <?php  echo sizeof($sales); ?></p>
	<p>Sales visit: <?php  echo $visitsales; ?></p>

<?php require 'footer.php'; ?>
	
</div><!-- \  <?php echo $this->plugin_name; ?>_page / -->
