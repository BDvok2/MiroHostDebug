<?php

include_once TECHLINK_CORE_INC_PATH . '/header/scroll-appearance/helper.php';

foreach ( glob( TECHLINK_CORE_INC_PATH . '/header/scroll-appearance/dashboard/*/*.php' ) as $dashboard ) {
	include_once $dashboard;
}

foreach ( glob( TECHLINK_CORE_INC_PATH . '/header/scroll-appearance/*/include.php' ) as $appearance ) {
	include_once $appearance;
}