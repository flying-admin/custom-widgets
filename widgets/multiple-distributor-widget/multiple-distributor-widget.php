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
        'description' => 'Distribuidor Multiple - Módulo de contenido',
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
                'normal' => 'Imagen Extendida (Normal)',
                'contained' => 'Imagen Contenida',
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
                    'items_type[icons]' => array('hide'),
                    '_else[items_type]' => array('show')
                  )
                ),

                'icon' => array(
                  'type' => 'icon',
                  'label' => 'Icono',
                  'optional' => true,
                  'state_handler' => array(
                    'items_type[icons]' => array('show'),
                    '_else[items_type]' => array('hide')
                  )
                ),
                'icon_color' => array(
                  'type' => 'color',
                  'label' => 'Color del icono',
                  'default' => '#FFFFFF',
                  'state_handler' => array(
                    'items_type[icons]' => array('show'),
                    '_else[items_type]' => array('hide')
                  )
                ),
                'icon_bgcolor' => array(
                  'type' => 'color',
                  'label' => 'Color de fondo',
                  'default' => '#00338D',
                  'state_handler' => array(
                    'items_type[icons]' => array('show'),
                    '_else[items_type]' => array('hide')
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

                'item_link_type' => array(
                  'type'  => 'radio',
                  'label' => 'Tipo de enlace',
                  'options' => array(
                    'none' => 'Ninguno',
                    'link' => 'Enlace normal',
                    'modal' => 'Enlace a lightbox'
                  ),
                  'default' => 'normal',
                  'state_emitter' => array(
                    'callback' => 'select',
                    'args' => array( 'item_link_type_{$repeater}' )
                  ),
                ),
                'item_link_text' => array(
                  'type' => 'text',
                  'label' => 'Texto del enlace',
                  'default' => '',
                  'optional' => true,
                  'state_handler' => array(
                    'item_link_type_{$repeater}[none]' => array('hide'),
                    '_else[item_link_type_{$repeater}]' => array('show')
                  )
                ),

                'item_link_url' => array(
                  'type' => 'link',
                  'label' => 'Url del enlace',
                  'default' => '',
                  'optional' => true,
                  'state_handler' => array(
                    'item_link_type_{$repeater}[link]' => array('show'),
                    '_else[item_link_type_{$repeater}]' => array('hide')
                  )
                ),
                'item_new_window' => array(
                  'type' => 'checkbox',
                  'default' => false,
                  'label' => 'Abrir enlace en pestaña nueva',
                  'state_handler' => array(
                    'item_link_type_{$repeater}[link]' => array('show'),
                    '_else[item_link_type_{$repeater}]' => array('hide')
                  )
                ),

                'section_item_modal' => array(
                  'type' => 'section',
                  'label' => 'Contenido del lightbox:',
                  'hide' => false,
                  'fields' => array(
                    'item_modal_type' => array(
                      'type' => 'select',
                      'label' => 'Tipo de contenido del modal',
                      'default' => 'text',
                      'options' => array(
                        'text' => 'Texto',
                        'image' => 'Fotografía (Formato JPG)',
                        'video' => 'Video (Formato MP4 o MOV)',
                        'stream' => 'Video (Youtube o Vimeo)',
                        'file' => 'Documento'
                      ),
                      'state_emitter' => array(
                        'callback' => 'select',
                        'args' => array( 'item_modal_type{$repeater}' )
                      ),
                    ),
                    'item_modal_text' => array(
                      'type' => 'tinymce',
                      'label' => 'Contenido del modal',
                      'default' => '',
                      'rows' => 10,
                      'optional' => true,
                      'state_handler' => array(
                        'item_modal_type{$repeater}[text]' => array('show'),
                        '_else[item_modal_type{$repeater}]' => array('hide')
                      )
                    ),
                    'item_modal_image' => array(
                      'type' => 'media',
                      'label' => 'Fotografía (Formato JPG)',
                      'library' => 'image',
                      'fallback' => true,
                      'optional' => true,
                      'state_handler' => array(
                        'item_modal_type{$repeater}[image]' => array('show'),
                        '_else[item_modal_type{$repeater}]' => array('hide')
                      )
                    ),
                    'item_modal_video' => array(
                      'type' => 'media',
                      'label' => 'Video (Formato MP4 o MOV)',
                      'library' => 'video',
                      'fallback' => true,
                      'optional' => true,
                      'state_handler' => array(
                        'item_modal_type{$repeater}[video]' => array('show'),
                        '_else[item_modal_type{$repeater}]' => array('hide')
                      )
                    ),
                    'item_modal_stream' => array(
                      'type' => 'text',
                      'label' => 'Enlace del vídeo',
                      'placeholder' => 'Por ejemplo, https://www.youtube.com/watch?v=XXXXXXXX o https://vimeo.com/XXXXXXXX',
                      'default' => '',
                      'optional' => true,
                      'state_handler' => array(
                        'item_modal_type{$repeater}[stream]' => array('show'),
                        '_else[item_modal_type{$repeater}]' => array('hide')
                      )
                    ),
                    'item_modal_file' => array(
                      'type' => 'media',
                      'label' => 'Documento',
                      'library' => 'file',
                      'fallback' => true,
                      'optional' => true,
                      'state_handler' => array(
                        'item_modal_type{$repeater}[file]' => array('show'),
                        '_else[item_modal_type{$repeater}]' => array('hide')
                      )
                    )
                  ),
                  'state_handler' => array(
                    'item_link_type_{$repeater}[modal]' => array('show'),
                    '_else[item_link_type_{$repeater}]' => array('hide')
                  )
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

    if ($vars['items_type'] != 'icons'){
      for($i = 0; $i < count($vars['items']); $i++){
        $vars['items'][$i]['image_url'] =  $this->getMedia($vars['items'][$i]['image_url'], $vars['items'][$i]['image_url_fallback']);
      }
    }

    for($j = 0; $j < count($vars['items']); $j++){
      if ($vars['items'][$j]['item_link_type'] == 'modal'){
        $vars['items'][$j]['section_item_modal']['item_modal_id'] = "modal-" . base_convert($instance["_sow_form_id"], 16, 36) . "-" . $j;

        if ($vars['items'][$j]['section_item_modal']['item_modal_type'] == 'image'){
          $vars['items'][$j]['section_item_modal']['item_modal_image'] =  $this->getMedia($vars['items'][$j]['section_item_modal']['item_modal_image'], $vars['items'][$j]['section_item_modal']['item_modal_image_fallback']);
        }
        if ($vars['items'][$j]['section_item_modal']['item_modal_type'] == 'video'){
          $vars['items'][$j]['section_item_modal']['item_modal_video'] =  $this->getMedia($vars['items'][$j]['section_item_modal']['item_modal_video'], $vars['items'][$j]['section_item_modal']['item_modal_video_fallback']);
        }
        if ($vars['items'][$j]['section_item_modal']['item_modal_type'] == 'file'){
          $vars['items'][$j]['section_item_modal']['item_modal_file'] =  $this->getMedia($vars['items'][$j]['section_item_modal']['item_modal_file'], $vars['items'][$j]['section_item_modal']['item_modal_file_fallback']);
        }
        if ($vars['items'][$j]['section_item_modal']['item_modal_type'] == 'stream'){
          if( strpos($vars['items'][$j]['section_item_modal']['item_modal_stream'], 'youtube') != false ){
            $vars['items'][$j]['section_item_modal']['item_modal_stream_type'] = 'youtube';
            $vars['items'][$j]['section_item_modal']['item_modal_stream_code'] = $this->getYoutubeId($vars['items'][$j]['section_item_modal']['item_modal_stream']);
          }
          elseif ( strpos($vars['items'][$j]['section_item_modal']['item_modal_stream'], 'vimeo') != false) {
            $vars['items'][$j]['section_item_modal']['item_modal_stream_type'] = 'vimeo';
            $vars['items'][$j]['section_item_modal']['item_modal_stream_code'] = $this->getVimeoId($vars['items'][$j]['section_item_modal']['item_modal_stream']);
          }
          else {
            $vars['items'][$j]['section_item_modal']['item_modal_stream_code'] = false;
          }
        }
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

  function getYoutubeId( $url ){
    if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match)) {
      $id = $match[1];

      if($id){
        return $id;
      } else {
        return '';
      }
    }
  }

  function getVimeoId( $url ){
    $regs = [];
    $id = '';

    if (preg_match('%^https?:\/\/(?:www\.|player\.)?vimeo.com\/(?:channels\/(?:\w+\/)?|groups\/([^\/]*)\/videos\/|album\/(\d+)\/video\/|video\/|)(\d+)(?:$|\/|\?)(?:[?]?.*)$%im', $url, $regs)) {
        $id = $regs[3];
    }

    if($id){
      return $id;
    } else {
      return '';
    }
  }

  function get_template_name($instance) {
    return 'multiple-distributor-widget-template';
  }

  function get_style_name($instance) {
    return 'multiple-distributor-widget-style';
  }
}
siteorigin_widget_register('multiple-distributor-widget', __FILE__, 'Multiple_Distributor_Widget');
