<?php

include_once TECHLINK_CORE_INC_PATH . '/blog/shortcodes/blog-list/blog-list.php';

foreach ( glob( TECHLINK_CORE_INC_PATH . '/blog/shortcodes/blog-list/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}