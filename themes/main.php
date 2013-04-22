<div class="<?php echo $this->plugin_name; ?>_page">
	<h1>Polcode User Info</h1>
	<p>User registered: <?php  echo sizeof($users); ?> </p>
	<table>
		<thead>
			<tr>
				<th>ID</th>
				<th>Login</th>
				<th>E-mail</th>
				<th>Show</th>
			</tr>
		</thead>
		<tbody>
			<?php for ($i=0; $i < sizeof($users) ; $i++) { ?>
				<tr>
					<td><?php echo $users[$i]->ID; ?></td>
					<td><?php echo $users[$i]->user_login; ?></td>
					<td><?php echo $users[$i]->user_email; ?></td>
					<td class="<?php echo $this->plugin_name; ?>_i"><a href="<?php echo get_admin_url(); ?>admin.php?page=polcode_user_info_user&id=<?php echo $users[$i]->ID; ?>" > show </a></td>
				</tr>				
			<?php } ?>
			
		</tbody>
	</table>

<?php require 'footer.php'; ?>
	
</div><!-- \  <?php echo $this->plugin_name; ?>_page / -->
