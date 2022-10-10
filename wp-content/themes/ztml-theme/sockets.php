<?php
require_once('./../../../wp-load.php');
require_once(__DIR__ . '/vendor/autoload.php');

define('COMPONENTS_PATH', dirname(__FILE__) . '/components/');

require_once(COMPONENTS_PATH . "topic-bar.php");
require_once(COMPONENTS_PATH . "news-templates/culture-news-template.php");
require_once(COMPONENTS_PATH . "news-templates/district-news-template.php");
require_once(COMPONENTS_PATH . "news-templates/economy-tempalte.php");
require_once(COMPONENTS_PATH . 'news-templates/incidents-news-template.php');
require_once(COMPONENTS_PATH . 'news-templates/main-news-template.php');
require_once(COMPONENTS_PATH . 'news-templates/most-read-news-template.php');
require_once(COMPONENTS_PATH . 'news-templates/newspapers-template.php');
require_once(COMPONENTS_PATH . 'news-templates/pallete-news-template.php');
require_once(COMPONENTS_PATH . 'news-templates/society-news-tempalte.php');
require_once(COMPONENTS_PATH . 'news-templates/sport-news-template.php');
require_once(COMPONENTS_PATH . 'news-templates/urban-economy-news-template.php');
require_once(COMPONENTS_PATH . 'news-templates/world-news-template.php');
require_once(COMPONENTS_PATH . 'news-templates/author-columns-template.php');
require_once(COMPONENTS_PATH . 'news-templates/top-three-news-template.php');
require_once(COMPONENTS_PATH . 'news-templates/timeline-news-template.php');
require_once(COMPONENTS_PATH . 'news-templates/video-news-tempalte.php');
require_once(COMPONENTS_PATH . 'news-templates/main-template.php');


use Thruway\Peer\Client;
use Thruway\Peer\Router;
use Thruway\Transport\RatchetTransportProvider;

$loop = React\EventLoop\Factory::create();

$pusher = new Client("realm1", $loop);

$pusher->on('open', function ($session) use ($loop) {
	$context = new React\ZMQ\Context($loop);

	$pull = $context->getSocket(ZMQ::SOCKET_PULL);
	$pull->bind('tcp://0.0.0.0:5555');

	$pull->on('message', function ($entry) use ($session) {
		$entryData = json_decode($entry, true);

		$category_render_templates = [
			'novosti-mira' => 'render_most_read_news_template',
			'obshhestvo' => 'render_society_news_template',
			'ekonomika' => 'render_urban_economy_news_template',
			'ekonomika-2' => 'render_economy_news_template',
			'kultura' => 'render_culture_news_template',
			'sport' => 'render_sport_news_template',
			'palitra-dnya' => 'render_pallete_news_template',
			'main' => 'render_main_template'
		];

		$new_categories_post = array();

		$cats = array_keys($category_render_templates);

		$entryData = json_decode($entry, true);
		$post_type = $entryData['event_type'];
		if ($entryData['event'] === 'new_post') {
			$post = get_post($entryData['post_id']);

			if ($post_type === 'newspaper') {
				$tax = wp_get_post_terms($post->ID, 'newspapers', ['fields' => 'slugs']);
				$template_posts_html = ob_start();
				render_pdf_attachments_item($post->ID);
				$template_posts_html = ob_get_clean();
				ob_end_flush();

				$session->publish($post_type, [json_encode([
					'data' => $template_posts_html,
					'tax' => $tax
				])]);
			}
		} else if ($entryData['event'] === 'news_block_update') {
			if ($post_type === 'news') {
				foreach ($entryData['update_blocks'] as $cat) {

					if (!in_array($cat, $cats)) continue;

					$block_html = ob_start();
					$category_render_templates[$cat]();
					$block_html = ob_get_clean();
					ob_end_flush();

					array_push($new_categories_post, [
						'data' => $block_html,
						'cat' => $cat
					]);
				}
				$session->publish('news', [json_encode($new_categories_post)]);
			}
		}
	});
});

$router = new Router($loop);
$router->addInternalClient($pusher);
$router->addTransportProvider(new RatchetTransportProvider("0.0.0.0", 8888));
$router->start();
