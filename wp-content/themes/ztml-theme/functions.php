<?php

// Все работает?

if (!defined('_S_VERSION')) {
	define('_S_VERSION', '1.0.0');
}

require_once(__DIR__ . '/vendor/autoload.php');

use ZMQContext;

define('COMPONENTS_PATH', dirname(__FILE__) . '/components/');
define('FUNC_PATH', dirname(__FILE__) . '/functionality/');
define('REQUEST_HANDLERS', dirname(__FILE__) . '/request-handlers/');
define('IMAGES_PATH', dirname(__FILE__) . '/assets/images/');
define('LIBS_PATH', dirname(__FILE__) . '/libs/');
define('WIDGETS_PATH', dirname(__FILE__) . '/widget-templates/');
define('SHORTCODES_PATH', dirname(__FILE__) . '/shortcodes/');

require_once(FUNC_PATH . 'carbon-fields.php');

function crb_register_custom_fieldss()
{
	require_once(WIDGETS_PATH . 'news-widget.php');
}

add_action('carbon_fields_register_fields', 'crb_register_custom_fieldss');

add_theme_support('admin-bar', array('callback' => '__return_false'));
add_theme_support('post-thumbnails');

function add_post_formats()
{
	add_theme_support('post-formats', array('gallery', 'quote', 'video', 'aside', 'image', 'link'));
}

add_action('after_setup_theme', 'add_post_formats', 20);

function theme_init()
{
	wp_enqueue_style('theme-style', get_stylesheet_uri(), array(), _S_VERSION);
}

add_action('wp_enqueue_scripts', 'theme_init');

add_filter('wpcf7_form_elements', function ($form) {
	return do_shortcode($form);
});

require_once(FUNC_PATH . 'events-taxanomy.php');
require_once(FUNC_PATH . 'newspaper-taxonomy.php');
require_once(FUNC_PATH . 'district-taxonomy.php');
require_once(FUNC_PATH . 'nav-locations.php');
require_once(FUNC_PATH . 'cae-taxonomy.php');
require_once(FUNC_PATH . 'aaq-taxonomy.php');
require_once(FUNC_PATH . 'aqq-appeals.php');
require_once(FUNC_PATH . 'primite-meri-taxonomy.php');
require_once(FUNC_PATH . 'authors-column-taxonomy.php');
require_once(FUNC_PATH . 'video-taxonomy.php');
require_once(FUNC_PATH . 'programs-post_type.php');
require_once(FUNC_PATH . 'post-dublicate.php');
require_once(FUNC_PATH . 'news-taxonomy.php');
require_once(FUNC_PATH . 'widgets.php');

require_once(COMPONENTS_PATH . "pdf-attachments.php");
require_once(COMPONENTS_PATH . 'satms-list-tem.php');
require_once(COMPONENTS_PATH . 'cae-list-item.php');
require_once(COMPONENTS_PATH . 'line-news-list-item.php');

require_once(REQUEST_HANDLERS . 'posts.php');
require_once(REQUEST_HANDLERS . 'timeline.php');
require_once(REQUEST_HANDLERS . 'news.php');
require_once(REQUEST_HANDLERS . 'news-posts.php');
require_once(REQUEST_HANDLERS . 'taxonomy-news-posts.php');
require_once(REQUEST_HANDLERS . 'taxonomy-authors-column-posts.php');
require_once(REQUEST_HANDLERS . 'taxonomy-take-action.php');
require_once(REQUEST_HANDLERS . 'taxonomy-cae-posts.php');
require_once(REQUEST_HANDLERS . 'main-timline-tape.php');
require_once(REQUEST_HANDLERS . 'author-materials.php');
require_once(REQUEST_HANDLERS . 'loadmore.php');
require_once(REQUEST_HANDLERS . 'taxonomy-videos-posts.php');
require_once(REQUEST_HANDLERS . 'ethers-posts.php');

require_once(LIBS_PATH . 'diff-image/dif-image.php');

require_once(SHORTCODES_PATH . 'extrenal-radio-player.php');
require_once(SHORTCODES_PATH . 'eternal-video.php');
require_once(SHORTCODES_PATH . 'subscribe-form.php');
require_once(SHORTCODES_PATH . 'share-links.php');
require_once(SHORTCODES_PATH . 'top-three-minsk.php');
require_once(SHORTCODES_PATH . 'speaks-and-shows.php');

