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
       $name = strip_tags(trim($_POST["emaildata"]['userfirstname']));
       $name = str_replace(array("\r","\n"),array(" "," "),$name);
       $userlastname = strip_tags(trim($_POST["emaildata"]['userlastname']));
       $userlastname = str_replace(array("\r","\n"),array(" "," "),$userlastname);
       $name .= " ".$userlastname;
       $email = filter_var(trim( $_POST["emaildata"]['useremail'] ), FILTER_SANITIZE_EMAIL);
       $message = trim( $_POST["emaildata"]['usermessage']);


      // Check that data was sent to the mailer.
      if ( empty($name) OR empty($message) OR !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Set a 400 (bad request) response code and exit.
        http_response_code(400);
        echo __('Oops! Something went wrong, please try again later', 'custom-widgets');
        exit;
      }

      // Set the recipient email address.
      $recipient = $_POST["emaildata"]['sendto'];
      // Set the email subject.
      $subject = "Fomulario: ".$_POST["emaildata"]['eventtopic'];

      // Build the email content.
      $email_content = "Name: $name\n";
      $email_content .= "Email: $email\n\n";
      $email_content .= "Message:\n$message\n\n";
      $email_content .= "Mesasge info: \n eventurl: ".$_POST["emaildata"]['eventurl']."\n eventtopic: ".$_POST["emaildata"]['eventtopic'];
      $resultado = wp_mail( $recipient, $subject ,$email_content);
      if(!$resultado){
        http_response_code(400);
        echo __('Oops! Something went wrong, please try again later', 'custom-widgets');
      }

      exit();
    }
  }
}
add_action( 'init', 'init_cta_form_send_form' );
