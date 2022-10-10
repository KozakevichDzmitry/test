<?php get_header(); ?>

<?php require_once(COMPONENTS_PATH . 'topic-bar.php'); ?>
<?php require_once(COMPONENTS_PATH . 'pdf-attachments.php'); ?>
<?php require_once(COMPONENTS_PATH . 'sidebar.php'); ?>
<?php require_once(COMPONENTS_PATH . 'half-post.php'); ?>


<?php require_once(COMPONENTS_PATH . 'line-news-list-item.php'); ?>

<?php require_once(COMPONENTS_PATH . 'news-templates.php'); ?>
<?php require_once(COMPONENTS_PATH . 'news-templates/top-three-news-template.php'); ?>
<?php require_once(COMPONENTS_PATH . 'news-templates/newspapers-template.php'); ?>
<?php require_once(COMPONENTS_PATH . 'news-templates/most-read-news-template.php'); ?>
<?php require_once(COMPONENTS_PATH . "adv.php"); ?>

<div class="adfox-banner-background">
	<?php render_adv('post', $post->ID, 'background'); ?>
</div>
<main class="authors-column-page">
	<div class="container container_adv"><?php render_adv('post', $post->ID, 'before_main'); ?></div>
	<?php plus_and_zen_post($post->ID); ?>
	<div class="container main-container">
		<div class="content-wrapper">
			<div class="authors-posts-container">

				<div class="main-content">
					<?php render_half_post($post, "Авторская колонка"); ?>
					<?php render_topic_bar('Читайте и подписывайтесь'); ?>
					<div class="sub-block">
						<div>
							<a target="_blank" href="https://yandex.by/news/smi/minsknewsby"><img alt="Yandex logo" src="<?php echo get_template_directory_uri() . '/assets/images/yandex-logo.png'; ?>" /></a>
						</div>
						<div>
							<a target="_blank" href="https://zen.yandex.ru/minsknews"><img alt="Yandex Zen logo" src="<?php echo get_template_directory_uri() . '/assets/images/yandex-logo-dzen.png'; ?>" /></a>
						</div>
						<div>
							<a target="_blank" href="https://news.google.com/publications/CAAqJggKIiBDQklTRWdnTWFnNEtERzFwYm5OcmJtVjNjeTVpZVNnQVAB?r=0&oc=1&hl=ru&gl=RU&ceid=RU:ru"><img src="<?php echo get_template_directory_uri() . '/assets/images/google-logo.png'; ?>" alt="Goolge logo" /></a>
						</div>
					</div>

					<?php
					$meri_args = array(
						'post_status' => 'publish',
						'posts_per_page' => 31,
						'post_type' => 'authors-column',
					);

					$meri_posts = get_posts($meri_args);
					?>

					<?php if (!empty($meri_posts)) : ?>
						<?php foreach ($meri_posts as $post) : ?>
							<?php render_half_post($post); ?>
						<?php endforeach; ?>
					<?php endif; ?>
				</div>

			</div>
			<div class="second-content">
				<?php render_top_three_news_template('post', $post->ID); ?>
				<?php render_newspapers_template('post', $post->ID); ?>
			</div>
		</div>

		<?php render_sidebar(); ?>
	</div>
</main>

<?php get_footer(); ?>