function page_scripts()
{
	wp_enqueue_script('burger-menu-js', get_stylesheet_directory_uri() . '/scripts/burger-menu.js', array('jquery', 'sticky-sidebar-js'));
	wp_enqueue_script('main-external-js', get_stylesheet_directory_uri() . '/scripts/components/eternal-video.js', array('jquery'), true);
	wp_enqueue_script('main-js', get_stylesheet_directory_uri() . '/scripts/main.js', array('jquery', 'sticky-sidebar-js'), true);
	wp_enqueue_script('timeline-js', get_stylesheet_directory_uri() . '/scripts/components/timeline.js', array('jquery'), true);
	wp_enqueue_script('ext-player', get_stylesheet_directory_uri() . '/scripts/components/ext-player.js', array('jquery'), true);
	wp_enqueue_script('jquery-ui', 'https://code.jquery.com/ui/1.13.2/jquery-ui.js', array('jquery'), null, true);

	wp_enqueue_script('search-bar-js', get_stylesheet_directory_uri() . '/scripts/components/search-bar.js', array('jquery'), true);

	wp_enqueue_script('datepicker-ru-js', get_template_directory_uri() . '/libs/datepicker-ru/datepicker-ru.js', array('jquery-ui', 'jquery'));

	wp_enqueue_script('calendar-js', get_stylesheet_directory_uri() . '/scripts/components/calendar.js', array('jquery-ui', 'datepicker-ru-js'), true);

	wp_enqueue_script('share-links-js', get_stylesheet_directory_uri() . '/scripts/components/share-links.js', array('jquery-ui', 'datepicker-ru-js'), true);

	wp_enqueue_script('play-preload-video-js', get_stylesheet_directory_uri() . '/scripts/components/play-preload-video.js', array(), true);

	wp_enqueue_script('single-post-js', get_stylesheet_directory_uri() . '/scripts/pages/single-post.js', array('jquery'), false);

	wp_enqueue_script('single-event-js', get_stylesheet_directory_uri() . '/scripts/pages/single-event.js', array('jquery'), false);

	wp_register_script('autoban-lib-js', 'https://cdnjs.cloudflare.com/ajax/libs/autobahn/20.9.2/autobahn.min.js', null, null, true);
	wp_enqueue_script('autoban-lib-js');

	wp_enqueue_script('sockets-js', get_stylesheet_directory_uri() . '/scripts/sockets.js', array('jquery', 'autoban-lib-js', 'slick-min-js'), false);

	global $wp_query;


	if (is_front_page()) {
		wp_enqueue_script('index-js', get_template_directory_uri() . '/scripts/pages/index.js', array('jquery-ui', 'jquery'));
		// wp_enqueue_script('tablet-district-js', get_template_directory_uri() . '/scripts/components/tablet-district.js', array('jquery'));

		wp_localize_script('index-js', 'ajaxpagination', array(
			'ajaxurl' => admin_url('admin-ajax.php'),
			'query_vars' => json_encode($wp_query->query)
		));
	}

	wp_localize_script('timeline-js', 'ajaxpagination', array(
		'ajaxurl' => admin_url('admin-ajax.php'),
		'query_vars' => json_encode($wp_query->query)
	));

	if (get_post_type() == "news") {
		wp_enqueue_script('loadmore', get_stylesheet_directory_uri() . '/scripts/components/loadmore.js', array('jquery'), 1.0, true);
		wp_localize_script('loadmore', 'ajax', array('ajaxurl' => admin_url('admin-ajax.php')));
	}

	if (get_page_template_slug() == "your-district.php") {
		wp_enqueue_script('your-district-page-js', get_stylesheet_directory_uri() . '/scripts/pages/your-district.js', array('jquery', 'jquery', 'slick-min-js', 'slick-lightbox-min-js'), false);

		wp_localize_script('your-district-page-js', 'ajaxpagination', array(
			'ajaxurl' => admin_url('admin-ajax.php'),
			'query_vars' => json_encode($wp_query->query)
		));
	}

	if (get_post_type() == "events") {
		wp_enqueue_script('single-event-js', get_stylesheet_directory_uri() . '/scripts/pages/single-event.js', array('jquery'), true);

		global $wp_query;

		wp_localize_script('single-event-js', 'ajaxpagination', array(
			'ajaxurl' => admin_url('admin-ajax.php'),
			'query_vars' => json_encode($wp_query->query)
		));
	}

	if (get_post_type() == "news") {
		wp_enqueue_script('taxonomy-news-js', get_stylesheet_directory_uri() . '/scripts/pages/taxonomy-news.js', array('jquery'), false);

		wp_localize_script('taxonomy-news-js', 'ajaxpagination', array(
			'ajaxurl' => admin_url('admin-ajax.php'),
			'query_vars' => json_encode($wp_query->query)
		));
	}

	if (get_post_type() == 'district') {
		wp_enqueue_script('district-page-js', get_stylesheet_directory_uri() . '/scripts/pages/single-district.js', array('jquery', 'slick-min-js'), false);

		wp_enqueue_script('district-page-js', get_stylesheet_directory_uri() . '/scripts/pages/single-district.js', array('jquery', 'slick-min-js', 'slick-lightbox-min-js'), false);
		wp_enqueue_style('slick-lightbox-css', get_template_directory_uri() . '/libs/slick-lightbox/slick-lightbox.css');
		wp_enqueue_script('slick-lightbox-min-js', get_template_directory_uri() . '/libs/slick-lightbox/slick-lightbox.min.js', array('jquery'));
	}

	if (get_page_template_slug() == 'tv-programme.php') {
		wp_enqueue_script('accordion-components-js', get_stylesheet_directory_uri() . '/scripts/components/accordion.js', array('jquery'), true);
		wp_enqueue_script('tv-programme-page-js', get_stylesheet_directory_uri() . '/scripts/pages/tv-programms.js', array('jquery'), true);
	}

	if (get_page_template_slug() == 'radio-minsk.php') {
		wp_enqueue_script('radio-minsk-page-js', get_stylesheet_directory_uri() . '/scripts/pages/radio-minsk.js', array('jquery', 'slick-min-js'), false);
	}

	if (get_post_type() == 'newspaper') {
		wp_enqueue_script('newspaper-js', get_stylesheet_directory_uri() . '/scripts/pages/newspapers.js', array('jquery'), true);

		global $wp_query;

		wp_localize_script('newspaper-js', 'ajaxpagination', array(
			'ajaxurl' => admin_url('admin-ajax.php'),
			'query_vars' => json_encode($wp_query->query)
		));
	}

	if (get_page_template_slug() == 'events.php') {
		wp_enqueue_script('events.js', get_stylesheet_directory_uri() . '/scripts/pages/events.js', array('jquery'), false);
	}

	if (get_page_template_slug() == 'satms.php') {
		wp_enqueue_script('satms-js', get_stylesheet_directory_uri() . '/scripts/pages/satms.js', array('jquery'), true);

		global $wp_query;

		wp_localize_script('satms-js', 'ajaxpagination', array(
			'ajaxurl' => admin_url('admin-ajax.php'),
			'query_vars' => json_encode($wp_query->query)
		));
	}

	if (get_page_template_slug() == 'cae.php') {
		wp_enqueue_script('cae-js', get_stylesheet_directory_uri() . '/scripts/pages/cae.js', array('jquery'), true);
		wp_enqueue_script('cae-components-js', get_stylesheet_directory_uri() . '/scripts/components/mn-player.js', array('jquery'), true);

		global $wp_query;

		wp_localize_script('cae-js', 'ajaxpagination', array(
			'ajaxurl' => admin_url('admin-ajax.php'),
			'query_vars' => json_encode($wp_query->query)
		));
	}

	if (get_page_template_slug() == 'ask-a-question.php') {
		wp_enqueue_script('aaq-js', get_stylesheet_directory_uri() . '/scripts/pages/aaq.js', array('jquery'), true);
	}

	if (get_post_type() == 'satm') {
		wp_enqueue_script('single-satm-js', get_stylesheet_directory_uri() . '/scripts/pages/single-satm.js', array('jquery'), true);

		global $wp_query;

		wp_localize_script('single-satm-js', 'ajaxpagination', array(
			'ajaxurl' => admin_url('admin-ajax.php'),
			'query_vars' => json_encode($wp_query->query)
		));
	}

	if (get_page_template_slug() == 'take-action.php') {
		wp_enqueue_script('take-action-js', get_stylesheet_directory_uri() . '/scripts/pages/take-action.js', array('jquery'), true);

		global $wp_query;

		wp_localize_script('take-action-js', 'ajaxpagination', array(
			'ajaxurl' => admin_url('admin-ajax.php'),
			'query_vars' => json_encode($wp_query->query)
		));
	}

	if (get_page_template_slug() == 'authors-column.php') {
		wp_enqueue_script('authors-column-js', get_stylesheet_directory_uri() . '/scripts/pages/authors-column.js', array('jquery'), true);

		global $wp_query;

		wp_localize_script('authors-column-js', 'ajaxpagination', array(
			'ajaxurl' => admin_url('admin-ajax.php'),
			'query_vars' => json_encode($wp_query->query)
		));
	}

	if (get_post_type() == "authors-column") {
		wp_enqueue_script('single-authors-column-js', get_stylesheet_directory_uri() . '/scripts/pages/single-authors-column.js', array('jquery'), true);

		global $wp_query;

		wp_localize_script('single-authors-column-js', 'ajaxpagination', array(
			'ajaxurl' => admin_url('admin-ajax.php'),
			'query_vars' => json_encode($wp_query->query)
		));
	}

	if (get_page_template_slug() == 'all-news.php') {
		wp_enqueue_script('all-news-js', get_stylesheet_directory_uri() . '/scripts/pages/all-news.js', array('jquery', 'slick-min-js'), true);

		global $wp_query;

		wp_localize_script('all-news-js', 'ajaxpagination', array(
			'ajaxurl' => admin_url('admin-ajax.php'),
			'query_vars' => json_encode($wp_query->query)
		));
	}

	if (is_author()) {
		wp_enqueue_script('author-page-js', get_stylesheet_directory_uri() . '/scripts/pages/author.js', array('jquery'), true);

		global $wp_query;

		wp_localize_script('author-page-js', 'ajaxpagination', array(
			'ajaxurl' => admin_url('admin-ajax.php'),
			'query_vars' => json_encode($wp_query->query)
		));
	}

	if (get_page_template_slug() == 'page-advertisement.php') {
		wp_enqueue_script('advertisement-js', get_stylesheet_directory_uri() . '/scripts/pages/advertisement.js', array('jquery'), true);
	}

	if (get_post_type() == 'video') {
		wp_enqueue_script('taxonomy-videos-js', get_stylesheet_directory_uri() . '/scripts/pages/taxonomy-videos.js', array('jquery'), false);

		global $wp_query;

		wp_localize_script('taxonomy-videos-js', 'ajaxpagination', array(
			'ajaxurl' => admin_url('admin-ajax.php'),
			'query_vars' => json_encode($wp_query->query)
		));
	}

	if (get_page_template_slug() == 'all-videos.php') {
		wp_enqueue_script('all-videos-js', get_stylesheet_directory_uri() . '/scripts/pages/all-videos.js', array('jquery'), false);

		global $wp_query;

		wp_localize_script('all-videos-js', 'ajaxpagination', array(
			'ajaxurl' => admin_url('admin-ajax.php'),
			'query_vars' => json_encode($wp_query->query)
		));
	}

	if (get_page_template_slug() == 'ask-a-question.php') {
		wp_enqueue_script('appeal-page-js', get_stylesheet_directory_uri() . '/scripts/pages/appeal.js', array('jquery'), false);

		global $wp_query;

		wp_localize_script('appeal-page-js', 'ajaxpagination', array(
			'ajaxurl' => admin_url('admin-ajax.php'),
			'query_vars' => json_encode($wp_query->query)
		));
	}

	if (get_page_template_slug() === 'about.php') {
		wp_enqueue_script('about-page-js', get_stylesheet_directory_uri() . '/scripts/pages/about.js', array('jquery', 'countup-min-js'), false);
	}
}

