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



// add_action("init","a21_test",999);
function a21_test(){

/* парсинг сайта с простой авторизацией,скрипт эмулиреут браузер,отрпвляет все заголовки:язык,юзер агент и т.д
работает на:
модифицирован: переходит последовательно на 3 страницы и формирует готоый html на выходе
 */

header("content-type: text/html;charset=utf-8");
ini_set('error_reporting', E_ALL);

// require_once "phpQuery-onefile.php";
require_once('phpQuery.php');

$domen = "http://gbo.dev";
$url = "http://rg.dev/parser/parser_works.php";

//замеряем время начала работы скрипта
$st_time =  microtime(true);

function get_result($url){

    $ch = curl_init();
    $headers = [
        'User-Agent: Mozilla/5.0 (Windows NT 6.1; WOW64; rv:35.0) Gecko/20100101 Firefox/35.0',
        'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
        'Accept-Language: ru-RU,ru;q=0.8,en-US;q=0.5,en;q=0.3',
        'Origin:https://freelance.ru',
        'Referer:https://freelance.ru/login/',
        'Connection: keep-alive'
    ];

    $referer = "http://www.gazunas.ru/models/";

    $post_fields = array(
                     "login" => "oenomaus2013",
                    "passwd" => "4265082109z",
                     "submit" => "Вход",
                    "auth" => "auth",
                    "return_url" => "/login/"
                    ); 

    $cookie = dirname(__FILE__)."/cookie.txt";
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_HTTPHEADER,$headers);
    // curl_setopt ($ch, CURLOPT_REFERER, $referer);
    curl_setopt($ch,CURLOPT_COOKIEJAR,$cookie);
    curl_setopt($ch,CURLOPT_COOKIEFILE,$cookie);
    // curl_setopt($ch,CURLOPT_COOKIESESSION,trues);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); // следовать за редиректами
    curl_setopt($ch, CURLOPT_FAILONERROR, 1);
    curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// просто отключаем проверку сертификата
    curl_setopt($ch, CURLOPT_POST, 0); // использовать данные в post
    // curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);

    $res = curl_exec($ch);
    if(curl_error($ch))
        {
        echo "\n\ncURL error:" . curl_error($ch);
        echo "\n\ncURL error:" . curl_errno($ch);
        //$flagerrcurl = true;
        }

    return $res;
}

