<?php
// register menu and register option in db

// exit if file is called directly
if ( ! defined( 'ABSPATH' ) ) {

	exit;
}

$options_scroll_check = get_option( 'vatovec-scroll-option');

if ($options_scroll_check['display_on_admin']) {
    add_action('admin_footer',  'vatovec_scroll_generate_scroll', 100);
}
    add_action( 'wp_footer', 'vatovec_scroll_generate_scroll', 100 );


function vatovec_scroll_generate_scroll() {

    $options_scroll = get_option( 'vatovec-scroll-option');
    $options_scroll_img = get_option( 'vatovec-scroll-image-option');

    //scroll imgae up
    if(isset( $options_scroll_img['setup_scroll_image_up'] ) && !empty( $options_scroll_img['setup_scroll_image_up'] )){
    $scroll_img_alt = 'scroll image up';
    $img_path = VATOVEC_SCROLL_PATH."assets/images/arrow-up/".$options_scroll_img['setup_scroll_image_up'];
    $scroll_img_up = sprintf('<img src="%s" alt="%s" />', $img_path, $scroll_img_alt);
    // wp_die(var_dump($scroll_img));
    } else {
        $scroll_img_alt = 'scroll image up';
        $img_path = VATOVEC_SCROLL_PATH."assets/images/arrow-up/black1.png";
        $scroll_img_up = sprintf('<img src="%s" alt="%s" />', $img_path, $scroll_img_alt);
    }
    // down arrow
    if(isset( $options_scroll ) && !empty( $options_scroll )){
      $scroll_show_up =  $options_scroll['scroll_image_top'] ? '<div class="vatovecScrollToTop">'. $scroll_img_up .'</div>' : '';
    //   wp_die(var_dump($scroll_show));
    echo $scroll_show_up;

    if(isset( $options_scroll_img['setup_scroll_image_down'] ) && !empty( $options_scroll_img['setup_scroll_image_down'] )){
        $scroll_img_alt = 'scroll image down';
        $img_path_down = VATOVEC_SCROLL_PATH."assets/images/arrow-down/".$options_scroll_img['setup_scroll_image_down'];
        $scroll_img_down = sprintf('<img src="%s" alt="%s" />', $img_path_down, $scroll_img_alt);
        // wp_die(var_dump($scroll_img));
        } else {
            $scroll_img_alt = 'scroll image down';
            $img_path_down = VATOVEC_SCROLL_PATH."assets/images/arrow-down/black1.png";
            $scroll_img_down = sprintf('<img src="%s" alt="%s" />', $img_path_down, $scroll_img_alt);
        }

    $scroll_show_down =  $options_scroll['scroll_image_bottom'] ? '<div class="vatovecScrollToBottom">'. $scroll_img_down .'</div>' : '';
    //   wp_die(var_dump($scroll_show));
    echo $scroll_show_down;
    }
}
