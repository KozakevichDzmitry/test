<?php
/*
 * Template Name: Реклама
*/

?>

<?php get_header(); ?>

<?php require_once(COMPONENTS_PATH . 'topic-bar.php'); ?>

<?php require_once(COMPONENTS_PATH . 'icons/advertising-icon.php'); ?>
<?php require_once(COMPONENTS_PATH . 'icons/share-icon.php'); ?>
<?php require_once(COMPONENTS_PATH . 'sidebar.php'); ?>

<?php require_once(COMPONENTS_PATH . 'news-templates/top-three-news-template.php'); ?>
<?php require_once(COMPONENTS_PATH . 'news-templates/newspapers-template.php'); ?>
<?php require_once(COMPONENTS_PATH . 'news-templates/most-read-news-template.php'); ?>
<?php require_once(COMPONENTS_PATH . "icons/arrow-up-icon.php"); ?>
<?php require_once(COMPONENTS_PATH . "adv.php"); ?>

<div class="adfox-banner-background">
	<?php render_adv('page', get_the_ID(), 'background'); ?>
</div>
<main class="page advertisement">
	<div class="container container_adv"><?php render_adv('page', get_the_ID(), 'before_main'); ?></div>
	<div class="container main-container">
		<div class="content-wrapper">
			<div class="main-content">
				<?php render_topic_bar(get_the_title(), false); ?>
				<div class="page-content">
					<?php the_content(); ?>
				</div>
				<div class="price-list">
					<?php foreach (carbon_get_post_meta(get_the_ID(), 'page_advertisement_block') as $acc) : ?>
						<div class="acc-item">
							<span class="acc-title acc-btn">
								<span>
									<?php echo $acc['page_advertisement_block_title'] ?>
								</span>
								<div>
									<?php render_arrow_up_icon(); ?>
								</div>
							</span>
							<div class="acc-content page-content">
								<?php echo apply_filters('the_content', $acc['page_advertisement_block_content']) ?>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
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