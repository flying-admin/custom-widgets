<?php

/*
Widget Name: Mapa
Description: Mapa module
Author: Flying Pigs
Author URI: http://flyingpigs.es
*/

class Map_Widget extends SiteOrigin_Widget {
  function __construct() {
    //Here you can do any preparation required before calling the parent constructor, such as including additional files or initializing variables.

    //Call the parent constructor with the required arguments.
    parent::__construct (
      // The unique id for your widget.
      'map-widget',

      // The name of the widget for display purposes.
      'Mapa',

      // The $widget_options array, which is passed through to WP_Widget.
      // It has a couple of extras like the optional help URL, which should link to your sites help or support page.
      array(
        'description' => 'Mapa - Módulo de contenido',
        'panels_groups' => array('fp-widgets'),
        'panels_icon' => 'dashicons dashicons-admin-page'
      ),

      //The $control_options array, which is passed through to WP_Widget
      array(

      ),

      //The $form_options array, which describes the form fields used to configure SiteOrigin widgets.
      array(
        'section_map' => array(
          'type' => 'section',
          'label' => 'Parámetros del mapa:',
          'hide' => false,
          'fields' => array(
            'map_title' => array(
              'type' => 'text',
              'label' => 'Título',
              'default' => '',
              'required' => true
            ),
            'map_text' => array(
              'type' => 'text',
              'label' => 'Entradilla',
              'default' => '',
              'optional' => true
            ),
            'map_segmentation' => array(
              'type' => 'checkbox',
              'default' => true,
              'label' => 'Añadir tabs por continente',
            )
          )
        ),
        'section_markers' => array(
          'type' => 'section',
          'label' => 'Marcadores del mapa:',
          'hide' => false,
          'fields' => array(
            'markers' => array(
              'type' => 'repeater',
              'label' => 'Marcadores',
              'item_name'  => 'Marcador',
              'item_label' => array(
                'selector'     => "[id*='marker_title']",
                'update_event' => 'change',
                'value_method' => 'val'
              ),
              'fields' => array(
                'marker_title' => array(
                  'type' => 'text',
                  'label' => 'Título',
                  'default' => '',
                  'required' => true
                ),
                'marker_text' => array(
                  'type' => 'textarea',
                  'label' => 'Entradilla',
                  'default' => '',
                  'required' => true,
                  'rows' => 5
                ),
                'marker_continent' => array(
                  'type' => 'select',
                  'label' => 'Continente',
                  'default' => 'europe',
                  'options' => array(
                    'europe' => 'Europe',
                    'africa' => 'Middle East & Africa',
                    'asia' => 'Asia Pacific',
                    'latin' => 'Latin America',
                    'america' => 'USA & Canada'
                  )
                ),
                'marker_lat' => array(
                  'type' => 'number',
                  'label' => 'Latitud',
                  'default' => '0.0',
                  'required' => true
                ),
                'marker_lng' => array(
                  'type' => 'number',
                  'label' => 'Longitud',
                  'default' => '0.0',
                  'required' => true
                ),

                'marker_image' => array(
                  'type' => 'media',
                  'label' => 'Imagen',
                  'library' => 'image',
                  'fallback' => true,
                  'optional' => true
                ),
                'marker_phone' => array(
                  'type' => 'text',
                  'label' => 'Teléfono',
                  'default' => '',
                  'optional' => true
                ),
                'marker_email' => array(
                  'type' => 'text',
                  'label' => 'Correo electrónico',
                  'default' => '',
                  'optional' => true
                ),
                'marker_address' => array(
                  'type' => 'text',
                  'label' => 'Dirección',
                  'default' => '',
                  'optional' => true
                ),

                'marker_cta' => array(
                  'type' => 'checkbox',
                  'default' => false,
                  'label' => 'Añadir CTA',
                  'state_emitter' => array(
                    'callback' => 'conditional',
                    'args' => array(
                      'marker_cta[on]: val == true',
                      'marker_cta[off]: val == false'
                    )
                  )
                ),
                'marker_cta_style' => array(
                  'type'  => 'radio',
                  'label' => 'Estilo del CTA',
                  'options' => array(
                    'button' => 'Botón',
                    'link' => 'Enlace',
                  ),
                  'default' => 'button',
                  'state_handler' => array(
                    'marker_cta[on]' => array('show'),
                    '_else[marker_cta]' => array('hide')
                  )
                ),
                'marker_cta_text' => array(
                  'type' => 'text',
                  'label' => 'Texto del CTA',
                  'default' => '',
                  'required' => true,
                  'state_handler' => array(
                    'marker_cta[on]' => array('show'),
                    '_else[marker_cta]' => array('hide')
                  )
                ),
                'marker_cta_url' => array(
                  'type' => 'link',
                  'label' => 'Url del CTA',
                  'default' => '',
                  'required' => true,
                  'state_handler' => array(
                    'marker_cta[on]' => array('show'),
                    '_else[marker_cta]' => array('hide')
                  )
                ),
                'new_window' => array(
                  'type' => 'checkbox',
                  'default' => false,
                  'label' => 'Abrir CTA en pestaña nueva',
                  'state_handler' => array(
                    'marker_cta[on]' => array('show'),
                    '_else[marker_cta]' => array('hide')
                  )
                )
              )
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
          'map-widget-clusterer',
          plugin_dir_url( __FILE__ ) . 'js/map-marker-clusterer.js',
          array(),
          '1.0'
        ),
        array(
          'map-widget-script',
          plugin_dir_url( __FILE__ ) . 'js/map-widget-scripts.js',
          array( 'jquery' ),
          '1.0'
        )
      )
    );
  }

  function get_template_variables($instance) {
    $vars = [];
    $vars['map_title'] = $instance['section_map']['map_title'];
    $vars['map_text'] = $instance['section_map']['map_text'];
    $vars['map_segmentation'] = $instance['section_map']['map_segmentation'];

    $vars['markers'] = $instance['section_markers']['markers'];
    $vars['regions'] = [];
    for ($i = 0; $i < count($vars['markers']); $i++){
      $vars['markers'][$i]['marker_image'] = $this->getMedia($vars['markers'][$i]['marker_image'], $vars['markers'][$i]['marker_image_fallback']);
      if (!in_array($vars['markers'][$i]['marker_continent'], $vars['regions'])){
        $vars['regions'][$vars['markers'][$i]['marker_continent']] = $vars['markers'][$i]['marker_continent'];
      }
    }

    return $vars;
  }

  function getMedia( $media , $fallback = false ){
    $media = wp_get_attachment_url( $media );

    if( $media ) {
      return $media;
    } else {
      return $fallback;
    }
  }

  function get_template_name($instance) {
    return 'map-widget-template';
  }

  function get_style_name($instance) {
    return 'map-widget-style';
  }
}
siteorigin_widget_register('map-widget', __FILE__, 'Map_Widget');
