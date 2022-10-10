<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
	<script>
		window.yaContextCb = window.yaContextCb || []
	</script>
	<script src="https://yandex.ru/ads/system/context.js" async></script>
	<?php if (is_home() || is_front_page()) : ?>
		<title>«<?php echo get_bloginfo('name'); ?>» – <?php echo get_bloginfo('description'); ?></title>
	<?php elseif (is_single() || is_page()) : ?>
		<title><?php echo $post->post_title; ?></title>
	<?php elseif (is_tax()) : ?>
		<?php $term = get_queried_object(); ?>
		<title><?php echo $term->description; ?></title>
	<?php elseif (is_404()) : ?>
		<title>Страница не найдена – «<?php echo get_bloginfo('name'); ?>»</title>
	<?php endif; ?>

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>

	<?php
	require_once(COMPONENTS_PATH . 'icons/header-logo-icon.php');

	require_once(COMPONENTS_PATH . 'icons/telegram-icon.php');
	require_once(COMPONENTS_PATH . 'icons/youtube-icon.php');
	require_once(COMPONENTS_PATH . 'icons/instagram-icon.php');
	require_once(COMPONENTS_PATH . 'icons/tiktok-icon.php');
	require_once(COMPONENTS_PATH . 'icons/vk-icon.php');
	require_once(COMPONENTS_PATH . 'icons/facebook-icon.php');

	require_once(COMPONENTS_PATH . 'icons/burger-icon.php');
	require_once(COMPONENTS_PATH . 'icons/search-icon.php');
	require_once(COMPONENTS_PATH . 'icons/search-close-icon.php');

	require_once(COMPONENTS_PATH . "nav.php");
	?>

	<div class="spalshscreen"></div>

	<header class="header" id="header-stiky">
		<div class="header__main-nav-wrapper">
			<div class="container">
				<nav class="main-nav">
					<div class="right-half">
						<div>
							<a href="/" id="logo">
								<img alt="logo" src="<?php echo get_template_directory_uri() . '/assets/images/logo.png'; ?>">
								<!-- <?php render_header_logo_icon() ?> -->
							</a>
						</div>

						<div class="nav-list">
							<?php render_main_header_nav(); ?>
						</div>
					</div>

					<div class="social-links">
						<ul>
							<li>
								<a target="_blank" href="https://t.me/minsknews_by">
									<?php render_telegram_icon(); ?>
								</a>
							</li>
							<li>
								<a target="_blank" href="https://www.youtube.com/channel/UCmPNL5ogNvN6mMiGrkzgmdQ">
									<?php render_youtube_icon(); ?>
								</a>
							</li>
							<li>
								<a target="_blank" href="https://www.instagram.com/minsknews/">
									<?php render_instagram_icon(); ?>
								</a>
							</li>
							<li>
								<a target="_blank" href="https://www.tiktok.com/@minsknews.by">
									<?php render_tiktok_icon(); ?>
								</a>
							</li>
							<li>
								<a target="_blank" href="https://vk.com/minsknews_by">
									<?php render_vk_icon(); ?>
								</a>
							</li>
							<li>
								<a target="_blank" href="https://www.facebook.com/minsknews">
									<?php render_facebook_icon(); ?>
								</a>
							</li>
						</ul>
					</div>
				</nav>
			</div>
		</div>
		<div class="header__sub-nav-wrapper">
			<div class="container">
				<nav class="sub-nav">
					<div>
						<button id="burger-btn">
							<?php render_burger_icon(); ?>
						</button>
						<div id="burger-nav">
							<?php render_burger_nav(); ?>
						</div>
					</div>
					<div class="sub-nav-list">
						<?php render_sub_header_nav(); ?>
					</div>
					<div>
						<button id="search-btn">
							<?php render_search_icon(); ?>
						</button>
					</div>
				</nav>
			</div>
		</div>
		<div id="search-bar" class="header__search-bar">
			<div class="container">
				<div class="header__search-bar-wrapper">
					<div class="header__search">
						<?php echo do_shortcode('[wpdreams_ajaxsearchlite]'); ?>
						<button id="searchBtnClose" class="search-btn-close">
							<?php render_search_close_icon(); ?>
						</button>
					</div>
					<p class="header__search-info">Нажмите Enter для поиска или Esc для выхода</p>
				</div>
			</div>
		</div>
	</header>