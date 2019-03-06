<?php
/*
 * Short description.
 *
 * Long description.
 *
 * @link       http://rocketships.ca
 * @since      1.0.0
 *
 * @package    Gotb_Business_Examiner
 * @subpackage Gotb_Business_Examiner/includes
 */

/**
 *
 * @since      1.0.0
 * @package    Gotb_Business_Examiner
 * @subpackage Gotb_Business_Examiner/includes
 * @author     Shannon Graham (kluny) <shannon@rocketships.ca>
 */
class Gotb_Business_Examiner_CPTs {

	public function init() {
		$issuus = new Gotb_Issuu();
		$issuus->init();
	}

	/**
	 *
	 *
	 * @since    1.0.0
	 */
	public function register_post_types() {
		$banners = new Gotb_Banners();
		$issuus = new Gotb_Issuu();

		$issuus->register_post_type();
		$banners->register_post_type();

	}

	public function extend_post_types() {
		// add Joomla user id custom field
		$users = new Gotb_Users();
		$users->extend_post_type();
	}

	public function custom_admin_fields() {
		$issuus = new Gotb_Issuu();
		$issuus->custom_admin_fields();

	}

	public function save_custom_fields( $post_id ) {
		$issuus = new Gotb_Issuu();
		$issuus->save_custom_fields( $post_id );
	}

}
