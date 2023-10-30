<?php
	$my_ajax_url = admin_url('admin-ajax.php');
// First, this needs to be added the Woo menu and stick it at the bottom
	function register_report_page() {
	    add_submenu_page( 'woocommerce', 'WC Product Report', 'WC Product Report', 'manage_options', 'wc-product-report', 'wc_product_report_callback' ); 
	}
	function wc_product_report_callback() {
		// Load in the main template
		if ( current_user_can( 'manage_options' ) ) {
	    	include plugin_dir_path( __DIR__ ) . '/templates/main.php';
		}
		if ( !current_user_can( 'manage_options' ) ) {
			include plugin_dir_path( __DIR__ ) . '/templates/oops.php';
		}
	}
	add_action('admin_menu', 'register_report_page',99);
// Pass data to myscript.js on page load

// Include the styling and scripts
		add_action('admin_enqueue_scripts', 'woo_sausage_stylesheet');
		function woo_sausage_stylesheet() {
		    wp_register_style( 'woo-style-sausage',  plugin_dir_url( __DIR__ ) . 'styles/css/main.css');
		    wp_enqueue_script( 'woo-script-sausage',  plugin_dir_url( __DIR__ ) . 'styles/js/main.js');
		    // Grab the date picker
			wp_register_style( 'jquery-ui', 'https://code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css' );
		}
		// Including my scripts and the datepicker
		wp_enqueue_style( 'woo-style-sausage' );
		wp_enqueue_script( 'woo-script-sausage' );
		wp_enqueue_script( 'jquery-ui-datepicker' );
		wp_enqueue_style( 'jquery-ui' );
?>