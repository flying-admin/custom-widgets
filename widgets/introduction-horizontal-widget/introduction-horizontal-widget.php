<?php

/*
Widget Name: Introducción - Imagen horizontal
Description: Introduction module
Author: Flying Pigs
Author URI: http://flyingpigs.es
*/

class Introduction_Horizontal_Widget extends SiteOrigin_Widget {
  function __construct() {
    //Here you can do any preparation required before calling the parent constructor, such as including additional files or initializing variables.

    //Call the parent constructor with the required arguments.
    parent::__construct (
      // The unique id for your widget.
      'introduction-horizontal-widget',

      // The name of the widget for display purposes.
      'Introduction Imagen Horizontal',

      // The $widget_options array, which is passed through to WP_Widget.
      // It has a couple of extras like the optional help URL, which should link to your sites help or support page.
      array(
        'description' => 'Permite crear un contenido breve a modo de introducción con una imagen horizontal complementaria.'
      ),

      //The $control_options array, which is passed through to WP_Widget
      array(

      ),

      //The $form_options array, which describes the form fields used to configure SiteOrigin widgets.
      array(
        'section_main' => array(
          'type' => 'section',
          'label' => 'Textos del módulo:',
          'hide' => false,
          'fields' => array(
            'title' => array(
              'type' => 'text',
              'label' => 'Texto principal',
              'default' => '',
              'required' => true
            ),
            'text' => array(
              'type' => 'text',
              'label' => 'Entradilla',
              'default' => '',
              'optional' => true
            ),
            'image_url' => array(
              'type' => 'media',
              'label' => 'Imagen',
              'library' => 'image',
              'fallback' => true,
              'required' => true
            ),
          ),
        ),
      ),

      //The $base_folder path string.
      plugin_dir_path(__FILE__)
    );
  }

  function initialize() {
    $this->register_frontend_scripts(
      array(
        array(
          'introduction-horizontal-widget',
          plugin_dir_url( __FILE__ ) . 'js/introduction-horizontal-widget-scripts.js',
          array( 'jquery' ),
          '1.0'
        )
      )
    );
  }

  function get_template_variables($instance) {

    $vars = [];

    $vars['title'] = $instance['section_main']['title'];
    $vars['text'] = $instance['section_main']['text'];
    $vars['image_url'] =  $this->getImage($instance['section_main']['image_url'], $instance['section_main']['image_url_fallback']);
    
    return $vars;
  }

  function getImage( $image , $fallback = false ){
    $img = wp_get_attachment_image_src( $image , 'full', false );
    if( $img ) {
      return $img[0];
    }else {
      return $fallback;
    }
  }

  function get_template_name($instance) {
    return 'introduction-horizontal-widget-template';
  }

  function get_style_name($instance) {
    return 'introduction-horizontal-widget-style';

  }
}
siteorigin_widget_register('introduction-horizontal-widget', __FILE__, 'Introduction_Horizontal_Widget');