function translit($str) {
    $rus = array('А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я', 'а', 'б', 'в', 'г', 'д', 'е', 'ё', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'ь', 'э', 'ю', 'я',' ','(',')','.');
    $lat = array('A', 'B', 'V', 'G', 'D', 'E', 'E', 'Gh', 'Z', 'I', 'Y', 'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'F', 'H', 'C', 'Ch', 'Sh', 'Sch', 'Y', 'Y', 'Y', 'E', 'Yu', 'Ya', 'a', 'b', 'v', 'g', 'd', 'e', 'e', 'gh', 'z', 'i', 'y', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'h', 'c', 'ch', 'sh', 'sch', 'y', 'y', 'y', 'e', 'yu', 'ya','-','','','');
    return str_replace($rus, $lat, $str);
  }

function parser($domen, $url, $p1_count, $count_cars_brand){

    $p1 = 1;
    echo "<hr><h2>Перебор всех элементов в цикле</h2><br>\r\n";
    phpQuery::newDocument( get_result($url) );
    $page = pq('.work-item');

    // echo $work_item = $page->html();
     // echo "<hr>";
     // echo $cl_parent = $page->attr("class");
     // echo "<hr>";
     $p2 = 1;
     foreach ($page as $item) {

        if($p1 < $p1_count){

            global $wpdb;
            echo "<hr>p1=".$p1."===========================";
            echo "<br>";

             $wrap_car_item = pq($item);

             // получаем имя класса родителя...work-item bmw
             $class_parent = $wrap_car_item->attr("class");
             $brand = explode(" ", $class_parent);
             // echo $brand[1];
             echo "<br>";
             // echo $wpdb->prefix;

             // если нечетное число то есть 1,3
             echo "нечет ".$p1 % $count_cars_brand;
             if($p1 % $count_cars_brand != 0){

                    echo "p1- ".$p1; echo "<br>";
                     $brand_slug = $wpdb->get_var( "SELECT slug FROM `{$wpdb->prefix}terms` WHERE slug='{$brand[1]}'");
                     echo "777=== ".$brand_slug;
                    $insert_brand = "INSERT INTO `{$wpdb->prefix}terms` ( `name`, `slug`, `term_group`) VALUES ('".mb_strtoupper($brand[1])."', '".$brand[1]."', '0')";
                    // echo $insert_brand;
                    if($brand_slug != $brand[1]) {$wpdb->query($insert_brand);}

                    // echo '<br>';
                    // echo "<b>last query:</b> ".$wpdb->last_query."<br>";
                    // echo "<b>last result:</b> "; print_r($wpdb->last_result);
                    // echo "<br><b>last error:</b> "; print_r($wpdb->last_error);
                    // echo '<br>';

                    echo "<hr>";
                    $last_brand_id = $wpdb->get_var( "SELECT MAX(`term_id`) FROM `{$wpdb->prefix}terms`");

                    echo "brand_id= ".$last_brand_id;
                    echo "<br>";
                    $insert_cat = "INSERT INTO `{$wpdb->prefix}term_taxonomy` (`term_id`, `taxonomy`, `description`, `parent`, `count`) VALUES ('{$last_brand_id}', 'category', '', '3', '2')";
                    //  echo $insert_cat;

                    $wpdb->query($insert_cat);
                    echo "<hr>";
             }

              $desc = $wrap_car_item->find("p");
             $slider = $wrap_car_item->find(".a21_slider_item")->html();
             $title = $wrap_car_item->find("h2")->text();
             $title_url = strtolower(translit($title));
            $content = $desc.'<div class="a21_slider_item">'.$slider.'</div>';
              echo "<hr>";
           // echo $last_post_id = $wpdb->get_var( "SELECT MAX(`ID`) FROM {$wpdb->posts} WHERE post_type='post'");

            // ! может быть проблема в случае когда автоинкримент 1,2,3 next 10  а вернет 3
            // $last_post_id = $wpdb->get_var( "SELECT MAX(`ID`) FROM {$wpdb->posts}");
            $get_id = $wpdb->get_row("SHOW TABLE STATUS LIKE '{$wpdb->posts}'"); 
            $last_post_id = $get_id->Auto_increment;

            // var_dump($last_post_id1);
            // $last_post_id2 = $last_post_id+$p1;
            // $last_post_id3 = 30+$pi;
            // echo "<br>last_post_id ====== ".$last_post_id1." ".$last_post_id2." ".$last_post_id3."<br>";
            echo "last_post_id";
            echo $last_post_id;
            echo "<br>";
             

             // почему то с этим не работает
             // $content = str_replace("\"", "&quot;", $content);
             $content = str_replace("\n", "", $content);
             $content = str_replace("  ", "", $content);
             // echo $content = str_replace("\"", "quot", $content);
             $content = str_replace("\"", "", $content);

            // echo $content = mysql_real_escape_string($content);

            // проблема дублирования 100 постов связана с html content,а именно с " и '

           $insert_post = "INSERT INTO $wpdb->posts (`post_author`, `post_content`, `post_title`, `post_name`, `post_type`,`guid`) VALUES 
           ('2', '{$content}', '{$title}','{$title_url}', 'post','{$last_post_id}')";
            /* 
            $insert_post = $wpdb->prepare("INSERT INTO $wpdb->posts (`ID`,`post_author`, `post_date`, `post_date_gmt`, `post_content`, `post_title`, `post_excerpt`, `post_status`, `comment_status`, `ping_status`, `post_password`, `post_name`, `to_ping`, `pinged`, `post_modified`, `post_modified_gmt`, `post_content_filtered`, `post_parent`, `guid`, `menu_order`, `post_type`, `post_mime_type`, `comment_count`) VALUES (%d,'2', '2017-03-22 12:07:36', '2017-03-22 09:07:36', %s, %s, '', 'publish', 'open', 'open', '', %s, '', '', '2017-03-22 12:07:36', '2017-03-22 09:07:36', '', '0', %s, '0', 'post', '', '0')",$last_post_id,$content,$title,$title_url,"http://{$_SERVER['HTTP_HOST']}/?p={$last_post_id}");
            */

            $wpdb->query($insert_post);
            echo "===<br>==запрос к базе- $p1 ==<br>";
             
             // echo $insert_post;
             // echo " wp_func_lastid ".$lastid = $wpdb->insert_id;


            echo '<br>';
            // echo "<b>last query:</b> ".$wpdb->last_query."<br>";
            // echo "<b>last result:</b> "; print_r($wpdb->last_result);
            echo "<br><b>last error:</b> "; print_r($wpdb->last_error);
            echo '<hr>';

            //  echo "<hr>";
            
            //echo $l_id = "SELECT 'AUTO_INCREMENT' FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA='gbo' AND TABLE_NAME ='{$wpdb->prefix}term_taxonomy'";
            // $l_id = $wpdb->query($l_id);
            // $l_id = $wpdb->get_row($l_id);
            // $get_id = $wpdb->get_row("SHOW TABLE STATUS LIKE '{$wpdb->prefix}term_taxonomy'"); 
            // $last_term_id = $get_id->Auto_increment;
            $term_id = "SELECT term_id FROM {$wpdb->prefix}terms WHERE slug='".$brand[1]."'";
            echo "--------------var dup  ";print_r( $wpdb->get_results("SELECT * FROM {$wpdb->prefix}terms") );
            echo "---------<hr>";
            $term_id = $wpdb->get_var($term_id);
            $taxon_id = "SELECT term_taxonomy_id FROM {$wpdb->prefix}term_taxonomy WHERE term_id='{$term_id}'";
            $taxon_id = $wpdb->get_var($taxon_id);
            echo " term ".$term_id." taxon".$taxon_id."<br>";
            var_dump($term_id);
            // $next_id = $last_id + 1;
            // echo "<br>";
            // var_dump($l_id);
            // echo "<br>";
            // $last_term_taxon_id = $wpdb->get_var( "SELECT MAX(`term_taxonomy_id`) FROM `{$wpdb->prefix}term_taxonomy`");
             echo $insert_relation = "INSERT INTO `{$wpdb->prefix}term_relationships` (`object_id`, `term_taxonomy_id`, `term_order`) VALUES ('{$last_post_id}', '{$taxon_id}', '0')";
            $wpdb->query($insert_relation);

            // echo $insert_relation;

            // echo "<b>last query:</b> ".$wpdb->last_query."<br>";
            // echo "<b>last result:</b> "; print_r($wpdb->last_result);
            // echo "<br><b>last error:</b> "; print_r($wpdb->last_error);
            // echo '<br>';
            
            $p1++;
         } else{ break; }

    } // endforeach 
global $wpdb;
echo "<pre>";
print_r($wpdb->queries);
echo "</pre>";


}

parser($domen, $url, 7, 2);
// parser($domen, $url, 7, 2);

// всего на сайте 49 марок
// parser($domen, $url, 6, 3);    Время выполнения 22s  (это 5 брендов по 2 машины)
// parser($domen, $url, 15, 3);    Время выполнения 42s (это 14 брендов по 2 машины)
// parser($domen, $url, 15, 3);  Время выполнения 91s  (это 5 брендов по 2 машины в каждом по 5 миниатюр с ориг размером каждая)
// parser($domen, $url, 20, 3);  Время выполнения 113s  (это 5 брендов по 2 машины в каждом по 5 миниатюр с ориг размером каждая)
// parser($domen, $url, 42, 3);  Время выполнения 307s  (это 42 брендa по 2 машины в каждом по 2-21 миниатюр с ориг размером каждая)
// parser($domen, $url, 51, 3);  Время выполнения 190s  (это 51 брендa по 2 машины в каждом по 2-21 миниатюр с ориг размером каждая)

$end_time   =   microtime(true);
echo "<br><br>Время выполнения скрипта ".($end_time - $st_time)." сек.";


/* ****** показывает все хуки и все функции вызванные в них ********** */
function list_hooked_functions($tag=false){

     global $wp_filter;
     if ($tag) {
      $hook[$tag]=$wp_filter[$tag];
      if (!is_array($hook[$tag])) {
      trigger_error("Nothing found for '$tag' hook", E_USER_WARNING);
      return;
      }
     }
     else {
      $hook=$wp_filter;
      ksort($hook);
     }
     echo '<pre>';
     foreach($hook as $tag => $priority){
      echo "<br />&gt;&gt;&gt;&gt;&gt;\t<strong>$tag</strong><br />";
      ksort($priority);
      foreach($priority as $priority => $function){
      echo $priority;
      foreach($function as $name => $properties) echo "\t$name<br />";
      }
     }
     echo '</pre>';
     return;
}
list_hooked_functions();

/* ****** показывает все хуки и все функции вызванные в них ********** */

exit;
}




