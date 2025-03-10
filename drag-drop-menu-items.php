<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @since             2.0.0
 * @package           Drag_Drop_Menu_Items
 *
 * Plugin Name:       Drag & Drop Menu Items
 * Plugin URI:        https://wordpress.org/plugins/drag-drop-menu-items/
 * Description:       Easily Add Nav Menu Item By Dragging It To Menu Lists Container.
 * Version:           2.0.0
 * Author:            Sajjad Hossain Sagor
 * Author URI:        https://sajjadhsagor.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       drag-drop-menu-items
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) die;

/**
 * Currently plugin version.
 */
define( 'DRAG_DROP_MENU_ITEMS_VERSION', '2.0.0' );

/**
 * Define Plugin Folders Path
 */
define( 'DRAG_DROP_MENU_ITEMS_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );

define( 'DRAG_DROP_MENU_ITEMS_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

define( 'DRAG_DROP_MENU_ITEMS_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-plugin-activator.php
 * 
 * @since    2.0.0
 */
function activate_drag_drop_menu_items()
{
	require_once DRAG_DROP_MENU_ITEMS_PLUGIN_PATH . 'includes/class-plugin-activator.php';
	
	Drag_Drop_Menu_Items_Activator::activate();
}

register_activation_hook( __FILE__, 'activate_drag_drop_menu_items' );

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-plugin-deactivator.php
 * 
 * @since    2.0.0
 */
function deactivate_drag_drop_menu_items()
{
	require_once DRAG_DROP_MENU_ITEMS_PLUGIN_PATH . 'includes/class-plugin-deactivator.php';
	
	Drag_Drop_Menu_Items_Deactivator::deactivate();
}

register_deactivation_hook( __FILE__, 'deactivate_drag_drop_menu_items' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 * 
 * @since    2.0.0
 */
require DRAG_DROP_MENU_ITEMS_PLUGIN_PATH . 'includes/class-plugin.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    2.0.0
 */
function run_drag_drop_menu_items()
{
	$plugin = new Drag_Drop_Menu_Items();
	
	$plugin->run();
}

run_drag_drop_menu_items();
