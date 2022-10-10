<?php get_header(); ?>

<?php require_once(COMPONENTS_PATH . 'topic-bar.php'); ?>
<?php require_once(COMPONENTS_PATH . 'pdf-attachments.php'); ?>
<?php require_once(COMPONENTS_PATH . 'satms-list-tem.php'); ?>
<?php require_once(COMPONENTS_PATH . 'sidebar.php'); ?>
<?php require_once(COMPONENTS_PATH . 'calendar.php'); ?>


<?php require_once(COMPONENTS_PATH . 'line-news-list-item.php'); ?>

<?php require_once(COMPONENTS_PATH . 'news-templates.php'); ?>
<?php require_once(COMPONENTS_PATH . 'news-templates/top-three-news-template.php'); ?>
<?php require_once(COMPONENTS_PATH . 'news-templates/newspapers-template.php'); ?>
<?php require_once(COMPONENTS_PATH . 'news-templates/most-read-news-template.php'); ?>


<?php require_once(COMPONENTS_PATH . "topic-minibar.php"); ?>

<?php require_once(COMPONENTS_PATH . 'news-templates/culture-news-template.php'); ?>
<?php require_once(COMPONENTS_PATH . 'news-templates/district-news-template.php'); ?>
<?php require_once(COMPONENTS_PATH . 'news-templates/economy-tempalte.php'); ?>
<?php require_once(COMPONENTS_PATH . 'news-templates/society-news-tempalte.php'); ?>
<?php require_once(COMPONENTS_PATH . 'news-templates/urban-economy-news-template.php'); ?>

<main class="events" id="events">
	<div class="container main-container">
		<div class="content-wrapper">
			<div class="main-content">
				<?php render_topic_bar(get_the_title(), false); ?>
				<p class="events-color">Для современного мира постоянное информационно-пропагандистское обеспечение нашей деятельности, а также свежий взгляд на привычные вещи - безусловно открывает новые горизонты для позиций, занимаемых участниками в отношении поставленных задач. Банальные, но неопровержимые выводы, а также элементы политического процесса, превозмогая сложившуюся непростую экономическую ситуацию, призваны к ответу. Задача организации, в особенности же социально-экономическое развитие позволяет выполнить важные задания по разработке экономической целесообразности принимаемых решений. Прежде всего, внедрение современных методик говорит о возможностях экспериментов, поражающих по своей масштабности.</p>
				<div class="event_slider">
					<?php $images_gallery = carbon_get_post_meta(get_the_ID(), 'slider_gallery'); ?>
					<?php foreach ($images_gallery as $image) : ?>
						<?php $file_type = wp_attachment_is('image', $image); ?>
						<?php if ($file_type) : ?>
							<div>
								<img class="fill zoom-img" src="<?php echo wp_get_attachment_image_url($image); ?>" alt="<?php echo get_post_meta($image, '_wp_attachment_image_alt', TRUE); ?>" />
							</div>
						<?php else : ?>
							<video controls>
								<source src="<?php echo wp_get_attachment_url($image); ?>" type="video/mp4">
							</video>
						<?php endif; ?>
					<?php endforeach; ?>
				</div>
				<?php $data = carbon_get_post_meta(get_the_ID(), 'crb_event'); ?>
				<div class="events-content">
					<?php foreach ($data as $data_item) : ?>
						<div class="events-header">
							<div class="text_container">
								<p class="events-time"><?php echo $data_item["event_time"]; ?></p>
								<p class="events-title"><?php echo $data_item["title"]; ?></p>
							</div>
						</div>
						<div class="img-container">
							<?php foreach ($data_item["crb_media_gallery"] as $image) : ?>
								<img class="event-img zoom-img" src="<?php echo wp_get_attachment_url($image); ?>" alt="<?php echo get_post_meta($image, '_wp_attachment_image_alt', TRUE); ?>" />
							<?php endforeach; ?>

						</div>
					<?php endforeach; ?>
				</div>
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