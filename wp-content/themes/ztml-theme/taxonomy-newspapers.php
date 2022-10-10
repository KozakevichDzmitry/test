<?php get_header(); ?>

<?php
require_once(COMPONENTS_PATH . 'pdf-attachments.php');
require_once(COMPONENTS_PATH . 'topic-bar.php');
require_once(COMPONENTS_PATH . 'topic-minibar.php');
require_once(COMPONENTS_PATH . 'news-templates/top-three-news-template.php');
require_once(COMPONENTS_PATH . 'news-templates/most-read-news-template.php');
require_once(COMPONENTS_PATH . 'news-templates/newspapers-template.php');
require_once(COMPONENTS_PATH . 'sidebar.php');
require_once(COMPONENTS_PATH . 'adv.php');
?>

<?php
$taxonomy_id = get_queried_object()->term_id;
$show_count = carbon_get_term_meta($taxonomy_id, 'crb_newspapers_taxonomy_show_count');
$load_count = carbon_get_term_meta($taxonomy_id, 'crb_newspapers_taxonomy_load_count');
$the_query = new WP_Query(
	array(
		'post_count' => $show_count,
		'post_type' => 'newspaper',
		'post_status' => 'publish',
		'tax_query' => array(
			array(
				'taxonomy' => 'newspapers',
				'field' => 'id',
				'terms' => $taxonomy_id,
			)
		)
	)
);
?>

<?php $topic_title = single_term_title('', false); ?>

<div class="adfox-banner-background">
	<?php render_adv('page', $taxonomy_id, 'background'); ?>
</div>
<main id="newspapers" class="newspapers">
	<div class="container container_adv"><?php render_adv('page', $taxonomy_id, 'before_main'); ?></div>
	<div class="container main-container">
		<div class="content-wrapper">
			<div class="main-content">
				<?php render_topic_bar($topic_title); ?>

				<div class="mob-container">
					<?php if ($topic_title === 'Качели') : ?>
						<div class="newspaper__kacheli-content">
							<img src="https://minsknews.by/wp-content/uploads/2020/02/logotip-poslednij-900x318.png" alt="kacheli image" />

							<div class="kacheli-content">
								<div class="kacheli-content__title">
									<span>«Качели» - журнал для детей и их родителей</span>
								</div>

								<div class="list">
									<div class="list-caption">
										<span>Он понравится:</span>
									</div>
									<ul class="items-list">
										<li>Ребятам 6-11 лет, которые с любопытством открывают и изучают окружающий мир;</li>
										<li>Родителям, которые хотят больше времени проводить со своими детьми;</li>
										<li>Бабушкам и дедушкам, которые готовы вместе с ребятами читать сказки, изучать родной язык, мастерить поделки и разгадывать сканворды;</li>
										<li>Педагогам и воспитателям, для которых журнал может стать добрым помощникам на классном часу.</li>
									</ul>
								</div>

								<div class="list">
									<div class="list-caption">
										<span>Подпишись!</span>
									</div>
									<ul class="items-list">
										<li>На сайте агентства «Минск-Новости (minsknews.by/podpiska/)</li>
										<li>В любом почтовом отделении</li>
										<li>В торговых павильонах «Белсоюзпечать».</li>
									</ul>
								</div>

								<div class="list">
									<div class="list-caption">
										<span>Подписные индексы:</span>
									</div>
									<ul class="items-list">
										<li>74901 (индивидуальный)</li>
										<li>749012 (ведомственный).</li>
										<li>В торговых павильонах «Белсоюзпечать».</li>
									</ul>
								</div>

								<div class="editors-address">
									<span><b>Адрес редакции:</b> 220005, г. Минск, пр. Независимости, 44, тел./факс 284-38-02.</span>
								</div>
							</div>
						</div>
					<?php else : ?>
						<div class="newspaper__description">
							<?php echo get_term_field('description', $taxonomy_id); ?>
						</div>
					<?php endif; ?>
					<?php
					$args = array(
						'post_type' => 'newspaper',
						'post_status' => 'publish',
						'posts_per_page' => intval($show_count),
						'order' => 'DESC',
						'tax_query' => array(
							array(
								'taxonomy' => 'newspapers',
								'field'    => 'id',
								'terms'    => $taxonomy_id
							)
						)
					);
					$posts = get_posts($args);
					$all_args = $args;
					$all_args['posts_per_page'] = -1;
					$all_posts = get_posts($all_args);
					if (!empty($posts)) {
					?>
						<div class="pdf-attachments">
							<?php
							foreach ($posts as $pst) {
								get_template_part('./components/tpl-pdf-attacments', null, ['ID' => $pst->ID]);
							}
							?>
						</div>
					<?php
					}
					?>
					<?php if (intval($show_count) < count($all_posts)) { ?>
						<button class="newspaper__moree-btn btn-loadmore" data-param-posts='<?php echo serialize($args); ?>' data-tpl='pdf-attacments' data-load-posts="<?php echo $load_count ?>" data-show-posts="<?php echo $show_count ?>" data-all-posts="<?php echo count($all_posts) ?>">
							Показать ещё
						</button>
					<?php } ?>
				</div>
			</div>
			<div class="second-content">
				<?php render_most_read_news_template(true, 'page', $taxonomy_id); ?>
				<?php render_top_three_news_template('page', $taxonomy_id); ?>

				<?php if (!($topic_title === 'Качели')) : ?>
					<?php render_newspapers_template('page', $taxonomy_id); ?>
				<?php endif; ?>
			</div>
		</div>
		<?php render_sidebar(function () {
			$newspapers_taxes = get_terms(
				array(
					'taxonomy' => get_taxonomies(['object_type' => ['newspaper']]),
					'hide_empty' => false
				)
			);
		?>
			<div>
				<?php foreach ($newspapers_taxes as $tax) : ?>
					<?php render_topic_minibar($tax->name, get_term_link($tax->term_id)); ?>
				<?php endforeach; ?>
			</div>
		<?php
		}); ?>
	</div>
</main>

<?php get_footer(); ?>