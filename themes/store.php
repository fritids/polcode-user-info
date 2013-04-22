<div class="<?php echo $this->plugin_name; ?>_page">
	<h1>Store: <?php echo $this->getPostById($_GET['id'])?></h1>
	<p><a href="<?php echo get_admin_url(); ?>admin.php?page=polcode_user_info_stores">  << back to list </a></p>
	<p>Visits: <?php echo sizeof($metas); ?></p>
	<h3>Visited by:</h3>
	<ul>
		<?php foreach($metas as $meta){
		echo '<li>';
		echo $meta->user_id;
		echo ' | ';
		echo $this->getUserById($meta->user_id)->user_login;
		echo '</li>';		
		}
		?>
		</ul>


<?php require 'footer.php'; ?>
	
</div><!-- \  <?php echo $this->plugin_name; ?>_page / -->
