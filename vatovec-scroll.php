<?php
/*
Plugin Name: Vatovec Scroll to Top and Bottom
Description: Adds a scroll to top and bottom which allows the visitors to easily scroll back to the top or the bottom of the page.
Plugin URI:  https://plugin-planet.com/
Author:      Boris Vatovec
Requires at least: 5.2
Requires PHP:      7.2
Version:     1.0
Text Domain:  vatovec-scroll
Domain Path:  /languages
License:     GPLv2 or later

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version
2 of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
with this program. If not, visit: https://www.gnu.org/licenses/
*/


// exit if file is called directly
if ( ! defined( 'ABSPATH' ) ) {

	exit;

}

const VATOVEC_PLUGIN_SLUG = 'vatovec-scroll-top';
define('VATOVEC_SCROLL_DIR', plugin_dir_path( __FILE__ ) );
define('VATOVEC_SCROLL_PATH', plugin_dir_url(__FILE__));

require_once VATOVEC_SCROLL_DIR . 'core/register_menu.php';
require_once VATOVEC_SCROLL_DIR . 'core/callback_functions.php';
require_once VATOVEC_SCROLL_DIR . 'core/generate_scroll.php';
	


// load text domain
function vatovec_scroll_load_textdomain() {
	
	load_plugin_textdomain( 'vatovec-scroll', false, plugin_dir_path( __FILE__ ) . 'languages/' );
	
}
add_action( 'plugins_loaded', 'vatovec_scroll_load_textdomain' );

function vatovec_scroll_add_plugins_page_settings_link( $links ) {
	$links[] = '<a href="' .menu_page_url(VATOVEC_PLUGIN_SLUG , FALSE) .'">' . __('Settings', 'vatovec-scroll-top') . '</a>';
	
	return $links;
}

add_filter('plugin_action_links_'.plugin_basename(__FILE__), 'vatovec_scroll_add_plugins_page_settings_link');



// Adding css to scroll to top

if( ! function_exists( 'vatovec_scroll_css') ) {
    function vatovec_scroll_css () {
        wp_enqueue_style( 'vatovec-scroll-css', plugin_dir_url(__FILE__). 'assets/css/vatovec-scroll-style.css' );  
    }

	if (is_admin()) {
		add_action( 'admin_enqueue_scripts', 'vatovec_scroll_css' );
	} else {
		add_action( 'wp_enqueue_scripts', 'vatovec_scroll_css' ); 
	}   
}

// Adding js scripts to control scroll to top behaviour

if( ! function_exists( 'vatovec_scroll_scripts') ) {
    function vatovec_scroll_scripts () {      
           
        wp_enqueue_script( 'vatovec-scroll-js',  plugin_dir_url(__FILE__). 'assets/js/vatovec-scroll.js', array('jquery' ), false, true );
	    
        
    }

    // add_action( 'wp_enqueue_scripts', 'vatovec_scroll_scripts' ); 
}

$options_scroll_check = get_option('vatovec-scroll-option');

if ($options_scroll_check['display_on_admin']) {

	if (is_admin()) {
		add_action( 'admin_enqueue_scripts', 'vatovec_scroll_scripts' );
	} 	
} 

if ($options_scroll_check['scroll_image_top'] || $options_scroll_check['scroll_image_bottom'] ) {
	if (!is_admin()) {
		add_action( 'wp_enqueue_scripts', 'vatovec_scroll_scripts' ); 
	  } 
	} 


// remove options on uninstall
function vatovec_scroll_on_uninstall() {

	if ( ! current_user_can( 'activate_plugins' ) ) return;

	delete_option( 'vatovec-scroll-option' );
	delete_option( 'vatovec-scroll-image-option' );

}
register_uninstall_hook( __FILE__, 'vatovec_scroll_on_uninstall' );




