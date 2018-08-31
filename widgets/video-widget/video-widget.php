<?php

/*
Widget Name: Video
Description: Video module
Author: Flying Pigs
Author URI: http://flyingpigs.es
*/

class Video_Widget extends SiteOrigin_Widget {
  function __construct() {
    //Here you can do any preparation required before calling the parent constructor, such as including additional files or initializing variables.

    //Call the parent constructor with the required arguments.
    parent::__construct (
      // The unique id for your widget.
      'video-widget',

      // The name of the widget for display purposes.
      'Video',

      // The $widget_options array, which is passed through to WP_Widget.
      // It has a couple of extras like the optional help URL, which should link to your sites help or support page.
      array(
        'description' => 'Video - Módulo de contenido'
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
            'video_size' => array(
              'type' => 'select',
              'label' => 'Elige ancho de vídeo centrado o completo',
              'default' => 'centered',
              'options' => array(
                'centered' => 'Centrado',
                'full_width' => 'Ancho completo',
              ),
              'state_emitter' => array(
                'callback' => 'select',
                'args' => array( 'video_size' )
              ),
            ),
            'title' => array(
              'type' => 'text',
              'label' => 'Texto principal',
              'default' => '',
              'required' => true,
              'state_handler' => array(
                'video_size[centered]' => array('show'),
                'video_size[full_width]' => array('hide'),
              )
            ),
            'text' => array(
              'type' => 'text',
              'label' => 'Entradilla',
              'default' => '',
              'optional' => true,
              'state_handler' => array(
                'video_size[centered]' => array('show'),
                'video_size[full_width]' => array('hide'),
              )
            ),
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
                'no_image' => 'Ninguna',
                'default_image' => 'Imagen del vídeo por defecto',
                'custom_image' => 'Personalizada',
              ),
              'default' => 'no_image',
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
                'video_image[no_image]'  => array('hide'),
                'video_image[default_image]' => array('hide'),
                'video_image[custom_image]' => array('show')
              )
            ),
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
          'video-widget',
          plugin_dir_url( __FILE__ ) . 'js/video-widget-scripts.js',
          array( 'jquery' ),
          '1.0'
        )
      )
    );
  }

  function get_template_variables($instance) {
    $vars = [];
    
    $var['video_size'] = $instance['section_main']['video_size'];

    if( $var['video_size'] == 'centered'){
      $vars['title'] = $instance['section_main']['title'];
      $vars['text'] = $instance['section_main']['text'];
    }

    $vars['video_url'] = $instance['section_main']['video_url'];
    $vars['video_type'] = false;
    $vars['extra_content_position'] = $instance['section_main']['video_position'];
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

    if( $instance['section_main']['video_image'] == 'custom_image' || $vars['video_type'] == false || $vars['video_url'] == false ){
      $vars['video_image']= $this->getImage( $instance['section_main']['image_url'], $instance['section_main']['image_url_fallback'] );
    } elseif ( $instance['section_main']['video_image'] == 'default_image' ) {
      if( $video_code != ''){
        if( $vars['video_type'] == 'youtube'){
            $vars['video_image'] = 'https://img.youtube.com/vi/'.$video_code.'/hqdefault.jpg';
        } elseif ($vars['video_type'] == 'vimeo'){
            $vars['video_image'] = $this->getVimeoVideoThumbnailByVideoId( $video_code, 'medium' );
        }
      }
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
    return 'video-widget-template';
  }

  function get_style_name($instance) {
    return 'video-widget-style';

  }
}
siteorigin_widget_register('video-widget', __FILE__, 'Video_Widget');
