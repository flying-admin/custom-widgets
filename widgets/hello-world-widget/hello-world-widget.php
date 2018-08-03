<?php

/*
Widget Name: Hello World Widget
Description: An example widget'.
Author: Flyingpigs
Author URI: http://flyingpigs.es
*/

class Hello_World_Widget extends SiteOrigin_Widget {
	function __construct() {
    //Here you can do any preparation required before calling the parent constructor, such as including additional files or initializing variables.

    //Call the parent constructor with the required arguments.
    parent::__construct (
      // The unique id for your widget.
      'hello-world-widget',

      // The name of the widget for display purposes.
      __('Hello World Widget', 'hello-world-widget'),

      // The $widget_options array, which is passed through to WP_Widget.
      // It has a couple of extras like the optional help URL, which should link to your sites help or support page.
      array(
          'description' => __('A hello world widget.', 'hello-world-widget')
      ),

      //The $control_options array, which is passed through to WP_Widget
      array(

      ),

      //The $form_options array, which describes the form fields used to configure SiteOrigin widgets. We'll explain these in more detail later.
      array(
					'image_url' => array(
						'type' => 'media',
						'label' => __('Image file', 'flyingpigs-custom-widgets'),
						'library' => 'image',
						'fallback' => true,
					),
          'title' => array(
              'type' => 'text',
              'label' => __('Title', 'flyingpigs-custom-widgets'),
              'default' => ''
          ),
					'show_text' => array(
						'type' => 'checkbox',
						'default' => true,
						'label' => __('Show text', 'flyingpigs-custom-widgets'),
					),
          'text' => array(
              'type' => 'text',
              'label' => __('Text', 'flyingpigs-custom-widgets'),
              'default' => ''
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
					'hello-world-widget',
					plugin_dir_url( __FILE__ ) . 'js/hello-world-widget.js',
					array( 'jquery' ),
					'1.0'
				)
			)
		);
	}

	function get_template_variables($instance) {
		$vars = [];
		$vars['title'] = $instance['title'];
		$vars['text'] = $instance['text'];
		$vars['show_text'] = $instance['show_text'];
		$vars['image_url'] = '';

		$image = wp_get_attachment_image_src($instance['image_url'], 'full', false);
		if ($image){
			$vars['image_url'] = $image[0];
		}
		else {
			$vars['image_url'] = $instance['image_url_fallback'];
		}

		return $vars;
	}

	function get_template_name($instance) {
		return 'hello-world-widget-template';
	}

	function get_style_name($instance) {
		return 'hello-world-widget-style';
	}
}

siteorigin_widget_register('hello-world-widget', __FILE__, 'Hello_World_Widget');
