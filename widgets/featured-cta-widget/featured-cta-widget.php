<?php

/*
Widget Name: Featured CTA Widget
Description: Featured CTA module
Author: Flying Pigs
Author URI: http://flyingpigs.es
*/

class Featured_Cta_Widget extends SiteOrigin_Widget {
  function __construct() {
    //Here you can do any preparation required before calling the parent constructor, such as including additional files or initializing variables.

    //Call the parent constructor with the required arguments.
    parent::__construct (
      // The unique id for your widget.
      'featured-cta-widget',

      // The name of the widget for display purposes.
      __('Featured Cta Widget', 'featured-cta-widget'),

      // The $widget_options array, which is passed through to WP_Widget.
      // It has a couple of extras like the optional help URL, which should link to your sites help or support page.
      array(
        'description' => __('Featured Cta Widget.', 'featured-cta-widget')
      ),

      //The $control_options array, which is passed through to WP_Widget
      array(

      ),

      //The $form_options array, which describes the form fields used to configure SiteOrigin widgets.
      array(
        'section_feats' => array(
          'type' => 'section',
          'label' => 'Icono y color del módulo:',
          'hide' => false,
          'fields' => array(
            'icon' => array(
              'type' => 'icon',
              'label' => 'Icono',
              'optional' => true
            ),
            'background' => array(
              'type'  => 'select',
              'label' => 'Color de fondo',
              'options' => array(
                'white' => 'Color blanco',
                'color' => 'Color destacado'
              ),
              'default' => 'color',
            ),
          )
        ),
        'section_text' => array(
          'type' => 'section',
          'label' => 'Textos del módulo:',
          'hide' => false,
          'fields' => array(
            'main' => array(
              'type' => 'text',
              'label' => 'Texto principal',
              'default' => '',
              'required' => true
            ),
            'text' => array(
              'type' => 'text',
              'label' => 'Descripción',
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
              'required' => true
            ),
            'cta_url' => array(
              'type' => 'text',
              'label' => 'Url del CTA',
              'default' => '',
              'required' => true
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
          'featured-cta-widget',
          plugin_dir_url( __FILE__ ) . 'js/featured-cta-widget-scripts.js',
          array( 'jquery' ),
          '1.0'
        )
      )
    );
  }

  function get_template_variables($instance) {
    $vars = [];
    $vars['icon'] = $instance['section_feats']['icon'];
    $vars['background'] = $instance['section_feats']['background'];
    $vars['main'] = $instance['section_text']['main'];
    $vars['text'] = $instance['section_text']['text'];
    $vars['cta_text'] = $instance['section_cta']['cta_text'];
    $vars['cta_url'] = $instance['section_cta']['cta_url'];
    $vars['new_window'] = $instance['section_cta']['new_window'];

    return $vars;
  }

  function get_template_name($instance) {
    return 'featured-cta-widget-template';
  }

  function get_style_name($instance) {
    return 'featured-cta-widget-style';
  }
}
siteorigin_widget_register('featured-cta-widget', __FILE__, 'Featured_Cta_Widget');
