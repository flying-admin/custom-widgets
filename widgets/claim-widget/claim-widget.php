<?php

/*
Widget Name: Claim Widget
Description: Claim module'
Author: Flying Pigs
Author URI: http://flyingpigs.es
*/

class Claim_Widget extends SiteOrigin_Widget {
  function __construct() {
    //Here you can do any preparation required before calling the parent constructor, such as including additional files or initializing variables.

    //Call the parent constructor with the required arguments.
    parent::__construct (
      // The unique id for your widget.
      'claim-widget',

      // The name of the widget for display purposes.
      __('Claim Widget', 'claim-widget'),

      // The $widget_options array, which is passed through to WP_Widget.
      // It has a couple of extras like the optional help URL, which should link to your sites help or support page.
      array(
        'description' => __('Claim Widget.', 'claim-widget')
      ),

      //The $control_options array, which is passed through to WP_Widget
      array(

      ),

      //The $form_options array, which describes the form fields used to configure SiteOrigin widgets. We'll explain these in more detail later.
      array(
        'image_url' => array(
          'type' => 'media',
          'label' => __('Image file', 'flyingpigs-custom-widgets'),
          'library' => 'image',
          'fallback' => true,
        ),
        'title' => array(
          'type' => 'text',
          'label' => __('Title', 'flyingpigs-custom-widgets'),
          'default' => ''
        ),
        'show_text' => array(
          'type' => 'checkbox',
          'default' => true,
          'label' => __('Show text', 'flyingpigs-custom-widgets'),
        ),
        'text' => array(
          'type' => 'text',
          'label' => __('Text', 'flyingpigs-custom-widgets'),
          'default' => ''
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
          'claim-widget',
          plugin_dir_url( __FILE__ ) . 'js/claim-widget-scripts.js',
          array( 'jquery' ),
          '1.0'
        )
      )
    );
  }

  function get_template_variables($instance) {
    $vars = [];
    $vars['title'] = $instance['title'];
    $vars['text'] = $instance['text'];
    $vars['show_text'] = $instance['show_text'];
    $vars['image_url'] = '';

    $image = wp_get_attachment_image_src($instance['image_url'], 'full', false);
    if($image) {
      $vars['image_url'] = $image[0];
    }
    else {
      $vars['image_url'] = $instance['image_url_fallback'];
    }

    return $vars;
  }

  function get_template_name($instance) {
    return 'claim-widget-template';
  }

  function get_style_name($instance) {
    return 'claim-widget-style';
  }
}
siteorigin_widget_register('claim-widget', __FILE__, 'Claim_Widget');
