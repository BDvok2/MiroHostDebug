-- Database cleanup script for krndsh.com
-- Run this after verifying the site works with remaining plugins
-- Usage: mysql -u u_krndsh -p krndsh < cleanup-db.sql

-- Remove deactivated/uninstalled plugins from active_plugins option
UPDATE zmso_options SET option_value = 'a:7:{i:0;s:31:"contact-form-7/wp-contact-form-7.php";i:1;s:19:"elementor/elementor.php";i:2;s:47:"qi-addons-for-elementor/class-qiaddonsforelementor.php";i:3;s:25:"qode-framework/class-qodeframework.php";i:4;s:42:"really-simple-ssl/rlrsssl-really-simple-ssl.php";i:5;s:24:"techlink-core/techlink-core.php";i:6;s:27:"woocommerce/woocommerce.php";}'
WHERE option_name = 'active_plugins';

-- Remove Really Simple SSL stored settings
DELETE FROM zmso_options WHERE option_name LIKE 'rsssl_%';
DELETE FROM zmso_options WHERE option_name = 'RSSSL_KEY';

-- Clean up WooCommerce logs schedule
DELETE FROM zmso_options WHERE option_name = 'woocommerce_api_enabled';

-- Remove Wordfence config (no longer installed)
DELETE FROM zmso_options WHERE option_name LIKE 'wordfence_%';
DELETE FROM zmso_options WHERE option_name LIKE 'wf_%';

-- Remove Yoast/SEO plugin data
DELETE FROM zmso_options WHERE option_name LIKE 'wpseo_%';
DELETE FROM zmso_options WHERE option_name LIKE '_yoast_%';

-- Remove RevSlider data
DELETE FROM zmso_options WHERE option_name LIKE 'revslider_%';

-- Remove Instagram/Twitter feed options
DELETE FROM zmso_options WHERE option_name LIKE 'sb_instagram_%';
DELETE FROM zmso_options WHERE option_name LIKE 'sb_twitter_%';
DELETE FROM zmso_options WHERE option_name LIKE 'cff_%';

-- Remove duplicate-page options
DELETE FROM zmso_options WHERE option_name LIKE 'duplicate_page_%';

-- Remove miniorange security options
DELETE FROM zmso_options WHERE option_name LIKE 'mo_%';

-- Remove svg-support options
DELETE FROM zmso_options WHERE option_name LIKE 'bodhi_svg_%';
