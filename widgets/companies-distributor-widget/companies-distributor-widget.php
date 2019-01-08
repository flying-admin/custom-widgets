<?php

/*
Widget Name: Distribuidor de Empresas
Description: Distribuidor de Empresas module
Author: Flying Pigs
Author URI: http://flyingpigs.es
*/

class Companies_Distributor_Widget extends SiteOrigin_Widget {
  function __construct() {
    //Here you can do any preparation required before calling the parent constructor, such as including additional files or initializing variables.

    //Call the parent constructor with the required arguments.
    parent::__construct (
      // The unique id for your widget.
      'companies-distributor-widget',

      // The name of the widget for display purposes.
      'Distribuidor de Empresas',

      // The $widget_options array, which is passed through to WP_Widget.
      // It has a couple of extras like the optional help URL, which should link to your sites help or support page.
      array(
        'description' => 'Distribuidor de Empresas - Módulo de contenido',
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
              'required' => true
            ),
            'text' => array(
              'type' => 'text',
              'label' => 'Entradilla',
              'default' => '',
              'optional' => true
            ),
            'color' => array(
              'type' => 'color',
              'label' => 'Color',
              'default' => '#00338d',
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
              'default' => 'four',
              'options' => array(
                'three' => '3',
                'four' => '4',
                'five' => '5'
              )
            ),
            'items_type' => array(
              'type'  => 'radio',
              'label' => 'Tipo de vista',
              'options' => array(
                'logo' => 'Vista de logos',
                'text' => 'Vista de texto',
              ),
              'default' => 'logo',
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
                  'label' => 'Logo de la empresa',
                  'library' => 'image',
                  'fallback' => true,
                  'optional' => true,
                  'state_handler' => array(
                    'items_type[text]' => array('hide'),
                    '_else[items_type]' => array('show')
                  )
                ),
                'item_name' => array(
                  'type' => 'text',
                  'label' => 'Nombre de la empresa',
                  'default' => '',
                  'optional' => true,
                  'state_handler' => array(
                    'items_type[logo]' => array('hide'),
                    '_else[items_type]' => array('show')
                  )
                ),

                'item_url' => array(
                  'type' => 'link',
                  'label' => 'Url del enlace',
                  'default' => '',
                  'optional' => true
                ),
                'item_new_window' => array(
                  'type' => 'checkbox',
                  'default' => false,
                  'label' => 'Abrir enlace en pestaña nueva'
                ),
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
    $vars['color'] = $instance['section_general']['color'];
    $vars['items_row'] = $instance['section_items']['items_row'];
    $vars['items_type'] = $instance['section_items']['items_type'];
    $vars['items'] = $instance['section_items']['items'];
    $vars['cta_text'] = $instance['section_cta']['cta_text'];
    $vars['cta_url'] = sow_esc_url( $instance['section_cta']['cta_url'] );
    $vars['new_window'] = $instance['section_cta']['new_window'];

    if ($vars['items_type'] != 'icons'){
      for($i = 0; $i < count($vars['items']); $i++){
        $vars['items'][$i]['image_url'] =  $this->getMedia($vars['items'][$i]['image_url'], $vars['items'][$i]['image_url_fallback']);
        $vars['items'][$i]['item_url'] = sow_esc_url( $vars['items'][$i]['item_url'] );
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
    return 'companies-distributor-widget-template';
  }

  function get_style_name($instance) {
    return 'companies-distributor-widget-style';
  }
}
siteorigin_widget_register('companies-distributor-widget', __FILE__, 'Companies_Distributor_Widget');
