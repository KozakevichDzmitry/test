<?php

function render_category_slider()
{
?>
	<div class="category-select-slider">
		<div class="slider-container">
			<?php foreach (get_categories(array(
				'taxonomy' => 'news-list',
			)) as $cat) : ?>
				<a class="category-select-btn" href="<?php echo get_category_link($cat); ?>">
					<?php echo $cat->name; ?>
				</a>
			<?php endforeach; ?>
		</div>
	</div>
<?php
}
