<?php

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
$st_time =	microtime(true);

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

// echo get_result($url);

// echo "<hr><h2>Here work phpquery...</h2><br><br>";

//создаем новый документ из полченной разметки
// phpQuery::newDocument( get_result($url) );
// $html = pq('.brands .brand-item');
// echo $html = $html->html();
// <a class="bi-name" href="/models/audi/">Audi</a>
// echo "<pre>";
// print_r($html);
// echo "</pre>";


// function parser($domen, $url, $i){

//     echo "<hr><h2>Перебор всех элементов в цикле</h2><br>";
//     phpQuery::newDocument( get_result($url) );
//     // $page = pq('.brand-item .bi-name');
//     $page = pq('.brand-item');

//      // echo $html = $html->html();
//      // echo "<br>";
//      foreach ($page as $item) {

//          if($i < 3){

//             $el = 1;
//              $item = pq($item);
//              // echo $item->html();
//              $link = $item->find(".bi-name")->attr("href"); //   /models/audi/
//              $link_text = $item->find(".bi-name")->text(); 
//              // echo $l = $item->find(".bi-img")->html(); 
//              $img_src = $item->find(".bi-img img")->attr("src"); //  
//              echo "<h3>Страница 1 - ".$domen.$link." <b>Итерация ".$i."</b></h3>";
//              echo "<img src='$domen.$img_src' />";
//              echo $link_text;
//               // echo $item->html();

//              echo "<br><b>Страница 2</b> - ".$domen.$link."<br>";
//              phpQuery::newDocument( get_result($domen.$link) );
//              $page2 = pq('.models .mi-name');

//              foreach ($page2 as $item2) {
//                  $item2 = pq($item2);
//                  $link2 = $item2->attr("href"); //   /photogalery/audi-a6-i-c4-sedan-2-8i-174hp-1994-1997/
//                  $link2_text = $item2->text(); //   
//                  echo "el ".$el." ".$link2." текст ссылки ".$link2_text."<br>";
//                  $el++;

//                     // .pg-desc
//                     echo "<br><b>Страница 3</b> - ".$domen.$link2."<br>";
//                     phpQuery::newDocument( get_result($domen.$link2) );
//                     $page3 = pq('.main-content');
//                     $page3_img_src = $domen.$page3->find("#exposition")->attr("src");
//                     echo "<img src='$page3_img_src' />";
//                     $page3_small_img = $page3->find(".pg-img");
//                     foreach ($page3_small_img as $img) {
//                          $img = pq($img);
//                          $small_src = $domen.$img->find("img")->attr("src");
//                          echo "<img src='$small_src' />";

//                     }
//                     echo $page3->find(".pg-desc")->text();
//                     echo $page3->find(".pg-more")->text();
//                     echo "<br><br>";

//             }
//             echo "<br>";
//             $i++;
//         }
//     }

// }


function parser($domen, $url, $p1_count, $count_cars_brand){

    $p1 = 0;
    echo "<hr><h2> ddd Перебор всех элементов в цикле</h2><br>\r\n";
    phpQuery::newDocument( get_result($url) );
    $page = pq('.work-item');

     $work_item = $page->html();
     echo "<hr>";
     echo $cl_parent = $page->attr("class");
     echo "<hr>";
     $p2 = 1;
     foreach ($page as $item) {
        global $wpdb;

        echo "p1=".$p1;
        echo "<br>";

        if($p1 < $p1_count){

             $el = 1;
             $wrap_car_item = pq($item);

             // получаем имя класса родителя...work-item bmw
             $class_parent = $wrap_car_item->attr("class");
             $brand = explode(" ", $class_parent);
             echo $brand[1];
             echo "<br>";
             if($p1 % $count_cars_brand == 0){
                 echo "INSERT INTO `d2zv_terms` ( `name`, `slug`, `term_group`) VALUES ('".mb_strtoupper($brand[1])."', '".$brand[1]."', '0')";
                 echo "<hr>";
                 echo "brand_id=".$last_brand_id = $wpdb->get_var( "SELECT MAX(`term_id`) FROM {$wpdb->posts}");
                 echo "INSERT INTO `d2zv_term_taxonomy` (`term_id`, `taxonomy`, `description`, `parent`, `count`) VALUES ('{$last_brand_id}', 'category', '', '3', '1')";
                 echo "<hr>";
             }

             echo $wrap_car_item->html();
             // $link = $item->find(".bi-name")->attr("href"); //   /models/audi/
             // $link_text = $item->find(".bi-name")->text(); 
             // // echo $l = $item->find(".bi-img")->html(); 
             // $img_src = $item->find(".bi-img img")->attr("src"); //  

             // // echo $link_text."<br>";

             // phpQuery::newDocument( get_result($domen.$link) );
             // $page2 = pq('.models .mi-name');


            $p1++;
         } else{ break; }

    } // endforeach 

}

parser($domen, $url, 6, 2);
// всего на сайте 49 марок
// parser($domen, $url, 6, 3);    Время выполнения 22s  (это 5 брендов по 2 машины)
// parser($domen, $url, 15, 3);    Время выполнения 42s (это 14 брендов по 2 машины)
// parser($domen, $url, 15, 3);  Время выполнения 91s  (это 5 брендов по 2 машины в каждом по 5 миниатюр с ориг размером каждая)
// parser($domen, $url, 20, 3);  Время выполнения 113s  (это 5 брендов по 2 машины в каждом по 5 миниатюр с ориг размером каждая)
// parser($domen, $url, 42, 3);  Время выполнения 307s  (это 42 брендa по 2 машины в каждом по 2-21 миниатюр с ориг размером каждая)
// parser($domen, $url, 51, 3);  Время выполнения 190s  (это 51 брендa по 2 машины в каждом по 2-21 миниатюр с ориг размером каждая)

$end_time	=	microtime(true);
echo "<br><br>Время выполнения скрипта ".($end_time - $st_time)." сек.";
