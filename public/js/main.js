AOS.init({
	duration: 800,
	easing: 'slide'
});

(function ($) {

	"use strict";

	$(window).stellar({
		responsive: true,
		parallaxBackgrounds: true,
		parallaxElements: true,
		horizontalScrolling: false,
		hideDistantElements: false,
		scrollProperty: 'scroll'
	});


	// loader
	var loader = function () {
		setTimeout(function () {
			if ($('#ftco-loader').length > 0) {
				$('#ftco-loader').removeClass('show');
			}
		}, 1);
	};
	loader();

	// Scrollax
	$.Scrollax();

	// Burger Menu
	var burgerMenu = function () {

		$('body').on('click', '.js-fh5co-nav-toggle', function (event) {

			event.preventDefault();

			if ($('#ftco-nav').is(':visible')) {
				$(this).removeClass('active');
			} else {
				$(this).addClass('active');
			}



		});

	};
	burgerMenu();


	var onePageClick = function () {


		$(document).on('click', '#ftco-nav a[href^="#"]', function (event) {
			event.preventDefault();

			var href = $.attr(this, 'href');

			$('html, body').animate({
				scrollTop: $($.attr(this, 'href')).offset().top - 70
			}, 500, function () {
				// window.location.hash = href;
			});
		});

	};

	onePageClick();


	var carousel = function () {
		$('.carousel-testimony').owlCarousel({
			autoplay: true,
			autoHeight: true,
			center: true,
			loop: true,
			items: 1,
			margin: 0,
			stagePadding: 0,
			nav: false,
			dots: true,
			navText: ['<span class="ion-ios-arrow-back">', '<span class="ion-ios-arrow-forward">'],
			responsive: {
				0: {
					items: 1
				},
				600: {
					items: 1
				},
				1000: {
					items: 1
				}
			}
		});
		$('.carousel-project').owlCarousel({
			autoplay: true,
			autoHeight: true,
			center: true,
			loop: true,
			items: 1,
			margin: 30,
			stagePadding: 0,
			nav: false,
			dots: true,
			navText: ['<span class="ion-ios-arrow-back">', '<span class="ion-ios-arrow-forward">'],
			responsive: {
				0: {
					items: 1
				},
				600: {
					items: 2
				},
				1000: {
					items: 3
				}
			}
		});

	};
	carousel();
	$('.clockpicker').clockpicker();

	$('#dropdown04').on('show.bs.dropdown', function () {
		console.log('show');
	});

	// scroll
	var scrollWindow = function () {
		$(window).scroll(function () {
			var $w = $(this),
				st = $w.scrollTop(),
				navbar = $('.ftco_navbar'),
				sd = $('.js-scroll-wrap');

			if (st > 150) {
				if (!navbar.hasClass('scrolled')) {
					navbar.addClass('scrolled');
				}
			}
			if (st < 150) {
				if (navbar.hasClass('scrolled')) {
					navbar.removeClass('scrolled sleep');
				}
			}
			if (st > 350) {
				if (!navbar.hasClass('awake')) {
					navbar.addClass('awake');
				}

				if (sd.length > 0) {
					sd.addClass('sleep');
				}
			}
			if (st < 350) {
				if (navbar.hasClass('awake')) {
					navbar.removeClass('awake');
					navbar.addClass('sleep');
				}
				if (sd.length > 0) {
					sd.removeClass('sleep');
				}
			}
		});
	};
	scrollWindow();



	var counter = function () {

		$('#section-counter, .hero-wrap, .ftco-counter').waypoint(function (direction) {

			if (direction === 'down' && !$(this.element).hasClass('ftco-animated')) {

				var comma_separator_number_step = $.animateNumber.numberStepFactories.separator(',')
				$('.number').each(function () {
					var $this = $(this),
						num = $this.data('number');
					console.log(num);
					$this.animateNumber(
						{
							number: num,
							numberStep: comma_separator_number_step
						}, 7000
					);
				});

			}

		}, { offset: '95%' });

	}
	counter();


	var contentWayPoint = function () {
		var i = 0;
		$('.ftco-animate').waypoint(function (direction) {

			if (direction === 'down' && !$(this.element).hasClass('ftco-animated')) {

				i++;

				$(this.element).addClass('item-animate');
				setTimeout(function () {

					$('body .ftco-animate.item-animate').each(function (k) {
						var el = $(this);
						setTimeout(function () {
							var effect = el.data('animate-effect');
							if (effect === 'fadeIn') {
								el.addClass('fadeIn ftco-animated');
							} else if (effect === 'fadeInLeft') {
								el.addClass('fadeInLeft ftco-animated');
							} else if (effect === 'fadeInRight') {
								el.addClass('fadeInRight ftco-animated');
							} else {
								el.addClass('fadeInUp ftco-animated');
							}
							el.removeClass('item-animate');
						}, k * 50, 'easeInOutExpo');
					});

				}, 100);

			}

		}, { offset: '95%' });
	};
	contentWayPoint();

	// magnific popup
	$('.image-popup').magnificPopup({
		type: 'image',
		closeOnContentClick: true,
		closeBtnInside: false,
		fixedContentPos: true,
		mainClass: 'mfp-no-margins mfp-with-zoom', // class to remove default margin from left and right side
		gallery: {
			enabled: true,
			navigateByImgClick: true,
			preload: [0, 1] // Will preload 0 - before current, and 1 after the current image
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


	$('#appointment_date').datepicker({
		'format': 'm/d/yyyy',
		'autoclose': true
	});

	$('#appointment_time').timepicker();

	var navListItems = $('div.setup-panel div a'),
		navListItems2 = $('div.setup-panel a'),
		allWells = $('.setup-content'),
		allNextBtn = $('.nextBtn');

	allWells.hide();

	navListItems2.click(function (e) {
		e.preventDefault();
		var $target = $($(this).attr('href')),
			$item = $(this);

		if (!$item.hasClass('disabled')) {
			navListItems.removeClass('btn-primary').addClass('btn-default');
			$item.addClass('btn-primary');
			allWells.hide();
			$target.show();
			$target.find('input:eq(0)').focus();
		}
	});
	navListItems.click(function (e) {
		e.preventDefault();
		var $target = $($(this).attr('href')),
			$item = $(this);

		if (!$item.hasClass('disabled')) {
			navListItems.removeClass('btn-primary').addClass('btn-default');
			$item.addClass('btn-primary');
			allWells.hide();
			$target.show();
			$target.find('input:eq(0)').focus();
		}
	});

	allNextBtn.click(function () {
		var curStep = $(this).closest(".setup-content"),
			curStepBtn = curStep.attr("id"),
			nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
			curInputs = curStep.find("input[type='text'].judul,input[type='text'].target,input[type='text'].batastanggal,input[type='text'].link,input[type='url'],input[type='file'].foto,input[type='number'],input[type='textarea'],div.ql-editor"),
			isValid = true;

		$(".form-group").removeClass("has-error");
		for (var i = 0; i < curInputs.length; i++) {
			if (curInputs[i].type == undefined) {
				if (curInputs[i].textContent == "") {
					isValid = false;
					$("." + curInputs[i].className.split(" ")[0]).removeClass("displaynone");
				}
				else {
					$("span." + curInputs[i].className.split(" ")[0]).addClass("displaynone");
				}
			}
			else if (curInputs[i].type == "file") {
				if (curInputs[i].files.length == 0) {
					isValid = false;
					$("." + curInputs[i].className.split(" ")[0]).removeClass("displaynone");
				}
				else {
					$("span." + curInputs[i].className.split(" ")[0]).addClass("displaynone");
					if (curInputs[i].files[0].size > 2097152) {
						isValid = false;
						$("." + curInputs[i].className.split(" ")[0] + "2").removeClass("displaynone");
					}
					else {
						$("span." + curInputs[i].className.split(" ")[0] + "2").addClass("displaynone");
					}
				}
			}
			else {
				if (curInputs[i].value == "") {
					isValid = false;
					$("." + curInputs[i]._prevClass.split(" ")[0]).removeClass("displaynone");
				}
				else {
					$("span." + curInputs[i]._prevClass.split(" ")[0]).addClass("displaynone");
				}
			}

		}

		if (isValid)
			nextStepWizard.removeAttr('disabled').trigger('click');
	});

	$('div.setup-panel div a.btn-primary').trigger('click');

	// setTimeout(function () {
	// 	$(".owl-carousel")
	// 		.owlCarousel(
	// 			{
	// 				loop: true,
	// 				margin: 5,
	// 				center: true,
	// 				pullDrag: false,
	// 				stagePadding: 0,
	// 				autoWidth: false,
	// 				autoplay: true,
	// 				mergeFit: true,
	// 				dotsEach: 1,
	// 				items: 3
	// 			}
	// 		);
	// }, 1000)

	setTimeout(function () {
		new Sortable(wrapprogramkerja, {
			group: 'shared', // set both lists to same group
			animation: 150,
			swapClass: 'highlight', // The class applied to the hovered swap item
			onEnd: function ( /**Event*/ evt) {
				var itemEl = evt.item; // dragged HTMLElement
				evt.to; // target list
				evt.from; // previous list
				evt.oldIndex; // element's old index within old parent
				evt.newIndex; // element's new index within new parent
				evt.oldDraggableIndex; // element's old index within old parent, only counting draggable elements
				console.log(evt.newDraggableIndex); // element's new index within new parent, only counting draggable elements
				evt.clone // the clone element
				evt.pullMode; // when item is in another sortable: `"clone"` if cloning, `true` if moving
			},
		})
	}, 2000)

})(jQuery);

