<?php

/*
Widget Name: Distribuidor Multiple
Description: Distribuidor Multiple module
Author: Flying Pigs
Author URI: http://flyingpigs.es
*/

class Multiple_Distributor_Widget extends SiteOrigin_Widget {
  function __construct() {
    //Here you can do any preparation required before calling the parent constructor, such as including additional files or initializing variables.

    //Call the parent constructor with the required arguments.
    parent::__construct (
      // The unique id for your widget.
      'multiple-distributor-widget',

      // The name of the widget for display purposes.
      'Distribuidor Multiple',

      // The $widget_options array, which is passed through to WP_Widget.
      // It has a couple of extras like the optional help URL, which should link to your sites help or support page.
      array(
        'description' => 'Distribuidor Multiple - Módulo de contenido'
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
        'section_items' => array(
          'type' => 'section',
          'label' => 'Elementos del módulo:',
          'hide' => false,
          'fields' => array(
            'items_row' => array(
              'type' => 'select',
              'label' => 'Número de items por fila',
              'default' => 'three',
              'options' => array(
                'two' => '2',
                'three' => '3',
                'four' => '4'
              )
            ),
            'items_type' => array(
              'type'  => 'radio',
              'label' => 'Tipo de vista',
              'options' => array(
                'normal' => 'Normal',
                'icons' => 'Destacados con iconos',
              ),
              'default' => 'normal',
              'state_emitter' => array(
                'callback' => 'select',
                'args' => array( 'items_type' )
              ),
            ),
            'items' => array(
              'type' => 'repeater',
              'label' => 'Elementos del distribuidor',
              'item_name'  => 'Elemento',
              'item_label' => array(
                'selector'     => "[id*='item_title']",
                'update_event' => 'change',
                'value_method' => 'val'
              ),
              'fields' => array(
                'image_url' => array(
                  'type' => 'media',
                  'label' => 'Imagen',
                  'library' => 'image',
                  'fallback' => true,
                  'optional' => true,
                  'state_handler' => array(
                    'items_type[normal]' => array('show'),
                    'items_type[icons]' => array('hide')
                  )
                ),

                'icon' => array(
                  'type' => 'icon',
                  'label' => 'Icono',
                  'optional' => true,
                  'state_handler' => array(
                    'items_type[normal]' => array('hide'),
                    'items_type[icons]' => array('show')
                  )
                ),
                'icon_color' => array(
                  'type' => 'color',
                  'label' => 'Color del icono',
                  'default' => '#FFFFFF',
                  'state_handler' => array(
                    'items_type[normal]' => array('hide'),
                    'items_type[icons]' => array('show')
                  )
                ),
                'icon_bgcolor' => array(
                  'type' => 'color',
                  'label' => 'Color de fondo',
                  'default' => '#00338D',
                  'state_handler' => array(
                    'items_type[normal]' => array('hide'),
                    'items_type[icons]' => array('show')
                  )
                ),

                'item_title' => array(
                  'type' => 'text',
                  'label' => 'Título del elemento',
                  'default' => '',
                  'optional' => true
                ),
                'item_text' => array(
                  'type' => 'text',
                  'label' => 'Descripción del elemento',
                  'default' => '',
                  'optional' => true
                ),
                'item_info' => array(
                  'type' => 'text',
                  'label' => 'Texto informativo',
                  'default' => '',
                  'optional' => true
                ),

                'item_link_text' => array(
                  'type' => 'text',
                  'label' => 'Texto del enlace',
                  'default' => '',
                  'optional' => true
                ),
                'item_link_url' => array(
                  'type' => 'link',
                  'label' => 'Url del enlace',
                  'default' => '',
                  'optional' => true
                ),
                'item_new_window' => array(
                  'type' => 'checkbox',
                  'default' => false,
                  'label' => 'Abrir enlace en pestaña nueva',
                )

              )
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
              'type' => 'link',
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
          'multiple-distributor-widget',
          plugin_dir_url( __FILE__ ) . 'js/multiple-distributor-widget-scripts.js',
          array( 'jquery' ),
          '1.0'
        )
      )
    );
  }

  function get_template_variables($instance) {

    $vars = [];
    $vars['title'] = $instance['section_general']['title'];
    $vars['text'] = $instance['section_general']['text'];
    $vars['items_row'] = $instance['section_items']['items_row'];
    $vars['items_type'] = $instance['section_items']['items_type'];
    $vars['items'] = $instance['section_items']['items'];
    $vars['cta_text'] = $instance['section_cta']['cta_text'];
    $vars['cta_url'] = sow_esc_url( $instance['section_cta']['cta_url'] );
    $vars['new_window'] = $instance['section_cta']['new_window'];

    if ($vars['items_type'] == 'normal'){
      for($i = 0; $i < count($vars['items']); $i++){
        $image = wp_get_attachment_image_src($vars['items'][$i]['image_url'], 'full', false);
        if($image) {
          $vars['items'][$i]['image_url'] = $image[0];
        }
        else {
          $vars['items'][$i]['image_url'] = $vars['items'][$i]['image_url_fallback'];
        }
      }
    }

    return $vars;
  }

  function get_template_name($instance) {
    return 'multiple-distributor-widget-template';
  }

  function get_style_name($instance) {
    return 'multiple-distributor-widget-style';
  }
}
siteorigin_widget_register('multiple-distributor-widget', __FILE__, 'Multiple_Distributor_Widget');
