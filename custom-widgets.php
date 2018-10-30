<?php

/*
 * Plugin Name: Custom Widgets for SiteOrigin
 * Description: Custom Widgets for SiteOrigin Widgets Bundle
 * Version: 1.0
 * Author: Flying Pigs
 * Author URI: http://flyingpigs.es
 * Text Domain: custom-widgets
 * Domain Path: /languages
 */

// Load all modules inside widgets folder
function custom_widgets ($folders){
  $folders[] = plugin_dir_path(__FILE__) . 'widgets/';

  return $folders;
}
add_filter( 'siteorigin_widgets_widget_folders', 'custom_widgets' );

function additional_customizer_settings( $wp_customize ) {

  $section = $wp_customize->get_section( 'fpie_theme' );
  if (!$section){
    $wp_customize->add_section(
      'fpie_theme',
      array(
        'title' => 'Ajustes del tema',
        'priority' => 1
      )
    );
  }

  $wp_customize->add_setting(
    'maps_api_key',
    array(
      'default' => '',
      'type' => 'option',
      'capability' => 'edit_theme_options'
    )
  );
  $wp_customize->add_control(
    'maps_api_key',
    array(
      'type' => 'text',
      'label' => 'API Key de Google Maps',
      'description' => '',
      'section' => 'fpie_theme'
    )
  );

}
add_action( 'customize_register', 'additional_customizer_settings' );

// Adding visibility options
function custom_widgets_visibility_field( $fields ) {
  $fields['custom_widgets_visibility'] = array(
      'name'        => 'Ocultar bloque de la web',
      'type'        => 'checkbox',
      'group'       => 'attributes',
      'default'     => false,
      'label'       => 'Ocultar bloque',
      'description' => 'Marque esta casilla para ocultar este bloque de forma temporal.',
      'priority'    => 20,
  );

  return $fields;
}
add_filter( 'siteorigin_panels_row_style_fields', 'custom_widgets_visibility_field' );
add_filter( 'siteorigin_panels_widget_style_fields', 'custom_widgets_visibility_field' );

// Adding visibility classes
function custom_widgets_visibility_attribute( $attributes, $args ) {
  if( !empty( $args['custom_widgets_visibility'] ) && ( $args['custom_widgets_visibility'] !== false ) ) {
    array_push( $attributes['class'], 'hide-widget' );
  }

  return $attributes;
}
add_filter( 'siteorigin_panels_row_style_attributes', 'custom_widgets_visibility_attribute', 10, 2);
add_filter( 'siteorigin_panels_widget_style_attributes', 'custom_widgets_visibility_attribute', 10, 2);

// Load default styles
function custom_widgets_styles() {
  wp_enqueue_style( 'custom-widgets-styles', plugin_dir_url(__FILE__) . '/css/default.css', array(), '1.0' );
  // wp_register_style( 'custom-widgets-styles', plugin_dir_url(__FILE__) . '/css/default.css', array(), '1.0' );
}
add_action( 'wp_enqueue_scripts', 'custom_widgets_styles' );

// Load translation files inside languages folder
function custom_widgets_load_textdomain() {
  $plugin_dir = dirname( plugin_basename( __FILE__ ) ) . '/languages';
  $res = load_plugin_textdomain( 'custom-widgets', false, $plugin_dir );
}
add_action( 'plugins_loaded', 'custom_widgets_load_textdomain' );

// Add widgets group
function custom_widgets_add_widget_tabs($tabs) {
  $tabs[] = array(
    'title' => 'Widgets de Flying Pigs',
    'filter' => array(
      'groups' => array('fp-widgets')
    )
  );

  return $tabs;
}
add_filter('siteorigin_panels_widget_dialog_tabs', 'custom_widgets_add_widget_tabs', 0);

// CTA Form Handler
function init_cta_form_send_form (){
  if ( $_SERVER["REQUEST_METHOD"] == "POST" && isset($_REQUEST["action"]) ) {
    if ($_REQUEST["action"] == "ie_exec_cta_formulario"){

      // Get the form fields and remove whitespace.
      if(isset($_POST["emaildata"]['userfirstname'])) {
        $name = strip_tags(trim($_POST["emaildata"]['userfirstname']));
        $name = str_replace(array("\r","\n"),array(" "," "),$name);
      }
      else {
        $name = '';
      }

      if(isset($_POST["emaildata"]['userlastname'])) {
        $lastname = strip_tags(trim($_POST["emaildata"]['userlastname']));
        $lastname = str_replace(array("\r","\n"),array(" "," "),$lastname);
      }
      else {
        $lastname = '';
      }

      $name .= " ".$lastname;

      if(isset($_POST["emaildata"]['usermessage'])) {
        $message = trim($_POST["emaildata"]['usermessage']);
      }
      else {
        $message = '';
      }

      if(isset($_POST["emaildata"]['useremail'])) {
        $email = filter_var(trim( $_POST["emaildata"]['useremail'] ), FILTER_SANITIZE_EMAIL);
      }
      else {
        $email = '';
      }

      // Set the recipient email address.
      $recipients = $_POST["emaildata"]['sendto'];

      var_dump($recipients);
      echo('<br />');

      $recipients = fp_ctaf_decript($recipients);

      var_dump($recipients);
      echo('<br />');

      // Set the email subject.
      $subject = "New form from".' '.get_option('blogname').": ".$_POST["emaildata"]['eventtopic'];

      // Build the email content.
      $email_content = __('First name','custom-widgets').": $name\n";
      $email_content .= __("Email","custom-widgets").": $email\n";
      $email_content .= __("Message","custom-widgets").": \n$message\n";
      $email_content .= "\n\n\n\n\n".get_option('blogname')." (".home_url().")";

      $resultado = wp_mail($recipients, $subject ,$email_content);
      if(!$resultado){
        http_response_code(400);
        echo __('Oops! Something went wrong, please try again later', 'custom-widgets');
      }

      exit();
    }
  }
}
add_action( 'init', 'init_cta_form_send_form' );

function fp_ctaf_encript($string){
	$key = fp_ctaf_get_key();
  $cypher = fp_ctaf_get_cypher();
	$result = '';

  $result = openssl_encrypt($string, $cypher, $key);
  return $result;
}

function fp_ctaf_decript($string){
	$key = fp_ctaf_get_key();
  $cypher = fp_ctaf_get_cypher();
	$result = '';

  $result = openssl_decrypt($string, $cypher, $key);
  return $result;
}

function fp_ctaf_get_key(){
  return 'Flying2017';
	//return 'ndfdajkhaSDmdsfkjhsSUVYw7w04876$vspzxcñlkjnbasdf';
}

function fp_ctaf_get_cypher(){
  return 'AES256';
	//return 'AES-256-CBC';
}
