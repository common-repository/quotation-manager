<?php
/*
Plugin Name: Quotation Manager
Description: Design a form visually, receive the data as requests for quotation and make a Woocommerce product of it
Version:     1.0.0
Author:      Pieter Hoekstra
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/

defined( 'ABSPATH' ) or die( 'Nope, not accessing this' );

define( 'QUOTATION_MANAGER_DIR', __DIR__ );

define( 'QUOTATION_MANAGER__PLUGIN_FILE', __FILE__ );

define( 'QUOTATION_MANAGER_TEXT_DOMAIN', 'quotation-manager' );

define( 'QUOTATION_MANAGER_POST_TYPE', 'qm_quotation' );

define( 'QUOTATION_MANAGER_NONCE', 'qm_quotation_save' );

function autoloader_quotation_manager( $class_name ){

	$class_name = str_replace( '\\', '/', $class_name );

	include_once QUOTATION_MANAGER_DIR . "/" . $class_name . '.php';
}

spl_autoload_register( 'autoloader_quotation_manager');

new QuotationManager\QuotationManager;

/*$debug_tags = array();
add_action( 'all', function ( $tag ) {
	global $debug_tags;
	if ( in_array( $tag, $debug_tags ) ) {
		return;
	}
	echo "<pre>" . $tag . "</pre>";
	$debug_tags[] = $tag;
} );
*/
spl_autoload_unregister( 'autoloader_quotation_manager' );

?>