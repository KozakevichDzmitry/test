<?php get_header(); ?>

<?php require_once(COMPONENTS_PATH . 'pdf-attachments.php'); ?>
<?php require_once(COMPONENTS_PATH . 'topic-bar.php'); ?>
<?php require_once(COMPONENTS_PATH . 'sidebar.php'); ?>

<?php require_once(COMPONENTS_PATH . 'author-column-slider-card.php'); ?>

<?php require_once(COMPONENTS_PATH . "icons/advertising-icon.php"); ?>
<?php require_once(COMPONENTS_PATH . "icons/marker-icon.php"); ?>
<?php require_once(COMPONENTS_PATH . "icons/location-icon.php"); ?>
<?php require_once(COMPONENTS_PATH . "icons/camera-icon.php"); ?>
<?php require_once(COMPONENTS_PATH . "icons/video-content-icon.php"); ?>

<?php require_once(COMPONENTS_PATH . 'news-template-palette-day.php'); ?>
<?php require_once(COMPONENTS_PATH . 'news-templates.php'); ?>

<?php require_once(COMPONENTS_PATH . 'news-templates/culture-news-template.php'); ?>
<?php require_once(COMPONENTS_PATH . 'news-templates/district-news-template.php'); ?>
<?php require_once(COMPONENTS_PATH . 'news-templates/economy-tempalte.php'); ?>
<?php require_once(COMPONENTS_PATH . 'news-templates/incidents-news-template.php'); ?>
<?php require_once(COMPONENTS_PATH . 'news-templates/main-news-template.php'); ?>
<?php require_once(COMPONENTS_PATH . 'news-templates/most-read-news-template.php'); ?>
<?php require_once(COMPONENTS_PATH . 'news-templates/newspapers-template.php'); ?>
<?php require_once(COMPONENTS_PATH . 'news-templates/pallete-news-template.php'); ?>
<?php require_once(COMPONENTS_PATH . 'news-templates/society-news-tempalte.php'); ?>
<?php require_once(COMPONENTS_PATH . 'news-templates/sport-news-template.php'); ?>
<?php require_once(COMPONENTS_PATH . 'news-templates/urban-economy-news-template.php'); ?>
<?php require_once(COMPONENTS_PATH . 'news-templates/world-news-template.php'); ?>
<?php require_once(COMPONENTS_PATH . 'news-templates/author-columns-template.php'); ?>
<?php require_once(COMPONENTS_PATH . 'news-templates/top-three-news-template.php'); ?>
<?php require_once(COMPONENTS_PATH . 'news-templates/timeline-news-template.php'); ?>
<?php require_once(COMPONENTS_PATH . 'news-templates/video-news-tempalte.php'); ?>

<?php require_once(COMPONENTS_PATH . 'icons/collapse-btn-icon.php'); ?>
<?php require_once(COMPONENTS_PATH . 'icons/expand-btn-icon.php'); ?>

<main class="site-main">
	<div class="container main-container">
		<div class="content-wrapper">
			<?php render_main_news_template(); ?>

			<?php render_district_news_template(); ?>

			<?php render_most_read_news_template(); ?>

			<?php render_society_news_template(); ?>

			<?php render_video_news_template("Смотрите"); ?>

			<?php render_urban_economy_news_template(); ?>

			<?php render_economy_news_template(); ?>

			<?php render_culture_news_template(); ?>

			<?php render_sport_news_template(); ?>

			<?php render_incidents_news_tempalte(); ?>

			<?php render_world_news_template(); ?>

			<?php render_pallete_news_template(); ?>

			<?php render_author_columns_template(); ?>

			<?php render_newspapers_template(); ?>
		</div>
		<?php render_sidebar(); ?>
	</div>
</main>

<?php get_footer(); ?>