<?php

include_once TECHLINK_CORE_INC_PATH . '/header/top-area/top-area.php';
include_once TECHLINK_CORE_INC_PATH . '/header/top-area/helper.php';

foreach ( glob( TECHLINK_CORE_INC_PATH . '/header/top-area/dashboard/*/*.php' ) as $dashboard ) {
	include_once $dashboard;
}