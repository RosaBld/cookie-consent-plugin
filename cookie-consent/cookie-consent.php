<?php

/* 

* @wordpress-plugin
  * Plugin Name: Cookie Consent Management
  * Plugin URI: pouetpouet.com
  * Description: Plugin to display the cookie consent form and informations
  * Version: 1.0.0
  * Author: Rosalie Boulard
  * Author URI: pouetpouet.com
  * License URI: pouetpouet.com
  * Text Domain: cookie-consent
  * Domain Path: /languages

*/

if ( ! defined( 'ABSPATH' ) ) {
  die( '-1' );
}

// plugin constants
define( 'COOKIE_CONSENT_VERSION', '1.0.0' );
define( 'COOKIE_CONSENT_MIN_PHP_VERSION', '7.4');
define ( 'COOKIE_CONSENT_NAME', 'cookie-consent' );

// plugin URL and path
define( 'COOKIE_CONSENT_URL', plugin_dir_url( __FILE__ ) );
define( 'COOKIE_CONSENT_DIR', plugin_dir_path( __FILE__ ) );
define( 'ACF_OPTIONS_MAIN_FILE_DIR', __FILE__ );
define( 'COOKIE_CONSENT_PLUGIN_DIRNAME', basename( rtrim( dirname( __FILE__ ), '/' ) ) );

// check PHP min version
if ( version_compare( PHP_VERSION, COOKIE_CONSENT_MIN_PHP_VERSION, '<' ) ) {
  require_once COOKIE_CONSENT_DIR . 'compat.php';

  add_action( 'admin_init', array( 'Compatibility', 'admin_init' ) );

  exit;
}

// Autoload
require_once COOKIE_CONSENT_DIR . 'autoload.php';

add_action( 'plugins_loaded', 'COOKIE_CONSENT_load', 100);

function COOKIE_CONSENT_load() {
  load_plugin_textdomain(
    'cookie_consent',
    false,
    COOKIE_CONSENT_PLUGIN_DIRNAME . '/languages'
  );

  $requirements = new \Cookie_Consent\Requirements();
  if ( ! $requirements->check_requirements() ) {
    return;
  }

  $ctrl = new \Cookie_Consent\Controller();

  $main = new \Cookie_Consent\Main();

  if ( is_admin() ) {
    $admin = new \Cookie_Consent\Admin();
  }
}