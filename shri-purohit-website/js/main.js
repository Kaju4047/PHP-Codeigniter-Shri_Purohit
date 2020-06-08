 AOS.init({
 	duration: 800,
 	easing: 'slide',
 	once: true
 });

jQuery(document).ready(function($) {

	"use strict";

	

	var siteMenuClone = function() {

		$('.js-clone-nav').each(function() {
			var $this = $(this);
			$this.clone().attr('class', 'site-nav-wrap').appendTo('.site-mobile-menu-body');
		});


		setTimeout(function() {
			
			var counter = 0;
      $('.site-mobile-menu .has-children').each(function(){
        var $this = $(this);
        
        $this.prepend('<span class="arrow-collapse collapsed">');

        $this.find('.arrow-collapse').attr({
          'data-toggle' : 'collapse',
          'data-target' : '#collapseItem' + counter,
        });

        $this.find('> ul').attr({
          'class' : 'collapse',
          'id' : 'collapseItem' + counter,
        });

        counter++;

      });

    }, 1000);

		$('body').on('click', '.arrow-collapse', function(e) {
      var $this = $(this);
      if ( $this.closest('li').find('.collapse').hasClass('show') ) {
        $this.removeClass('active');
      } else {
        $this.addClass('active');
      }
      e.preventDefault();  
      
    });

		$(window).resize(function() {
			var $this = $(this),
				w = $this.width();

			if ( w > 768 ) {
				if ( $('body').hasClass('offcanvas-menu') ) {
					$('body').removeClass('offcanvas-menu');
				}
			}
		})

		$('body').on('click', '.js-menu-toggle', function(e) {
			var $this = $(this);
			e.preventDefault();

			if ( $('body').hasClass('offcanvas-menu') ) {
				$('body').removeClass('offcanvas-menu');
				$this.removeClass('active');
			} else {
				$('body').addClass('offcanvas-menu');
				$this.addClass('active');
			}
		}) 

		// click outisde offcanvas
		$(document).mouseup(function(e) {
	    var container = $(".site-mobile-menu");
	    if (!container.is(e.target) && container.has(e.target).length === 0) {
	      if ( $('body').hasClass('offcanvas-menu') ) {
					$('body').removeClass('offcanvas-menu');
				}
	    }
		});
	}; 
	siteMenuClone();


	var sitePlusMinus = function() {
		$('.js-btn-minus').on('click', function(e){
			e.preventDefault();
			if ( $(this).closest('.input-group').find('.form-control').val() != 0  ) {
				$(this).closest('.input-group').find('.form-control').val(parseInt($(this).closest('.input-group').find('.form-control').val()) - 1);
			} else {
				$(this).closest('.input-group').find('.form-control').val(parseInt(0));
			}
		});
		$('.js-btn-plus').on('click', function(e){
			e.preventDefault();
			$(this).closest('.input-group').find('.form-control').val(parseInt($(this).closest('.input-group').find('.form-control').val()) + 1);
		});
	};
	// sitePlusMinus();


	var siteSliderRange = function() {
    $( "#slider-range" ).slider({
      range: true,
      min: 0,
      max: 500,
      values: [ 75, 300 ],
      slide: function( event, ui ) {
        $( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
      }
    });
    $( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) +
      " - $" + $( "#slider-range" ).slider( "values", 1 ) );
	};
	// siteSliderRange();


	var siteMagnificPopup = function() {
		$('.image-popup').magnificPopup({
	    type: 'image',
	    closeOnContentClick: true,
	    closeBtnInside: false,
	    fixedContentPos: true,
	    mainClass: 'mfp-no-margins mfp-with-zoom', // class to remove default margin from left and right side
	     gallery: {
	      enabled: true,
	      navigateByImgClick: true,
	      preload: [0,1] // Will preload 0 - before current, and 1 after the current image
	    },
	    image: {
	      verticalFit: true
	    },
	    zoom: {
	      enabled: true,
	      duration: 300 // don't foget to change the duration also in CSS
	    }
	  });

	  $('.popup-youtube, .popup-vimeo, .popup-gmaps').magnificPopup({
	    disableOn: 700,
	    type: 'iframe',
	    mainClass: 'mfp-fade',
	    removalDelay: 160,
	    preloader: false,

	    fixedContentPos: false
	  });
	};
	siteMagnificPopup();


	var siteCarousel = function () {
		if ( $('.nonloop-block-13').length > 0 ) {
			$('.nonloop-block-13').owlCarousel({
		    center: false,
		    items: 1,
		    loop: true,
				stagePadding: 10,
		    margin: 30,
		    smartSpeed: 1000,
		    autoplay:true,
				autoplayTimeout:1000,
				autoplayHoverPause:false,

		    nav: true,
				navText: ['<span class="icon-keyboard_arrow_left">', '<span class="icon-keyboard_arrow_right">'],
		    responsive:{
	        600:{
	        	margin: 30,
	        	nav: true,
	          items: 2
	        },
	        1000:{
	        	margin: 30,
	        	nav: true,
	          items: 3
	        },
	        1200:{
	        	margin: 30,
	        	nav: true,
	          items: 4
	        }
		    }
			});
		}

		$('.slide-one-item').owlCarousel({
	    center: false,
	    items: 1,
	    loop: true,
			stagePadding: 0,
			smartSpeed: 1000,
	    margin: 0,
	    // autoplay: true,
	    pauseOnHover: false,
	    nav: true,
	    navText: ['<span class="icon-keyboard_arrow_left">', '<span class="icon-keyboard_arrow_right">'],
	  });
	};
	siteCarousel();

	var siteStellar = function() {
		$(window).stellar({
	    responsive: false,
	    parallaxBackgrounds: true,
	    parallaxElements: true,
	    horizontalScrolling: false,
	    hideDistantElements: false,
	    scrollProperty: 'scroll'
	  });
	};
	siteStellar();

	var siteCountDown = function() {

		$('#date-countdown').countdown('2020/10/10', function(event) {
		  var $this = $(this).html(event.strftime(''
		    + '<span class="countdown-block"><span class="label">%w</span> weeks </span>'
		    + '<span class="countdown-block"><span class="label">%d</span> days </span>'
		    + '<span class="countdown-block"><span class="label">%H</span> hr </span>'
		    + '<span class="countdown-block"><span class="label">%M</span> min </span>'
		    + '<span class="countdown-block"><span class="label">%S</span> sec</span>'));
		});
				
	};
	siteCountDown();

	var siteDatePicker = function() {

		if ( $('.datepicker').length > 0 ) {
			$('.datepicker').datepicker();
		}

	};
	siteDatePicker();

	var siteRangeSlider = function() {

		$('input[type="range"]').rangeslider({
	    polyfill : false,
	    onInit : function() {
	        this.output = $( '<div class="range-output" />' ).insertAfter( this.$range ).html( this.$element.val() );
	    },
	    onSlide : function( position, value ) {
	        this.output.html( value );
	    }
		});

	};
	siteRangeSlider();
	

});

 $(document).ready(function() {
              $('.hs_testi_slider_wrapper .owl-carousel').owlCarousel({
                loop: true,
                margin: 10,
				autoplay:true,
                responsiveClass: true,
				smartSpeed: 1200,
				navText : ['<i class="flaticon-left-arrow" aria-hidden="true"></i>','<i class="flaticon-right-arrow" aria-hidden="true"></i>'],
                responsive: {
                  0: {
                    items: 1,
                    nav: true
                  },
                  600: {
                    items: 1,
                    nav: true
                  },
                  1000: {
                    items: 1,
                    nav: true,
                    loop: true,
                    margin: 20
                  }
                }
              })
            })

 // silder
    $('.your-class').slick({
      dots:true,
      autoplay:true,
      slidesToShow:1,
      slidesToScroll:1,
      infinite:true,
      autoplaySpeed:6000,
      fade: true,
      cssEase: 'linear',
      arrows:false
    });
    // slidere end
    (function ($) {
  $.fn.countTo = function (options) {
    options = options || {};
    
    return $(this).each(function () {
      // set options for current element
      var settings = $.extend({}, $.fn.countTo.defaults, {
        from:            $(this).data('from'),
        to:              $(this).data('to'),
        speed:           $(this).data('speed'),
        refreshInterval: $(this).data('refresh-interval'),
        decimals:        $(this).data('decimals')
      }, options);
      
      // how many times to update the value, and how much to increment the value on each update
      var loops = Math.ceil(settings.speed / settings.refreshInterval),
        increment = (settings.to - settings.from) / loops;
      
      // references & variables that will change with each update
      var self = this,
        $self = $(this),
        loopCount = 0,
        value = settings.from,
        data = $self.data('countTo') || {};
      
      $self.data('countTo', data);
      
      // if an existing interval can be found, clear it first
      if (data.interval) {
        clearInterval(data.interval);
      }
      data.interval = setInterval(updateTimer, settings.refreshInterval);
      
      // initialize the element with the starting value
      render(value);
      
      function updateTimer() {
        value += increment;
        loopCount++;
        
        render(value);
        
        if (typeof(settings.onUpdate) == 'function') {
          settings.onUpdate.call(self, value);
        }
        
        if (loopCount >= loops) {
          // remove the interval
          $self.removeData('countTo');
          clearInterval(data.interval);
          value = settings.to;
          
          if (typeof(settings.onComplete) == 'function') {
            settings.onComplete.call(self, value);
          }
        }
      }
      
      function render(value) {
        var formattedValue = settings.formatter.call(self, value, settings);
        $self.html(formattedValue);
      }
    });
  };
  
  $.fn.countTo.defaults = {
    from: 0,               // the number the element should start at
    to: 0,                 // the number the element should end at
    speed: 1000,           // how long it should take to count between the target numbers
    refreshInterval: 100,  // how often the element should be updated
    decimals: 0,           // the number of decimal places to show
    formatter: formatter,  // handler for formatting the value before rendering
    onUpdate: null,        // callback method for every time the element is updated
    onComplete: null       // callback method for when the element finishes updating
  };
  
  function formatter(value, settings) {
    return value.toFixed(settings.decimals);
  }
}(jQuery));

