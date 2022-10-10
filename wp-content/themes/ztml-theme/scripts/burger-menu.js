jQuery(document).ready(function ($) {
	const hamburgerMenuEl = $("#burger-nav");
	let hamburgerIsOpen = false;

	const closeHamburgerMenu = () => {
		hamburgerMenuEl.css("transform", "translateX(-1000%)");
		hamburgerIsOpen = false;
		$("body").css("overflow-y", "auto");
		$("html").css("overflow-y", "auto");
		$("body .spalshscreen").css("display", "none");
	};

	const openHamburgerMenu = () => {
		$("header.header .sub-nav #burger-nav").css({
			top: $("#header-stiky").height(),
		});
		hamburgerMenuEl.css("transform", "translateX(0)");
		$("body").css("overflow-y", "hidden");
		$("html").css("overflow-y", "hidden");
		$("body .spalshscreen").css("display", "block");
		hamburgerIsOpen = true;
	};

	const closeSidebar = () => {
		$("#secondary").removeClass("active");
		$(".secondary-mobile .secondary-mobile-btn").removeClass("active");
		$("body").css("overflow-y", "auto");
		$("html").css("overflow-y", "auto");
		$("body .spalshscreen").css("display", "none");
	};

	const openSidebar = () => {
		closeHamburgerMenu();
		$("body .spalshscreen").css("display", "block");
		$("#secondary").addClass("active");
		$(".secondary-mobile .secondary-mobile-btn").addClass("active");
		$("html").css("overflow-y", "hidden");
		$("body").css("overflow-y", "hidden");
		$("body .spalshscreen").css("display", "block");
	};

	const wpbarHeight =
		$("#wpadminbar").height() > 0 ? $("#wpadminbar").height() : 0;

	$("#secondary").stickySidebar({
		topSpacing: $("header").height() + wpbarHeight + 32,
		bottomSpacing: 80,
		containerSelector: ".main-container",
	});

	$(".secondary-mobile-btn").on("click", function (e) {
		e.stopPropagation();
		if ($("#secondary").hasClass("active")) {
			closeSidebar();
		} else {
			openSidebar();
		}
	});

	$(document).on("click", function (e) {
		e.stopPropagation();
		const $tg = $(e.target);

		const isHamburgerMenuBtn = Boolean($tg.closest("#burger-btn").length);
		const isHamburgerMenu = Boolean($tg.closest("#burger-nav").length);

		if (isHamburgerMenuBtn && !isHamburgerMenu) {
			if (hamburgerIsOpen) {
				closeHamburgerMenu();
			} else {
				closeSidebar();
				openHamburgerMenu();
			}
		} else if (
			!(isHamburgerMenuBtn || isHamburgerMenu) &&
			hamburgerIsOpen == true
		) {
			closeHamburgerMenu();
		}
	});
});
