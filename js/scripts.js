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