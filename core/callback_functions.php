<?php
// register menu and register option in db

// exit if file is called directly
if ( ! defined( 'ABSPATH' ) ) {

	exit;
}
// option validate function

if( ! function_exists( 'vatovec_scroll_validate_options' )  ){
    function vatovec_scroll_validate_options(  $input ){

        $options_scroll_image = get_option( 'vatovec-scroll-option');

		// display scroll image to top
	if ( ! isset( $input['scroll_image_top'] ) ) {
		
		$input['scroll_image_top'] = null;
		
	};
	
	$input['scroll_image_top'] = ($input['scroll_image_top'] == 1 ? 1 : 0);

    	// display scroll image to bottom
	if ( ! isset( $input['scroll_image_bottom'] ) ) {
		
		$input['scroll_image_bottom'] = null;
		
	};
	
	$input['scroll_image_bottom'] = ($input['scroll_image_bottom'] == 1 ? 1 : 0);

    	// display scroll
	if ( ! isset( $input['display_on_admin'] ) ) {
		
		$input['display_on_admin'] = null;
		
	};
	
	$input['display_on_admin'] = ($input['display_on_admin'] == 1 ? 1 : 0);


    // wp_die(var_dump($input));
	return $input;
	}
}

if( ! function_exists( 'vatovec_scroll_validate_image_setup' )  ){
    function vatovec_scroll_image_setup(  $input ){

	// setup scroll image up
	if ( isset( $input['setup_scroll_image_up'] ) ) {
		
		$input['setup_scroll_image_up'] = sanitize_text_field( $input['setup_scroll_image_up'] );
		
	};
	// setup scroll image down
	if ( isset( $input['setup_scroll_image_down'] ) ) {
		
		$input['setup_scroll_image_down'] = sanitize_text_field( $input['setup_scroll_image_down'] );
		
	};
    // wp_die(var_dump($input));
	return $input;
	}
}


//  callback display funcions

// display the plugin menu page
if( ! function_exists( 'vatovec_scroll_callback_display_menu_page' )  ){
    function vatovec_scroll_callback_display_menu_page() {
        
        // check if user is allowed access
        if ( ! current_user_can( 'manage_options' ) ) return;
        

        $default_tab = 'main_page';
        $tab = isset($_GET['tab']) ? $_GET['tab'] : $default_tab;
        ?>
        
        <div class="wrap">
        <!-- Print the page title -->
            <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
            <!-- Here are our tabs -->
            <nav class="nav-tab-wrapper">
                <a href="?page=<?php echo VATOVEC_PLUGIN_SLUG ?>&tab=main_page" class="nav-tab <?php if($tab==='main_page'):?>nav-tab-active<?php endif; ?>">Main Page</a>
                <a href="?page=<?php echo VATOVEC_PLUGIN_SLUG ?>&tab=settings_page" class="nav-tab <?php if($tab==='settings_page'):?>nav-tab-active<?php endif; ?>">Settings Page</a>
            </nav>

        <div class="tab-content">		
        <form action="options.php" method="post">			
            <?php
                
                if( $tab == 'main_page' ) {		
                    
                        //output security fields
                        settings_fields( 'vatovec-scroll-option' );
                        // output setting sections
                        do_settings_sections( 'vatovec_scroll_main_page');                      
                } 	
                elseif ( $tab == 'settings_page' ) {			 
                         //output security fields
                         settings_fields( 'vatovec-scroll-image-option' );
                         // output setting sections                      
                         do_settings_sections( 'vatovec_scroll_setting_page' );             
                } 

                submit_button( 'Confirm changes', 'large' );					
            ?>
                
            </form>
        </div>
        
        <?php
        
    }
}

