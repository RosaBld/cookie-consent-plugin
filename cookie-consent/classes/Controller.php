<?php

namespace Cookie_Consent;

use Spruce\Utility\StringTransformator;

class Controller {

  public function __construct() {
      if( function_exists('acf_add_options_page') ) {
          $this->addCookieConsentPage();
          $this->addRoute();

          add_filter( 'acf/settings/load_json', [$this, 'my_acf_json_load_point'] );
          $this->writeCssVars();

          add_shortcode('cookie-consent', function() {
              print "<div id='cookie-consent-managenement-shortcode'><div id='inline-cookie-consent-banner'></div></div>";
          });
          
          add_shortcode('cookie-consent-modifier', function() {
              print "<span id='cookie-consent-modifier'></span>";
          });
      }
  }

  public function  my_acf_json_load_point( $paths ) {
      $paths[] = COOKIE_CONSENT_DIR . 'public/acf-json';
      return $paths;    
  }

  protected function addCookieConsentPage() {
      $parent = acf_add_options_page(array(
          'page_title' 	=> 'Cookie Consent Settings',
          'menu_title'	=> 'Cookie Consent',
          'menu_slug' 	=> 'cookie-consent-settings-parent',
          'capability'	=> 'edit_posts',
          'redirect'		=> true
      ));
      
      acf_add_options_page(array(
          'page_title' 	=> 'Cookie Consent - Cookies',
          'menu_title'	=> 'Cookies',
          'menu_slug' 	=> 'cookie-consent-settings',
          'capability'	=> 'edit_posts',
          'redirect'		=> false,
          "parent_slug"   => $parent['menu_slug'],
      ));
      
      acf_add_options_page(array(
          'page_title' 	=> 'Cookie Consent - Styles',
          'menu_title'	=> 'Styles',
          'menu_slug' 	=> 'cookie-consent-style',
          'capability'	=> 'edit_posts',
          'redirect'		=> false,
          "parent_slug"   => $parent['menu_slug'],
      ));
}

  protected function addRoute() {
      \Routes::map("/cookie-consent-data", function($args) {
          
          if (isset($_GET["locale"])) {
              $this->currentLanguage = $_GET["locale"];
              $currentLanguage = \PLL()->curlang;
              $currentLanguage->locale = $_GET["locale"];
          }
          $this->prepareContent();
          wp_send_json($this->content);
          die;
      });
  }
  
  public function writeCssVars() {

      add_action('acf/save_post', function ( ) {
          $screen = get_current_screen();
          if ($screen->id == "cookie-consent_page_cookie-consent-style") {
              ob_start();
                  include_once ((COOKIE_CONSENT_DIR . "/views/vars.php"));
                  $vars = ob_get_contents();
              ob_end_clean();
            //   var_dump($vars);
            //   die();
              file_put_contents(COOKIE_CONSENT_DIR . "/public/css/vars.css", $vars);
          }
      });

  }

  public function getFunctions() {
      $this->functions = [];
      foreach ($this->content["cookies"] as $key => $value) {
          $functions[$key] = $value["rawFn"];
      }

      return $functions;
  }

  protected function prepareContent() {
      $cookieConsent = get_field("cookie_consent", "option");
      $cookies = [];
      if (is_null($cookieConsent)) return [];
      foreach ($cookieConsent["cookies"] as $cookie) {
          $name = StringTransformator::makeUrlFriendly($cookie['title']);
          $cookie["name"] = $name;
          $cookie["rawFn"] = $cookie["function"];
          // $cookie["function"] = $name;
          $cookies[$name] = $cookie;
      }

      $content = [
          "locale" => $this->currentLanguage,
          "content" => $cookieConsent["content"],
          "labels" => $cookieConsent["labels"],
          "cookies" => $cookies,
      ];

      $this->content = $content;
  }

}