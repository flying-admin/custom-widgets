<?php

/*
Widget Name: Guest Critics
Description: Muestra un listado de las personas externas a la Escuela que colaboran impartiendo charlas y seminarios nombrando la empresa en la que trabajan. Los Guest critics a mostrar se seleccionan manualmente.
Author: Flying Pigs
Author URI: http://flyingpigs.es
*/

class Guest_Critics_Widget extends SiteOrigin_Widget {
  function __construct() {
    //Here you can do any preparation required before calling the parent constructor, such as including additional files or initializing variables.

    //Call the parent constructor with the required arguments.
    parent::__construct (
      // The unique id for your widget.
      'guest-critics-widget',

      // The name of the widget for display purposes.
      'Guest critics',

      // The $widget_options array, which is passed through to WP_Widget.
      // It has a couple of extras like the optional help URL, which should link to your sites help or support page.
      array(
        'description' => 'Guest critics - Módulo informativo',
        'panels_groups' => array('fp-widgets'),
        'panels_icon' => 'dashicons dashicons-admin-page'
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
              'label' => 'Titulo',
              'default' => '',
              'optional' => true
            ),
            'text' => array(
              'type' => 'text',
              'label' => 'Entradilla',
              'default' => '',
              'optional' => true
            ),
            'items' => array(
              'type' => 'repeater',
              'label' => 'Elementos del módulo',
              'item_name'  => 'Elemento',
              'item_label' => array(
                'selector'     => "[id*='guest-critics_title']",
                'update_event' => 'change',
                'value_method' => 'val'
              ),
              'fields' => array(
                'name' => array(
                  'type' => 'text',
                  'label' => 'Nombre',
                  'default' => '',
                  'optional' => true
                ),
                'position' => array(
                  'type' => 'text',
                  'label' => 'Cargo',
                  'default' => '',
                  'optional' => true
                ),
                'photo' => array(
                    'type' => 'media',
                    'label' => 'Foto de perfil',
                    'library' => 'image',
                    'fallback' => true,
                    'optional' => true,
                ),
                'background' => array(
                    'type' => 'media',
                    'label' => 'Imagen de fondo',
                    'library' => 'image',
                    'fallback' => true,
                    'optional' => true,
                    'description' => 'Hay que subir una imagen de al menos 740 x 480 px.'
                ),
                'rich_text' => array(
                  'type' => 'tinymce',
                  'label' => 'Descripción',
                  'default' => '',
                  'rows' => 10,
                  'optional' => true
                ),
              )
            ),
          )
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
          'guest-critics-widget',
          plugin_dir_url( __FILE__ ) . 'js/guest-critics-widget-scripts.js',
          array( 'jquery' ),
          '1.0'
        )
      )
    );
  }

  function get_template_variables($instance) {
    $vars = [];
    $vars['title'] = $instance['section_main']['title'];
    $vars['text'] = $instance['section_main']['text'];
    $module_items = $instance['section_main']['items'];

    for ($j = 0; $j < count($module_items); $j++ ){

      if( empty ( $module_items[$j]["photo"] ) ){
        $module_items[$j]["item_photo"] = "";
      }else{
        $module_items[$j]["item_photo"] =  $this->getImage( $module_items[$j]["photo"] ,$module_items[$j]["photo_fallback"]) ;
      }

      if( empty ( $module_items[$j]["background"] ) ){
        $module_items[$j]["item_background"] = "";
      }else{
        $module_items[$j]["item_background"] =  $this->getImage( $module_items[$j]["background"] ,$module_items[$j]["background_fallback"]) ;
      }

      $module_items[$j]['modal_id'] = "";
      if(  $module_items[$j]["rich_text"] != '' ){
        $module_items[$j]['modal_id']= "m-". base_convert($instance["_sow_form_id"], 16, 36) ."-".$j;
      }

    }

    $vars['items'] = $module_items;

    return $vars;
  }

  function getImage( $image , $fallback = false ){
    $img = wp_get_attachment_image_src( $image , 'full', false );
    if( $img ) {
      return $img[0];
    } else {
      return $fallback;
    }
  }

  function get_template_name($instance) {
    return 'guest-critics-widget-template';
  }

  function get_style_name($instance) {
    return 'guest-critics-widget-style';
  }
}
siteorigin_widget_register('guest-critics-widget', __FILE__, 'Guest_Critics_Widget');
