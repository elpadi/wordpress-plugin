<?php

use Whoops\{
    Run,
    Handler\PrettyPageHandler
};

/*
define('WP_ALLOW_MULTISITE', true);
define('MULTISITE', true);
define('SUBDOMAIN_INSTALL', false);
define('DOMAIN_CURRENT_SITE', 'tome-v2.lndo.site');
define('PATH_CURRENT_SITE', '/');
define('SITE_ID_CURRENT_SITE', 1);
define('BLOG_ID_CURRENT_SITE', 1);
 */

define('WP_DEBUG', true);

/*
require_once __DIR__ . '/wplib/vendor/autoload.php';
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/wp-content/plugins/tome2-admin/vendor/autoload.php';
 */

if (class_exists(Run::class) && WP_DEBUG) {
    $whoops = new Run();
    $whoops->pushHandler(new PrettyPageHandler());
    $whoops->register();
}
