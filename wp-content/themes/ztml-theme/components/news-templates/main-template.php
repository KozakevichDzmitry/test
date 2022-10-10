<?php

function render_main_template($tax_name = '')
{
?>
	<?php $main_attached_posts = get_attached_news(1, 'main'); ?>
	<?php $main_posts = get_default_news(2, 'main', $main_attached_posts['ids']); ?>
	<div class="box-column-gap" style="height: 100%;">
		<div class="box" style="padding: 10px;height: 50%;">
			<?php render_new_template_image($main_attached_posts['posts'][0]->ID); ?>
		</div>
		<div class="box additional_box">
			<?php render_news_template_line($main_posts[0]->ID, true, false, true); ?>
			<?php render_news_template_line($main_posts[1]->ID, true, false, true); ?>
		</div>
	</div>
<?php
}
