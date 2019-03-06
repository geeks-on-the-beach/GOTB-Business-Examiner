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
class Gotb_Banners {

	/**
	 *
	 *
	 * @since    1.0.0
	 */
	public function register_post_type() {

		// need these fields:
		/**
		 * name::post title
		 * type (image, custom)
		 * width
		 * height
		 * alt text
		 * click url
		 * description::post content
		 * status (published, not)
		 * category::banner category
		 * pinned
		 * total impressions
		 * total clicks
		 * client::user
		 * purchase type
		 * track impressions
		 * track clicks
		 * created date
		 * created by
		 * modified date
		 * modified by
		 * revision (number)
		 *
		 */

		// Banners
		$labels = array(
			'name'                => _x( 'Banners', 'Post Type General Name', 'gotb' ),
			'singular_name'       => _x( 'Banner', 'Post Type Singular Name', 'gotb' ),
			'menu_name'           => __( 'Banners', 'gotb' ),
			'parent_item_colon'   => __( 'Parent Banner', 'gotb' ),
			'all_items'           => __( 'All Banners', 'gotb' ),
			'view_item'           => __( 'View Banner', 'gotb' ),
			'add_new_item'        => __( 'Add New Banner', 'gotb' ),
			'add_new'             => __( 'Add New', 'gotb' ),
			'edit_item'           => __( 'Edit Banner', 'gotb' ),
			'update_item'         => __( 'Update Banner', 'gotb' ),
			'search_items'        => __( 'Search Banner', 'gotb' ),
			'not_found'           => __( 'Not Found', 'gotb' ),
			'not_found_in_trash'  => __( 'Not found in Trash', 'gotb' ),
		);

		// Set other options for Custom Post Type

		$args = array(
			'label'               => __( 'banners', 'gotb' ),
			'description'         => __( 'Client banner ads', 'gotb' ),
			'labels'              => $labels,
			// Features this CPT supports in Post Editor
			'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'revisions', 'custom-fields', ),
			'taxonomies'          => array( 'banner-categories' ),
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'menu_position'       => 5,
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'capability_type'     => 'page',
		);

		// Registering your Custom Post Type
		register_post_type( 'banner', $args );
		register_taxonomy_for_object_type( 'category', 'banner' );


	}




}
