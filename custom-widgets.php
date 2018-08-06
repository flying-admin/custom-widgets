<?php

/*
Plugin Name: Custom Widgets for SiteOrigin
Description: Custom Widgets for SiteOrigin Widgets Bundle
Version: 1.0
Author: Flying Pigs
Author URI: http://flyingpigs.es
*/

function custom_widgets ($folders){
	$folders[] = plugin_dir_path(__FILE__).'widgets/';
	return $folders;
}
add_filter( 'siteorigin_widgets_widget_folders', 'custom_widgets' );