add_action("wp_head","a21_ajax_output");

function a21_ajax_output(){

    function a21_ajax_output_2($slug = 'audi'){
        ?>
        <br> 
        <h1>Получение результатов для ajax</h1>
        <?php

        echo $cat_id = get_cat_ID( $slug );

        $args = array(
            'posts_per_page' => 2,
            'cat' => $cat_id,
        );

        $query = new WP_Query( $args );

        // Цикл
        if ( $query->have_posts() ) {
            while ( $query->have_posts() ) {
                $query->the_post();
                the_title();
                echo "<hr>";
                the_content();
            }
        } else {
            echo "<p>Постов не найдено<p>";
        }
        /* Возвращаем оригинальные данные поста. Сбрасываем $post. */
        wp_reset_postdata();

    }
    a21_ajax_output_2();
    a21_ajax_output_2("bmw");
    /*********************************/

    function a21_delete_rows_db(){
        global $wpdb;
        $wpdb->query("DELETE FROM {$wpdb->posts} WHERE ID>28");
        $wpdb->query("DELETE FROM {$wpdb->prefix}terms WHERE term_id>3");
        $wpdb->query("DELETE FROM {$wpdb->prefix}term_taxonomy WHERE term_taxonomy_id>3");
        $wpdb->query("DELETE FROM {$wpdb->prefix}term_relationships WHERE object_id>28");
        echo '<br>';
        echo "<b>last query:</b> ".$wpdb->last_query."<br>";
        echo "<b>last result:</b> "; print_r($wpdb->last_result);
        echo "<br><b>last error:</b> "; print_r($wpdb->last_error);
        echo '<br>';
    }

    // a21_delete_rows_db();
    global $wpdb;
     $last_id = $wpdb->get_var("SELECT 'AUTO_INCREMENT' FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA='gbo' AND TABLE_NAME ='{$wpdb->posts}'");
     echo "last_id = ".$last_id;

    exit;
}
