<div class="<?php echo $this->plugin_name; ?>_page">
	<h1>Edit</h1>
	<p><a href="<?php echo get_admin_url(); ?>admin.php?page=polcode_user_info_user&id=<?php echo $_GET['user']?>">  << back to user </a></p>
	<div class="<?php echo $this->plugin_name; ?>_left">
		<form action="<?php echo get_admin_url(); ?>admin.php?page=polcode_user_info_edit&id=<?php echo $_GET['id']; ?>&user=<?php echo $_GET['user']; ?>" method="post">
			<textarea name="str"><?php echo $data[0]->meta_value ?></textarea><br/>
			<input type="submit" value="save">		
		</form>
	</div>
	<div class="<?php echo $this->plugin_name; ?>_right">
		<ul>
			<?php
				$this->nameParserFq($data[0]->meta_value);
			?>
		</ul>
	</div>
<br style="clear: both;">
<?php require 'footer.php'; ?>
	
</div><!-- \  <?php echo $this->plugin_name; ?>_page / -->
