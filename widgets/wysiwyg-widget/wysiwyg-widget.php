<?php

/*
Widget Name: Wysiwyg
Description: Wysiwyg module
Author: Flying Pigs
Author URI: http://flyingpigs.es
*/

class Wysiwyg_Widget extends SiteOrigin_Widget {
  function __construct() {
    //Here you can do any preparation required before calling the parent constructor, such as including additional files or initializing variables.

    //Call the parent constructor with the required arguments.
    parent::__construct (
      // The unique id for your widget.
      'wysiwyg-widget',

      // The name of the widget for display purposes.
      'Wysiwyg',

      // The $widget_options array, which is passed through to WP_Widget.
      // It has a couple of extras like the optional help URL, which should link to your sites help or support page.
      array(
        'description' => 'Wysiwyg - Módulo de la parte superior'
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
              'required' => true
            ),
            'add_media' => array(
              'type'  => 'radio',
              'label' => 'Añadir enlace agrupador',
              'options' => array(
                'none' => 'Ninguno',
                'image' => 'Imagen',
                'video' => 'Video',
              ),
              'default' => 'none',
              'state_emitter' => array(
                'callback' => 'select',
                'args' => array( 'add_media' )
              ),
            ),
            'video_url' => array(
              'type' => 'text',
              'label' => 'Enlace del vídeo',
              'placeholder' => 'Por ejemplo, https://www.youtube.com/watch?v=b2fATDBV-JU o https://vimeo.com/28301101',
              'description' => "Por ejemplo, https://www.youtube.com/watch?v=b2fATDBV-JU o https://vimeo.com/28301101",
              'default' => '',
              'required' => true,
              'state_handler' => array(
                'add_media[none]' => array('hide'),
                'add_media[image]' => array('hide'),
                'add_media[video]' => array('show')
              )
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
              'state_handler' => array(
                'add_media[none]' => array('hide'),
                'add_media[image]' => array('hide'),
                'add_media[video]' => array('show')
              )
            ),
            'video_image_url' => array(
              'type' => 'media',
              'label' => 'Imagen personalizada',
              'description' => "Hay que subir una imagen de al menos 1005 x 523 px.",
              'library' => 'image',
              'fallback' => true,
              'required' => true,
              'state_handler' => array(
                'video_image[default_image]' => array('hide'),
                'video_image[custom_image]' => array('show'),
                'add_media[none]' => array('hide'),
                'add_media[image]' => array('hide'),
                'add_media[video]' => array('show')
              )
            ),
            'image_url' => array(
              'type' => 'media',
              'label' => 'Imagen',
              'description' => "Hay que subir una imagen de al menos 1005 px. de ancho (la altura puede ser variable)",
              'library' => 'image',
              'fallback' => true,
              'required' => true,
              'state_handler' => array(
                'add_media[none]' => array('hide'),
                'add_media[image]' => array('show'),
                'add_media[video]' => array('hide')
              )
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
          'wysiwyg-widget',
          plugin_dir_url( __FILE__ ) . 'js/wysiwyg-widget-scripts.js',
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


    $vars['extra_content'] = $instance['section_main']['add_media'];
    switch ($instance['section_main']['add_media']) {
      case "image":
          $vars['image'] = true;
          $vars['image_url' ] =  $this->getImage($instance['section_main']['image_url'], $instance['section_main']['image_url_fallback']);
          $vars['extra_content_position' ]= $instance['section_main']['image_position'];
          break;
      case "video":
          $vars['video'] = true;
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
            $vars['video_image']= $this->getImage( $instance['section_main']['video_image_url'], $instance['section_main']['video_image_url_fallback'] );
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
    return 'wysiwyg-widget-template';
  }

  function get_style_name($instance) {
    return 'wysiwyg-widget-style';

  }
}
siteorigin_widget_register('wysiwyg-widget', __FILE__, 'Wysiwyg_Widget');