add_action('wp_enqueue_scripts', 'page_scripts');

function slick_register()
{
	wp_register_style('slick-css', get_template_directory_uri() . '/libs/slick/slick.css');
	wp_register_style('slick-theme-css', get_template_directory_uri() . '/libs/slick/slick-theme.css');
	wp_enqueue_script('slick-min-js', get_template_directory_uri() . '/libs/slick/slick.min.js', array('jquery'));

	wp_enqueue_style('slick-css');
	wp_enqueue_style('slick-theme-css');
	wp_enqueue_script('jquery-min-js');
	wp_enqueue_script('slick-min-js');
}

add_action('wp_enqueue_scripts', 'slick_register');

function countup_register()
{
	wp_enqueue_script('countup-min-js', get_template_directory_uri() . '/libs/countup/countUp.min.js', array('jquery'));
	wp_enqueue_script('countup-min-js');
}

add_action('wp_enqueue_scripts', 'countup_register');

function swiper_register()
{
	wp_register_style('swiper-css', get_template_directory_uri() . '/libs/swiper/swiper.css');
	wp_enqueue_script('swiper-js', get_template_directory_uri() . '/libs/swiper/swiper.js', array('jquery'));

	wp_enqueue_style('swiper-css');
	wp_enqueue_script('swiper-js');
}

