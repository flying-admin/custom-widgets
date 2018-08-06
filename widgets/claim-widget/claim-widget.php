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
        'veil' => array(
          'type' => 'checkbox',
          'default' => true,
          'label' => __('Include veil', 'flyingpigs-custom-widgets'),
        ),
        'claim' => array(
          'type' => 'text',
          'label' => __('Claim', 'flyingpigs-custom-widgets'),
          'default' => ''
        ),
        'text' => array(
          'type' => 'text',
          'label' => __('Text', 'flyingpigs-custom-widgets'),
          'default' => ''
        ),
        'cta_text' => array(
          'type' => 'text',
          'label' => __('CTA Text', 'flyingpigs-custom-widgets'),
          'default' => ''
        ),
        'cta_url' => array(
          'type' => 'text',
          'label' => __('CTA Url', 'flyingpigs-custom-widgets'),
          'default' => ''
        ),
        'new_window' => array(
          'type' => 'checkbox',
          'default' => false,
          'label' => __('Open CTA in new window', 'flyingpigs-custom-widgets'),
        )
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
    $vars['veil'] = $instance['veil'];
    $vars['claim'] = $instance['claim'];
    $vars['text'] = $instance['text'];
    $vars['cta_text'] = $instance['cta_text'];
    $vars['cta_url'] = $instance['cta_url'];
    $vars['new_window'] = $instance['new_window'];
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
