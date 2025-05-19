<?php
/**
 * This file contains the definition of the Drag_Drop_Menu_Items_Admin class, which
 * is used to load the plugin's admin-specific functionality.
 *
 * @package       Drag_Drop_Menu_Items
 * @subpackage    Drag_Drop_Menu_Items/admin
 * @author        Sajjad Hossain Sagor <sagorh672@gmail.com>
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version and other methods.
 *
 * @since    2.0.0
 */
class Drag_Drop_Menu_Items_Admin {
	/**
	 * The ID of this plugin.
	 *
	 * @since     2.0.0
	 * @access    private
	 * @var       string $plugin_name The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since     2.0.0
	 * @access    private
	 * @var       string $version The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since     2.0.0
	 * @access    public
	 * @param     string $plugin_name The name of this plugin.
	 * @param     string $version     The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {
		$this->plugin_name = $plugin_name;
		$this->version     = $version;
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since     2.0.0
	 * @access    public
	 */
	public function enqueue_styles() {
		global $pagenow;

		if ( 'nav-menus.php' === $pagenow ) {
			wp_enqueue_style( $this->plugin_name, DRAG_DROP_MENU_ITEMS_PLUGIN_URL . 'admin/css/admin.css', array(), $this->version, 'all' );
		}
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since     2.0.0
	 * @access    public
	 */
	public function enqueue_scripts() {
		global $pagenow;

		if ( 'nav-menus.php' === $pagenow ) {
			wp_enqueue_script( $this->plugin_name, DRAG_DROP_MENU_ITEMS_PLUGIN_URL . 'admin/js/admin.js', array( 'jquery', 'wp-util' ), $this->version, false );

			wp_localize_script(
				$this->plugin_name,
				'DragDropMenuItems',
				array(
					'ajaxurl'             => admin_url( 'admin-ajax.php' ),
					'fakeDropPlaceholder' => __( 'Drop here to Add Menu item here', 'drag-drop-menu-items' ),
				)
			);
		}
	}

	/**
	 * Adds a settings link to the plugin's action links on the plugin list table.
	 *
	 * @since     2.0.0
	 * @access    public
	 * @param     array $links The existing array of plugin action links.
	 * @return    array $links The updated array of plugin action links, including the settings link.
	 */
	public function add_plugin_action_links( $links ) {
		$links[] = sprintf( '<a href="%s">%s</a>', esc_url( admin_url( 'nav-menus.php' ) ), __( 'Settings', 'drag-drop-menu-items' ) );

		return $links;
	}
}
