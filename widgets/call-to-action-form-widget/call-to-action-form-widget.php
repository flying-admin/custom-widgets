<?php

/*
Widget Name: Call To Action Form
Description: Call To Action Form module
Author: Flying Pigs
Author URI: http://flyingpigs.es
*/

class Call_To_Action_Form_Widget extends SiteOrigin_Widget {
  function __construct() {
    //Here you can do any preparation required before calling the parent constructor, such as including additional files or initializing variables.

    //Call the parent constructor with the required arguments.
    parent::__construct (
      // The unique id for your widget.
      'call-to-action-form-widget',

      // The name of the widget for display purposes.
      'Call To Action Form',

      // The $widget_options array, which is passed through to WP_Widget.
      // It has a couple of extras like the optional help URL, which should link to your sites help or support page.
      array(
        'description' => 'Call To Action Formulario - Módulo de la parte superior'
      ),

      //The $control_options array, which is passed through to WP_Widget
      array(

      ),

      //The $form_options array, which describes the form fields used to configure SiteOrigin widgets.
      array(
        'section_main' => array(
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
            'description' => array(
              'type' => 'textarea',
              'label' => 'Descripción',
              'default' => '',
              'required' => true
            ),
            'contact_person' => array(
              'type' => 'text',
              'label' => 'Persona de contacto',
              'default' => '',
              'required' => true
            ),
            'contact_phone' => array(
              'type' => 'text',
              'label' => 'Teléfono de contacto',
              'default' => '',
              'optional' => true
            ),
            'contact_email' => array(
              'type' => 'text',
              'label' => 'Email de contacto',
              'default' => '',
              'optional' => true
            ),
            'chargue' => array(
              'type' => 'text',
              'label' => 'Cargo',
              'default' => '',
              'optional' => true
            ),
            'image_url' => array(
              'type' => 'media',
              'label' => 'Foto',
              'library' => 'image',
              'fallback' => true,
              'required' => true
            ),
            'add_form' => array(
              'type'  => 'radio',
              'label' => '¿Quieres añadir el formulario?',
              'options' => array(
                'yes' => 'Sí',
                'none' => 'No',
              ),
              'default' => 'yes',
              'state_emitter' => array(
                'callback' => 'select',
                'args' => array( 'add_form' )
              ),
            ),
            'form_email' => array(
              'type' => 'text',
              'label' => 'Dirigido a',
              'default' => '',
              'required' => true,
              'state_handler' => array(
                'add_form[none]' => array('hide'),
                'add_form[yes]' => array('show')
              )
            ),
            'form_link_text' => array(
              'type' => 'text',
              'label' => 'Texto del enlace',
              'default' => '',
              'required' => true,
              'state_handler' => array(
                'add_form[none]' => array('show'),
                'add_form[yes]' => array('hide')
              )
            ),
            'form_link_url' => array(
              'type' => 'link',
              'label' => 'URL del enlace',
              'default' => '',
              'required' => true,
              'state_handler' => array(
                'add_form[none]' => array('show'),
                'add_form[yes]' => array('hide')
              )
            )
          ),
        ),
      ),

      //The $base_folder path string.
      plugin_dir_path(__FILE__)
    );
  }

  function initialize() {
    $this->register_frontend_scripts(
      array(
        array(
          'call-to-action-form-widget',
          plugin_dir_url( __FILE__ ) . 'js/call-to-action-form-widget-scripts.js',
          array( 'jquery' ),
          '1.0'
        )
      )
    );
  }

  function get_template_variables($instance) {
    $vars = [];
    $vars['title'] =           $instance['section_main']['title'];
    $vars['description'] =     $instance['section_main']['description'];
    $vars['contact_person'] =  $instance['section_main']['contact_person'];
    $vars['contact_phone'] =   $instance['section_main']['contact_phone'];
    $vars['contact_email'] =   $instance['section_main']['contact_email'];
    $vars['chargue'] =         $instance['section_main']['chargue'];
    $vars['add_form'] =        $instance['section_main']['add_form'];
    $vars['fp_ctaf'] =         fp_ctaf_encript($instance['section_main']['form_email']);
    $vars['form_link_text'] =  $instance['section_main']['form_link_text'];
    $vars['form_link_url'] =   $instance['section_main']['form_link_url'];
    $vars['image' ] =          $this->getImage($instance['section_main']['image_url'], $instance['section_main']['image_url_fallback']);
    return $vars;
  }

  function getImage( $image , $fallback = false ){
    $img = wp_get_attachment_image_src( $image , 'full', false );
    if( $img ) {
      return $img[0];
    }else {
      return $fallback;
    }
  }

  function get_template_name($instance) {
    return 'call-to-action-form-widget-template';
  }

  function get_style_name($instance) {
    return 'call-to-action-form-widget-style';

  }
}
siteorigin_widget_register('call-to-action-form-widget', __FILE__, 'Call_To_Action_Form_Widget');
