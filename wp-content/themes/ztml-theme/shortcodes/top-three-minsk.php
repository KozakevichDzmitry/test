<?php

function top_three_minsk()
{
	$news_posts_quary = new WP_Query([
		'post_type' => 'any',
		'posts_per_page' => 3,
		'post_status' => 'publish',
		'paged' => 1,
		'post__in' => array(
			url_to_postid(get_option('top1_url')),
			url_to_postid(get_option('top2_url')),
			url_to_postid(get_option('top3_url')),
		),
		'ignore_sticky_posts' => true
	]);

	$news_posts = $news_posts_quary->posts;

	echo '<h3 class="widget-title">Топ-3 о Минске</h3>';

	echo '<div class="box box-list no-lines">';
	foreach ($news_posts as $pst) {
		render_news_template_line($pst->ID, true, false, true);
	}
	echo '</div>';
}

add_shortcode('top_three_minsk_scn', 'top_three_minsk');
