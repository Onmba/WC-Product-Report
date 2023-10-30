<?php
/**
* Plugin Name: WC Product Report
* Plugin URI: https://www.tomnelsonsmith.com/
* Description: The plugin for the Brave Test
* Version: 0.1
* Author: Tom Nelson
* Author URI: https://www.tomnelsonsmith.com/

**/

// Includes
	// Settings - main template is loaded in settings callback
		include plugin_dir_path( __FILE__ ) . '/settings/settings.php';
	// Functions
		include plugin_dir_path( __FILE__ ) . '/woo-search.php';
