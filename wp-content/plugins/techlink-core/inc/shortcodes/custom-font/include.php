<?php

include_once TECHLINK_CORE_SHORTCODES_PATH . '/custom-font/custom-font.php';

foreach ( glob( TECHLINK_CORE_SHORTCODES_PATH . '/custom-font/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}