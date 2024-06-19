<?php

namespace Cookie_Consent;

class Requirements {

	/**
	 * All about requirements checks
	 *
	 * @return bool
	 */
  
	public function check_requirements() {
		if ( ! function_exists( 'acf' ) || ! function_exists( 'pll_current_language' ) ) {
			$this->display_error( __( 'Advanced Custom Fields and Polylang are required plugins.', 'cookie-consent' ) );

			return false;
		}

		if ( version_compare( acf()->version, '5.6.0', '<' ) ) {
			$this->display_error( __( 'Advanced Custom Fields should be on version 5.6.0 or above.', 'cookie-consent' ) );

			return false;
		}

		return true;
	}

	// Display message and handle errors
	public function display_error( $message ) {
		trigger_error( esc_html( $message ) );

		add_action(
			'admin_notices',
			function () use ( $message ) {
				printf( '<div class="notice error is-dismissible"><p>%s</p></div>', esc_html( $message ) );
			}
		);

		// Deactive self
		add_action(
			'admin_init',
			function () {
				deactivate_plugins( ACF_OPTIONS_MAIN_FILE_DIR );
				unset( $_GET['activate'] );
			}
		);
	}
}