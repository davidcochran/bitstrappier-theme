<?php
/**
 * Required by WordPress.
 *
 * Keep this file clean and only use it for requires.
 */

require_once locate_template('/lib/utils.php');           // Utility functions
require_once locate_template('/lib/init.php');            // Initial theme setup and constants
require_once locate_template('/lib/sidebar.php');         // Sidebar class
require_once locate_template('/lib/config.php');          // Configuration
// BitStrappier bypasses these activation options
// require_once locate_template('/lib/activation.php');      // Theme activation
require_once locate_template('/lib/cleanup.php');         // Cleanup
require_once locate_template('/lib/nav.php');             // Custom nav modifications
require_once locate_template('/lib/htaccess.php');        // Rewrites for assets, H5BP .htaccess
require_once locate_template('/lib/widgets.php');         // Sidebars and widgets
require_once locate_template('/lib/scripts.php');         // Scripts and stylesheets
require_once locate_template('/lib/custom.php');          // Custom functions

// Lessphp
// Check for LESS file updates and compile live in PHP
//
// NOTE: 	Plugins utilizing lessphp could call
// 				for another instance of lessc, creating a conflict
//				**Comment out to turn off this functionality in the theme**
//
require_once locate_template( '/lib/less.php' );					// Less Compiling functions
