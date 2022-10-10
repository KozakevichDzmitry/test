<?php

function base_load_posts(
	$fn_args = array(
		'load' => 10,
		'offset' => 0,
		'type' => 'news',
	)
) {
	$q_args = array(
		'posts_per_page' => $fn_args['load'],
		'offset' => $fn_args['offset'],
		'post_status' => 'publish',
		'post_type' => $fn_args['type'],
	);

	if (!empty($fn_args['tax_query'])) {
		$q_args['tax_query'] = $fn_args['tax_query'];
	}

	if (!empty($fn_args['date'])) {
		$date = date('Y-m-d', strtotime($fn_args['date'] . ' 00:00:00'));
		$q_args['date_query'] = array(
			array(
				'after' => "$date 00:00:00",
			),
		);
		$q_args['order'] = 'ASC';
	}

	$posts = get_posts($q_args);
	$q_args['posts_per_page'] = -1;
	$all_posts = get_posts($q_args);

	return array(
		'posts' => $posts,
		'count' => count($all_posts),
	);
}
