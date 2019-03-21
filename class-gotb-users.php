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
	class Gotb_Users {

		public function add_fields( $user ) {
			?>
            <h3><?php _e( "Joomla", "blank" ); ?></h3>
            <table class="form-table">
                <tr>
                    <th><label for="joomla_id"><?php _e( "Joomla ID" ); ?></label></th>
                    <td>
                        <input type="text" name="joomla_id" id="joomla_id"
                               disabled="disabled"
                               value="<?php echo esc_html( get_user_meta( $user->ID, 'joomla_id', true ) ); ?>"
                               class="regular-text"/><br/>
                        <span class="description"><?php _e( "Don't edit this." ); ?></span>
                    </td>
                </tr>
            </table>
			<?php
			wp_nonce_field( 'update_joomla_id', 'gotb_user_fields' );
		}

		public function save_fields( $user ) {
            // because joomla ids shouldn't be changed.
            return false;
		    if ( ! current_user_can( 'edit_user', $user ) ) {
				return false;
			}

			if ( ! wp_verify_nonce( $_POST['gotb_user_fields'], 'update_joomla_id' ) ) {
				return false;
			}

			update_user_meta( $user, 'joomla_id', $_POST['joomla_id'] );
		}

	}
