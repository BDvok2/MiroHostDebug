<?php

include_once TECHLINK_CORE_SHORTCODES_PATH . '/item-showcase/item-showcase.php';

foreach ( glob( TECHLINK_CORE_SHORTCODES_PATH . '/item-showcase/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}