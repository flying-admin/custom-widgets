<?php

/*
Widget Name: Distribuidor de Iconos y Texto
Description: Distribuidor de Iconos y Texto module
Author: Flying Pigs
Author URI: http://flyingpigs.es
*/

class Icon_Distributor_Widget extends SiteOrigin_Widget {
  function __construct() {
    //Here you can do any preparation required before calling the parent constructor, such as including additional files or initializing variables.

    //Call the parent constructor with the required arguments.
    parent::__construct (
      // The unique id for your widget.
      'icon-distributor-widget',

      // The name of the widget for display purposes.
      'Distribuidor de Iconos y Texto',

      // The $widget_options array, which is passed through to WP_Widget.
      // It has a couple of extras like the optional help URL, which should link to your sites help or support page.
      array(
        'description' => 'Distribuidor de Iconos y Texto - Módulo de contenido',
        'panels_groups' => array('fp-widgets'),
        'panels_icon' => 'dashicons dashicons-admin-page'
      ),

      //The $control_options array, which is passed through to WP_Widget
      array(

      ),

      //The $form_options array, which describes the form fields used to configure SiteOrigin widgets.
      array(
        'section_general' => array(
          'type' => 'section',
          'label' => 'Textos del módulo:',
          'hide' => false,
          'fields' => array(
            'title' => array(
              'type' => 'text',
              'label' => 'Título',
              'default' => '',
              'optional' => true
            ),
            'text' => array(
              'type' => 'text',
              'label' => 'Entradilla',
              'default' => '',
              'optional' => true
            )
          )
        ),
        'section_items' => array(
          'type' => 'section',
          'label' => 'Iconos',
          'hide' => false,
          'fields' => array(
            'items_align' => array(
              'type' => 'select',
              'label' => 'Alineación de los items',
              'default' => 'center',
              'options' => array(
                'center' => 'Centro',
                'left' => 'Izquierda',
                'right' => 'Derecha'
              )
            ),
            'items_row' => array(
              'type' => 'select',
              'label' => 'Número de items por fila',
              'default' => 'six',
              'options' => array(
                'one' => '1',
                'two' => '2',
                'three' => '3',
                'four' => '4',
                'five' => '5',
                'six' => '6'
              )
            ),
            'items' => array(
              'type' => 'repeater',
              'label' => 'Elementos del módulo',
              'item_name'  => 'Elemento',
              'item_label' => array(
                'selector'     => "[id*='icon_title']",
                'update_event' => 'change',
                'value_method' => 'val'
              ),
              'fields' => array(
                'icon_type' => array(
                  'type'  => 'radio',
                  'label' => 'Tipo de icono',
                  'options' => array(
                    'icon' => 'Icono',
                    'image' => 'Imagen',
                  ),
                  'default' => 'icon',
                  'state_emitter' => array(
                    'callback' => 'select',
                    'args' => array( 'icon_type_{$repeater}' )
                  ),
                ),
                'icon_icon' => array(
                  'type' => 'icon',
                  'label' => 'Icono',
                  'optional' => true,
                  'state_handler' => array(
                    'icon_type_{$repeater}[icon]' => array('show'),
                    '_else[icon_type_{$repeater}]' => array('hide')
                  )
                ),
                'icon_image' => array(
                  'type' => 'media',
                  'label' => 'Imagen',
                  'library' => 'image',
                  'fallback' => true,
                  'optional' => true,
                  'state_handler' => array(
                    'icon_type_{$repeater}[image]' => array('show'),
                    '_else[icon_type_{$repeater}]' => array('hide')
                  )
                ),
                'icon_title' => array(
                  'type' => 'text',
                  'label' => 'Título del elemento',
                  'default' => '',
                  'optional' => true
                ),
                'icon_text' => array(
                  'type' => 'text',
                  'label' => 'Descripción del elemento',
                  'default' => '',
                  'optional' => true
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
          'icon-distributor-widget',
          plugin_dir_url( __FILE__ ) . 'js/icon-distributor-widget-scripts.js',
          array( 'jquery' ),
          '1.0'
        )
      )
    );
  }

  function get_template_variables($instance) {
    $vars = [];
    $vars['image_url'] = '';
    $vars['title'] = $instance['section_general']['title'];
    $vars['text'] = $instance['section_general']['text'];
    $vars['items_align'] = $instance['section_items']['items_align'];
    $vars['items_row'] = $instance['section_items']['items_row'];
    $vars['items'] = $instance['section_items']['items'];

    for($i = 0; $i < count($vars['items']); $i++){
      if($vars['items'][$i]['icon_type'] == 'image'){
        $image = wp_get_attachment_image_src($vars['items'][$i]['icon_image'], 'full', false);
        if($image) {
          $vars['items'][$i]['icon_image'] = $image[0];
        }
        else {
          $vars['items'][$i]['icon_image'] = $vars['items'][$i]['icon_image_fallback'];
        }
      }
    }

    return $vars;
  }

  function get_template_name($instance) {
    return 'icon-distributor-widget-template';
  }

  function get_style_name($instance) {
    return 'icon-distributor-widget-style';
  }
}
siteorigin_widget_register('icon-distributor-widget', __FILE__, 'Icon_Distributor_Widget');
