/*
 *
 *		CUSTOM.JS
 *
 */

(function($){
	
	// DETECT TOUCH DEVICE //
	function is_touch_device() {
		return !!('ontouchstart' in window) || ( !! ('onmsgesturechange' in window) && !! window.navigator.maxTouchPoints);
	}
	
	
	// SHOW/HIDE MOBILE MENU //
	function show_hide_mobile_menu() {
		
		$("#mobile-menu-button").on("click", function(e) {
            
			e.preventDefault();
			
			$("#mobile-menu").slideToggle(300);
			
        });	
		
	}
	
	
	// MOBILE MENU //
	function mobile_menu() {
		
		if ($(window).width() < 992) {
			
			if ($("#menu").length > 0) {
			
				if ($("#mobile-menu").length < 1) {
					
					$("#menu").clone().attr({
						id: "mobile-menu",
						class: ""
					}).insertAfter("#header");
					
					$("#mobile-menu .megamenu > a").on("click", function(e) {
                        
						e.preventDefault();
						
						$(this).toggleClass("open").next("div").slideToggle(300);
						
                    });
					
					$("#mobile-menu .dropdown > a").on("click", function(e) {
                        
						e.preventDefault();
						
						$(this).toggleClass("open").next("ul").slideToggle(300);
						
                    });
				
				}
				
			}
				
		} else {
			
			$("#mobile-menu").hide();
			
		}
		
	}
	
	
	// HEADER SEARCH //
	function header_search() {	
		
		$(".menu li.search a").on("click", function(e) { 
		
			e.preventDefault();
			
			if(!$(".menu li.search a").hasClass("open")) {
			
				$("#search-form").fadeIn().addClass("open");
				
				$("#search-form").append('<a class="close" href="#">x</a>');
				
			}
			
			$("#search-form a.close").on("click", function(e) { 
		
				e.preventDefault();
				$("#search-form").fadeOut().removeClass("open");
				$(this).remove();
				
			});
			
		});
		
		$(window).scroll(function(){

			$("#search-form").fadeOut(300);

		});
		
	}
	
	
	// STICKY //
	function sticky() {
		
		var sticky_point = $("#header-container").innerHeight();
		var sticky_point_2 = $("#header-top").innerHeight() + $("#header").innerHeight();
		
		$("#header").clone().attr({
			id: "header-sticky",
			class: ""
		}).insertAfter("header");
		
		$(window).scroll(function(){
			
			if ($(window).scrollTop() > sticky_point) {  
				$("#header-sticky").fadeIn(0).addClass("header-sticky");
				$("#header .menu ul, #header .menu .megamenu-container").css({"visibility": "hidden"});
			} else {
				$("#header-sticky").fadeOut(0).removeClass("header-sticky");
				$("#header .menu ul, #header .menu .megamenu-container").css({"visibility": "visible"});
			}
			
			if ($(window).scrollTop() > sticky_point_2) {
				$("#header-sticky").addClass("header-sticky-small");
			} else {
				$("#header-sticky").removeClass("header-sticky-small");
			}
			
		});
		
		$("#header-sticky .menu li.search a").on("click", function(e) { 
		
			e.preventDefault();
			
			if(!$("#header-sticky .menu li.search a").hasClass("open")) {
			
				$("#header-sticky #search-form").fadeIn().addClass("open");
				
				$("#header-sticky #search-form").append('<a class="close" href="#">x</a>');
				
			}
			
			$("#search-form a.close").on("click", function(e) { 
		
				e.preventDefault();
				$("#header-sticky #search-form").fadeOut().removeClass("open");
				$(this).remove();
				
			});
			
		});
		
		$(window).scroll(function(){

			$("#header-sticky #search-form").fadeOut(300);

		});
		
	}
	
 
	// PROGRESS BARS // 
	function progress_bars() {
		
		$(".progress .progress-bar:in-viewport").each(function() {
			
			if (!$(this).hasClass("animated")) {
				$(this).addClass("animated");
				$(this).animate({
					width: $(this).attr("data-width") + "%"
				}, 2000);
			}
			
		});
		
	}


	// CHARTS //
	function pie_chart() {
		
		if (typeof $.fn.easyPieChart !== 'undefined') {
		
			$(".pie-chart:in-viewport").each(function() {
				
				$(this).easyPieChart({
					animate: 1500,
					lineCap: "square",
					lineWidth: $(this).attr("data-line-width"),
					size: $(this).attr("data-size"),
					barColor: $(this).attr("data-bar-color"),
					trackColor: $(this).attr("data-track-color"),
					scaleColor: "transparent",
					onStep: function(from, to, percent) {
						$(this.el).find(".pie-chart-percent .value").text(Math.round(percent));
					}
				});
				
			});
			
		}
		
	}
	
	// COUNTER //
	function counter() {
		
		if (typeof $.fn.jQuerySimpleCounter !== 'undefined') {
		
			$(".counter .counter-value:in-viewport").each(function() {
				
				if (!$(this).hasClass("animated")) {
					$(this).addClass("animated");
					$(this).jQuerySimpleCounter({
						start: 0,
						end: $(this).attr("data-value"),
						duration: 2000
					});	
				}
			
			});
			
		}
	}
	
	
	function statistics() {
		
		if (typeof Chart !== 'undefined') {
		
			$(".statistics-container .animate-chart:in-viewport").each(function() {
				
				if(!$(this).hasClass("animated")) {
					
					$(this).addClass("animated");
					
					// LINE CHART //
					var data1 = {
						labels : ["0", "10", "20", "30", "40", "50", "60", "70", "80", "90", "100", "150", "200", "250", "300"],
						datasets : [
							{
								fill: "true",
								label: "Profit",
								backgroundColor: "transparent",
								borderWidth: 1,
								borderColor: "#1c0533",
								pointBorderColor: "#1c0533",
								pointBackgroundColor: "#fff",
								pointHoverBackgroundColor: "#fff",
								pointHoverBorderColor: "#1c0533",
								pointBorderWidth: 1,
								pointHoverBorderWidth: 1,
								tension: 0,
								stacked: false,
								data : ["35", "25", "40", "35", "50", "45", "65", "70", "85", "75", "70", "73", "55", "40", "55"]
							},
							{
								fill: "true",
								label: "Revenue",
								backgroundColor: "transparent",
								borderWidth: 1,
								borderColor: "#894aca",
								pointBorderColor: "#894aca",
								pointBackgroundColor: "#fff",
								pointHoverBackgroundColor: "#fff",
								pointHoverBorderColor: "#894aca",
								pointBorderWidth: 1,
								pointHoverBorderWidth: 1,
								tension: 0,
								stacked: false,
								data : ["30", "40", "33", "50", "43", "30", "60", "50", "70", "30", "50", "45", "65", "50", "70"]
							}
						]
					}
					
					if ($("#line-chart").length > 0) {
						
						var line_chart = new Chart(document.getElementById("line-chart").getContext("2d"), {
							type: 'line',
							data: data1,
							options: {
								responsive: true,
								legend: {
									display: true,
									labels: {
										boxWidth: 12,
										fontColor: "#838383",
										fontFamily: "Roboto",
										fontSize: 12,
										padding: 20
									}
								},
								tooltips: {
									enabled: false
								},
								scales: {
									xAxes: [{
										display: true,
									}],
									yAxes: [{
										display: true,
										ticks: {
											suggestedMin: 0,
											suggestedMax: 100,
										}
									}]
								}
							}
						});

					}
					
					
					// DOUGHNUT CHART //
					var data2 = {
						labels: [
							"Credibility",
							"Sustenability",
							"Economy"
						],
						datasets: [
						{
							data: [20, 10, 70],
							borderWidth: 0,
							backgroundColor: [
								"#894aca",
								"#1c0533",
								"#d7d7d7"
							],
							hoverBackgroundColor: [
								"#894aca",
								"#1c0533",
								"#d7d7d7"
							]
						}]
					};
					
					if ($("#doughnut-chart").length > 0) {
						
						var doughnut_chart = new Chart(document.getElementById("doughnut-chart").getContext("2d"), {
							type: 'doughnut',
							data: data2,
							options: {
								cutoutPercentage: 80,
								responsive: true,
								legend: {
									display: true,
									position: "bottom",
									labels: {
										boxWidth: 12,
										fontFamily: "Roboto",
										fontSize: 12,
										padding: 20
									}
								},
								tooltips: {
									enabled: false
								},
								scales: {
									xAxes: [{
										display: false
									}],
									yAxes: [{
										display: false,
									}]
								}
							}
						});

					}
					
					
					// PIE CHART //
					var data3 = {
						labels: [
							"Credibility",
							"Sustenability",
							"Economy"
						],
						datasets: [
						{
							data: [20, 10, 70],
							borderWidth: 0,
							backgroundColor: [
								"#894aca",
								"#1c0533",
								"#d7d7d7"
							],
							hoverBackgroundColor: [
								"#894aca",
								"#1c0533",
								"#d7d7d7"
							]
						}]
					};
					
					if ($("#pie-chart").length > 0) {
						
						var pie_chart = new Chart(document.getElementById("pie-chart").getContext("2d"), {
							type: 'pie',
							data: data3,
							options: {
								responsive: true,
								legend: {
									display: true,
									position: "bottom",
									labels: {
										boxWidth: 12,
										fontColor: "#838383",
										fontFamily: "Roboto",
										fontSize: 12,
										padding: 20
									}
								},
								tooltips: {
									enabled: false
								},
								scales: {
									xAxes: [{
										display: false
									}],
									yAxes: [{
										display: false,
									}]
								}
							}
						});

					}
					
					
					// BAR CHART //
					var data4 = {
						labels : ["Jan", "Feb", "Mar", "Apr", "May", "Jun"],
						datasets : [
							{
								label: "Profit",
								backgroundColor: "#894aca",
								borderColor: "#fff",
								borderWidth: 3,
								hoverBorderWidth: 3,
								hoverBackgroundColor: "#894aca",
								hoverBorderColor: "#fff",
								data : [80, 70, 60, 50, 80, 50]
							},
							{
								label: "Revenue",
								backgroundColor: "#1c0533",
								borderColor: "#fff",
								borderWidth: 3,
								hoverBorderWidth: 3,
								hoverBackgroundColor: "#1c0533",
								hoverBorderColor: "#fff",
								data : [70, 60, 55, 40, 100, 75]
							}
						]
					}
					
					if ($("#bar-chart").length > 0) {
						
						var bar_chart = new Chart(document.getElementById("bar-chart").getContext("2d"), {
							type: 'bar',
							data: data4,
							options: {
								responsive: true,
								legend: {
									display: true,
									labels: {
										boxWidth: 12,
										fontColor: "#838383",
										fontFamily: "Roboto",
										fontSize: 12,
										padding: 20
									}
								},
								tooltips: {
									enabled: true,
									xPadding: 15
								},
								scales: {
									xAxes: [{
										display: false
									}],
									yAxes: [{
										display: false,
										ticks: {
											suggestedMin: 0,
											suggestedMax: 100,
										}
									}]
								}
							}
						});

					}
					
					
					// AREA CHART //
					var data5 = {
						labels : ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
						datasets : [
							{
								fill: "true",
								label: "Profit",
								backgroundColor: "rgba(137, 74, 202, 0.2)",
								borderWidth: 1,
								borderColor: "#894aca",
								pointBorderColor: "#894aca",
								pointBackgroundColor: "#fff",
								pointHoverBackgroundColor: "#fff",
								pointHoverBorderColor: "#894aca",
								pointBorderWidth: 1,
								pointHoverBorderWidth: 1,
								tension: 0.4,
								stacked: false,
								data : [55, 85, 65, 70, 40, 65, 75, 55, 70, 40, 65, 45]
							},
							{
								fill: "true",
								label: "Revenue",
								backgroundColor: "transparent",
								borderWidth: 1,
								borderColor: "#1c0533",
								pointBorderColor: "#1c0533",
								pointBackgroundColor: "#fff",
								pointHoverBackgroundColor: "#fff",
								pointHoverBorderColor: "#1c0533",
								pointBorderWidth: 1,
								pointHoverBorderWidth: 1,
								tension: 0.4,
								stacked: false,
								data : [65, 75, 55, 65, 50, 75, 90, 80, 60, 50, 55, 70]
							}
						]
					}
					
					if ($("#area-chart").length > 0) {
						
						var area_chart = new Chart(document.getElementById("area-chart").getContext("2d"), {
							type: 'line',
							data: data5,
							options: {
								responsive: true,
								legend: {
									display: true,
									labels: {
										boxWidth: 12,
										fontColor: "#838383",
										fontFamily: "Roboto",
										fontSize: 12,
										padding: 20
									}
								},
								tooltips: {
									enabled: false
								},
								scales: {
									xAxes: [{
										display: true
									}],
									yAxes: [{
										display: true,
										ticks: {
											suggestedMin: 0,
											suggestedMax: 100,
										}
									}]
								}
							}
						});

					}
					
				}
				
			});
			
		}
		
	}
	
	
	// LOAD MORE PROJECTS //
	function load_more_projects() {
	
		var number_clicks = 0;
		
		$(".load-more").on("click", function(e) {
			
			e.preventDefault();
			
			if (number_clicks == 0) {
				$.ajax({
					type: "POST",
					url: $(".load-more").attr("href"),
					dataType: "html",
					cache: false,
					msg : '',
					success: function(msg) {
						$(".isotope").append(msg);	
						$(".isotope").imagesLoaded(function() {
							$(".isotope").isotope("reloadItems").isotope();
							$(".fancybox").fancybox({
								prevEffect: 'fade',
								nextEffect: 'fade',
								padding: 0
							});
						});
						number_clicks++;
						$(".load-more").html("Nothing to load");
					}
				});
			}
			
		});
		
	}
	
	
	// SHOW/HIDE SCROLL UP //
	function show_hide_scroll_top() {
		
		if ($(window).scrollTop() > $(window).height()/2) {
			$("#scroll-up").fadeIn(300);
		} else {
			$("#scroll-up").fadeOut(300);
		}
		
	}
	
	
	// SCROLL UP //
	function scroll_up() {				
		
		$("#scroll-up").on("click", function() {
			$("html, body").animate({
				scrollTop: 0
			}, 800);
			return false;
		});
		
	}
	
	
	// INSTAGRAM FEED //
	function instagram_feed() {

		if ($("#instafeed").length > 0 ) {
				
			var nr = $("#instafeed").data('number');
			var userid = $("#instafeed").data('user');
			var accesstoken = $("#instafeed").data('accesstoken');
			
			var feed = new Instafeed({
				target: 'instafeed',
				get: 'user',
				userId: userid,
				accessToken: accesstoken,
				limit: nr,
				resolution: 'thumbnail',
				sortBy: 'most-recent'
			});
			
			feed.run();
		
		}
		
	}
	
	// MULTILAYER PARALLAX //
	function multilayer_parallax() {
		
		$(".multilayer-parallax .parallax-layer").each(function(){
			
			var x = parseInt($(this).attr("data-x"), 10),
				y = parseInt($(this).attr("data-y"), 10);
			
			$(this).css({
				"left": x + "%", 
				"top": y + "%"
			});
			
			if ($(this).attr("data-x") === "center") {
				$(this).addClass("x-center");
			}
			
		});

	}
	
	
	// EQUAL HEIGHT //
	function equal_height() {

		$(".text-boxes-list").each(function(){
			
			var x = 0;
			
			$(".text-boxes-list li").each(function() {
				
				if($(this).height() > x) {
					x = $(this).height();
				}
				
			});
			
			$(".text-boxes-list li .text-box").css("height", x + "px");

		});
		
		if ($(window).width() > 767) {
		
			$(".services-list").each(function(){
				
				var x = 0;
				
				$(".services-list li").each(function() {
					
					if($(this).height() > x) {
						x = $(this).height();
					}
					
				});
				
				$(".services-list li .service-box").css("height", x + "px");

			});
			
		}

	}
	
	
	// FULL SCREEN //
	function full_screen() {

		if ($(window).width() > 767) {
			$(".full-screen").css("height", $(window).height() + "px");
		} else {
			$(".full-screen").css("height", "auto");
		}

	}
	
	
	// ANIMATIONS //
	function animations() {
		
		animations = new WOW({
			boxClass: 'wow',
			animateClass: 'animated',
			offset: 100,
			mobile: false,
			live: true
		});
		
		animations.init();
		
	}
	
	// DOCUMENT READY //
	$(document).ready(function(){
		
		// STICKY //
		sticky();
		
		
		// MENU //
		if (typeof $.fn.superfish !== 'undefined') {
			
			$(".menu").superfish({
				delay: 500,
				animation: {
					opacity: 'show',
					height: 'show'
				},
				speed: 'fast',
				autoArrows: true
			});
			
		}
		
		
		// HEADER SEARCH //
		header_search();
		
		
		// SHOW/HIDE MOBILE MENU //
		show_hide_mobile_menu();
		
		
		// MOBILE MENU //
		mobile_menu();
		
		
		// FANCYBOX //
		if (typeof $.fn.fancybox !== 'undefined') {
		
			$(".fancybox").fancybox({
				prevEffect: 'fade',
				nextEffect: 'fade',
				padding: 0
			});
		
		}
		
		// REVOLUTION SLIDER //
		if (typeof $.fn.revolution !== 'undefined') {
			
			$(".rev_slider").revolution({
				sliderType: "standard",
				sliderLayout: "auto",
				delay: 5000,
				navigation: {
					arrows:{
						style: "custom",
						enable: true,
						hide_onmobile: true,
						hide_onleave: false,
						hide_delay: 200,
						hide_delay_mobile: 1200,
						hide_under: 0,
						hide_over: 9999,
						tmp: '',
						left: {
							h_align: "left",
							v_align: "center",
							h_offset: 20,
							v_offset: 0
						 },
						 right: {
							h_align: "right",
							v_align: "center",
							h_offset: 20,
							v_offset: 0
						 }
					},
					bullets:{
						style: "custom",
						enable: true,
						hide_onmobile: false,
						hide_onleave: false,
						hide_delay: 200,
						hide_delay_mobile: 1200,
						hide_under: 0,
						hide_over: 9999,
						tmp: '', 
						direction: "horizontal",
						space: 10,       
						h_align: "center",
						v_align: "bottom",
						h_offset: 0,
						v_offset: 40
					},
					touch:{
						touchenabled: "on",
						swipe_treshold: 75,
						swipe_min_touches: 1,
						drag_block_vertical: false,
						swipe_direction: "horizontal"
					}
				},
				parallax:{
					type: "mouse",
					levels: [5,10,15,20,25,30,35,40,45,50,55,60,65,70,75,80,85],
					origo: "enterpoint",
					speed: 400,
					bgparallax: "false",
					disable_onmobile: "off"
				},
				gridwidth: 1170,
				gridheight: 895		
			});
			
		}
	
	
		// OWL Carousel //
		if (typeof $.fn.owlCarousel !== 'undefined') {
			
			// IMAGES SLIDER //
			$(".owl-carousel.images-slider").owlCarousel({
				items: 1,
				autoplay: true,
				autoplayTimeout: 3000,
				autoplayHoverPause: true,
				smartSpeed: 700,
				loop: true,
				nav: false,
				navText: false,
				dots: true,
				mouseDrag: true,
				touchDrag: true,
				animateIn: 'fadeIn',
				animateOut: 'fadeOut'
			});
			
			
			// TESTIMONIALS SLIDER //
			$(".owl-carousel.testimonials-slider").owlCarousel({
				autoplay: true,
				autoplayTimeout: 3000,
				autoplayHoverPause: true,
				smartSpeed: 700,
				loop: true,
				nav: true,
				navText: false,
				dots: true,
				mouseDrag: true,
				touchDrag: true,
				margin: 20,
				responsive: {
					0:{
						items: 1
					},
					480:{
						items: 2
					},
					768:{
						items: 3
					},
					992:{
						items: 4
					}
				}
			});
			
			
			// LOGOS SLIDER //
			$(".owl-carousel.logos-slider").owlCarousel({
				autoplay: true,
				autoplayTimeout: 3000,
				autoplayHoverPause: true,
				smartSpeed: 700,
				loop: true,
				nav: true,
				navText: false,
				dots: false,
				mouseDrag: true,
				touchDrag: true,
				responsive: {
					0:{
						items: 1
					},
					480:{
						items: 2
					},
					768:{
						items: 3
					},
					992:{
						items: 4
					},
					1200:{
						items: 5
					}
				}
			});
		
		}
		
		
		// GOOGLE MAPS //
		if (typeof $.fn.gmap3 !== 'undefined') {
		
			$(".map").each(function() {
				
				var data_zoom = 15,
					data_height,
					data_popup = false;
				
				if ($(this).attr("data-zoom") !== undefined) {
					data_zoom = parseInt($(this).attr("data-zoom"),10);
				}	
				
				if ($(this).attr("data-height") !== undefined) {
					data_height = parseInt($(this).attr("data-height"),10);
				}
				
				if ($(this).attr("data-address-details") !== undefined) {
					
					data_popup = true;
					
					var infowindow = new google.maps.InfoWindow({
						content: $(this).attr("data-address-details")
					});
					
				}
				
				
				$(this)
				.gmap3({
					address: $(this).attr("data-address"),
					zoom: data_zoom,
					mapTypeId: google.maps.MapTypeId.ROADMAP,
					scrollwheel: false
				})
				.marker([
					{address: $(this).attr("data-address")}
				])
				.on({
					click: function(marker, event){
						if (data_popup) {
							infowindow.open(marker.get('map'), marker);
						}
					}
				});
				  
				$(this).css("height", data_height + "px");
				
			});
			
		}
		
		
		// ISOTOPE //
		if ((typeof $.fn.imagesLoaded !== 'undefined') && (typeof $.fn.isotope !== 'undefined')) {
		
			$(".isotope").imagesLoaded( function() {
				
				var container = $(".isotope");
				
				container.isotope({
					itemSelector: '.isotope-item',
					layoutMode: 'masonry',
					transitionDuration: '0.8s'
				});
				
				$(".filter li a").on("click", function() {
					$(".filter li a").removeClass("active");
					$(this).addClass("active");
		
					var selector = $(this).attr("data-filter");
					container.isotope({
						filter: selector
					});
		
					return false;
				});
		
				$(window).resize(function() {
					container.isotope();
				});
				
			});
			
		}
		
		
		// LOAD MORE PORTFOLIO ITEMS //
		load_more_projects();
		
		
		// PLACEHOLDER //
		if (typeof $.fn.placeholder !== 'undefined') {
			
			$("input, textarea").placeholder();
			
		}
		
		
		// CONTACT FORM VALIDATE & SUBMIT //
		// VALIDATE //
		if (typeof $.fn.validate !== 'undefined') {
		
			$("#contact-form").validate({
				rules: {
					name: {
						required: true
					},
					email: {
						required: true,
						email: true
					},
					subject: {
						required: true
					},
					message: {
						required: true,
						minlength: 10
					}
				},
				messages: {
					name: {
						required: "Please enter your name!"
					},
					email: {
						required: "Please enter your email!",
						email: "Please enter a valid email address"
					},
					subject: {
						required: "Please enter the subject!"
					},
					message: {
						required: "Please enter your message!"
					}
				},
					
				// SUBMIT //
				submitHandler: function(form) {
					var result;
					$(form).ajaxSubmit({
						type: "POST",
						data: $(form).serialize(),
						url: "assets/php/send.php",
						success: function(msg) {
							
							if (msg == 'OK') {
								result = '<div class="alert alert-success">Your message was successfully sent!</div>';
								$("#contact-form").clearForm();
							} else {
								result = msg;
							}
							
							$("#alert-area").html(result);
		
						},
						error: function() {
		
							result = '<div class="alert alert-danger">There was an error sending the message!</div>';
							$("#alert-area").html(result);
		
						}
					});
				}
			});
			
		}
		
		
		// PARALLAX //
		if (typeof $.fn.stellar !== 'undefined') {
		
			// MULTILAYER PARALLAX //
			multilayer_parallax();
		
			if (!is_touch_device()) {
				
				$(window).stellar({
					horizontalScrolling: false,
					verticalScrolling: true,
					responsive: true
				});
				
			}
		
		}
		
		
		// SHOW/HIDE SCROLL UP
		show_hide_scroll_top();
		
		
		// SCROLL UP //
		scroll_up();
		
		
		// PROGRESS BARS //
		progress_bars();
		
		
		// PIE CHARTS //
		pie_chart();
		
		
		// COUNTER //
		counter();
		
		
		// STATISTICS //
		statistics();
		
		
		// YOUTUBE PLAYER //
		if (typeof $.fn.mb_YTPlayer !== 'undefined') {
			
			$(".youtube-player").mb_YTPlayer();
		
		}
		
		
		// COUNTDOWN //
		if (typeof $.fn.countdown !== 'undefined') {
			
			$(".countdown").countdown('2017/12/31 00:00', function(event) {
				$(this).html(event.strftime(
					'<div><div class="count">%-D</div> <span>Days</span></div>' +
					'<div><div class="count">%-H</div> <span>Hours</span></div>' +
					'<div><div class="count">%-M</div> <span>Minutes</span></div>' +
					'<div><div class="count">%S</div> <span>Seconds</span></div>'
				));
			});
		
		}
		
		
		// INSTAGRAM FEED //
		instagram_feed();
		
		
		// EQUAL HEIGHT //
		equal_height();
		
		
		// FULL SCREEN //
		full_screen();
		
		
		// ANIMATIONS //
		animations();
		
	});

	
	// WINDOW SCROLL //
	$(window).scroll(function() {
		
		progress_bars();
		pie_chart();
		counter();
		statistics();
		show_hide_scroll_top();
		
	});
	
	
	// WINDOW RESIZE //
	$(window).resize(function() {

		mobile_menu();
		equal_height();
		full_screen();
		
	});
	
})(window.jQuery);