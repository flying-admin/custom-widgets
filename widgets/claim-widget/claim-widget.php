<?php

/*
Widget Name: Claim
Description: Claim module
Author: Flying Pigs
Author URI: http://flyingpigs.es
*/

class Claim_Widget extends SiteOrigin_Widget {
  function __construct() {
    //Here you can do any preparation required before calling the parent constructor, such as including additional files or initializing variables.

    //Call the parent constructor with the required arguments.
    parent::__construct (
      // The unique id for your widget.
      'claim-widget',

      // The name of the widget for display purposes.
      'Claim',

      // The $widget_options array, which is passed through to WP_Widget.
      // It has a couple of extras like the optional help URL, which should link to your sites help or support page.
      array(
        'description' => 'Claim - Módulo de la parte superior',
        'panels_groups' => array('fp-widgets'),
        'panels_icon' => 'dashicons dashicons-admin-page'
      ),

      //The $control_options array, which is passed through to WP_Widget
      array(

      ),

      //The $form_options array, which describes the form fields used to configure SiteOrigin widgets.
      array(
        'section_bg' => array(
          'type' => 'section',
          'label' => 'Fondo del módulo:',
          'hide' => false,
          'fields' => array(
            'bg_type' => array(
              'type'  => 'radio',
              'label' => 'Tipo de fondo',
              'options' => array(
                'image' => 'Imagen',
                'video' => 'Video',
              ),
              'default' => 'image',
              'state_emitter' => array(
                'callback' => 'select',
                'args' => array( 'bg_type' )
              ),
            ),
            'image_url' => array(
              'type' => 'media',
              'label' => 'Imagen',
              'library' => 'image',
              'fallback' => true,
              'required' => true,
              'state_handler' => array(
                'bg_type[image]' => array('show'),
                '_else[bg_type]' => array('hide')
              )
            ),
            'video_url' => array(
              'type' => 'text',
              'label' => 'Enlace del vídeo',
              'placeholder' => 'Por ejemplo, https://www.youtube.com/watch?v=XXXXXXXX o https://vimeo.com/XXXXXXXX',
              'default' => '',
              'required' => true,
              'state_handler' => array(
                'bg_type[video]' => array('show'),
                '_else[bg_type]' => array('hide')
              )
            ),
            'video_bg' => array(
              'type' => 'media',
              'label' => 'Imagen del video',
              'library' => 'image',
              'fallback' => true,
              'required' => true,
              'state_handler' => array(
                'bg_type[video]' => array('show'),
                '_else[bg_type]' => array('hide')
              )
            ),
            'video_modal' => array(
              'type' => 'checkbox',
              'default' => false,
              'label' => 'Incluir modal del video',
              'state_handler' => array(
                'bg_type[video]' => array('show'),
                '_else[bg_type]' => array('hide')
              ),
              'state_emitter' => array(
                'callback' => 'conditional',
                'args' => array(
                    'video_modal[on]: val == true',
                    'video_modal[off]: val == false'
                )
              ),
            ),
            'video_modal_text' => array(
              'type' => 'text',
              'label' => 'Texto del enlace al modal',
              'default' => '',
              'required' => true,
              'state_handler' => array(
                'video_modal[on]' => array('show'),
                '_else[video_modal]' => array('hide')
              )
            ),
            'veil' => array(
              'type' => 'checkbox',
              'default' => true,
              'label' => 'Incluir velo',
            )
          )
        ),
        'section_text' => array(
          'type' => 'section',
          'label' => 'Textos del módulo:',
          'hide' => false,
          'fields' => array(
            'claim' => array(
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
          'claim-widget',
          plugin_dir_url( __FILE__ ) . 'js/claim-widget-scripts.js',
          array( 'jquery' ),
          '1.0'
        )
      )
    );
  }

  function get_template_variables($instance) {
    $vars = [];
    $vars['bg_type'] = $instance['section_bg']['bg_type'];
    $vars['veil'] = $instance['section_bg']['veil'];
    $vars['claim'] = $instance['section_text']['claim'];
    $vars['text'] = $instance['section_text']['text'];
    $vars['cta_text'] = $instance['section_cta']['cta_text'];
    $vars['cta_url'] = sow_esc_url( $instance['section_cta']['cta_url'] );
    $vars['new_window'] = $instance['section_cta']['new_window'];

    if ($vars['bg_type'] == 'image'){
      $vars['image_url'] = '';

      $image = wp_get_attachment_image_src($instance['section_bg']['image_url'], 'full', false);
      if ($image) {
        $vars['image_url'] = $image[0];
      }
      else {
        $vars['image_url'] = $instance['section_bg']['image_url_fallback'];
      }
    }
    elseif ($vars['bg_type'] == 'video'){
      $vars['video_modal'] = $instance['section_bg']['video_modal'];
      $vars['video_url'] = $instance['section_bg']['video_url'];
      $vars['video_type'] = false;
      $vars['video_bg'] = '';
      $video_code = '';

      if ( strpos( $vars['video_url'] , 'youtube') != false ){
        $vars['video_type'] = 'youtube';
        $video_code = $this->getYoutubeId( $vars['video_url'] );
      }
      elseif ( strpos( $vars['video_url'] , 'vimeo') != false) {
        $vars['video_type'] = 'vimeo';
        $video_code = $this->getVimeoId( $vars['video_url'] );
      }
      else {
        $vars['video_url'] = false;
      }
      $vars['video_code'] = $video_code;

      $image = wp_get_attachment_image_src($instance['section_bg']['video_bg'], 'full', false);
      if ($image) {
        $vars['video_bg'] = $image[0];
      }
      else {
        $vars['video_bg'] = $instance['section_bg']['video_bg_fallback'];
      }

      if($vars['video_modal']){
        $vars['video_modal_text'] = $instance['section_bg']['video_modal_text'];
      }
    }

    return $vars;
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
    return 'claim-widget-template';
  }

  function get_style_name($instance) {
    return 'claim-widget-style';
  }
}
siteorigin_widget_register('claim-widget', __FILE__, 'Claim_Widget');