add_action('wp_enqueue_scripts', 'swiper_register');

function jquery_sticky_register()
{
	wp_enqueue_script('jquery-sticky-js', get_template_directory_uri() . '/libs/jquery-sticky/jquery-sticky.js', array('jquery'));
	wp_enqueue_script('jquery-sticky-js');
}

add_action('wp_enqueue_scripts', 'jquery_sticky_register');

function sticky_sidebar_register()
{
	wp_enqueue_script('sticky-sidebar-js', get_template_directory_uri() . '/libs/sticky-sidebar/sticky-sidebar.min.js', array('jquery'));
	wp_enqueue_script('sticky-sidebar-js');
}

add_action('wp_enqueue_scripts', 'sticky_sidebar_register');

function diff_image_register()
{
	wp_register_style('diff-image-css', get_template_directory_uri() . '/libs/diff-image/dif-image.css');
	wp_enqueue_script('diff-image-js', get_template_directory_uri() . '/libs/diff-image/dif-image.js', array('jquery'));

	wp_enqueue_style('diff-image-css');
	wp_enqueue_script('diff-image-js');
}

add_action('wp_enqueue_scripts', 'diff_image_register');

function slick_lightbox_register()
{
	wp_enqueue_style('slick-lightbox-css', get_template_directory_uri() . '/libs/slick-lightbox/slick-lightbox.css');
	wp_enqueue_script('slick-lightbox-min-js', get_template_directory_uri() . '/libs/slick-lightbox/slick-lightbox.min.js', array('jquery'));
}

