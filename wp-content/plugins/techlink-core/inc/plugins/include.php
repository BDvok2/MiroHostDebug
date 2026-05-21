<?php

foreach ( glob( TECHLINK_CORE_PLUGINS_PATH . '/*/include.php' ) as $module ) {
	include_once $module;
}