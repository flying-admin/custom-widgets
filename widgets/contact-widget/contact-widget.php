<?php

/*
Widget Name: Contacto
Description: Contacto module
Author: Flying Pigs
Author URI: http://flyingpigs.es
*/

class Contact_Widget extends SiteOrigin_Widget {
  function __construct() {
    //Here you can do any preparation required before calling the parent constructor, such as including additional files or initializing variables.

    //Call the parent constructor with the required arguments.
    parent::__construct (
      // The unique id for your widget.
      'contact-widget',

      // The name of the widget for display purposes.
      'Contacto',

      // The $widget_options array, which is passed through to WP_Widget.
      // It has a couple of extras like the optional help URL, which should link to your sites help or support page.
      array(
        'description' => 'Contacto - Módulo de contenido',
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
          'label' => 'Textos del bloque:',
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
        'section_contacts' => array(
          'type' => 'section',
          'label' => 'Marcadores del mapa:',
          'hide' => false,
          'fields' => array(
            'contacts' => array(
              'type' => 'repeater',
              'label' => 'Contactos',
              'item_name'  => 'Contacto',
              'item_label' => array(
                'selector'     => "[id*='contact_title']",
                'update_event' => 'change',
                'value_method' => 'val'
              ),
              'fields' => array(
                'contact_name' => array(
                  'type' => 'text',
                  'label' => 'Nombre',
                  'default' => '',
                  'required' => true
                ),
                'contact_desc' => array(
                  'type' => 'textarea',
                  'label' => 'Descripción',
                  'default' => '',
                  'optional' => true
                ),
                'contact_title' => array(
                  'type' => 'text',
                  'label' => 'Título',
                  'default' => '',
                  'required' => true
                ),
                'contact_address' => array(
                  'type' => 'textarea',
                  'label' => 'Dirección',
                  'default' => '',
                  'optional' => true
                ),
                'contact_phone' => array(
                  'type' => 'text',
                  'label' => 'Teléfono',
                  'default' => '',
                  'optional' => true
                ),
                'contact_email' => array(
                  'type' => 'text',
                  'label' => 'Correo electrónico',
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
          'contact-widget-script',
          plugin_dir_url( __FILE__ ) . 'js/contact-widget-scripts.js',
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
    $vars['contacts'] = $instance['section_contacts']['contacts'];

    return $vars;
  }

  function get_template_name($instance) {
    return 'contact-widget-template';
  }

  function get_style_name($instance) {
    return 'contact-widget-style';
  }
}
siteorigin_widget_register('contact-widget', __FILE__, 'Contact_Widget');
