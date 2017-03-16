<?php

show_admin_bar(false);

remove_action('wp_head', 'wp_generator');
remove_action( 'wp_head', 'feed_links_extra', 3 ); 
remove_action( 'wp_head', 'feed_links', 2 );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'index_rel_link' );
remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 ); 
remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 );
remove_action('wp_head', 'wp_shortlink_wp_head');
//отключение xml-rpc
add_filter('xmlrpc_enabled', '__return_false');



register_nav_menus( array(
  'loc_menu' => 'top-menu',
  'loc_menu2' => 'foot-menu'
) );

function breadcrumbs($separator = ' » ', $home = 'Главная') {

	$path = array_filter(explode('/', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)));
	$base_url = ($_SERVER['HTTPS'] ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/';
	$breadcrumbs = array("<a href=\"$base_url\">$home</a>");

	$last = end( array_keys($path) );

	foreach( $path as $x => $crumb ){
		$title = ucwords(str_replace(array('.php', '_'), Array('', ' '), $crumb));
		if( $x != $last ){
			$breadcrumbs[] = '<a href="'.$base_url.$crumb.'">'.$title.'</a>';
		}
		else {
			$breadcrumbs[] = $title;
		}
	}

	return implode( $separator, $breadcrumbs );
}

add_action( 'wp_enqueue_scripts', 'css_js_for_theme' );
function css_js_for_theme(){
  wp_deregister_script( 'jquery' );
   wp_enqueue_script('jquery', get_template_directory_uri()."/js/jquery-1.12.4.min.js",'','',true);

   if( is_page('fotogalereya')){ 
   	   wp_enqueue_style( 'lightbox-css', get_template_directory_uri()."/libs/lightbox/css/lightbox.min.css");
       wp_enqueue_script('lightbox-js', get_template_directory_uri()."/libs/lightbox/js/lightbox.min.js",array('jquery'),'',true);
    }
    if( is_front_page() || is_page('prajs-list')){
    	// /home/jetfire/www/gbo.dev/wp-content/themes/gbo/js/waves/waves.min.js
    	wp_enqueue_script('waves-js', get_template_directory_uri()."/js/waves/waves.min.js",array('jquery'),'',true);
   	   wp_enqueue_style( 'waves-css', get_template_directory_uri()."/js/waves/waves.css");
    }
}


/* ********** */

add_action( 'admin_init', 'alex21_register_settings' );
/*  Register settings */
function alex21_register_settings() 
{
    register_setting( 
        'general', 
        'option_address',
        'esc_html' // <--- Customize this if there are multiple fields
    );
    register_setting( 
        'general', 
        'option_phone',
        'esc_html' // <--- Customize this if there are multiple fields
    );
    // add_settings_section( 
    //     'site-guide', 
    //     'Name section', 
    //     '__return_false', 
    //     'general' 
    // );
    add_settings_field( 
        'phone_id', 
        'Телефон:', 
        'alex21_add_html_for_option_phone', 
        'general'
        // 'site-guide' 
    );
    add_settings_field( 
        'address_id', 
        'Адрес:', 
        'alex21_add_html_for_option', 
        'general'
        // 'site-guide' 
    );
}    
/* Print settings field content */
function alex21_add_html_for_option_phone() 
{
    $value = html_entity_decode (get_option( 'option_phone' ));
    echo '<input type="text" class="regular-text" id="phone_id" name="option_phone" value="' . esc_attr( $value ) . '"/>';
}
function alex21_add_html_for_option() 
{
    $value = html_entity_decode (get_option( 'option_address' ));
    echo '<textarea class="large-text code" id="address_id" name="option_address">' . esc_attr( $value ) . '</textarea>';
}