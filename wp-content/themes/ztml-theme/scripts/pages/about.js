jQuery(document).ready(function ($) {
	const countUpRoot = document.querySelector(".metrics");

	const callback = (entries, observer) => {
		entries.forEach((entry) => {
			if (entry.isIntersecting) {
				$(".metrics .card .card__title b").each((_, item) => {
					$(item).countUp({
						time: 10000,
						delay: 10,
						last: item.textContent,
					});
				});
				observer.disconnect();
			}
		});
	};

	const myObserver = new IntersectionObserver(callback, options);
	myObserver.observe(countUpRoot, {
		threshold: 0.5,
	});
});
