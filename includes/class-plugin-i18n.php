<?php

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      2.0.0
 * @package    Drag_Drop_Menu_Items
 * @subpackage Drag_Drop_Menu_Items/includes
 * @author     Sajjad Hossain Sagor <sagorh672@gmail.com>
 */
class Drag_Drop_Menu_Items_i18n
{
	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    2.0.0
	 * @access   public
	 */
	public function load_plugin_textdomain()
	{
		load_plugin_textdomain(
			'drag-drop-menu-items',
			false,
			dirname( DRAG_DROP_MENU_ITEMS_PLUGIN_BASENAME ) . '/languages/'
		);
	}
}
