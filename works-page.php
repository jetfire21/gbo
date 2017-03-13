<?php /* Template Name: Фотогалерея */ ?>

<?php get_header(); ?>

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
<div class="protection page_middle">

<div class="content-block gallery">

    <h2 class="title-page">Фотогалерея</h2>

        <div class="categoriesContainer">
		
		<?php get_template_part( 'car_brands' ); ?>
                 
		<!-- 
		        <div class="categoryInner" data-brand="cadillac">
		            <a href="/photogallery/changan"><img src="<?php echo get_template_directory_uri();?>/img/alex/brand/cadillac.png" alt="Changan"></a>  
		            <div class="read">
		                 <div class="title">
		                    <p>Cadillac</p>
		                </div>
		            </div>
		        </div>
		 -->				 				 									
		</div>

<div class="works-wrap">

<!-- 
	<div class="work-item audi">
		<div class="col-md-4">
			<img class="img-responsive" src="/img/alex/works/Audi_A8.jpg" alt="">
		</div>
		<div class="col-md-8 work-slides">
			<h2>AUDI A8</h2>
			АУДИ А8 Установка ГБО (газового оборудования) OMVL (ЭБУ OMVL SAVER PRO, форсунки АЕВ, редуктор Silver), 65 л цил. Гарантия 3 года на весь комплект оборудования и на работы + 3 года гарантии на двигатель.
			<div class="clearfix"></div>
			<div class="col-md-4"><img class="img-responsive" src="/img/alex/works/Audi_A8_vid1.jpg" alt=""></div>
			<div class="col-md-4"><img class="img-responsive" src="/img/alex/works/Audi_A8_vid2.jpg" alt=""></div>
		</div>

	</div>

	<div class="work-item bmw">
		<div class="col-md-4">
			<img class="img-responsive" src="/img/alex/works/BMW_X5.jpg" alt="">
		</div>
		<div class="col-md-8 work-slides">
			<h2>BMW X5</h2>
			BMW X5 Установка ГБО (газового оборудования) Digitronic (ЭБУ Digitronic 3D, форсунки АЕВ, редуктор KME Gold), 74 л тор. Гарантия 3 года на весь комплект оборудования и на работы + 3 года гарантии на двигатель.
			<div class="clearfix"></div>
			<div class="col-md-4"><img class="img-responsive" src="/img/alex/works/BMW_X5_vid1.jpg" alt=""></div>
			<div class="col-md-4"><img class="img-responsive" src="/img/alex/works/BMW_X5_vid2.jpg" alt=""></div>
			<div class="col-md-4"><img class="img-responsive" src="/img/alex/works/BMW_X5_vid3.jpg" alt=""></div>
			<div class="col-md-4"><img class="img-responsive" src="/img/alex/works/BMW_X5_vid4.jpg" alt=""></div>
		</div>

	</div>
	<div class="work-item ford">
		<div class="col-md-4">
			<img class="img-responsive" src="/img/alex/works/BMW_X5.jpg" alt="">
		</div>
		<div class="col-md-8 work-slides">
			<h2>FORD MONDEO</h2>
			FORD MONDEO Установка ГБО (газового оборудования) Digitronic (ЭБУ Digitronic Maxi 2, форсунки AEB, редуктор Shark 1500), 63 л тор. Гарантия 3 года на весь комплект оборудования и на работы + 3 года гарантии на двигатель.
			<div class="clearfix"></div>
			<div class="col-md-4"><img class="img-responsive" src="/img/alex/works/BMW_X5_vid1.jpg" alt=""></div>
			<div class="col-md-4"><img class="img-responsive" src="/img/alex/works/BMW_X5_vid2.jpg" alt=""></div>
			<div class="col-md-4"><img class="img-responsive" src="/img/alex/works/BMW_X5_vid3.jpg" alt=""></div>
			<div class="col-md-4"><img class="img-responsive" src="/img/alex/works/BMW_X5_vid4.jpg" alt=""></div>
		</div>
	</div>
 -->    
 <div id="works-anchor-car"></div>
<?php require_once('parser_works.php'); ?>
</div> 
<!-- end .works-wrap -->

</div>
</div>
<div class="footer-spacer"></div>            <div class="clear"></div>
            </div>

<?php get_footer();?>