add_action('wp_enqueue_scripts', 'slick_lightbox_register');

// Allow SVG
add_filter('wp_check_filetype_and_ext', function ($data, $file, $filename, $mimes) {

	global $wp_version;
	if ($wp_version !== '4.7.1') {
		return $data;
	}

	$filetype = wp_check_filetype($filename, $mimes);

	return [
		'ext' => $filetype['ext'],
		'type' => $filetype['type'],
		'proper_filename' => $data['proper_filename']
	];
}, 10, 4);

function cc_mime_types($mimes)
{
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}

add_filter('upload_mimes', 'cc_mime_types');

function fix_svg()
{
	echo '<style type="text/css">
        .attachment-266x266, .thumbnail img {
             width: 100% !important;
             height: auto !important;
        }
        </style>';
}

add_action('admin_head', 'fix_svg');

add_filter( 'wp_check_filetype_and_ext', 'fix_svg_mime_type', 10, 5 );

# Исправление MIME типа для SVG файлов.
function fix_svg_mime_type( $data, $file, $filename, $mimes, $real_mime = '' ){

    // WP 5.1 +
    if( version_compare( $GLOBALS['wp_version'], '5.1.0', '>=' ) ){
        $dosvg = in_array( $real_mime, [ 'image/svg', 'image/svg+xml' ] );
    }
    else {
        $dosvg = ( '.svg' === strtolower( substr( $filename, -4 ) ) );
    }

    // mime тип был обнулен, поправим его
    // а также проверим право пользователя
    if( $dosvg ){

        // разрешим
        if( current_user_can('manage_options') ){

            $data['ext']  = 'svg';
            $data['type'] = 'image/svg+xml';
        }
        // запретим
        else {
            $data['ext']  = false;
            $data['type'] = false;
        }

    }

    return $data;
}


// AJAX загрузка постов
function load_posts()
{
	$args = unserialize(stripslashes($_POST['query']));
	$args['posts_per_page'] = $_POST['load'];
	$args['offset'] = $_POST['show'];
	$posts = get_posts($args);

	if (!empty($posts)) {
		foreach ($posts as $pst) {
			get_template_part('./components/tpl-' . $_POST['tpl'], null, ['ID' => $pst->ID]);
		}
		die();
	}
}

add_action('wp_ajax_loadmore', 'load_posts');
add_action('wp_ajax_nopriv_loadmore', 'load_posts');

require_once(__DIR__ . "/tv-parser.php");

function save_post_action($id, $post)
{
	if (get_page_template_slug($post) === 'tv-programme.php') {
		$zip_url = get_attached_file(carbon_get_post_meta($id, "crb_tv_programms"));

		if (strlen($zip_url)) {
			parse_tv_programm_file($zip_url);
		}
	}
}

add_action('post_updated', 'save_post_action', 10, 3);



add_shortcode('socials', 'social_shortcode');
function social_shortcode()
{
	$r = '<div class="social-icons">';
	foreach (carbon_get_the_post_meta('socials') as $item) :
		$r .= '<div>';
		$r .= '<a href="' . $item['link'] . '"><img alt="' . get_post_meta($item['icon'], '_wp_attachment_image_alt', TRUE) . '" src="' . wp_get_attachment_url($item['icon']) . '" width="30"></a>';
		$r .= '</div>';
	endforeach;
	$r .= '</div>';
	return $r;
}

