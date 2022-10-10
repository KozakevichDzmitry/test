<?php

/*
 * Template Name: Примите меры
*/

?>

<?php get_header(); ?>

<?php require_once(COMPONENTS_PATH . 'topic-bar.php'); ?>
<?php require_once(COMPONENTS_PATH . 'pdf-attachments.php'); ?>
<?php require_once(COMPONENTS_PATH . 'satms-list-tem.php'); ?>
<?php require_once(COMPONENTS_PATH . 'sidebar.php'); ?>
<?php require_once(COMPONENTS_PATH . 'calendar.php'); ?>
<?php require_once(COMPONENTS_PATH . 'adv.php'); ?>


<?php require_once(COMPONENTS_PATH . 'line-news-list-item.php'); ?>

<?php require_once(COMPONENTS_PATH . 'news-templates.php'); ?>
<?php require_once(COMPONENTS_PATH . 'news-templates/top-three-news-template.php'); ?>
<?php require_once(COMPONENTS_PATH . 'news-templates/newspapers-template.php'); ?>
<?php require_once(COMPONENTS_PATH . 'news-templates/most-read-news-template.php'); ?>

<?php
$show_count = 27;
$load_count = 27;

$meri_args = array(
	'post_status' => 'publish',
	'posts_per_page' => $show_count,
	'post_type' => 'meri',
);

$meri_posts = get_posts($meri_args);
$all_args = $meri_args;
$all_args['posts_per_page'] = -1;
$all_posts = get_posts($all_args);
?>

<?php
$first_post_id = get_posts(array(
	'numberposts' => 1,
	'post_type' => 'meri',
	'post_status' => 'publish',
	'order' => 'DESC'
))[0]->ID;

$last_post_id = get_posts(array(
	'numberposts' => 1,
	'post_type' => 'meri',
	'post_status' => 'publish',
	'order' => 'ASC'
))[0]->ID;
?>

<div class="adfox-banner-background">
	<?php render_adv('page', get_the_ID(), 'background'); ?>
</div>
<main class="ta">
	<div class="container container_adv"><?php render_adv('page', get_the_ID(), 'before_main'); ?></div>
	<div class="container main-container">
		<div class="content-wrapper">
			<div class="main-content">
				<?php render_topic_bar(get_the_title(), true, array(
					'render' => 'render_calendar',
					'args' => array(
						'id' => 'datepicker-take-action-template',
						'min_date' => get_the_time('Y-m-d', $last_post_id),
						'max_date' => get_the_time('Y-m-d', $first_post_id),
					)
				));
				?>

				<div class="page-description">
					<?php echo the_content(); ?>
				</div>

				<div class="ta-list">
					<?php if (!empty($meri_posts)) : ?>
						<?php foreach ($meri_posts as $post) : ?>
							<?php render_line_news_list_item($post->ID); ?>
						<?php endforeach; ?>
					<?php endif; ?>
				</div>

				<?php if (intval($show_count) < count($all_posts)) : ?>
					<div class="load-moree-btn">
						<button data-all-posts="<?php echo count($all_posts) ?>">Показать ещё</button>
					</div>
				<?php endif ?>
			</div>
			<div class="second-content">
				<?php render_most_read_news_template(true, 'page', get_the_ID()); ?>
				<?php render_top_three_news_template('page', get_the_ID()); ?>
				<?php render_newspapers_template('page', get_the_ID()); ?>
			</div>
		</div>
		<?php render_sidebar(); ?>
	</div>
</main>

<?php get_footer(); ?>