<?php

include_once TECHLINK_CORE_CPT_PATH . '/portfolio/shortcodes/portfolio-category-list/portfolio-category-list.php';

foreach ( glob( TECHLINK_CORE_CPT_PATH . '/portfolio/shortcodes/portfolio-category-list/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}