<?php

/*
 * Template Name: Все новости
*/

?>

<?php require_once(COMPONENTS_PATH . 'sidebar.php'); ?>
<?php require_once(COMPONENTS_PATH . 'pdf-attachments.php'); ?>
<?php require_once(COMPONENTS_PATH . 'topic-bar.php'); ?>
<?php require_once(COMPONENTS_PATH . 'news-templates/newspapers-template.php'); ?>
<?php require_once(COMPONENTS_PATH . 'calendar.php'); ?>
<?php require_once(COMPONENTS_PATH . 'news-templates/video-news-tempalte.php'); ?>
<?php require_once(COMPONENTS_PATH . 'adv.php'); ?>

<?php get_header(); ?>

<?php
$term = get_queried_object();
$taxonomy_id = $term->term_id;
?>

<?php
$show_count = 27;
$load_count = 27;

$tax_query = array(
	array(
		'taxonomy' => $term->taxonomy,
		'field' => 'term_id',
		'terms' => $term->term_id
	)
);

$meri_args = array(
	'post_status' => 'publish',
	'posts_per_page' => $show_count,
	'post_type' => 'video',
	'tax_query' => $tax_query
);

$meri_posts = get_posts($meri_args);
$all_args = $meri_args;
$all_args['posts_per_page'] = -1;
$all_posts = get_posts($all_args);
?>

<?php
$first_post_id = get_posts(array(
	'numberposts' => 1,
	'post_type' => 'video',
	'post_status' => 'publish',
	'order' => 'DESC',
	'tax_query' => $tax_query
))[0]->ID;

$last_post_id = get_posts(array(
	'numberposts' => 1,
	'post_type' => 'video',
	'post_status' => 'publish',
	'order' => 'ASC',
	'tax_query' => $tax_query
))[0]->ID;
?>

<div class="adfox-banner-background">
	<?php render_adv('page', $taxonomy_id, 'background'); ?>
</div>
<main id="videos-list" class="videos-satm">
	<div class="container container_adv"><?php render_adv('page', $taxonomy_id, 'before_main'); ?></div>
	<div class="container main-container">
		<div class="content-wrapper">
			<div class="main-content">
				<?php render_topic_bar($term->name, true, array(
					'render' => 'render_calendar',
					'args' => array(
						'id' => 'datepicker-taxonomy-videos-template',
						'min_date' => get_the_time('Y-m-d', $last_post_id),
						'max_date' => get_the_time('Y-m-d', $first_post_id),
					)
				));
				?>

				<div class="videos-list-content">
					<?php foreach ($meri_posts as $pst) : ?>
						<div class="box">
							<?php render_new_template_video($pst->ID, true, true, true); ?>
						</div>
					<?php endforeach; ?>
				</div>

				<?php if (intval($show_count) < count($all_posts)) : ?>
					<div class="load-moree-btn">
						<button data-tax-name="<?php echo $term->taxonomy; ?>" data-tax-id="<?php echo $term->term_id; ?>" data-all-posts="<?php echo count($all_posts) ?>">Показать ещё</button>
					</div>
				<?php endif ?>
			</div>

			<div class="second-content">
				<?php render_video_news_template("Минский курьер", array(
					array(
						'taxonomy' => 'videos',
						'terms' => 'minskij-kurer',
						'field' => 'slug',
						'operator' => 'IN'
					)
				)); ?>
				<?php render_newspapers_template('page', $taxonomy_id); ?>
			</div>
		</div>
		<?php render_sidebar(); ?>
	</div>
</main>

<?php get_footer(); ?>