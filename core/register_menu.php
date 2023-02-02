<?php
// register menu and register option in db

// exit if file is called directly
if ( ! defined( 'ABSPATH' ) ) {

	exit;
}

// register top level menu page
if( ! function_exists( 'vatovec_scroll_toplevel_menu' )  ){
    function vatovec_scroll_toplevel_menu(){						
				add_menu_page(
					esc_attr__('Vatovec Scroll To Top', 'vatovec-scroll'),
				    esc_attr__(	'Vatovec Scroll', 'vatovec-scroll'),
					'manage_options',
					VATOVEC_PLUGIN_SLUG,
					'vatovec_scroll_callback_display_menu_page',
					'dashicons-move',
					0
				);
    }


add_action( 'admin_menu', 'vatovec_scroll_toplevel_menu' );
}



// register option in db
if( ! function_exists( 'vatovec_scroll_register_settings' )  ){
function vatovec_scroll_register_settings(){
	register_setting( 
		'vatovec-scroll-option', 
		'vatovec-scroll-option', 
		'vatovec_scroll_validate_options' 
	); 

    register_setting( 
		'vatovec-scroll-image-option', 
		'vatovec-scroll-image-option', 
		'vatovec_scroll_validate_image_setup' 
	); 

// create section for main page
        add_settings_section( 
            'vatovec_scroll_section_main_page', 
            esc_attr__('Set Scroll Visibility', 'vatovec-scroll'),
            'vatovec_scroll_callback_display_section_main_page', 
            'vatovec_scroll_main_page'
        );

// create section for settings page
        add_settings_section( 
            'vatovec_scroll_section_setting_page', 
            esc_attr__('Customize Scroll Settings', 'vatovec-scroll'),
            'vatovec_scroll_callback_display_section_settings_page', 
            'vatovec_scroll_setting_page'
        );


    //create settings field to display scroll to top image or not
        add_settings_field(
            'vatovec_scroll_display_settings',
            esc_attr__('Display Scroll to Top', 'vatovec-scroll'),
            'vatovec_scroll_callback_display_settings_up',
            'vatovec_scroll_main_page',
            'vatovec_scroll_section_main_page',
            [ 'id' => 'scroll_image_top', 'label' => 'Add and Remove scroll to top' ]		
        );

      //create settings field to display scroll to bottom image or not
      add_settings_field(
        'vatovec_scroll_display_settings_bottom',
        esc_attr__('Display Scroll to Bottom', 'vatovec-scroll'),
        'vatovec_scroll_callback_display_settings_bottom',
        'vatovec_scroll_main_page',
        'vatovec_scroll_section_main_page',
        [ 'id' => 'scroll_image_bottom', 'label' => 'Add and Remove scroll to bottom' ]		
    );

    //create settings field to display scroll image on admin page
         add_settings_field(
                'vatovec_scroll_display_scroll_on_admin',
                esc_attr__('Display Scroll on Admin Page', 'vatovec-scroll'),
                'vatovec_scroll_callback_display_scroll_on_admin',
                'vatovec_scroll_main_page',
                'vatovec_scroll_section_main_page',
                [ 'id' => 'display_on_admin', 'label' => 'Display Scroll on Admin Page' ]		
            ); 

    //create settings field to setup scroll image up
         add_settings_field(
            'vatovec_scroll_setup_scroll_image_up',
            esc_attr__('Setup Scroll Image Up', 'vatovec-scroll'),
            'vatovec_scroll_callback_display_setup_up_scroll_image',
            'vatovec_scroll_setting_page',
            'vatovec_scroll_section_setting_page',
            [ 'id' => 'setup_scroll_image_up', 'label' => 'Select scroll image for up arrow' ]		
        ); 
    //create settings field to setup scroll image down
         add_settings_field(
            'vatovec_scroll_setup_scroll_image_down',
            esc_attr__('Setup Scroll Image Down', 'vatovec-scroll'),
            'vatovec_scroll_callback_display_setup_down_scroll_image',
            'vatovec_scroll_setting_page',
            'vatovec_scroll_section_setting_page',
            [ 'id' => 'setup_scroll_image_down', 'label' => 'Select scroll image for down arrow ' ]		
        ); 

    }

    add_action( 'admin_init', 'vatovec_scroll_register_settings' );
}