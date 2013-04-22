<div class="<?php echo $this->plugin_name; ?>_page">
	<h1>User: <?php  echo $user->user_login; ?></h1>
	<p><a href="<?php echo get_admin_url(); ?>admin.php?page=polcode_user_info"> << back to list </a></p>
	<div style="border: 1px solid #CECECE; padding: 10px;">
		<p>First name: <?php echo $first_name[0]->meta_value; ?></p>
		<p>Last name: <?php echo $last_name[0]->meta_value; ?></p>
		<p>Nickname: <?php echo $nickname[0]->meta_value; ?></p>
		<p>E-mail: <?php echo $user->user_email; ?></p>
		<hr>
		<p>Alerts(<a href="<?php echo get_admin_url(); ?>admin.php?page=polcode_user_info_edit&id=<?php echo $alerts[0]->umeta_id; ?>&user=<?php echo $_GET['id']; ?>">edit</a>):</p> 
		<ul>
		<?php
			$this->nameParser($alerts[0]->meta_value);
		?>
		</ul>

		<p>Alerts Freq(<a href="<?php echo get_admin_url(); ?>admin.php?page=polcode_user_info_edit&id=<?php echo $alertsfreq[0]->umeta_id; ?>&user=<?php echo $_GET['id']; ?>">edit</a>):</p> 
		<ul>
		<?php
			$this->nameParserFq($alertsfreq[0]->meta_value);
		?>
		</ul>
		<hr>
		<p>Brand alerts(<a href="<?php echo get_admin_url(); ?>admin.php?page=polcode_user_info_edit&id=<?php echo $brandalerts[0]->umeta_id; ?>&user=<?php echo $_GET['id']; ?>">edit</a>):</p>
		<ul>
		<?php
			$this->nameParser($brandalerts[0]->meta_value);
		?>
		</ul>
		<p>Brand alerts freq(<a href="<?php echo get_admin_url(); ?>admin.php?page=polcode_user_info_edit&id=<?php echo $brandalertsfreq[0]->umeta_id; ?>&user=<?php echo $_GET['id']; ?>">edit</a>):</p> <?php //echo $brandalertsfreq[0]->meta_value; ?></p>
		<ul>
		<?php
			$this->nameParserFq($brandalertsfreq[0]->meta_value);
		?>
		</ul>
		<hr>
		<p>Default alerts:<br> <?php echo $defaultalerts[0]->meta_value; ?></p>
		<p>Alert hour:<br> <?php echo $alerthour[0]->meta_value; ?></p>
		<p>Alert minute:<br> <?php echo $alertminute[0]->meta_value; ?></p>
	</div>
	<h3>Visited stores:</h3> 
		<ul>
		<?php foreach($stores as $store){
		echo '<li>';
		echo $store->meta_value;
		echo ' | ';
		echo $this->getPostById($store->meta_value);
		echo '</li>';
		
		}
		?>
		</ul>
	<h3>Visited brands:</h3> 
		<ul>
		<?php foreach($brands as $brand){
		echo '<li>';
		echo $brand->meta_value;
		echo ' | ';
		echo $this->getPostById($brand->meta_value);
		echo '</li>';
		}
		?>
		</ul>
	<h3>Visited sales:</h3> 
		<ul>
		<?php foreach($sales as $sale){
		echo '<li>';
		echo $sale->meta_value;
		echo ' | ';
		echo $this->getPostById($sale->meta_value);
		echo '</li>';		
		}
		?>
		</ul>

<?php require 'footer.php'; ?>
	
</div><!-- \  <?php echo $this->plugin_name; ?>_page / -->


