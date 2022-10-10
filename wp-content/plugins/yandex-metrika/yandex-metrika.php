<?php
/*
Plugin Name: Популярные статьи Метрика
Author: Velial Cypher
Description: not found
Version: 0.0.1
*/

add_action('admin_menu', function () {
	add_options_page(
		'Популярные статьи Метрика',
		'Популярные статьи Метрика',
		'edit_others_posts',
		basename(__FILE__),
		function () {
			$fname = "metrika.json";
			require_once(dirname(__FILE__) . "/templates/dashboard.php");
		}
	);
});
