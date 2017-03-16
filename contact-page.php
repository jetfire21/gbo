<?php /* Template Name: Контакты */ ?>

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

    <div class="site-contact  page_middle">
    <h2 class="title-page">Контакты</h2>

    <div class="contacts-info">

    <div class="contact_text">
        <p>
        <strong><span class="contico i1">Телефон:</span><br> </strong>
        <span class="tel"><?php echo get_option('option_phone');?></span>
        </p>

        <p><strong><span class="contico i2">E-mail:</span><br> </strong><a href="mailto:gazoved21@mail.ru">gazoved21@mail.ru</a></p>
        <p><strong>Адрес:</strong> <br> <?php echo get_option('option_address');?> </p>
        <p><strong>Время работы:</span><br></strong>Понедельник - Суббота<br>9:00-18:00</p>
        <div class="clear"></div>
    </div>

    <div class="back_form_right">
		<div class="map">
			<script type="text/javascript" charset="utf-8" src="https://api-maps.yandex.ru/services/constructor/1.0/js/?sid=q2O4EzeZqDbAtdHU87Kecx4v4K6CDfuX&width=100%&height=333"></script>
		</div>
    </div>

	<h3>Форма обратной связи</h3>
	<div class="back_form_left">
    <form id="contact-form" action="/contacts" method="post" role="form">

        <input type="hidden" name="_csrf" value="eUlXcFByQmoWHWc4FzwKGgsKEREkNDscHS46Ng8XGx8bKg0fMzoOEA==">        <div class="row">
        <div class="col-sm-6">
        <div class="form-group field-contactform-name required">
        <div>
        <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span><input type="text" id="contactform-name" class="form-control" name="ContactForm[name]" placeholder="Имя"></div>

        <p class="help-block help-block-error"></p>
        </div>
        </div><div class="form-group field-contactform-email required">
        <div>
        <div class="input-group"><span class="input-group-addon">@</span><input type="text" id="contactform-email" class="form-control" name="ContactForm[email]" placeholder="E-mail"></div>

        <p class="help-block help-block-error"></p>
        </div>
        </div>                <div class="form-group field-contactform-body required">
        <div>
        <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-comment"></i></span><textarea id="contactform-body" class="form-control" name="ContactForm[body]" rows="6" placeholder="Сообщение"></textarea></div>

        <p class="help-block help-block-error"></p>
        </div>
        </div>            </div>

        </div>
        <div class="row">
        <div class="col-sm-6">
        <div class="form-group field-contactform-verifycode">
        <div>
        <div class="row"><div class="col-lg-4"><img id="contactform-verifycode-image" src="/page/captcha?v=58a563c1cbe06" alt=""></div><div class="col-lg-6"><input type="text" id="contactform-verifycode" class="form-control" name="ContactForm[verifyCode]"></div></div>

        <p class="help-block help-block-error"></p>
        </div>
        </div>            </div>
        <div class="col-sm-6 form-group">
        <button type="submit" class="btn btn-primary" name="contact-button">Отправить</button>            </div>
        </div>
        <div class="form-group field-contactform-subject required">
        <div>
        <input type="hidden" id="contactform-subject" class="form-control" name="ContactForm[subject]" value="Заявка с сайта Установка ГБО в Самаре газобаллонное оборудование &quot;ГазАвтоПрофи&quot;! ">

        <p class="help-block help-block-error"></p>
        </div>
    </div>
</form>

</div>
<!-- end back_form_left -->
    </div>
<!-- end contacts-info -->
<div class="clear"></div>
<p><p>&nbsp; &nbsp;</p></p>

 </div>
 <!-- end site-contact -->
 <div class="clear"></div>
</div>
<!-- end content -->

<?php get_footer();?>
