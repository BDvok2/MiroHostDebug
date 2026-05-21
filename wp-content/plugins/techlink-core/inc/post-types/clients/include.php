<?php

include_once TECHLINK_CORE_CPT_PATH . '/clients/helper.php';

foreach ( glob( TECHLINK_CORE_CPT_PATH . '/clients/dashboard/meta-box/*.php' ) as $module ) {
	include_once $module;
}