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

// Отключаем сам REST API
add_filter('rest_enabled', '__return_false');
// Отключаем фильтры REST API
remove_action( 'xmlrpc_rsd_apis',            'rest_output_rsd' );
remove_action( 'wp_head',                    'rest_output_link_wp_head', 10, 0 );
remove_action( 'template_redirect',          'rest_output_link_header', 11, 0 );
remove_action( 'auth_cookie_malformed',      'rest_cookie_collect_status' );
remove_action( 'auth_cookie_expired',        'rest_cookie_collect_status' );
remove_action( 'auth_cookie_bad_username',   'rest_cookie_collect_status' );
remove_action( 'auth_cookie_bad_hash',       'rest_cookie_collect_status' );
remove_action( 'auth_cookie_valid',          'rest_cookie_collect_status' );
remove_filter( 'rest_authentication_errors', 'rest_cookie_check_errors', 100 );
// Отключаем события REST API
remove_action( 'init',          'rest_api_init' );
remove_action( 'rest_api_init', 'rest_api_default_filters', 10, 1 );
remove_action( 'parse_request', 'rest_api_loaded' );
// Отключаем Embeds связанные с REST API
remove_action( 'rest_api_init',          'wp_oembed_register_route'              );
remove_filter( 'rest_pre_serve_request', '_oembed_rest_pre_serve_request', 10, 4 );
remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
// если собираетесь выводить вставки из других сайтов на своем, то закомментируйте след. строку.
remove_action( 'wp_head',                'wp_oembed_add_host_js'                 );



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
    // if( is_front_page() || is_page('prajs-list')){
    	// /home/jetfire/www/gbo.dev/wp-content/themes/gbo/js/waves/waves.min.js
    	wp_enqueue_script('waves-js', get_template_directory_uri()."/js/waves/waves.min.js",array('jquery'),'',true);
   	   wp_enqueue_style( 'waves-css', get_template_directory_uri()."/js/waves/waves.css");
    // }
       wp_enqueue_script('owl-carousel',get_template_directory_uri()."/js/owl-carousel/owl.carousel.min.js",'','',true);
       wp_enqueue_script('a21_main', get_template_directory_uri()."/js/scripts.js",'','',true);
        wp_localize_script('a21_main', 'a21_myajax', 
        array(
            'url' => admin_url('admin-ajax.php'),
            'gal_nonce' => wp_create_nonce('a21_cr_gal-nonce')
        )
    );  

}




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



/* *************************** */



add_action('wp_ajax_a21_get_gal_cars', 'a21_get_gal_cars');
add_action('wp_ajax_nopriv_a21_get_gal_cars', 'a21_get_gal_cars');

function a21_get_gal_cars(){
        ?>
        <?php

        $brand = sanitize_text_field($_POST['brand']);
        $nonce = $_POST['nonce'];
        if( empty($brand) || !wp_verify_nonce( $nonce, 'a21_cr_gal-nonce')) exit("<p>Для данной категории материалов нет!</p>");
        // if( !wp_verify_nonce( $nonce, 'a21_cr_gal-nonce')) exit("<p>Для данной категории материалов нет!</p>");

        // // $slug = "bmw";
        $slug = $brand;
        $cat_id = get_cat_ID( $slug );

        $args = array(
            'posts_per_page' => 2,
            'cat' => $cat_id,
        );

        $query = new WP_Query( $args );

        if ( $query->have_posts() ) {
            while ( $query->have_posts() ) {
                $query->the_post();
                $post_id = get_the_ID();
                global $wpdb;
                $img_url = $wpdb->get_var("SELECT `meta_value` FROM {$wpdb->prefix}postmeta WHERE post_id='{$post_id}'");

                $html = '<div class="work-item '.$slug.'" >
                        <div class="col-md-4"><img class="img-responsive" src="'.$img_url.'" alt=""></div>
                        <div class="col-md-8 work-slides">
                                <h2>'.get_the_title().'</h2>'.
                                get_the_content().'
                        </div>
                        </div>';
                echo $html;

                // echo json_encode($html);

               // echo "<hr>$i"; $i++;
            }
        } else {
            echo "<p>Постов не найдено<p>";
        }
        /* Возвращаем оригинальные данные поста. Сбрасываем $post. */
        wp_reset_postdata();
        // echo $slug;
        exit;
}