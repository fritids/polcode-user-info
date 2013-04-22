<?php
/* 
	Plugin Name: Polcode User Info
	Plugin Uri:
	Description: Plugin geting user info from database 
	Version: 1.0
	Author: Przemysław Olesiński
*/


class polcode_user_info {
	
	private $table_prefix;
	private $user_table;
	private $meta_table;
	private $plugin_name;
	private $admin_url;
	private $post_table;

	function __construct(){
		//init var for class, themes and helpers
		$this->table_prefix = 'polcode_user_info';
		$this->user_table = 'wp_users';
		$this->meta_table = 'wp_usermeta';
		$this->plugin_name ='polcode_user_info';
		$this->post_table = 'wp_posts';

		

		// init for admin site
		if(is_admin()) {
			add_action('admin_menu', array($this, 'initAction'));
			
		}
	}

	function initAction(){
		wp_register_style( 'userinfo', plugins_url('css/polcode_user_info.css', __FILE__) );
    	wp_enqueue_style( 'userinfo' );



		//adding elements to menu
			//main menu name
			add_menu_page('User info', 'User info', 'manage_options', 'polcode_user_info', array($this, 'mainAction'));
				//adding submenu elements
					add_submenu_page('polcode_user_info', 'Polcode User Info Stores', 'Stores', 'manage_options', 'polcode_user_info_stores', array($this, 'storesAction') );		
					add_submenu_page('polcode_user_info', 'Polcode User Info Brands', 'Brands', 'manage_options', 'polcode_user_info_brands', array($this, 'brandsAction') );		
					add_submenu_page('polcode_user_info', 'Polcode User Info Sales', 'Sales', 'manage_options', 'polcode_user_info_sales', array($this, 'salesAction') );		
					add_submenu_page('polcode_user_info', 'Polcode User Info Stats', 'Stats', 'manage_options', 'polcode_user_info_stats', array($this, 'statsAction') );		
					add_submenu_page('polcode_user_info', 'Polcode User Info About', 'About', 'manage_options', 'polcode_user_info_about', array($this, 'aboutAction') );
						// unsee 
							add_submenu_page('polcode_user_info_about', 'Polcode User Info ', 'User', 'manage_options', 'polcode_user_info_user', array($this, 'userAction') );
							add_submenu_page('polcode_user_info_about', 'Polcode User Info Store ', 'Store', 'manage_options', 'polcode_user_info_store', array($this, 'storeAction') );
							add_submenu_page('polcode_user_info_about', 'Polcode User Info Brand ', 'Brand', 'manage_options', 'polcode_user_info_brand', array($this, 'brandAction') );
							add_submenu_page('polcode_user_info_about', 'Polcode User Info Sale ', 'Sale', 'manage_options', 'polcode_user_info_sale', array($this, 'saleAction') );
							add_submenu_page('polcode_user_info_about', 'Polcode User Info Edit Meta ', 'Edit Meta', 'manage_options', 'polcode_user_info_edit', array($this, 'editMetaAction') );
	}

	/********************************** view Action **************************************************/

	//main window init view
	function mainAction(){
		$users = $this->getUsers();
		include 'themes/main.php';
	}

	function aboutAction() {
		include 'themes/about.php';	
	}


	//single user init view
	function userAction(){
		$id = $_GET['id'];
		$user = $this->getUserById($id);
		$stores = $this -> getUserMeta($id, 'stores_read_home');
		$brands = $this -> getUserMeta($id, 'brand_read_home');
		$sales = $this -> getUserMeta($id, 'read_sale');
		$alertsfreq = $this->getMetaData($id, 'alertsfreq');
		$brandalerts = $this->getMetaData($id, 'brandalerts');
		$brandalertsfreq = $this->getMetaData($id, 'brandalertsfreq');
		$alerts = $this->getMetaData($id, 'alerts');
		$first_name = $this->getMetaData($id, 'first_name');
		$last_name = $this->getMetaData($id, 'last_name');
		$nickname = $this->getMetaData($id, 'nickname');
		$defaultalerts = $this->getMetaData($id, 'defaultalerts');
		$alerthour = $this->getMetaData($id, 'alerthour');
		$alertminute = $this->getMetaData($id, 'alertminute');
				//var_dump($alertsfreq);
		include 'themes/user.php';
	}


	/*
	function datasAction(){

	}*/

	function storesAction() {
		$stores = $this->getDataAll('winkel');
		$visit = sizeof($this->getAllStoresVisits());
		include 'themes/stores.php';		
	}

	function storeAction(){
		$id = $_GET['id'];
		$metas = $this->getStoreVisits($id);
		include 'themes/store.php';	
	}

	function brandsAction(){
		//$brands = $this->getDataAll('merken');
		$brands = $this->getDataAll('merken');
		$visit = sizeof($this->getAllBrandsVisits());
		include 'themes/brands.php';	
	}

	function brandAction(){
		$id = $_GET['id'];
		$metas = $this->getBrandVisits($id);
		//var_dump($metas);
		include 'themes/brand.php';	
	}

	function salesAction() {
		$stores = $this->getSalesAll();
		$visit = sizeof($this->getAllSalesVisits());
		include 'themes/sales.php';		
	}

	function saleAction(){
		$id = $_GET['id'];
		$metas = $this->getSaleVisits($id);
		//var_dump($metas);
		include 'themes/sale.php';	
	}

