<?php

/**
 * Plugin Name:       Product Enquiry
 * Description:       Product Enquiry Widget is created by Zain.
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Zain Hassan
 * Text Domain:       dokan
*/

if(!defined('ABSPATH')){
exit;
}

/**
 *  Elementor Custom Widgets
 * 
 * 
*/

// Forms Data
include( 'inc/form_submission.php' );

require_once(WP_PLUGIN_DIR .'/dokan-pro/modules/product-enquiry/module.php');

require_once( __DIR__ . '/module.php' );


function register_custom_elementor_widgets( $widgets_manager ) {
    /** Accordion Widget **/
	require_once( __DIR__ . '/enquiry.php' );
	$widgets_manager->register( new \custom_enquiry_widget );
}
add_action( 'elementor/widgets/register', 'register_custom_elementor_widgets' );

