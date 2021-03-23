$(document).ready(function() {
	"use strict";
	/*
	 * ----------------------------------------------------------------------------------------
	 *  CHANGE MENU BACKGROUND JS
	 * ----------------------------------------------------------------------------------------
	 */

	var headertopoption = $(window);
	var headTop = $('.header-top-area');
	headertopoption.on('scroll', function() {
		if (headertopoption.scrollTop() > 200) {
			headTop.addClass('menu-bg');
		} else {
			headTop.removeClass('menu-bg');
		}
	});

	// add_class
	var nav_icon = $('#nav-icon2');
	var mainmenu_ul = $('.mainmenu ul');
	nav_icon.on('click', function() {
		$(this).toggleClass('open');
		mainmenu_ul.toggleClass('nav-menu-show');
	});

	/* ---------------------------------------------
	 Smooth scroll
	 --------------------------------------------- */
	var navbar_collapsejs = $('.navbar-collapse');
	$(document).on("scroll", onScroll);
	var navLinks = $('.nav li a[href^="#"]');
	navLinks.on("click", function(e) {
		var anchor = $(this);
		$('html, body').stop().animate({
			scrollTop : $(anchor.attr('href')).offset().top - 50
		}, 1000);
		e.preventDefault();
		if ($(window).width() <= 991) {
			navbar_collapsejs.removeClass('collapse');
			navbar_collapsejs.removeClass('show');
			navbar_collapsejs.addClass('collaping');
			navbar_collapsejs.attr('aria-expanded', 'false');
			setTimeout(function() {
				navbar_collapsejs.addClass('collapse');
				navbar_collapsejs.removeClass('collaping');
			}, 500);
		}
	});

	function onScroll(event) {
		var homeClass = $('#home');
		var navLink = $('.nav li a');
		if (homeClass.length) {
			var scrollPos = $(document).scrollTop();
			navLink.each(function() {
				var currLink = $(this);
				var refElement = $(currLink.attr("href"));
				console.log(refElement)
				if (refElement.position().top - 50 <= scrollPos && refElement.position().top + refElement.height() > scrollPos) {
					navLink.removeClass("active");
					currLink.addClass("active");
				} else {
					// currLink.removeClass("active");
				}
			});
		}

	}
if ($('#wavybg-wrapper').length) {
					var smokyBG = $('#wavybg-wrapper').waterpipe({
						//Default values
						gradientStart : '#fa05fa',
						gradientEnd : '#6b71e3',
						smokeOpacity : 0.1,
						numCircles : 1,
						maxMaxRad : 'auto',
						minMaxRad : 'auto',
						minRadFactor : 0,
						iterations : 8,
						drawsPerFrame : 10,
						lineWidth : 2,
						speed : 1,
						bgColorInner : "none",
						bgColorOuter : "none"
					});

				}
	// popup
	var popup_youtube = $('.popup-youtube');
	popup_youtube.magnificPopup({
		disableOn : 700,
		type : 'iframe',
		mainClass : 'mfp-fade',
		removalDelay : 160,
		preloader : false,
		fixedContentPos : true,
		closeBtnInside : false
	});
	var popup_btn = $('.popup-btn');
	popup_btn.magnificPopup({
		type : 'image',
		gallery : {
			enabled : true
		}
	});
	/*----------------------------------------------
	 -----------Masonry Grid view Function  --------------------
	 -------------------------------------------------*/
	var container_grid = $(".container-grid");
	container_grid.imagesLoaded(function() {
		container_grid.isotope({
			itemSelector : ".nf-item",
			layoutMode : "fitRows"
		});
	});

	/*----------------------------------------------
	 -----------Masonry Grid Filter Function  --------------------
	 -------------------------------------------------*/
	var container_filter = $(".container-filter");
	container_filter.on("click", ".categories", function() {
		var e = $(this).attr("data-filter");
		container_grid.isotope({
			filter : e
		});
	});
	/*----------------------------------------------
	 -----------Masonry filter Active Function  --------------------
	 -------------------------------------------------*/
	container_filter.each(function(e, a) {
		var i = $(a);
		i.on("click", ".categories", function() {
			i.find(".active").removeClass("active"), $(this).addClass("active");
		});
	});
	/*==============================================================
	 wow animation - on scroll
	 ==============================================================*/
	var wowJs = $('.wow');
	if (wowJs.length) {
		var wow = new WOW({
			boxClass : 'wow',
			animateClass : 'animated',
			offset : 0,
			mobile : false,
			live : true
		});

		wow.init();
		// WOW JS
		new WOW({
			mobile : false
		}).init();
	}
	/*==============================================================
	 set parallax
	 ==============================================================*/
	function stellarParallax() {
		if ($(window).width() > 1024) {
			$.stellar();
		} else {
			$.stellar('destroy');
			$('.parallax').css('background-position', '');
		};
	};
	// HOME TYPED JS
	 var typeJs = $(".text_type");
	if (typeJs.length) {
	var text1 = typeJs.data('text1');
	 var text2 = typeJs.data('text2');
	 var text3 = typeJs.data('text3');
	 var text4 = typeJs.data('text4');
	 typeJs.typed({
		 strings : [text1, text2, text3, text4],
		 typeSpeed : 10,
		 loop : true,
		 backDelay : 3000
	 });
	}
	//	Testimonial Carousel
	var testimonial = $('.testimonial');
	testimonial.owlCarousel({
		loop : true,
		margin : 30,
		nav : false,
		dots : false,
		center : false,
		autoplay : true,
		autoplayTimeout : 3000,
		autoplayHoverPause : true,
		navText : ["<i class='ion-ios-arrow-back'></i>", "<i class='ion-ios-arrow-forward'></i>"],
		responsive : {
			0 : {
				items : 1
			},
			767 : {
				items : 2
			},
			992 : {
				items : 3
			},
			1200 : {
				items : 3
			}
		}
	});
	$(".banner_js").owlCarousel({
		items : 1,
		loop : true,
		mouseDrag : true,
		autoplay : true,
		autoplayTimeout : 3000,
		dots : false,
		nav : true,
		navText : ['<span> <i class="fa fa-angle-left" aria-hidden="true"></i> </span>', '<span> <i class="fa fa-angle-right" aria-hidden="true"></i> </span>'],
		smartSpeed : 500
	});
	//onload function
var preloader = $("#preloader");
	preloader.delay(500).fadeOut();
	// Validation function
	var contact_form = $("#contact-form");
	contact_form.validator();
	contact_form.on("submit", function(e) {
		if (!e.isDefaultPrevented()) {
			var url = "mail.php";
			$.ajax({
				type : "POST",
				url : url,
				data : $(this).serialize(),
				success : function(data) {
					var messageAlert = "alert-" + data.type;
					console.log(messageAlert + "alert");
					var messageText = data.message;
					console.log(messageText + "test");
					var alertBox = '<div class="alert ' + messageAlert + ' alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' + messageText + "</div>";

					if (messageAlert && messageText) {
						$("#contact-form").find(".messages").html(alertBox);
						$("#contact-form")[0].reset();
					}
				}
			});
			return false
		}
	});
});
