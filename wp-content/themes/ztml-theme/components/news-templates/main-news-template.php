<?php

require_once(COMPONENTS_PATH . 'calendar.php');
require_once(COMPONENTS_PATH . 'news-templates/main-template.php');

function render_main_news_template()
{
	$timeline_news_quary = new WP_Query([
		'post_type' => 'any',
		'posts_per_page' => '8',
		'post_status' => 'publish',
		'tax_query' => array(
			'relation' => 'OR',
			array(
				'taxonomy' => 'news-list',
				'field' => 'slug',
				'terms' => 'feed'
			),
			array(
				'taxonomy' => 'meri-list',
				'field' => 'slug',
				'terms' => 'feed'
			)
		)
	]);

	$timeline_news_posts = $timeline_news_quary->posts;
?>
	<div class="main-news-cat box-line-gap" style="margin-bottom: 30px;">
		<?php render_main_template(); ?>

		<?php
		$first_post_id = get_posts(
			array(
				'numberposts' => 1,
				'post_type' => 'any',
				'post_status' => 'publish',
				'order' => 'DESC',
				'tax_query' => array(
					'relation' => 'OR',
					array(
						'taxonomy' => 'news-list',
						'field' => 'slug',
						'terms' => 'feed'
					),
					array(
						'taxonomy' => 'meri-list',
						'field' => 'slug',
						'terms' => 'feed'
					)
				)
			)
		)[0]->ID;
		?>

		<?php
		$last_post_id = get_posts(
			array(
				'numberposts' => 1,
				'post_type' => 'any',
				'post_status' => 'publish',
				'order' => 'ASC',
				'tax_query' => array(
					'relation' => 'OR',
					array(
						'taxonomy' => 'news-list',
						'field' => 'slug',
						'terms' => 'feed'
					),
					array(
						'taxonomy' => 'meri-list',
						'field' => 'slug',
						'terms' => 'feed'
					)
				)
			)
		)[0]->ID;
		?>

		<div class="long-news-list">
			<?php render_topic_bar("Новости", true, array(
				'link' => get_site_url() . '/vse-novosti/',
				'render' => 'render_calendar',
				'args' => array(
					'id' => 'datepicker-all-news',
					'min_date' => get_the_time('Y-m-d', $last_post_id),
					'max_date' => get_the_time('Y-m-d', $first_post_id),
				)
			));
			?>

			<div class="box box-list news-scrolled timeline-main no-lines" style="padding: 10px;">
				<?php foreach ($timeline_news_posts as $pst) : ?>
					<?php render_news_template_line($pst->ID); ?>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
<?php
}
