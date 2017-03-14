<div id="footer">
	<div id="nav">
		<div class="wrapper page_middle">
<!-- 
		    <ul id="w1" class="nav">
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
		<!-- end footer wrapper page-middle -->
	</div>

	<div class="wrapper page_middle">

	        <div class="footer_left">
	            <!-- <a href="/"><div class="logo"><img src="/img/logo-footer.png"></div></a> -->
	            <!-- <!-- <a href="/"><div class="logo"><img src="/img/alex/footer_audi.png"></div></a> -->
	            <a href="/"><div class="logo"><img src="<?php echo get_template_directory_uri();?>/img/alex/logo.png"></div></a>
	            <div class="text-footer">Качественная и надёжная установка
	                                   ГБО <b>с Газовик</b>
	            </div>
	                <div class="card-head">
	                    <p>Мы принимаем:</p>
	                    <div class="visa"></div>
	                    <div class="master"></div>
	                </div>
	        </div>
	        <div class="footer_end">
		        <div class="contacts">
		            <div class="cont-tel ttm">
		                <div class="tel-2"> <span class="tel">+7 (937) 989-09-88</span></div>
		            </div>
		            <div class="last_foot">
		                <div class="cont-text">Круглосуточно по записи</div>
		                <div class="cont-addres">г. Чебоксары, ул. Пятигорская, д.13 </div>
		            </div>
		        </div>
		        <div class="metr">
		            <div class="сopyr">© Газовик 2016</div>
		        </div>
		<!--         <div class="metr_neo">
		            <div class="сopyr_neo">© <a target="_blank" href="http://neopulse.ru">Разработка сайта</a> NeoPulse</div>
		        </div>
		 -->  
	 	  </div>
	        
	</div>

</div>
<!-- end footer -->
<?php wp_footer(); ?>
<script src="<?php echo get_template_directory_uri();?>/js/owl-carousel/owl.carousel.min.js"></script>
<!-- <script src="<?php echo get_template_directory_uri();?>/js/bxslider/jquery.bxslider.min.js"></script> -->
<script src="<?php echo get_template_directory_uri();?>/js/scripts.js"></script>

<div id="boxes">
<div id="anchor_call_back" class="window">
    <p class="m_n">Заказать звонок</p>
    <div class="success_answer"><p></p></div>
    <div class="callback_body">
        <form method="POST" id="form_call_back" class="main_page_form">
            <div class="name">
                <p>Ваше имя:</p>
                <input type="text" name="name" required placeholder="ФИО" x-autocompletetype="name">
            </div>
            <div class="phone">
                <p>Ваш телефон:</p>
                <input type="text" name="phone" required placeholder="8(999)123-45-64">
            </div>
            <input type="submit" value="Отправить" id="send_proposal">
        </form>
    </div>
    <a href="#" class="close">&#10005;</a>
</div>
<div id="back_modal"></div>
</div>

<?php if( is_front_page() || is_page('prajs-list')):?>

	        <div id="boxes">
            <div id="anchor_proposal" class="window">
                <p class="m_n">Заявка на установку ГБО</p>
                <div class="success_answer"><p></p></div>
                <div class="callback_body">
                    <form method="POST" id="form_proposal" class="main_page_form">
                        <div class="name">
                            <p>Ваше имя:</p>
                            <input type="text" name="name" required placeholder="ФИО" x-autocompletetype="name">
                        </div>
                        <div class="phone">
                            <p>Ваш телефон:</p>
                            <input type="text" name="phone" required placeholder="8(999)123-45-64">
                        </div>
                        <input type="submit" value="Отправить" id="send_proposal">
                    </form>
                </div>
                <a href="#" class="close">&#10005;</a>
            </div>
            <div id="back_modal"></div>
        </div>
	<script>

		var config = {
		    duration: 1500,
		    delay: 200
		};
	                
		// Initialise Waves with the config
		Waves.init(config);
	    Waves.attach('.float-button-light2', ['waves-button', 'waves-light' ]);
	    // Waves.attach('.float-button-light', ['waves-button',  'waves-ripple' ]);

	    // $( ".float-button-light" ).on( "click", function() {
	    $( ".float-button-light2" ).load(function() {
			 console.log( $( this ).text() );
				 // Ripple with a 1s delay between starting
				// and stopping the ripple, centred at 
				var options = { wait: 500, //ms
				   				 position: { x: 0, y: 0  } //px // This position relative to HTML element
				};

				function blink(){
				  setInterval(function() {
				  	 Waves.ripple('.float-button-light2', options);
				  	 // Waves.ripple('.float-button-light');
				  }, 2000);			  
				}

				 blink();				 
		});
		$( ".float-button-light2" ).trigger( "load" ); // искусственно вызвыаем событие load

	 	$('#form_proposal').submit(function(e){
			e.preventDefault();
			var obj = $(this);
			// console.log(obj.parent().parent().find("p.m_n").text());
			var name_form = obj.parent().parent().find("p.m_n").text();
			// console.log("send form proposal");
			var form_data = obj.serialize() + "&name_form="+name_form;;
			// console.log(form_data);
			// console.log($(this).html());

			function ValidPhone(obj) {

				// 8 (999) 123-45-64 или 8(999)123-45-64 или 8 (999)123-45-64
			    var re = /^[\d]{1} ?\([\d]{2,3}\) ?[\d]{2,3}-[\d]{2,3}-[\d]{2,3}$/;
			    // var re = /^[\d]{1}\ \([\d]{2,3}\)\ [\d]{2,3}-[\d]{2,3}-[\d]{2,3}$/;
			    var Phone = obj.find(".phone input").val();
			    // var Phone = obj.find("input[name='phone']").val();
			    var valid = re.test(Phone);
			    return valid;
			    // return Phone;
			    // return output;
			} 
			// console.log("valid "+ValidPhone( obj) );
			// console.log(form_data);
			obj.find(".phone .js-validation").remove();
			obj.find(".name .js-validation").remove();
			if( !ValidPhone(obj)){
				obj.find(".phone").append( '<p class="js-validation">Номер телефона введен неправильно!<p>');
				return false;
			}
			 $.ajax({
				  type: 'post',
         		   url: path_theme+'/mail.php',
				  data: form_data,
				  success: function(data){
				  	var data = JSON.parse(data);
					if(data.res == 'success') { 
						alert("Ваше сообщение успешно отправлено!"); 
						$(".window, #back_modal").hide();
					}
					if(data.res == 'error_empty') {
						obj.find(".name").append( '<p class="js-validation">Поле не заполнено!<p>');
					}
				  },
				  error:function(){
					alert("error");
				}
			});	
		});	


	</script>
<?php endif;?>
</body>
</html>