	function statsAction() {
		$users = $this->getUsers();
		$stores = $this->getDataAll('winkel');
		$visitstores = sizeof($this->getAllStoresVisits());
		$brands = $this->getDataAll('merken');
		$visitbrands = sizeof($this->getAllBrandsVisits());
		$sales = $this->getSalesAll();
		$visitsales = sizeof($this->getAllSalesVisits());
		include 'themes/stats.php';		
	}

	function editMetaAction(){
		$id = $_GET['id'];
		if(isset($_POST['str'])) {
			//echo '<h1>edycja</h1>';
			$this->editMeta($_POST['str'], $id);
		}

		$data = $this->getEditMeta($id);
		include 'themes/editmeta.php';		
	}


	/********************************** geters and seters *******************************************/



	//get option from wp_options
	function getOption($val) {
		return get_option($val);
	}

	//get user by id
	function getUserById($id){
		global $wpdb;
		$user = $wpdb->get_results('SELECT * FROM '.$this->user_table . ' WHERE ID = '.$id);
		return $user[0];
	}

	//geting all user meta from db
	function getAllUserMeta($id){
		global $wpdb;
		$meta = $wpdb->get_results('SELECT * FROM '.$this->meta_table . ' WHERE user_id = '.$id);
		return $meta;
	}

	function getUserMeta($id, $meta_key) {
		global $wpdb;
		$meta = $wpdb->get_results("SELECT * FROM ".$this->meta_table . " WHERE meta_key = '".$meta_key."' AND user_id = ".$id);
		return $meta;
	}



	//get all users
	function getUsers(){
		global $wpdb;
		if(isset($_POST['str'])){
			echo 'save';
		}

		$users = $wpdb->get_results('SELECT * FROM '.$this->user_table . ' ORDER BY ID');
		//var_dump($users);
		return $users;
	}



	/**************************************** Get post elements ************************************/

	function getPostById($id) {
		global $wpdb;
		$post = $wpdb->get_results('SELECT * FROM '.$this->post_table.' WHERE ID = '.$id );		
		return $post[0]->post_title; 	
	}

	function gerPost($id){
		global $wpdb;
		$post = $wpdb->get_results('SELECT * FROM '.$this->post_table.' WHERE ID = '.$id );		
		return $post; 
	}


	function getDataAll($name){
		global $wpdb;
		$data = $wpdb->get_results("SELECT * FROM ".$this->post_table." WHERE post_type = '".$name."'" );	
		return $data;
	}



	function getStoreVisits($id) {
		global $wpdb;
		$meta = $wpdb->get_results("SELECT * FROM ".$this->meta_table . " WHERE meta_key = 'stores_read_home' AND meta_value = ".$id);
		return $meta;
	}


	function getAllStoresVisits() {
		global $wpdb;
		$stores = $wpdb->get_results("SELECT * FROM ".$this->meta_table . " WHERE meta_key = 'stores_read_home'");
		return $stores;
	}

	function getBrandVisits($id) {
		global $wpdb;
		$meta = $wpdb->get_results("SELECT * FROM ".$this->meta_table . " WHERE meta_key = 'brand_read_home' AND meta_value = ".$id);
		return $meta;
	}
	
	function getAllBrandsVisits() {
		global $wpdb;
		$stores = $wpdb->get_results("SELECT * FROM ".$this->meta_table . " WHERE meta_key = 'brand_read_home'");
		return $stores;
	}

	function getSalesAll() {
		global $wpdb;
		$post = $wpdb->get_results("SELECT * FROM ".$this->post_table." WHERE post_type = 'kortingscode'" );	
		return $post;
	}


	function getSaleVisits($id) {
		global $wpdb;
		$meta = $wpdb->get_results("SELECT * FROM ".$this->meta_table . " WHERE meta_key = 'read_sale' AND meta_value = ".$id);
		return $meta;
	}
	
	function getAllSalesVisits() {
		global $wpdb;
		$stores = $wpdb->get_results("SELECT * FROM ".$this->meta_table . " WHERE meta_key = 'read_sale'");
		return $stores;
	}

	function getMetaData($user, $meta){
		global $wpdb;
		$data = $wpdb->get_results("SELECT * FROM ".$this->meta_table . " WHERE meta_key = '".$meta."' AND user_id = ".$user);
		return $data;
	}

	/****************************** parsers ***************************************/

	function nameParser($name) {
		$tab = explode(",", $name);
		foreach ($tab as $row) {
			echo '<li>'.$row.' | '.$this->getPostById($row).'</li>';
		}

	}

	function nameParserFq($name) {
		$tab = explode(",", $name);
		foreach ($tab as $row) {
			$in = 0;
			$in = strrpos($row, "_");
			if($in!=false) {
				$st = substr($row, 0, $in);
				echo '<li>'.$row.' | '.$this->getPostById($st).'</li>';
			}
			else {
				echo '<li>'.$row.' | '.$this->getPostById($row).'</li>';
			}
		}

	}

	/************************* Edit *********************************************/

	function getEditMeta($id){
		global $wpdb;
		$data = $wpdb->get_results("SELECT * FROM ".$this->meta_table." WHERE umeta_id = ".$id);
		//var_dump($data);
		return $data;
	}

	function editMeta($strmeta, $id) {
		global $wpdb;
		$wpdb->get_results("UPDATE ".$this->meta_table." SET meta_value = '".$strmeta."' WHERE umeta_id = ".$id);

	}

	/************************ other function **************************************/


}

$polcode_user_info = new polcode_user_info();