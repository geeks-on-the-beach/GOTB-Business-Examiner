<?php
/**
 * Plugin Name:     Gotb Business Examiner
 * Plugin URI:      https://geeksonthebeach.ca
 * Description:     Basic Functionality for Business Examiner
 * Author:          Shannon Graham (kluny)
 * Author URI:      http://rocketships.ca
 * Text Domain:     gotb-business-examiner
 * Domain Path:     /languages
 * Version:         0.1.0
 *
 * @package         Gotb_Business_Examiner
 */

define('GOTB_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

require_once  GOTB_PLUGIN_DIR . '/class-gotb-business-examiner-cpts.php';
require_once  GOTB_PLUGIN_DIR . '/class-gotb-banners.php';
require_once  GOTB_PLUGIN_DIR . '/class-gotb-issuu.php';
require_once  GOTB_PLUGIN_DIR . '/class-gotb-users.php';


function gotb_init() {
	$cpts = new Gotb_Business_Examiner_CPTs;
	$cpts->init();
}
add_action('init', 'gotb_init');


function gotb_custom_post_types() {
	$cpts = new Gotb_Business_Examiner_CPTs;
	$cpts->register_post_types();

}
add_action('init', 'gotb_custom_post_types' );

function gotb_extend_post_types() {
	$cpts = new Gotb_Business_Examiner_CPTs;
	$cpts->extend_post_types();

}

function gotb_custom_admin_fields() {
	$cpts = new Gotb_Business_Examiner_CPTs;
	$cpts->custom_admin_fields();

}
add_action('add_meta_boxes', 'gotb_custom_admin_fields' );

function gotb_save_custom_fields( $post_id ) {
	$cpts = new Gotb_Business_Examiner_CPTs;
	$cpts->save_custom_fields( $post_id );
}
add_action( 'save_post', 'gotb_save_custom_fields' );

