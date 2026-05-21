<?php

include_once TECHLINK_CORE_INC_PATH . '/social-share/shortcodes/social-share/social-share.php';

foreach ( glob( TECHLINK_CORE_INC_PATH . '/social-share/shortcodes/social-share/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}