require_once(COMPONENTS_PATH . 'single-satm-slide.php');

function trim_excerpt($text)
{
	$text = str_replace('[&hellip;]', '...', $text);
	return $text;
}

add_filter('get_the_excerpt', 'trim_excerpt');

function custom_excerpt_length($length)
{
	return 15;
}

add_filter('excerpt_length', 'custom_excerpt_length', 999);

function iframe_scn($atts)
{
	$atts = shortcode_atts(array(
		'src' => '#',
		'frameborder' => '0',
		'allowfullscreen' => 'allowfullscreen'
	), $atts);

	return '<iframe title="YouTube video player" src="' . $atts['src'] . '" width="560" height="315" frameborder="' . $atts['frameborder'] . '" allowfullscreen="' . $atts['allowfullscreen'] . '"></iframe>';
}

add_shortcode("iframe", "iframe_scn");

function gt_get_post_view()
{
	$count = get_post_meta(get_the_ID(), 'post_views_count', true);
	return $count;
}

function gt_set_post_view()
{
	$key = 'post_views_count';
	$post_id = get_the_ID();
	$count = (int)get_post_meta($post_id, $key, true);
	$count++;
	update_post_meta($post_id, $key, $count);
}

function gt_posts_column_views($columns)
{
	$columns['post_views'] = 'Views';
	return $columns;
}

function gt_posts_custom_column_views($column)
{
	if ($column === 'post_views') {
		echo gt_get_post_view();
	}
}

add_filter('manage_posts_columns', 'gt_posts_column_views');
add_action('manage_posts_custom_column', 'gt_posts_custom_column_views');

function get_attached_news($count, $term, $add_tax = NULL)
{
	$date_now = (new DateTime("now", new DateTimeZone('Europe/Minsk')))->format('Y-m-d H:i:s');

	$q_args = array(
		'post_type' => 'news',
		'posts_per_page' => $count,
		'post_status' => 'publish',
		'orderby' => 'publish_date',
		'order' => 'DESC',
		'tax_query' => array(
			array(
				'taxonomy' => 'news-list',
				'terms' => $term,
				'field' => 'slug',
			)
		),
		'meta_query' => array(
			'relation' => 'OR',
			array(
				'key' => 'news_is_attached',
				'value' => 'yes',
				'compare' => 'LIKE'
			),
			array(
				'key' => 'news_is_attached_status',
				'value' => 'yes',
				'compare' => 'LIKE'
			),
			array(
				'key' => '_news_is_attached_time_to',
				'value' => $date_now,
				'compare' => '<',
				'type' => 'DATETIME'
			),
		)
	);

	if ($add_tax != NULL) {
		array_push($q_args['tax_query'], array(
			'relation' => 'OR',
			$add_tax
		));
	}

	$news_posts = new WP_Query($q_args);

	$exclude_list = array();

	foreach ($news_posts->posts as $post) {
		array_push($exclude_list, $post->ID);
	}

	$needs_posts_count = $count - count($news_posts->posts);

	if ($needs_posts_count > 0) {
		$adds_news_args = [
			'post_type' => 'news',
			'posts_per_page' => $needs_posts_count,
			'post_status' => 'publish',
			'tax_query' => array(
				array(
					'taxonomy' => 'news-list',
					'terms' => $term,
					'field' => 'slug',
				)
			),
			'meta_query' => array(
				'relation' => 'OR',
				array(
					'key' => '_news_is_attached',
					'value' => 'yes',
					'compare' => '!=',
				),
				array(
					'key' => '_news_is_attached_status',
					'value' => 'yes',
					'compare' => '!=',
				),
			),
			'orderby' => 'date',
			'post__not_in' => $exclude_list,
		];

		if ($add_tax != NULL) {
			array_push($adds_news_args['tax_query'], array(
				'relation' => 'OR',
				$add_tax
			));
		}

		$adds_news_quary = new WP_Query($adds_news_args);

		$news_posts->posts = array_merge($news_posts->posts, $adds_news_quary->posts);

		$add_posts_id_exclude = array();

		foreach ($adds_news_quary->posts as $post) {
			array_push($add_posts_id_exclude, $post->ID);
		}

		$exclude_list = array_merge($exclude_list, $add_posts_id_exclude);
	}

	return array(
		'posts' => $news_posts->posts,
		'ids' => $exclude_list
	);
}

