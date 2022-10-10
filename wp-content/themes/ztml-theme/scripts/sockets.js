jQuery(document).ready(function ($) {
	var connection = new autobahn.Connection({
		url: "ws://127.0.0.1:8888/",
		realm: "realm1",
	});

	connection.onopen = function (session) {
		let counter = 1;

		session.subscribe("newspaper", (msg) => {
			const newspapersBlocks = JSON.parse(msg[0]);
			newspapersBlocks.tax.forEach((tax) => {
				let insertTo = $(`#main-content > div.pdf-attachments.${tax}`);
				insertTo = insertTo.find(".pdf-attachments-item").last().remove();
				$(`#main-content > div.pdf-attachments.${tax}`).prepend(
					$(newspapersBlocks.data)
				);
			});
		});

		session.subscribe("news", (msg) => {
			const newsBlocks = JSON.parse(msg[0]);
			newsBlocks.forEach((block) => {
				if (block.cat === "main") {
					$(
						"#main-content > div.main-news-cat.box-line-gap > div.main-news-list > div.box-column-gap"
					).replaceWith(block.data);
				} else {
					const blockHtml = $(block.data).remove(".topic-bar").last();
					$(`.site-main #main-content .${block.cat}`).replaceWith(blockHtml);
				}
			});
		});

		session.subscribe("event", (msg) => {
			const eventData = JSON.parse(msg[0]);
			$page = $("#events");
			$body = $("body");
			document.querySelector("#events div.event_slider");
			if ($page && $body.hasClass(`postid-${eventData.post_id}`)) {
				$("#events div.event_slider").slick("unslick");
				$("#events div.event_slider").replaceWith(eventData.data.slider);
				$("#events div.event_slider").slick({
					dots: true,
					infinite: true,
					speed: 300,
					slidesToShow: 4,
					slidesToScroll: 1,
					responsive: [
						{
							breakpoint: 1360,
							settings: {
								slidesToShow: 3,
								slidesToScroll: 1,
								infinite: true,
								dots: true,
							},
						},
						{
							breakpoint: 600,
							settings: {
								arrows: false,
								centerMode: true,
								centerPadding: "40px",
								infinite: true,
								slidesToShow: 1,
								slidesToScroll: 1,
							},
						},
					],
				});
				$(`#events div.main-content > div.events-content`).replaceWith(
					eventData.data.messages
				);
			}
		});

		session.subscribe("feed", (msg) => {
			$("#close_timeline").after(JSON.parse(msg).footerFeed);
			$("#timeline-main-block").prepend(JSON.parse(msg).newsBlockFeed);
			$("#added_news_counter").text(counter++);
		});

		session.subscribe("video", (msg) => {
			$(".video-news-template").prepend(JSON.parse(msg[0]).data);
			$(".video-news-template").children().last().remove();
			$("#added_news_counter").text(counter++);
		});

		session.subscribe("authors_column", (msg) => {
			const data = JSON.parse(msg[0]);
			const toReplace = $(
				`#main-content > div.swiper-module div.swiper-wrapper .author-column-slider-card[data-id=${data.author_id}] div.content-container`
			);
			toReplace.replaceWith(data.data);
		});

		session.subscribe("district", (msg) => {
			const blockHtml = JSON.parse(msg[0]).data;

			$(
				"#main-content > div.district-preview > div.district-item.active > div > div.content > div.district-news"
			).html(blockHtml);
			$(
				"#main-content > div.district-tablet-template > div.districts-list-container > div.district-item.active > div > div.content > div.district-news"
			).html(blockHtml);

			const districts = JSON.parse(msg[0]).slug;

			// document.querySelector(`.${district} > div > div.content > div.district-news`)

			districts.forEach((district) => {
				$(
					`.${district} > div > div.content > div.district-news > .news-template-line `
				).replaceWith(blockHtml);
				$(
					`.${district} > div > div.content > div.district-news > div:nth-child(3)`
				).remove();
				$(
					`.${district} > div > div.content > div.district-news > div:nth-child(3)`
				).remove();
			});
		});
	};

	connection.open();
});