jQuery(function ($) {
  // custom formatting example
  $('.count-number').data('countToOptions', {
  formatter: function (value, options) {
    return value.toFixed(options.decimals).replace(/\B(?=(?:\d{3})+(?!\d))/g, ',');
  }
  });
  
  // start all the timers
  $('.timer').each(count);  
  
  function count(options) {
  var $this = $(this);
  options = $.extend({}, options || {}, $this.data('countToOptions') || {});
  $this.countTo(options);
  }
});
 



 // sidebar



// mtree.js
// Requires jquery.js and velocity.js (optional but recommended).
// Copy the below function, add to your JS, and simply add a list <ul class=mtree> ... </ul>
(function ($, window, document, undefined) {
  
  // Only apply if mtree list exists
  if($('ul.mtree').length) { 
  
    
  // Settings
  var collapsed = true; // Start with collapsed menu (only level 1 items visible)
  var close_same_level = false; // Close elements on same level when opening new node.
  var duration = 400; // Animation duration should be tweaked according to easing.
  var listAnim = true; // Animate separate list items on open/close element (velocity.js only).
  var easing = 'easeOutQuart'; // Velocity.js only, defaults to 'swing' with jquery animation.
    
  
  // Set initial styles 
  $('.mtree ul').css({'overflow':'hidden', 'height': (collapsed) ? 0 : 'auto', 'display': (collapsed) ? 'none' : 'block' });
  
  // Get node elements, and add classes for styling
  var node = $('.mtree li:has(ul)');  
  node.each(function(index, val) {
    $(this).children(':first-child').css('cursor', 'pointer')
    $(this).addClass('mtree-node mtree-' + ((collapsed) ? 'closed' : 'open'));
    $(this).children('ul').addClass('mtree-level-' + ($(this).parentsUntil($('ul.mtree'), 'ul').length + 1));
  });
  
  // Set mtree-active class on list items for last opened element
  $('.mtree li > *:first-child').on('click.mtree-active', function(e){
    if($(this).parent().hasClass('mtree-closed')) {
      $('.mtree-active').not($(this).parent()).removeClass('mtree-active');
      $(this).parent().addClass('mtree-active');
    } else if($(this).parent().hasClass('mtree-open')){
      $(this).parent().removeClass('mtree-active'); 
    } else {
      $('.mtree-active').not($(this).parent()).removeClass('mtree-active');
      $(this).parent().toggleClass('mtree-active'); 
    }
  });

  // Set node click elements, preferably <a> but node links can be <span> also
  node.children(':first-child').on('click.mtree', function(e){
    
    // element vars
    var el = $(this).parent().children('ul').first();
    var isOpen = $(this).parent().hasClass('mtree-open');
    
    // close other elements on same level if opening 
    if((close_same_level || $('.csl').hasClass('active')) && !isOpen) {
      var close_items = $(this).closest('ul').children('.mtree-open').not($(this).parent()).children('ul');
      
      // Velocity.js
      if($.Velocity) {
        close_items.velocity({
          height: 0
        }, {
          duration: duration,
          easing: easing,
          display: 'none',
          delay: 100,
          complete: function(){
            setNodeClass($(this).parent(), true)
          }
        });
        
      // jQuery fallback
      } else {
        close_items.delay(100).slideToggle(duration, function(){
          setNodeClass($(this).parent(), true);
        });
      }
    }
    
    // force auto height of element so actual height can be extracted
    el.css({'height': 'auto'}); 
    
    // listAnim: animate child elements when opening
    if(!isOpen && $.Velocity && listAnim) el.find(' > li, li.mtree-open > ul > li').css({'opacity':0}).velocity('stop').velocity('list');
    
    // Velocity.js animate element
    if($.Velocity) {
      el.velocity('stop').velocity({
        //translateZ: 0, // optional hardware-acceleration is automatic on mobile
        height: isOpen ? [0, el.outerHeight()] : [el.outerHeight(), 0]
      },{
        queue: false,
        duration: duration,
        easing: easing,
        display: isOpen ? 'none' : 'block',
        begin: setNodeClass($(this).parent(), isOpen),
        complete: function(){
          if(!isOpen) $(this).css('height', 'auto');
        }
      });
    
    // jQuery fallback animate element
    } else {
      setNodeClass($(this).parent(), isOpen);
      el.slideToggle(duration);
    }
    
    // We can't have nodes as links unfortunately
    e.preventDefault();
  });
  
  // Function for updating node class
  function setNodeClass(el, isOpen) {
    if(isOpen) {
      el.removeClass('mtree-open').addClass('mtree-closed');
    } else {
      el.removeClass('mtree-closed').addClass('mtree-open');
    }
  }
  
  // List animation sequence
  if($.Velocity && listAnim) {
    $.Velocity.Sequences.list = function (element, options, index, size) {
      $.Velocity.animate(element, { 
        opacity: [1,0],
        translateY: [0, -(index+1)]
      }, {
        delay: index*(duration/size/2),
        duration: duration,
        easing: easing
      });
    };
  }
    
    // Fade in mtree after classes are added.
    // Useful if you have set collapsed = true or applied styles that change the structure so the menu doesn't jump between states after the function executes.
    if($('.mtree').css('opacity') == 0) {
      if($.Velocity) {
        $('.mtree').css('opacity', 1).children().css('opacity', 0).velocity('list');
      } else {
        $('.mtree').show(200);
      }
    }
  }
}(jQuery, this, this.document));

$(document).ready(function(){
    // Toggles paragraphs display
    $(".hide").click(function(){
        $(".edit_profile_block").toggle();
    });
});


$('.service-slider').slick({
  dots: true,
  infinite: false,
  speed: 300,
  slidesToShow: 4,
  autoplay:true,
  autoplaySpeed:4000,
  slidesToScroll: 4,
  responsive: [
    {
      breakpoint: 992,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 3,
        infinite: true,
        dots: true
      }
    },
    {
      breakpoint: 767,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 2
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
  ]
});