function get_default_news($count, $term, $exclude_list, $add_tax = [])
{
	$news_posts = new WP_Query(array(
		'post_type' => 'news',
		'posts_per_page' => $count,
		'post_status' => 'publish',
		'orderby' => 'publish_date',
		'order' => 'DESC',
		'tax_query' => array(
			array(
				'taxonomy' => 'news-list',
				'terms' => $term,
				'field' => 'slug',
			)
		),
		'meta_query' => array(
			'relation' => 'OR',
			array(
				'key' => 'news_is_attached_status',
				'value' => 'yes',
				'compare' => '!=',
			),
			array(
				'key' => 'news_is_attached',
				'compare' => 'NOT EXISTS',
			),
		),
		'post__not_in' => $exclude_list,
	));

	return $news_posts->posts;
}


add_filter('cron_schedules', 'wpshout_add_cron_interval');
function wpshout_add_cron_interval($schedules)
{
	$schedules['everyminute'] = array(
		'interval'  => 60, // time in seconds
		'display'   => 'Every Minute'
	);
	return $schedules;
}

function unstick_posts()
{
	$date_now = (new DateTime("now", new DateTimeZone('Europe/Minsk')))->format('Y-m-d H:i:s');

	$posts_quary = new WP_Query([
		'post_count' => -1,
		'post_type' => 'any',
		'post_status' => 'publish',
		'meta_query' => array(
			'relation' => 'AND',
			array(
				'key' => 'news_is_attached',
				'value' => 'yes'
			),
			array(
				'key' => 'news_is_attached_status',
				'value' => 'yes'
			),
			array(
				'key' => 'news_is_attached_time_to',
				'value' => $date_now,
				'compare' => '<',
				'type' => 'DATETIME'
			),
		)
	]);

	foreach ($posts_quary->posts as $tpost) {
		update_post_meta($tpost->ID, '_news_is_attached_status', 'no');
		$context = new ZMQContext();
		$socket = $context->getSocket(ZMQ::SOCKET_PUSH);
		$socket->connect("tcp://127.0.0.1:5555");
		$socket->send(json_encode([
			'event' => 'news_block_update',
			'update_blocks' => wp_get_post_terms($tpost->ID, 'news-list', ['fields' => 'slugs'])
		]));
	}
}

function stick_posts()
{
	$date_now = (new DateTime("now", new DateTimeZone('Europe/Minsk')))->format('Y-m-d H:i:s');

	$posts_quary = new WP_Query([
		'post_count' => -1,
		'post_type' => 'any',
		'post_status' => 'publish',
		'meta_query' => array(
			'relation' => 'AND',
			array(
				'key' => 'news_is_attached',
				'value' => 'yes'
			),
			array(
				'key' => 'news_is_attached_time_from',
				'value' => $date_now,
				'compare' => '<=',
				'type' => 'DATETIME'
			),
			array(
				'key' => 'news_is_attached_time_to',
				'value' => $date_now,
				'compare' => '>=',
				'type' => 'DATETIME'
			),
			array(
				'key' => 'news_is_attached_status',
				'value' => 'yes',
				'compare' => '!=',
			),
		)
	]);

	foreach ($posts_quary->posts as $tpost) {
		update_post_meta($tpost->ID, '_news_is_attached_status', 'yes');
		$context = new ZMQContext();
		$socket = $context->getSocket(ZMQ::SOCKET_PUSH);
		$socket->connect("tcp://127.0.0.1:5555");
		$socket->send(json_encode([
			'event' => 'news_block_update',
			'update_blocks' => wp_get_post_terms($tpost->ID, 'news-list', ['fields' => 'slugs'])
		]));
	}
}

if (!wp_next_scheduled('prefix_hourly_event')) {
	wp_schedule_event(time(), 'everyminute', 'manage_stiky_posts_event');
}

function manage_stiky_posts()
{
	stick_posts();
	unstick_posts();
}

add_action('manage_stiky_posts_event', 'manage_stiky_posts');

add_action('admin_bar_menu', 'customize_my_wp_admin_bar', 80);
function customize_my_wp_admin_bar($wp_admin_bar)
{
	$new_content_node = $wp_admin_bar->get_node('new-content');
	$new_content_node->href = '/wp-admin/post-new.php?post_type=news';
	$wp_admin_bar->add_node($new_content_node);
}