// display section main page
if( ! function_exists( 'vatovec_scroll_callback_display_section_main_page' )  ){
    function vatovec_scroll_callback_display_section_main_page(){ ?>
		<div>							
            <p><?php echo esc_html__('This plugin adds a scroll to top and bottom and allows the visitors to easily scroll back to the top or to the bottom of the page.', 'vatovec-scroll'); ?></p>
            <p><?php echo esc_html__('On this page you can activate and deactivate scroll to top and scroll to bottom and also whether the scroll should be shown on admin page', 'vatovec-scroll'); ?></p>						
	</div>
	<?php
	}
}

// display section settings
if( ! function_exists( 'vatovec_scroll_callback_display_section_settings_page' )  ){
    function vatovec_scroll_callback_display_section_settings_page(){ ?>
								
            <p><?php echo esc_html__('On this page you can chose what image you want to use as scroll to top and bottom icon', 'vatovec-scroll'); ?></p>
            <p><?php echo esc_html__('At the moment there is only couple images to chose between', 'vatovec-scroll'); ?></p>
       
	<?php
	}
}

//display settings for showing scroll to top arrow
if( ! function_exists( 'vatovec_scroll_callback_display_settings_up' )  ){
    function vatovec_scroll_callback_display_settings_up($args){
		$options = get_option( 'vatovec-scroll-option' );
		
		$id    = isset( $args['id'] )    ? $args['id']    : '';
		$label = isset( $args['label'] ) ? $args['label'] : '';
		
		$checked = isset( $options[$id] ) ? checked( $options[$id], 1, false ) : '';
		$scroll_status =  $checked  ? '<b> Active </b>' : '<b>Inactive</b>';
		
		echo '<input id="vatovec-scroll-option_'. $id .'" name="vatovec-scroll-option['. $id .']" type="checkbox" value="1"'. $checked .'> ';
		echo '<label for="vatovec-scroll-option_'. $id .'">'. $label .'</label>';
		echo '<br>';
		echo '<br>';
		echo '<br>';
		echo '<p>Scroll to top status: ' . $scroll_status . '</p>';
	}
}

//display settings for showing scroll to top arrow
if( ! function_exists( 'vatovec_scroll_callback_display_settings_bottom' )  ){
    function vatovec_scroll_callback_display_settings_bottom($args){
		$options = get_option( 'vatovec-scroll-option' );
		
		$id    = isset( $args['id'] )    ? $args['id']    : '';
		$label = isset( $args['label'] ) ? $args['label'] : '';
		
		$checked = isset( $options[$id] ) ? checked( $options[$id], 1, false ) : '';
		$scroll_status =  $checked  ? '<b> Active </b>' : '<b>Inactive</b>';
		
		echo '<input id="vatovec-scroll-option_'. $id .'" name="vatovec-scroll-option['. $id .']" type="checkbox" value="1"'. $checked .'> ';
		echo '<label for="vatovec-scroll-option_'. $id .'">'. $label .'</label>';
		echo '<br>';
		echo '<br>';
		echo '<br>';
		echo '<p>Scroll to top status: ' . $scroll_status . '</p>';
	}
}



//display settings for showing scroll to to arrow on admin page
if( ! function_exists( 'vatovec_scroll_callback_display_scroll_on_admin' )  ){
    function vatovec_scroll_callback_display_scroll_on_admin($args){
		$options = get_option( 'vatovec-scroll-option' );        
		
		$id    = isset( $args['id'] )    ? $args['id']    : '';
		$label = isset( $args['label'] ) ? $args['label'] : '';
		
		$checked = isset( $options[$id] ) ? checked( $options[$id], 1, false ) : '';
       
            $scroll_on_admin = $checked ? '<b> Shown </b>' : '<b>Not Shown </b>';
        	
		if ( $options['scroll_image_top'] || $options['scroll_image_bottom']) {
            echo '<input id="vatovec-scroll-option_'. $id .'" name="vatovec-scroll-option['. $id .']" type="checkbox" value="1"'. $checked .'> ';
            echo '<label for="vatovec-scroll-option_'. $id .'">'. $label .'</label>';
            echo '<br>';
            echo '<br>';
            echo '<br>';
            echo '<p>Scroll to top is: ' . $scroll_on_admin . ' on admin page</p>';
            
        }
		
	}
}

