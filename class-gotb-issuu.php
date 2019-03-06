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
	class Gotb_Issuu {

		public $post_type = 'issuu';
		public $display_name = 'Issuu';
		public $plural = 'Issuus';

		public function init() {
			add_action( 'do_meta_boxes', array( $this, 'move_featured_image' ) );
		}


		/**
		 *
		 *
		 * @since    1.0.0
		 */
		public function register_post_type() {

			// Issuus
			$labels = array(
				'name'               => _x( $this->plural, 'Post Type General Name', 'gotb' ),
				'singular_name'      => _x( $this->display_name, 'Post Type Singular Name', 'gotb' ),
				'menu_name'          => __( $this->plural, 'gotb' ),
				'parent_item_colon'  => __( 'Parent Issuu', 'gotb' ),
				'all_items'          => __( 'All Issuus', 'gotb' ),
				'view_item'          => __( 'View Issuu', 'gotb' ),
				'add_new_item'       => __( 'Add New Issuu', 'gotb' ),
				'add_new'            => __( 'Add New', 'gotb' ),
				'edit_item'          => __( 'Edit Issuu', 'gotb' ),
				'update_item'        => __( 'Update Issuu', 'gotb' ),
				'search_items'       => __( 'Search Issuu', 'gotb' ),
				'not_found'          => __( 'Not Found', 'gotb' ),
				'not_found_in_trash' => __( 'Not found in Trash', 'gotb' ),
			);

			// Set other options for Custom Post Type

			$args = array(
				'label'               => __( 'issuus', 'gotb' ),
				'description'         => __( 'Client issuu ads', 'gotb' ),
				'labels'              => $labels,
				// Features this CPT supports in Post Editor
				'supports'            => array(
					'title',
					'author',
					'thumbnail',
					'revisions',
					'custom-fields',
					'sticky'
				),
				'taxonomies'          => array( 'issuu-categories' ),
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
			register_post_type( $this->post_type, $args );

			remove_post_type_support( 'post', 'edit' );
			register_taxonomy_for_object_type( 'category', $this->post_type );

		}

		public function custom_admin_fields() {
			add_meta_box(
				$this->post_type, // $id
				$this->display_name, // $title
				array( $this, 'show_fields' ), // $callback
				$this->post_type, // $screen
				'normal', // $context
				'high' // $priority
			);

		}

		public function show_fields() {

			// need these fields:
			/**
			 * name - string - fine
			 * frontpage - radio y/n - good
			 * categories - categories - fine
			 * primary category - category
			 * cover image - image - wp featured image - fine
			 * table of contents - multiple text fields - fine
			 * issuu link - text field url - fine
			 * social buttons - radio y/n
			 * related articles - articles
			 *
			 * metadata
			 * type - category (current issue), this can replace "Issuu"
			 * hits - int
			 *
			 *
			 */
			global $post;
			$meta = get_post_meta( $post->ID, $this->post_type, true );

			if ( $meta ) {
				$meta = unserialize( $meta );
			}

			?>
			<input type="hidden" name="<?php echo $this->post_type . "__nonce"; ?>"
			       value="<?php echo wp_create_nonce( basename( __FILE__ ) ); ?>">
			<p>
				<label for="<?php echo $this->post_type; ?>[issuu_link]">Issuu Link</label>
				<br>
				<input type="text" name="<?php echo $this->post_type; ?>[issuu_link]"
				       id="<?php echo $this->post_type; ?>[issuu_link]" class="regular-text"
				       value="<?php echo esc_url( $meta['issuu_link'] ); ?>">
			</p>
			<p>
				<label for="<?php echo $this->post_type; ?>[frontpage]">Front Page</label>
				<br>
				<input type="checkbox" name="<?php echo $this->post_type; ?>[frontpage]"
				       id="<?php echo $this->post_type; ?>[frontpage]" class="regular-text"
				       value="1" <?php checked( esc_html( $meta['frontpage'] ) ); ?>>
			</p>
			<p>
				<label for="<?php echo $this->post_type; ?>[social_media]">Show Social Media</label>
				<br>
				<input type="checkbox" name="<?php echo $this->post_type; ?>[social_media]"
				       id="<?php echo $this->post_type; ?>[social_media]" class="regular-text"
				       value="1" <?php checked( esc_html( $meta['social_media'] ) ); ?>>
			</p>

			<p>
				<label>Table Of Contents</label>
				<br>
				<?php for ( $n = 1; $n < 6; $n ++ ) { ?>
					<label for="<?php echo $this->post_type; ?>[toc][<?php echo $n; ?>]"><?php echo $n; ?></label>
					<input type="text" name="<?php echo $this->post_type; ?>[toc][<?php echo $n; ?>]"
					       id="<?php echo $this->post_type; ?>[toc][<?php echo $n; ?>]"
					       class="regular-text"
					       value="<?php echo $meta['toc'][ $n ] ?>"/>
					<br>
				<?php } ?>
			</p>

			<?php

			pf_render( $this->post_type . '[related_posts]', $meta['related_posts'], array(
				'show_numbers'   => true,
				'show_recent'    => true,
				'limit'          => 10,
				'include_script' => true
			) );

			$meta = get_post_meta( $post->ID, $this->post_type . '__hits', true );

			?>
			<p>
				<label for="<?php echo $this->post_type; ?>[hits]">Hits</label>
				<br>
				<input type="text" name="<?php echo $this->post_type; ?>[hits]"
				       id="<?php echo $this->post_type; ?>[hits]" class="regular-text"
				       value="<?php echo esc_html( $meta ); ?>"
				       disabled="true"
				       size="10">
			</p>

			<?php
		}

		public function save_custom_fields( $post_id ) {
			if ( ! $this->nonce_checks( $post_id ) ) {
				return $post_id;
			}

			$new    = $_POST[ $this->post_type ];
			$values = array();

			foreach ( $new as $key => $value ) {
				$saved = get_post_meta( $post_id, $key, true );

				$values[ $key ] = $saved;
				if ( $value && $value !== $saved ) {
					if ( 'issuu_link' === $key ) {
						$value = esc_url( $value );
					} elseif ( 'toc' === $key && is_array( $value ) ) {
						foreach ( $value as $k => $v ) {
							$value[ $k ] = sanitize_text_field( $v );
						}
					} else {
						$value = sanitize_text_field( $value );
					}
					$values[ $key ] = $value;
				}
			}


			$values = serialize( $values );
			update_post_meta( $post_id, $this->post_type, $values );

		}


		public function nonce_checks( $post_id ) {
			if ( ! wp_verify_nonce( $_POST[ $this->post_type . "__nonce" ], basename( __FILE__ ) ) ) {
				return false;
			}

			if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
				return false;
			}

			return true;

		}

		public function move_featured_image() {
			remove_meta_box( 'postimagediv', $this->post_type, 'side' );
			add_meta_box( 'postimagediv', __( 'Featured Image' ), 'post_thumbnail_meta_box', $this->post_type, 'normal', 'high' );
		}
	}
