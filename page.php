<?php
/**
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

get_header(); ?>


<div class="breadcrumbs page_middle">
<!-- 
<ul class="breadcrumb">
	<li><a href="/">Главная</a></li>
	<li class="active">Цены на установку ГБО</li>
</ul>  
 -->
 <ul class="breadcrumb"><li><a href="/">Главная</a></li><li><?php echo get_the_title();?></li></ul>
 </div>

<div class="content">

<?php get_template_part( 'header-under-bg' ); ?>
<div class="page-default-index protection page_middle">

<!-- 
<div id="leftcol" class="protection">
<div class="newsModule">
<div class="title">Услуги компании</div>
<ul id="menu-left">
<li class="item1"><a href="/ustanovka_gbo">Установка ГБО</a></li>
<li class="item2"><a href="/texnicheskoe_obsluzhivanie_gbo">Техническое обслуживание ГБО</a></li>
<li class="item3"><a href="/strakhovanie_gbo">Страхование ГБО</a></li>
<li class="item4"><a href="/kredit">Установить ГБО в рассрочку</a></li>
</ul>
</div>
</div>
 -->

<div class="content-block">

	<?php if(have_posts() ): ?>
	<?php while(have_posts() ) : the_post();?>
	    <div class="inner_hbg"><h2 class="title-page"><?php the_title();?></h2></div>
	    <div><?php echo the_content();?></div>
	<?php endwhile; ?>
	<?php else: ?>
	   	<div>no content</div>
	<?php endif; ?>	

</div>  

 <div class="clear"></div>

</div>
</div>
<?php get_footer(); ?>
