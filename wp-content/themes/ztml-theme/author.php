<?php
require_once(COMPONENTS_PATH . 'topic-bar.php');
require_once(COMPONENTS_PATH . 'sidebar.php');

require_once(COMPONENTS_PATH . 'news-templates.php');
require_once(COMPONENTS_PATH . 'news-templates/top-three-news-template.php');
require_once(COMPONENTS_PATH . 'news-templates/newspapers-template.php');
require_once(COMPONENTS_PATH . 'news-templates/most-read-news-template.php');
require_once(COMPONENTS_PATH . 'calendar.php');

$show_count = 27;
$load_count = 27;

$meri_args = array(
	'post_status' => 'publish',
	'posts_per_page' => $show_count,
	'post_type' => array('news', 'authors-column'),
);

$meri_posts = get_posts($meri_args);
$all_args = $meri_args;
$all_args['posts_per_page'] = -1;
$all_posts = get_posts($all_args);
?>

<?php
$first_post_id = get_posts(array(
	'numberposts' => 1,
	'post_type' => array('news', 'authors-column'),
	'post_status' => 'publish',
	'order' => 'DESC'
))[0]->ID;

$last_post_id = get_posts(array(
	'numberposts' => 1,
	'post_type' => array('news', 'authors-column'),
	'post_status' => 'publish',
	'order' => 'ASC'
))[0]->ID;

?>

<?php get_header(); ?>

<main class="printing">
	<div class="container main-container">
		<div class="content-wrapper">
			<div class="main-content">
				<?php render_topic_bar(get_the_author_meta('display_name'), true, array(
					'render' => 'render_calendar',
					'args' => array(
						'id' => 'datepicker-all-authors-materials-template',
						'min_date' => get_the_time('Y-m-d', $last_post_id),
						'max_date' => get_the_time('Y-m-d', $first_post_id),
					)
				));
				?>

				<div class="ta-list">
					<?php if (!empty($meri_posts)) : ?>
						<?php foreach ($meri_posts as $post) : ?>
							<?php render_line_regular_news($post->ID, true); ?>
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
				<?php render_most_read_news_template(true); ?>
				<?php render_top_three_news_template(); ?>
				<?php render_newspapers_template(); ?>
			</div>
		</div>
		<?php render_sidebar(); ?>
	</div>
</main>


<?php get_footer(); ?>