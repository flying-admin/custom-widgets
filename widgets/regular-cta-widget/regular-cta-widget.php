<?php

/*
Widget Name: CTA Normal
Description: CTA Normal module
Author: Flying Pigs
Author URI: http://flyingpigs.es
*/

class Regular_Cta_Widget extends SiteOrigin_Widget {
  function __construct() {
    //Here you can do any preparation required before calling the parent constructor, such as including additional files or initializing variables.

    //Call the parent constructor with the required arguments.
    parent::__construct (
      // The unique id for your widget.
      'regular-cta-widget',

      // The name of the widget for display purposes.
      'CTA Normal',

      // The $widget_options array, which is passed through to WP_Widget.
      // It has a couple of extras like the optional help URL, which should link to your sites help or support page.
      array(
        'description' => 'CTA Normal - Módulo de contenido',
      ),

      //The $control_options array, which is passed through to WP_Widget
      array(

      ),

      //The $form_options array, which describes the form fields used to configure SiteOrigin widgets.
      array(
        'section_feats' => array(
          'type' => 'section',
          'label' => 'Parámetros del módulo:',
          'hide' => false,
          'fields' => array(
            'background' => array(
              'type'  => 'radio',
              'label' => 'Color de fondo',
              'options' => array(
                'color' => 'Color destacado',
                'white' => 'Color blanco'
              ),
              'default' => 'color',
            ),
            'bordered' => array(
              'type' => 'checkbox',
              'default' => true,
              'label' => 'Módulo con bordes',
            )
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
              'type' => 'link',
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
          'regular-cta-widget',
          plugin_dir_url( __FILE__ ) . 'js/regular-cta-widget-scripts.js',
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
    $vars['bordered'] = $instance['section_feats']['bordered'];
    $vars['main'] = $instance['section_text']['main'];
    $vars['desc'] = $instance['section_text']['desc'];
    $vars['cta_text'] = $instance['section_cta']['cta_text'];
    $vars['cta_url'] = sow_esc_url( $instance['section_cta']['cta_url'] );
    $vars['new_window'] = $instance['section_cta']['new_window'];

    return $vars;
  }

  function get_template_name($instance) {
    return 'regular-cta-widget-template';
  }

  function get_style_name($instance) {
    return 'regular-cta-widget-style';
  }
}
siteorigin_widget_register('regular-cta-widget', __FILE__, 'Regular_Cta_Widget');
