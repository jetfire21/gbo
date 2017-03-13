<!DOCTYPE html>
<html lang="ru-RU">
<head>
    <meta charset="UTF-8"/>
	 <meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0, width=device-width"> 
	<link rel="shortcut icon" href="/favicon.ico">
    <title>Установка ГБО в Чувашии газобаллонное оборудование &quot;Газовик&quot;! </title>
    <meta name="keywords" content="установка гбо, гбо, ремонт гбо,диагностика,установка гбо 4 поколения">
<meta name="description" content="В Установочном центре ГБО &quot;Газ Авто Профи&quot; в Самаре  Вы можете установить газобаллонное оборудование(ГБО) 4го поколения!">
<!-- <script type="text/javascript" src="<?php echo get_template_directory_uri();?>/js/jquery-1.12.4.min.js"></script> -->
<link href="<?php echo get_template_directory_uri();?>/css/home.css" rel="stylesheet">
<!-- <link h<?php echo get_template_directory_uri();?>ref="/css/owl.carousel.css" rel="stylesheet"> -->
<link href="<?php echo get_template_directory_uri();?>/js/bxslider/jquery.bxslider.css" rel="stylesheet">
<link href="<?php echo get_template_directory_uri();?>/css/style.css" rel="stylesheet">
<link href="<?php echo get_template_directory_uri();?>/css/bootstrap.css" rel="stylesheet">
<link href="<?php echo get_template_directory_uri();?>/css/site.css" rel="stylesheet">
<link href="<?php echo get_template_directory_uri();?>/css/alex-media.css" rel="stylesheet">    
<link href="<?php echo get_template_directory_uri();?>/js/owl-carousel/owl.carousel.css" rel="stylesheet">    
<link href="<?php echo get_template_directory_uri();?>/js/owl-carousel/owl.theme.css" rel="stylesheet">   
<link href="<?php echo get_template_directory_uri();?>/fonts/fontello/css/fontello.css" rel="stylesheet">    
    <!--[if lt IE 9]>
        <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
<?php wp_head(); ?>
<script>var path_theme='<?php echo get_template_directory_uri()?>';</script>
</head>
<body>  

<div class="wrapmain">
       
<div id="header">
    <div class="wrapper page_middle">
        <a href="/"><div class="logo">
     	   <!-- <img src="/img/logo.png">-->
     	   <img src="<?php echo get_template_directory_uri();?>/img/alex/logo.png">
     	  </div>
        </a>
		<div class="head_middle">
			<div class="button-head">
					<a href="#anchor_call_back" name="modal" class="btn-application">
						<span>Заказать звонок</span>
					</a>
			</div>
			<div class="text-head">Работаем круглосуточно по записи</div>
		</div>	
        <div class="contacts">
            <div class="tel-1"><span class="tel">+7 (846) 989-09-88</span></div>
        </div>
    </div>
</div>


<p class="menu_button active"></p>

<div id="nav">
    <div class="wrapper page_middle">
<!-- 
        <ul id="w0" class="nav">
            <li class="active"><a href="/">Главная</a></li>
            <li><a href="/about.html">О нас</a></li>
            <li><a href="/works.php">Фотогалерея</a></li>
            <li><a href="/price.html">Прайс-лист</a></li>
             <li><a href="/contacts.html">Контакты</a></li>
         </ul>
 -->
        <?php
            $args = array(
              'theme_location'  => 'loc_menu',
              'menu'            => 'top-menu', 
              'container'       => '', 
              'container_class' => '', 
              'container_id'    => '',
              'menu_class'      => 'nav', 
              'menu_id'         => 'w0',
              'echo'            => true,
              'fallback_cb'     => 'wp_page_menu',
              'before'          => '',
              'after'           => '',
              'link_before'     => '',
              'link_after'      => '',
              'items_wrap'      => '
                    <ul class="%2$s">%3$s</ul>',
              'depth'           => 0
            );
             wp_nav_menu( $args );
        ?>

        <div class="social">
            <a href="http://vk.com/gbo_ustanovka_ru" class="vk"></a>
            <a href="https://instagram.com/gaz_avto_profi_163" class="inst"></a>
        </div>
        <div class="clear"></div>
        </div>
</div>