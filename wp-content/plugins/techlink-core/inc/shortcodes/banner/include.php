<?php

include_once TECHLINK_CORE_SHORTCODES_PATH . '/banner/banner.php';

foreach ( glob( TECHLINK_CORE_INC_PATH . '/shortcodes/banner/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}