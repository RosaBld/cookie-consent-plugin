<?php

namespace Cookie_Consent;

class Main {

  public function __construct() {
    add_action("wp_enqueue_scripts", [$this, "add_scripts"]);
    add_action("wp_enqueue_scripts", [$this, "add_styles"]);
  }

  /**
   * Use the trait
   */

  public function add_scripts() {
    wp_enqueue_script( COOKIE_CONSENT_NAME, COOKIE_CONSENT_URL . 'public/js/app.bundle.js', array( 'jquery' ), COOKIE_CONSENT_VERSION, false );
  }
  
  public function add_styles() {
    wp_enqueue_style( COOKIE_CONSENT_NAME, COOKIE_CONSENT_URL . 'public/css/main.css', array(), COOKIE_CONSENT_VERSION, 'all' );
    wp_enqueue_style( COOKIE_CONSENT_NAME . "vars", COOKIE_CONSENT_URL . 'public/css/vars.css', array(), COOKIE_CONSENT_VERSION, 'all' );
  }
}