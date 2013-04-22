<div class="<?php echo $this->plugin_name; ?>_page">
	<h1>Brands</h1>
	<p>Brands registered: <?php  echo sizeof($brands); ?> </p>
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
			<?php for ($i=0; $i < sizeof($brands) ; $i++) { ?>
				<tr>
					<td><?php echo $brands[$i]->ID; ?></td>
					<td><?php echo $brands[$i]->post_title; ?></td>
					<td class="<?php echo $this->plugin_name; ?>_i"><a href="<?php echo get_admin_url(); ?>admin.php?page=polcode_user_info_brand&id=<?php echo $brands[$i]->ID; ?>" > show </a></td>
				</tr>				
			<?php } ?>			
		</tbody>
	</table>

<?php require 'footer.php'; ?>
	
</div><!-- \  <?php echo $this->plugin_name; ?>_page / -->
