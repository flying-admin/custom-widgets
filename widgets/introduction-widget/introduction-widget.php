<?php

/*
Widget Name: Introduction
Description: Permite crear un contenido breve a modo de introduccion.
Author: Flying Pigs
Author URI: http://flyingpigs.es
*/

class Introduction_Widget extends SiteOrigin_Widget {
  function __construct() {
    //Here you can do any preparation required before calling the parent constructor, such as including additional files or initializing variables.

    //Call the parent constructor with the required arguments.
    parent::__construct (
      // The unique id for your widget.
      'introduction-widget',

      // The name of the widget for display purposes.
      'Introduccion',

      // The $widget_options array, which is passed through to WP_Widget.
      // It has a couple of extras like the optional help URL, which should link to your sites help or support page.
      array(
        'description' => 'Introducción - Permite crear un contenido breve a modo de introducción.'
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
              'label' => 'Texto principal',
              'default' => '',
              'required' => true
            ),
            'text' => array(
              'type' => 'text',
              'label' => 'Entradilla',
              'default' => '',
              'optional' => true
            ),
            'rich_text' => array(
              'type' => 'tinymce',
              'label' => 'Contenido',
              'default' => '',
              'rows' => 10,
              'optional' => true
            ),
            'add_link' => array(
              'type'  => 'radio',
              'label' => 'Añadir enlace agrupador',
              'options' => array(
                'none' => 'No',
                'yes' => 'Sí',
              ),
              'default' => 'none',
              'state_emitter' => array(
                'callback' => 'select',
                'args' => array( 'add_link' )
              ),
            ),
            'link_text' => array(
              'type' => 'text',
              'label' => 'Texto del link',
              'default' => '',
              'optional' => true,
              'state_handler' => array(
                'add_link[none]' => array('hide'),
                'add_link[yes]' => array('show')
              )
            ),
            'link_url' => array(
              'type' => 'link',
              'label' => 'Url del link',
              'default' => '',
              'optional' => true,
              'state_handler' => array(
                'add_link[none]' => array('hide'),
                'add_link[yes]' => array('show')
              )
            ),
            'link_blank' => array(
              'type' => 'checkbox',
              'default' => false,
              'label' => 'Abrir enlace en pestaña nueva',
              'state_handler' => array(
                'add_link[none]' => array('hide'),
                'add_link[yes]' => array('show')
              )
            ),
            'extra_content' => array(
              'type'  => 'radio',
              'label' => 'Contenido extra',
              'options' => array(
                'none' => 'Ninguno',
                'cta' => 'Call To Action',
                'image' => 'Imagen',
                'video' => 'Video'
              ),
              'default' => 'none',
              'state_emitter' => array(
                'callback' => 'select',
                'args' => array( 'extra_content' )
              ),
            ),
          ),
        ),
        'section_cta' => array(
          'type' => 'section',
          'label' => 'Call To Action (CTA):',
          'hide' => false,
          'fields' => array(
            'title' => array(
              'type' => 'text',
              'label' => 'Titulo',
              'default' => '',
              'required' => true
            ),
            'text' => array(
              'type' => 'text',
              'label' => 'Texto',
              'default' => '',
              'optional' => true
            ),
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
            ),
            'position' => array(
              'type' => 'select',
              'label' => 'Posicion del CTA',
              'default' => 'right',
              'options' => array(
                'left' => 'Izquierda',
                'right' => 'Derecha',
              ),
            ),
          ),
          'state_handler' => array(
            'extra_content[none]' => array('hide'),
            'extra_content[cta]' => array('show'),
            'extra_content[image]' => array('hide'),
            'extra_content[video]' => array('hide')
          ),
        ),
        'section_image' => array(
          'type' => 'section',
          'label' => 'Image:',
          'hide' => false,
          'fields' => array(
            'image_url' => array(
              'type' => 'media',
              'label' => 'Imagen',
              'library' => 'image',
              'description' => "Introducir una imagen de 740 x 480",
              'fallback' => true,
              'required' => true
            ),
            'image_position' => array(
              'type' => 'select',
              'label' => 'Posicion de la imagen',
              'default' => 'right',
              'options' => array(
                'left' => 'Izquierda',
                'right' => 'Derecha',
              ),
            ),
          ),
          'state_handler' => array(
            'extra_content[none]' => array('hide'),
            'extra_content[cta]' => array('hide'),
            'extra_content[image]' => array('show'),
            'extra_content[video]' => array('hide')
          )
        ),
        'section_video' => array(
          'type' => 'section',
          'label' => 'Video:',
          'hide' => false,
          'fields' => array(
            'video_url' => array(
              'type' => 'text',
              'label' => 'Enlace del vídeo',
              'placeholder' => 'Por ejemplo, https://www.youtube.com/watch?v=b2fATDBV-JU o https://vimeo.com/28301101',
              'default' => '',
              'required' => true
            ),
            'video_image' => array(
              'type'  => 'radio',
              'label' => '¿Qué imagen quieres para el vídeo?',
              'options' => array(
                'default_image' => 'Imagen del vídeo por defecto',
                'custom_image' => 'Personalizada',
              ),
              'default' => 'default_image',
              'state_emitter' => array(
                'callback' => 'select',
                'args' => array( 'video_image' )
              ),
            ),
            'image_url' => array(
              'type' => 'media',
              'label' => 'Imagen',
              'library' => 'image',
              'fallback' => true,
              'required' => true,
              'state_handler' => array(
                'video_image[default_image]' => array('hide'),
                'video_image[custom_image]' => array('show')
              )
            ),
            'video_position' => array(
              'type' => 'select',
              'label' => 'Posicion del vídeo',
              'default' => 'right',
              'options' => array(
                'left' => 'Izquierda',
                'right' => 'Derecha',
              ),
            ),
          ),
          'state_handler' => array(
            'extra_content[none]' => array('hide'),
            'extra_content[cta]' => array('hide'),
            'extra_content[image]' => array('hide'),
            'extra_content[video]' => array('show')
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
          'introduction-widget',
          plugin_dir_url( __FILE__ ) . 'js/introduction-widget-scripts.js',
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
    $vars['rich_text'] = $instance['section_main']['rich_text'];

   
    $vars['link'] = false;
    if( $instance['section_main']['add_link'] == 'yes' ){
      $vars['link'] = true;
      $vars['link_text'] = $instance['section_main']['link_text'];
      $vars['link_url'] = sow_esc_url($instance['section_main']['link_url']);
      $vars['link_blank'] = $instance['section_main']['link_blank'];
    }
      
    $vars['extra_content'] = $instance['section_main']['extra_content'];
    switch ($instance['section_main']['extra_content']) {

      case "cta":
          $vars['cta'] = true;
          $vars['cta_title'] = $instance['section_cta']['title'];
          $vars['cta_text'] = $instance['section_cta']['text'];
          $vars['cta_link_text'] = $instance['section_cta']['cta_text'];
          $vars['cta_link_url'] =  sow_esc_url( $instance['section_cta']['cta_url'] );
          $vars['cta_new_window'] = $instance['section_cta']['new_window'];
          $vars['extra_content_position'] = $instance['section_cta']['position'];
          break;
      case "image":
          $vars['image'] = true;
          $vars['image_url' ] =  $this->getImage($instance['section_image']['image_url'], $instance['section_image']['image_url_fallback']);
          $vars['extra_content_position' ]= $instance['section_image']['image_position'];
          break;
      case "video":
          $vars['video'] = true;
          $vars['video_url'] = $instance['section_video']['video_url'];
          $vars['video_type'] = false;
          $vars['extra_content_position'] = $instance['section_video']['video_position'];
          $vars['video_image'] = false;
          
          $video_code = '';

          if( strpos( $vars['video_url'] , 'youtube') != false ){
            $vars['video_type'] = 'youtube';
            $video_code = $this->getYoutubeId( $vars['video_url'] );
          } elseif ( strpos( $vars['video_url'] , 'vimeo') != false) {
            $vars['video_type'] = 'vimeo';
            $video_code = $this->getVimeoId( $vars['video_url'] );
          }else{
            $vars['video_url'] = false;
          }

          $vars['video_code'] = $video_code ;

          if( $instance['section_video']['video_image'] == 'custom_image' || $vars['video_type'] == false || $vars['video_url'] == false ){
            $vars['video_image']= $this->getImage( $instance['section_video']['image_url'], $instance['section_video']['image_url_fallback'] );
          } else {
            if( $video_code != ''){
              if( $vars['video_type'] == 'youtube'){
                  $vars['video_image'] = 'https://img.youtube.com/vi/'.$video_code.'/hqdefault.jpg';
              } elseif ($vars['video_type'] == 'vimeo'){
                  $vars['video_image'] = $this->getVimeoVideoThumbnailByVideoId( $video_code, 'medium' );
              }
            }
          }
          break;
    }

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


  function getVimeoVideoThumbnailByVideoId( $id = '', $thumbType = 'medium' ) {
      $id = trim( $id );
      if ( $id == '' ) {
          return FALSE;
      }
      $apiData = unserialize( file_get_contents( "http://vimeo.com/api/v2/video/$id.php" ) );
      if ( is_array( $apiData ) && count( $apiData ) > 0 ) {
          $videoInfo = $apiData[ 0 ];
          switch ( $thumbType ) {
              case 'small':
                  return $videoInfo[ 'thumbnail_small' ];
                  break;
              case 'large':
                  return $videoInfo[ 'thumbnail_large' ];
                  break;
              case 'medium':
                  return $videoInfo[ 'thumbnail_medium' ];
              default:
                  break;
          }
      }
      return FALSE;
  }

  function getYoutubeId( $url ){
      // parse_str( parse_url( $url, PHP_URL_QUERY ), $my_array_of_vars );
      // if(array_key_exists ( 'v' , $my_array_of_vars ) ){
      //   return  $my_array_of_vars['v'];   
      // }else{
      //   return '';   
      // } 

      if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match)) {
        $id = $match[1];

        if($id){
          return $id;
        }else{
          return '';
        }
    }
  }

  function getVimeoId( $url ){
      // $id = substr( parse_url($url, PHP_URL_PATH), 1 );
      // if($id){
      //   return $id;
      // }else{
      //   return '';
      // }

      $regs = [];
      $id = '';
  
      if (preg_match('%^https?:\/\/(?:www\.|player\.)?vimeo.com\/(?:channels\/(?:\w+\/)?|groups\/([^\/]*)\/videos\/|album\/(\d+)\/video\/|video\/|)(\d+)(?:$|\/|\?)(?:[?]?.*)$%im', $url, $regs)) {
          $id = $regs[3];
      }
  
      if($id){
        return $id;
      }else{
        return '';
      }
  } 
  

  function get_template_name($instance) {
    return 'introduction-widget-template';
  }

  function get_style_name($instance) {
    return 'introduction-widget-style';

  }
}
siteorigin_widget_register('introduction-widget', __FILE__, 'Introduction_Widget');
