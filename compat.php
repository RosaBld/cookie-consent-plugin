<?php

class Compatibility {
	/**
	 * admin_init hook callback
	 *
	 * @since 0.1
	 */
	public static function admin_init() {
		// Not on ajax
		if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
			return;
		}

		// Check activation
		if ( ! current_user_can( 'activate_plugins' ) ) {
			return;
		}

		trigger_error( sprintf( 'Cookie Consent requires PHP version %s or greater to be activated.', esc_html( COOKIE_CONSENT_MIN_PHP_VERSION ) ) );

		// Deactive self
		deactivate_plugins( COOKIE_CONSENT_DIR . 'plugin-boilerplate.php' );

		unset( $_GET['activate'] );

		add_action( 'admin_notices', array( __CLASS__ , 'admin_notices' ) );
	}

	/**
	 * Notify the user about the incompatibility issue.
	 */
	public static function admin_notices() {
    echo '<div class="notice error is-dismissible">';
    echo '<p>' . esc_html( sprintf( 'Plugin Boilerplate requires PHP version %s or greater to be activated. Your server is currently running PHP version %s.', COOKIE_CONSENT_MIN_PHP_VERSION, PHP_VERSION ) ) . '</p>';
    echo '</div>';
	}
}
