<?php

/*
Widget Name: Introduction - Imagen Vertical
Description: Introduction module with vertical image
Author: Flying Pigs
Author URI: http://flyingpigs.es
*/

class Introduction_Vertical_Widget extends SiteOrigin_Widget {
  function __construct() {
    //Here you can do any preparation required before calling the parent constructor, such as including additional files or initializing variables.

    //Call the parent constructor with the required arguments.
    parent::__construct (
      // The unique id for your widget.
      'introduction-vertical-widget',

      // The name of the widget for display purposes.
      'Introduction vertical image',

      // The $widget_options array, which is passed through to WP_Widget.
      // It has a couple of extras like the optional help URL, which should link to your sites help or support page.
      array(
        'description' => 'Introduction con imagen vertical - Modulo de introduccion'
      ),

      //The $control_options array, which is passed through to WP_Widget
      array(

      ),

      //The $form_options array, which describes the form fields used to configure SiteOrigin widgets.
      array(
        'section_main' => array(
          'type' => 'section',
          'label' => 'Contenido del módulo:',
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
            'rich_text' => array(
              'type' => 'tinymce',
              'label' => 'Contenido',
              'default' => '',
              'rows' => 10,
              'optional' => true
            ),
            'image_url' => array(
              'type' => 'media',
              'label' => 'Imagen',
              'library' => 'image',
              'fallback' => true,
              'required' => true,
            ),
            'add_link' => array(
              'type'  => 'radio',
              'label' => 'Añadir enlace agrupador',
              'options' => array(
                'none' => 'No',
                'yes' => 'Sí',
              ),
              'default' => 'none',
              'state_emitter' => array(
                'callback' => 'select',
                'args' => array( 'add_link' )
              ),
            ),
            'link_text' => array(
              'type' => 'text',
              'label' => 'Texto del link',
              'default' => '',
              'optional' => true,
              'state_handler' => array(
                'add_link[none]' => array('hide'),
                'add_link[yes]' => array('show')
              )
            ),
            'link_url' => array(
              'type' => 'link',
              'label' => 'Url del link',
              'default' => '',
              'optional' => true,
              'sanitize' => 'url',
              'state_handler' => array(
                'add_link[none]' => array('hide'),
                'add_link[yes]' => array('show')
              )
            ),
            'link_blank' => array(
              'type' => 'checkbox',
              'default' => false,
              'label' => 'Abrir enlace en pestaña nueva',
              'state_handler' => array(
                'add_link[none]' => array('hide'),
                'add_link[yes]' => array('show')
              ),
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
          'introduction-vertical-widget',
          plugin_dir_url( __FILE__ ) . 'js/introduction-vertical-widget-scripts.js',
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
    $vars['rich_text'] = $instance['section_main']['rich_text'];

   
    $vars['link'] = false;
    if( $instance['section_main']['add_link'] == 'yes' ){
      $vars['link'] = true;
      $vars['link_text'] = $instance['section_main']['link_text'];
      $vars['link_url'] = $instance['section_main']['link_url'];
      $vars['link_blank'] = $instance['section_main']['link_blank'];
    }

    $vars['image_url' ] =  $this->getImage( $instance['section_main']['image_url'], $instance['section_main']['image_url_fallback']);
        
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
    return 'introduction-vertical-widget-template';
  }

  function get_style_name($instance) {
    return 'introduction-vertical-widget-style';

  }
}
siteorigin_widget_register('introduction-vertical-widget', __FILE__, 'Introduction_Vertical_Widget');
