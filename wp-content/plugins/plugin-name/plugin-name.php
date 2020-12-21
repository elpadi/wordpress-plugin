<?php

/**
 * Plugin Name:       Plugin Name
 * Plugin URI:        https://github.com/elpadi/wordpress-plugin
 * Description:       Boilerplate for WordPress plugin
 * Version:           1.0.0
 * Author:            Carlos Padilla <padi_05@yahoo.com>
 * Author URI:        https://github.com/elpadi
 * License:           GPL-3.0+
 * License URI:       http://www.gnu.org/licenses/gpl-3.0.txt
 * Text Domain:       plugin-name
 * Domain Path:       /languages
 */

namespace PluginName;

use Whoops\{
    Run,
    Handler\PrettyPageHandler
};
use Pimple\Container;
use PluginName\Plugin\{
    Plugin,
    SettingsPage
};

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

require __DIR__ . '/vendor/autoload.php';

if (class_exists(Run::class) && WP_DEBUG) {
    $whoops = new Run();
    $whoops->pushHandler(new PrettyPageHandler());
    $whoops->register();
}

Plugin::$container = new Container();

Plugin::$container['plugin'] = function ($c) {
    return new Plugin();
};

Plugin::$container['plugin_data'] = function ($c) {
    return function_exists('get_plugin_data') ? get_plugin_data(__FILE__) : [];
};

register_activation_hook(__FILE__, [Plugin::$container['plugin'], 'onActivation']);
register_deactivation_hook(__FILE__, [Plugin::$container['plugin'], 'onDeactivation']);

add_action('admin_init', function () {
});

add_action('admin_menu', function () {
    Plugin::$container['settings_page'] = function ($c) {
        return new SettingsPage($c['plugin_data']);
    };

    Plugin::$container['settings_page']->init();
});
