<?php

/*
Widget Name: Distribuidor Destacado
Description: Distribuidor Destacado module
Author: Flying Pigs
Author URI: http://flyingpigs.es
*/

class Featured_Distributor_Widget extends SiteOrigin_Widget {
  function __construct() {
    //Here you can do any preparation required before calling the parent constructor, such as including additional files or initializing variables.

    //Call the parent constructor with the required arguments.
    parent::__construct (
      // The unique id for your widget.
      'featured-distributor-widget',

      // The name of the widget for display purposes.
      'Distribuidor Destacado',

      // The $widget_options array, which is passed through to WP_Widget.
      // It has a couple of extras like the optional help URL, which should link to your sites help or support page.
      array(
        'description' => 'Distribuidor Destacado - Módulo de contenido'
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
            'distributor_type' => array(
              'type'  => 'radio',
              'label' => 'Tipo de distribuidor',
              'options' => array(
                'normal' => 'Normal',
                'phrase' => 'Con frase destacada',
                'cypher' => 'Con cifra destacada'
              ),
              'default' => 'normal',
              'state_emitter' => array(
                'callback' => 'select',
                'args' => array( 'distributor_type' )
              ),
            )
          )
        ),
        'section_common' => array(
          'type' => 'section',
          'label' => 'Contenido del módulo:',
          'hide' => false,
          'fields' => array(
            'main' => array(
              'type' => 'text',
              'label' => 'Titulo',
              'default' => '',
              'optional' => true
            ),
            'desc' => array(
              'type' => 'text',
              'label' => 'Descripción',
              'default' => '',
              'optional' => true
            ),
            'url' => array(
              'type' => 'link',
              'label' => 'Url del enlace',
              'default' => '',
              'optional' => true
            ),
            'new_window' => array(
              'type' => 'checkbox',
              'default' => false,
              'label' => 'Abrir enlace en pestaña nueva',
            )
          )
        ),
        'section_phrase' => array(
          'type' => 'section',
          'label' => 'Frase destacada:',
          'hide' => false,
          'fields' => array(
            'phrase_main' => array(
              'type' => 'text',
              'label' => 'Frase destacada',
              'default' => '',
              'required' => true
            ),
            'phrase_desc' => array(
              'type' => 'text',
              'label' => 'Texto descriptivo',
              'default' => '',
              'required' => true
            )
          ),
          'state_handler' => array(
        		'distributor_type[normal]' => array('hide'),
        		'distributor_type[phrase]' => array('show'),
        		'distributor_type[cypher]' => array('hide')
        	)
        ),
        'section_cypher' => array(
          'type' => 'section',
          'label' => 'Cifra destacada:',
          'hide' => false,
          'fields' => array(
            'cypher_number' => array(
              'type' => 'number',
              'label' => 'Cifra destacada',
              'default' => '',
              'required' => true
            ),
            'cypher_ordinal' => array(
              'type' => 'text',
              'label' => 'Ordinal para cifra destacada',
              'default' => '',
              'optional' => true
            ),
            'cypher_desc' => array(
              'type' => 'text',
              'label' => 'Texto descriptivo',
              'default' => '',
              'required' => true
            )
          ),
          'state_handler' => array(
            'distributor_type[normal]' => array('hide'),
            'distributor_type[phrase]' => array('hide'),
            'distributor_type[cypher]' => array('show')
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
          'featured-distributor-widget',
          plugin_dir_url( __FILE__ ) . 'js/featured-distributor-widget-scripts.js',
          array( 'jquery' ),
          '1.0'
        )
      )
    );
  }

  function get_template_variables($instance) {
    $vars = [];
    $vars['type'] = $instance['section_feats']['distributor_type'];
    $vars['main'] = $instance['section_common']['main'];
    $vars['desc'] = $instance['section_common']['desc'];
    $vars['url'] = sow_esc_url( $instance['section_common']['url'] );
    $vars['new_window'] = $instance['section_common']['new_window'];

    $vars['phrase_main'] = $instance['section_phrase']['phrase_main'];
    $vars['phrase_desc'] = $instance['section_phrase']['phrase_desc'];

    $vars['cypher_number'] = $instance['section_cypher']['cypher_number'];
    $vars['cypher_ordinal'] = $instance['section_cypher']['cypher_ordinal'];
    $vars['cypher_desc'] = $instance['section_cypher']['cypher_desc'];

    return $vars;
  }

  function get_template_name($instance) {
    return 'featured-distributor-widget-template';
  }

  function get_style_name($instance) {
    return 'featured-distributor-widget-style';
  }
}
siteorigin_widget_register('featured-distributor-widget', __FILE__, 'Featured_Distributor_Widget');
