jQuery(document).ready(function() {     

	// alex code

    jQuery(".categoryInner").click( function(e){
    	e.preventDefault();
    	var brand = jQuery(this).attr("data-brand");
    	console.log(brand);
    	// if(brand == "bmv"){ jQuery(".audi").hide(); jQuery(".ford").hide(); jQuery(".bmv").show(); }
    	// if(brand == "audi"){ jQuery(".bmv").hide(); jQuery("ford").hide(); jQuery(".audi").show();}
    	// if(brand == "ford"){ jQuery(".bmv").hide(); jQuery(".audi").hide(); jQuery(".ford").show();}
    	jQuery(".work-item").hide();
    	jQuery("."+brand).show();
      
        // var scroll = (jQuery('#item-nav').offset().top)-110;
        // var height_brands = jQuery(".categoriesContainer").height();
        var scroll = (jQuery('#works-anchor-car').offset().top)-110;
        // jQuery(document.body).scrollTop(scroll);
          jQuery(document.body).scrollTop(scroll);
          // jQuery(document.body).scrollTop(700);
            // window.scrollTo(0,1000);
        console.log("width groups: "+scroll);
        // console.log("width groups: "+h);

    });

    jQuery("#owl-home-slider").owlCarousel({

    navigation : true, // Show next and prev buttons
      slideSpeed : 300,
      paginationSpeed : 400,
      singleItem:true,
      pagination: false,
      navigationText: ["",""],
      // autoPlay:4000
    });

  jQuery("#owl-demo").owlCarousel({
      autoPlay: 3000, //Set AutoPlay to 3 seconds
      items : 3,
      itemsDesktop : [1199,3],
      itemsDesktopSmall : [979,2],
      navigation:true,
       navigationText: ["",""],
       pagination: false,
  });

    $('#form_call_back').submit(function(e){
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
        obj.find(".phone").append( '<p class="js-validation">Номер телефона введен неправильно! Должен быть в формате: 8 (999) 999-99-99<p>');
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

    /* ******** *********** */
        var config = {
        duration: 1500,
        delay: 200
    };
                  
    // Initialise Waves with the config
    Waves.init(config);
      Waves.attach('.a21_btn_home_call_blink', ['waves-button', 'waves-light' ]);

      $( ".a21_btn_home_call_blink").load(function() {
        console.log( $( this ).text() );
         // Ripple with a 1s delay between starting
        // and stopping the ripple, centred at 
        var options3 = { wait: 200, //ms
                   position: { x: 150, y: 0  } //px // This position relative to HTML element
        };

        function blink(){
          setInterval(function() {
             Waves.ripple('.a21_btn_home_call_blink', options3);
             console.log('blink 3');
          }, 2000);       
        }
         blink();        
    });
    $( ".a21_btn_home_call_blink" ).trigger( "load" ); // искусственно вызвыаем событие load

    /* ******** *********** */

	// alex code
  var pageHref =window.location.pathname;            
  jQuery('#menu-left li a').removeClass('active-menu-left');                 
  jQuery('#menu-left li a').each(function(){                
  var linkHref = jQuery(this).attr('href');               
  if (pageHref == linkHref){            
    jQuery(this).addClass('active-menu-left');  
  }
  });
  jQuery("p.menu_button").click(function() {
    jQuery(this).toggleClass("active");
    jQuery(this).parent().find("ul.nav").toggle('slide');
  });
  jQuery(".newsModule .title").click(function() {
    jQuery(this).toggleClass("active");
    jQuery(this).parent().find("#menu-left").animate({'width': 'toggle'});
  });

    jQuery('a[name=modal]').click(function(e) {
    var ww = document.body.clientWidth;
    e.preventDefault();
    var id = jQuery(this).attr('href');
    var backHeight = jQuery(document).height();
    var backWidth = jQuery(window).width();
    jQuery('#back_modal').css({'width':backWidth,'height':backHeight});
    jQuery('#back_modal').fadeTo("fast",0.8);
    var winH = jQuery(window).height();
    var winW = jQuery(window).width();
    if (ww > 601) {
      var Top_modal_window = jQuery(window).scrollTop() + jQuery(window).height()/2-jQuery(id).height()/2;
      jQuery(id).css('top',  Top_modal_window);
      jQuery(id).css('left', winW/2-jQuery(id).width()/2);
    }
    if (ww < 600) {
      var Top_modal_window = jQuery(window).scrollTop() + jQuery(window).height()/2-jQuery(id).height()/2;
      jQuery(id).css('top',  Top_modal_window);
      jQuery(id).css('left', winW/2-jQuery(id).width()/2);
    }

    jQuery(id).fadeIn(250);
     console.log("modal");
  });

  jQuery('.window .close').click(function (e) {
    e.preventDefault();
    jQuery('#back_modal, .window').hide();
  });
  jQuery('#back_modal').click(function () {
    jQuery(this).hide();
    jQuery('.window').hide();
  });


});