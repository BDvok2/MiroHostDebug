<?php

include_once TECHLINK_CORE_SHORTCODES_PATH . '/single-image/single-image.php';

foreach ( glob( TECHLINK_CORE_SHORTCODES_PATH . '/single-image/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}