//display settings for up arrow
if( ! function_exists( 'vatovec_scroll_callback_display_setup_up_scroll_image' )  ){
    function vatovec_scroll_callback_display_setup_up_scroll_image($args){
        
        $user = wp_get_current_user();
        $allowed_roles = array( 'editor', 'administrator', 'author' );
        if ( array_intersect( $allowed_roles, $user->roles ) ) {
                $options = get_option( 'vatovec-scroll-image-option' );        
                
                $id    = isset( $args['id'] )    ? $args['id']    : '';
                $label = isset( $args['label'] ) ? $args['label'] : '';

                $selected_option = isset( $options[$id] ) ? sanitize_text_field( $options[$id] ) : '';
            
                $arrow_up_images_path = VATOVEC_SCROLL_DIR.'assets/images/arrow-up/';
                $files_in_arrowup_folder = list_files( $arrow_up_images_path );
               
            foreach($files_in_arrowup_folder as $filename){
                    
                    $scroll_up_image_filename = basename($filename);                    
                    $scroll__up_image_alt = $scroll_up_image_filename;
                    $scroll__up_img_path =  VATOVEC_SCROLL_PATH."assets/images/arrow-up/".$scroll_up_image_filename;
                    $scroll__up_image = sprintf('<img src="%s" alt="%s" />', $scroll__up_img_path, $scroll__up_image_alt);
                    
                    $checked_up = checked( $selected_option === $scroll_up_image_filename, true, false );
                    
                    echo '<br /><br /><label><input name="vatovec-scroll-image-option['. $id .']" type="radio" value="'. $scroll_up_image_filename .'"'. $checked_up .'> ';
                    echo '<span>'. $label .'</span>';
                    echo '<div class="scroll-image-container" >'. $scroll__up_image.'</div></label>';
                    
                }    
      
    } else {
        echo '<span>YOU DO NOT HAVE SUFFICIENT PRIVILAGES</span>';
    }
			
   }
}

//display settings for down arrow
if( ! function_exists( 'vatovec_scroll_callback_display_setup_down_scroll_image' )  ){
    function vatovec_scroll_callback_display_setup_down_scroll_image($args){
        
        $user = wp_get_current_user();
        $allowed_roles = array( 'editor', 'administrator', 'author' );
        if ( array_intersect( $allowed_roles, $user->roles ) ) {
                $options = get_option( 'vatovec-scroll-image-option' );        
                
                $id    = isset( $args['id'] )    ? $args['id']    : '';
                $label = isset( $args['label'] ) ? $args['label'] : '';

                $selected_option = isset( $options[$id] ) ? sanitize_text_field( $options[$id] ) : '';
            
                $arrow_down_images_path = VATOVEC_SCROLL_DIR.'assets/images/arrow-down/';
                $files_in_arrowdown_folder = list_files( $arrow_down_images_path );
               
            foreach($files_in_arrowdown_folder as $filename){
                    
                    $scroll_down_image_filename = basename($filename);
                    $scroll_down_image_alt = $scroll_down_image_filename ;
                    $scroll_down_img_path =  VATOVEC_SCROLL_PATH."assets/images/arrow-down/".$scroll_down_image_filename;
                    $scroll_down_image = sprintf('<img src="%s" alt="%s" />', $scroll_down_img_path, $scroll_down_image_alt);
                    
                    $checked_down = checked( $selected_option === $scroll_down_image_filename, true, false );
                    
                    echo '<br /><br /><label><input name="vatovec-scroll-image-option['. $id .']" type="radio" value="'. $scroll_down_image_filename .'"'. $checked_down .'> ';
                    echo '<span>'. $label .'</span>';
                    echo '<div class="scroll-image-container" >'. $scroll_down_image.'</div></label>';
                    
                }              
     
    } else {
        echo '<span>YOU DO NOT HAVE SUFFICIENT PRIVILAGES</span>';
    }
			
   }
}


