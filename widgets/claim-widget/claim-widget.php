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
        'section_img' => array(
          'type' => 'section',
          'label' => 'Imagen de Claim:',
          'hide' => false,
          'fields' => array(
            'image_url' => array(
              'type' => 'media',
              'label' => 'Imagen',
              'library' => 'image',
              'fallback' => true,
              'required' => true
            ),
            'veil' => array(
              'type' => 'checkbox',
              'default' => true,
              'label' => 'Incluir velo',
            )
          )
        ),
        'section_text' => array(
          'type' => 'section',
          'label' => 'Textos del Claim:',
          'hide' => false,
          'fields' => array(
            'claim' => array(
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
            )
          )
        ),
        'section_cta' => array(
          'type' => 'section',
          'label' => 'Call To Action (CTA):',
          'hide' => false,
          'fields' => array(
            'cta_text' => array(
              'type' => 'text',
              'label' => 'Texto del CTA',
              'default' => '',
              'optional' => true
            ),
            'cta_url' => array(
              'type' => 'text',
              'label' => 'Url del CTA',
              'default' => '',
              'optional' => true
            ),
            'new_window' => array(
              'type' => 'checkbox',
              'default' => false,
              'label' => 'Abrir CTA en pestaña nueva',
            )
          )
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
    $vars['veil'] = $instance['section_img']['veil'];
    $vars['claim'] = $instance['section_text']['claim'];
    $vars['text'] = $instance['section_text']['text'];
    $vars['cta_text'] = $instance['section_cta']['cta_text'];
    $vars['cta_url'] = $instance['section_cta']['cta_url'];
    $vars['new_window'] = $instance['section_cta']['new_window'];
    $vars['image_url'] = '';

    $image = wp_get_attachment_image_src($instance['section_img']['image_url'], 'full', false);
    if($image) {
      $vars['image_url'] = $image[0];
    }
    else {
      $vars['image_url'] = $instance['section_img']['image_url_fallback'];
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
