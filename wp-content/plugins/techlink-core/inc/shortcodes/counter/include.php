<?php

include_once TECHLINK_CORE_SHORTCODES_PATH . '/counter/counter.php';

foreach ( glob( TECHLINK_CORE_SHORTCODES_PATH . '/counter/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}