jQuery(document).ready(function ($) {
	$(window).scroll(function () {
		var sticky = $("#header-stiky"),
			scroll = $(window).scrollTop();

		if (scroll >= $("#header-stiky").height() + 300) {
			sticky.addClass("is-sticky sticky");
		} else {
			sticky.removeClass("is-sticky sticky");
		}
	});
});

jQuery(document).ready(function ($) {
	const sidebarLabel = $("#sidebar-label");
	const sidebar = $("#sidebar-wrapper");

	let sidebarOn = false;

	sidebarLabel.on("click", function (e) {
		sidebarOn = !sidebarOn;
		sidebarOn ? sidebar.addClass("active") : sidebar.removeClass("active");
		sidebar.css("right", sidebarOn ? "0px" : "-320px");
	});
});

jQuery(document).ready(function ($) {
	$(".minimize-bar").on("click", () => {
		$("footer .timeline").removeClass("minimize");
	});

	new IntersectionObserver(([obj]) => {
		if ($("footer .timeline").hasClass("minimize")) {
			$("footer .timeline").css("position", "fixed");

			if (obj.isIntersecting) {
				$("footer .timeline").addClass("inverted");
			} else {
				$("footer .timeline").removeClass("inverted");
			}
		} else {
			if (obj.isIntersecting) {
				$("footer .timeline").addClass("inverted");
				$("footer .timeline").css("position", "static");
			} else {
				$("footer .timeline").removeClass("inverted");
				$("footer .timeline").css("position", "fixed");
			}
		}
	}).observe(document.querySelector("footer.footer"));
});

jQuery(document).ready(function ($) {
	$(".managment-list .mob-get-more").on("click", function functionName() {
		more_block = $(this).prev();
		if (more_block.hasClass("active")) {
			more_block.removeClass("active");
			$(this).text("Читать все");
		} else {
			more_block.addClass("active");
			$(this).text("Скрыть");
		}
	});
});

jQuery(document).ready(function ($) {
	new Swiper(".swiper-container.two", {
		pagination: ".swiper-pagination",
		paginationClickable: true,
		clickable: true,
		paginationBulletRender: function (index, className) {
			return '<span class="swiper-pagination-bullet"></span>';
		},
		effect: "coverflow",
		autoHeight: false,
		loop: false,
		centeredSlides: true,
		slidesPerView: "auto",
		spaceBetween: 0,
		coverflow: {
			rotate: 0,
			stretch: 100,
			depth: 0,
			modifier: 1.5,
			slideShadows: false,
		},
		breakpoints: {
			576: {
				spaceBetween: 700,
			},
			768: {
				spaceBetween: 0,
			},
		},
	});
});

jQuery(document).ready(function ($) {
	const districtPreviewEl = $(".district-preview");
	const $districtTabletEls = $(
		".district-tablet-template .districts-list-container .district-item"
	);
	let currentSlideIndex = 0;

	const alignHeightDistricts = () => {
		let maxH = 0;
		$(".district-preview>.district-item > div").each(function () {
			if ($(this).height() > maxH) {
				maxH = $(this).height();
			}
		});

		$(".district-preview>.district-item").each(function () {
			$(this).height(maxH < 100 ? 550 : maxH);
		});
	};

	const districtEls = districtPreviewEl.find(".district-item");

	districtPreviewEl.click((e) => {
		alignHeightDistricts();
		$target = $(e.target);
		$caption = $target.closest(".district-item");

		if ($caption.length > 0) {
			districtEls.removeClass("active");
			currentSlideIndex = $caption.data("id");
			$caption.addClass("active");

			$districtTabletEls.removeClass("active");
			$($districtTabletEls[currentSlideIndex]).addClass("active");
		}
		alignHeightDistricts();
	});

	const sliderAdaptive = () => {
		if ($(window).width() < 768) {
			if ($(".district-preview").hasClass(".slick-initialized") == false) {
				$(".district-preview").find(".district-item").addClass("active");
				districtPreviewEl.not(".slick-initialized").slick({
					slidesToShow: 1,
					arrows: false,
					dots: true,
					arrows: true,
					prevArrow: $("#js-features-arrows__prev"),
					nextArrow: $("#js-features-arrows__next"),
				});
				districtPreviewEl.slick("slickGoTo", currentSlideIndex);
				districtPreviewEl.on("afterChange", function (event, slick, nextSlide) {
					$($districtTabletEls[currentSlideIndex]).removeClass("active");
					currentSlideIndex = nextSlide;
					$($districtTabletEls[currentSlideIndex]).addClass("active");
				});
			}
		} else {
			if (districtPreviewEl.hasClass("slick-initialized")) {
				districtPreviewEl.slick("unslick");
			}

			districtPreviewEl.find(".district-item").removeClass("active");
			$(districtPreviewEl.find(".district-item")[currentSlideIndex]).addClass(
				"active"
			);
		}
		alignHeightDistricts();
	};

	$(".districts-list ul").on("click", (e) => {
		$target = $(e.target);
		$caption = $target.closest(".district-caption");

		if ($caption.length > 0) {
			$($districtTabletEls[currentSlideIndex]).removeClass("active");
			currentSlideIndex = $caption.data("id");
			$($districtTabletEls[currentSlideIndex]).addClass("active");
		}
		alignHeightDistricts();
	});

	sliderAdaptive();
	$(window).on("resize", sliderAdaptive);
});

jQuery(document).ready(function ($) {
	$(".burger-nav .menu").on("click", (e) => {
		$target = $(e.target);
		$parentLink = $target.closest(".menu-item.menu-item-has-children");
		$parentLink.find(".sub-menu").toggle("slow");
		$parentLink.find("button").toggleClass("expand");
	});
});

jQuery(document).ready(function ($) {
	$("header.header .sub-nav #burger-nav").css({
		top: $("#header-stiky").height(),
	});
});

jQuery(document).ready(function ($) {
	// const timelineEl = $(".timeline");
	// let isTimelineEl = false;
	// timelineEl.mousemove(() => {
	// 	if (
	// 		$(".timeline .container.news").hasClass("expanded") &&
	// 		$(window).width() > 768
	// 	) {
	// 		$("html").css("overflow-y", "hidden");
	// 		$("body").css("overflow-y", "hidden");
	// 		isTimelineEl = true;
	// 	}
	// });
	// timelineEl.mouseleave(() => {
	// 	if (isTimelineEl && $(window).width() > 768) {
	// 		$("body").css("overflow-y", "auto");
	// 		$("html").css("overflow-y", "auto");
	// 		isTimelineEl = false;
	// 	}
	// });
	// const $container = $(".timeline .timeline__news-list-expanded");
	// let scroll = 0;
	// $(window).on("wheel", function (e) {
	// 	if (isTimelineEl && $(window).width() > 768) {
	// 		const maxScroll = $container.prop("scrollHeight") - $container.height();
	// 		if (e.originalEvent.deltaY !== 0) {
	// 			if (e.originalEvent.deltaY < 0 && scroll > 0) {
	// 				scroll += e.originalEvent.deltaY * 0.1;
	// 			} else if (e.originalEvent.deltaY > 0 && scroll < maxScroll) {
	// 				scroll += e.originalEvent.deltaY * 0.1;
	// 			}
	// 		}
	// 		$container.scrollTop(scroll);
	// 	}
	// });
});