function plus_and_zen_post($post_ID)
{
	$is_insert_code = carbon_get_post_meta($post_ID, 'rss_include_yandex_zen');

	if ($is_insert_code) {
		echo '<!-- Rating@Mail.ru counter -->
	<script type="text/javascript">
	var _tmr = window._tmr || (window._tmr = []);
	_tmr.push({id: "3077047", type: "pageView", start: (new Date()).getTime()});
	(function (d, w, id) {
		if (d.getElementById(id)) return;
		var ts = d.createElement("script"); ts.type = "text/javascript"; ts.async = true; ts.id = id;
		ts.src = "https://top-fwz1.mail.ru/js/code.js";
		var f = function () {var s = d.getElementsByTagName("script")[0]; s.parentNode.insertBefore(ts, s);};
		if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); }
	})(document, window, "topmailru-code");
	</script><noscript><div>
	<img src="https://top-fwz1.mail.ru/counter?id=3077047;js=na" style="border:0;position:absolute;left:-9999px;" alt="Top.Mail.Ru" />
	</div></noscript>
	<!-- //Rating@Mail.ru counter -->';
	}
}

function update_client_view_by_post_type($post_type, $cb)
{
	add_action("rest_after_insert_{$post_type}", function ($post) use ($cb) {
		if (defined('REST_REQUEST') && REST_REQUEST) {
			if (get_post_status($post) == 'publish') {
				$context = new ZMQContext();
				$socket = $context->getSocket(ZMQ::SOCKET_PUSH);
				$socket->connect("tcp://127.0.0.1:5555");
				$socket->send($cb($post));
			}
		}
	});
}

update_client_view_by_post_type('newspaper', function ($post) {
	return json_encode([
		'event' => 'new_post',
		'post_id' => $post->ID,
		'event_type' => $post->post_type
	]);
});

update_client_view_by_post_type('news', function ($post) {
	$terms = wp_get_post_terms($post->ID, 'news-list', ['fields' => 'slugs']);
	if (in_array('feed', $terms)) {
		$users = carbon_get_post_meta(1057365, 'authors_column_sticked_authors');

		$post_author = NULL;

		foreach ($users as $user) {
			if ($post->post_author == $user['id']) {
				$post_author = $user['id'];
			}
		}

		return json_encode([
			'event' => 'news_block_update',
			'post_id' => $post->ID,
			'update_blocks' => array('feed'),
			'event_type' => $post->post_type,
			'post_id' => $post->ID,
			'author_id' => $post_author
		]);
	}
});

function update_event_page($_, $post_id)
{
	if (get_post_type($post_id) == 'event') {
		if ($_GET['message'] == 1) {
			$context = new ZMQContext();
			$socket = $context->getSocket(ZMQ::SOCKET_PUSH);
			$socket->connect("tcp://127.0.0.1:5555");
			$socket->send(json_encode([
				'event' => 'update_page_event',
				'post_id' => $post_id,
			]));
		}
	}
}
add_action('updated_post_meta', 'update_event_page', 10, 4);

update_client_view_by_post_type('video', function ($post) {
	return json_encode([
		'event' => 'video_block_update',
		'post_id' => $post->ID,
		'event_type' => $post->post_type
	]);
});

update_client_view_by_post_type('authors-column', function ($post) {
	$users = carbon_get_post_meta(1057365, 'authors_column_sticked_authors');

	$post_author = NULL;

	foreach ($users as $user) {
		if ($post->post_author == $user['id']) {
			$post_author = $user['id'];
		}
	}

	if ($post_author == NULL) return;

	return json_encode([
		'event' => 'authors_column_update',
		'author_id' => $post_author,
		'post_id' => $post->ID
	]);
});

add_action('carbon_fields_post_meta_container_saved', 'crb_after_save_event');
function crb_after_save_event($post_id)
{
	if (get_post_status($post_id) === 'publish' && get_post_type($post_id) === 'news') {
		$terms = wp_get_post_terms($post_id, 'news-list', ['fields' => 'slugs']);

		if (in_array('feed', $terms)) {
			$terms = \array_filter($terms, static function ($el) {
				return $el !== 'feed';
			});
		}

		$users = carbon_get_post_meta(1057365, 'authors_column_sticked_authors');

		$post_author = NULL;

		foreach ($users as $user) {
			if (get_post_field('post_author', $post_id) == $user['id']) {
				$post_author = $user['id'];
			}
		}

		$context = new ZMQContext();
		$socket = $context->getSocket(ZMQ::SOCKET_PUSH);
		$socket->connect("tcp://127.0.0.1:5555");
		$socket->send(json_encode([
			'event' => 'news_block_update',
			'post_id' => $post_id,
			'update_blocks' => $terms,
			'district_update_blocks' => wp_get_post_terms($post_id, 'news-district', ['fields' => 'slugs']),
			'event_type' => get_post_type($post_id),
			'author_id' => $post_author,
			'post' => get_post($post_id)
		]));
	}

	return false;
}
