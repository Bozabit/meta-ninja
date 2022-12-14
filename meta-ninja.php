<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://luckyseed.io/people/bozabit
 * @since             1.0.0
 * @package           Meta_Ninja
 *
 * @wordpress-plugin
 * Plugin Name:       Meta Ninja
 * Plugin URI:        https://luckyseed.io/wp/plugins/meta-ninja
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           0.2.1
 * Author:            Bozabit
 * Author URI:        https://luckyseed.io/people/bozabit
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       meta-ninja
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define('META_NINJA_VERSION', '0.2.1');

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-meta-ninja-activator.php
 */
function activate_meta_ninja()
{
	require_once plugin_dir_path(__FILE__) . 'includes/class-meta-ninja-activator.php';
	Meta_Ninja_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-meta-ninja-deactivator.php
 */
function deactivate_meta_ninja()
{
	require_once plugin_dir_path(__FILE__) . 'includes/class-meta-ninja-deactivator.php';
	Meta_Ninja_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_meta_ninja');
register_deactivation_hook(__FILE__, 'deactivate_meta_ninja');

require plugin_dir_path(__FILE__) . 'includes/class-meta-ninja-updater.php';
$update_checker = new Meta_Ninja_Updater(__FILE__);
$update_checker->check_updates();

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path(__FILE__) . 'includes/class-meta-ninja.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_meta_ninja()
{

	$plugin = new Meta_Ninja();
	$plugin->run();
}
run_meta_ninja();