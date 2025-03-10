<?php

/**
 * Fired when the plugin is uninstalled.
 *
 * @since      2.0.0
 * @package    Drag_Drop_Menu_Items
 */

// If uninstall not called from WordPress, then exit.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) die;

/**
 * Remove plugin options on uninstall/delete
 */
delete_option( 'plugin_settings_name' );
