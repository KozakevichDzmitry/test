<?php
/*
 * Template Name: Курсы валют
*/
?>

<?php require_once(COMPONENTS_PATH . 'topic-bar.php'); ?>
<?php require_once(COMPONENTS_PATH . 'calendar.php'); ?>
<?php require_once(COMPONENTS_PATH . 'news-templates/most-read-news-template.php'); ?>
<?php require_once(COMPONENTS_PATH . 'news-templates/top-three-news-template.php'); ?>
<?php require_once(COMPONENTS_PATH . 'news-templates/newspapers-template.php'); ?>
<?php require_once(COMPONENTS_PATH . "adv.php"); ?>
<?php get_header(); ?>

<div class="adfox-banner-background">
	<?php render_adv('page', get_the_ID(), 'background'); ?>
</div>
<main class="exchange-rates">
	<div class="container container_adv"><?php render_adv('page', get_the_ID(), 'before_main'); ?></div>
	<div class="container main-container">
		<div class="content-wrapper">
			<div class="main-content">
				<?php render_topic_bar(get_the_title(), false); ?>

				<div class="mob-container">
					<div class="page-description">
						<?php echo the_content(); ?>
					</div>
					<div class="exchange-rates-content">
						<iframe style="border:0;" height="131" marginheight="0" marginwidth="0" scrolling="no" src="https://admin.myfin.by/outer/informer/minsk/full" width="100%"></iframe>
					</div>
				</div>

			</div>
			<div class="second-content">
				<?php render_most_read_news_template(true, 'page', get_the_ID()); ?>
				<?php render_top_three_news_template('page', get_the_ID()); ?>
				<?php render_newspapers_template('page', get_the_ID()); ?>
			</div>
		</div>
		<?php if (is_active_sidebar('main-sidebar')) : ?>
			<div id="secondary" class="widget-area" role="complementary">
				<?php dynamic_sidebar('main-sidebar'); ?>
			</div>
		<?php endif; ?>
	</div>
</main>

<?php get_footer(); ?>