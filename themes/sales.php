<div class="<?php echo $this->plugin_name; ?>_page">
	<h1>Sales</h1>
	<p>Stores registered: <?php  echo sizeof($stores); ?> </p>
	<p>All visites: <?php echo $visit;?></p>
	<table>
		<thead>
			<tr>
				<th>ID</th>
				<th>Name</th>
				<th>Show</th>
			</tr>
		</thead>		
		<tbody>
			<?php for ($i=0; $i < sizeof($stores) ; $i++) { ?>
				<tr>
					<td><?php echo $stores[$i]->ID; ?></td>
					<td><?php echo $stores[$i]->post_title; ?></td>
					<td class="<?php echo $this->plugin_name; ?>_i"><a href="<?php echo get_admin_url(); ?>admin.php?page=polcode_user_info_sale&id=<?php echo $stores[$i]->ID; ?>" > show </a></td>
				</tr>				
			<?php } ?>			
		</tbody>
	</table>

<?php require 'footer.php'; ?>
	
</div><!-- \  <?php echo $this->plugin_name; ?>_page / -->
