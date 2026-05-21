<?php

include_once TECHLINK_CORE_SHORTCODES_PATH . '/pricing-table/pricing-table.php';

foreach ( glob( TECHLINK_CORE_SHORTCODES_PATH . '/pricing-table/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}