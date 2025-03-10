<?php

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      2.0.0
 * @package    Drag_Drop_Menu_Items
 * @subpackage Drag_Drop_Menu_Items/includes
 * @author     Sajjad Hossain Sagor <sagorh672@gmail.com>
 */
class Drag_Drop_Menu_Items
{
	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    2.0.0
	 * @access   protected
	 * @var      Drag_Drop_Menu_Items_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    2.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    2.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    2.0.0
	 * @access   public
	 */
	public function __construct()
	{
		if ( defined( 'DRAG_DROP_MENU_ITEMS_VERSION' ) )
		{
			$this->version = DRAG_DROP_MENU_ITEMS_VERSION;
		}
		else
		{
			$this->version = '2.0.0';
		}
		
		$this->plugin_name = 'drag-drop-menu-items';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();
	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Drag_Drop_Menu_Items_Loader. Orchestrates the hooks of the plugin.
	 * - Drag_Drop_Menu_Items_i18n. Defines internationalization functionality.
	 * - Drag_Drop_Menu_Items_Admin. Defines all hooks for the admin area.
	 * - Drag_Drop_Menu_Items_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    2.0.0
	 * @access   private
	 */
	private function load_dependencies()
	{
		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once DRAG_DROP_MENU_ITEMS_PLUGIN_PATH . 'includes/class-plugin-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once DRAG_DROP_MENU_ITEMS_PLUGIN_PATH . 'includes/class-plugin-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once DRAG_DROP_MENU_ITEMS_PLUGIN_PATH . 'admin/class-plugin-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once DRAG_DROP_MENU_ITEMS_PLUGIN_PATH . 'public/class-plugin-public.php';

		$this->loader = new Drag_Drop_Menu_Items_Loader();
	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Drag_Drop_Menu_Items_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    2.0.0
	 * @access   private
	 */
	private function set_locale()
	{
		$plugin_i18n = new Drag_Drop_Menu_Items_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );
	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    2.0.0
	 * @access   private
	 */
	private function define_admin_hooks()
	{
		$plugin_admin = new Drag_Drop_Menu_Items_Admin( $this->get_plugin_name(), $this->get_version() );

		// $this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

		$this->loader->add_action( 'plugin_action_links_' . DRAG_DROP_MENU_ITEMS_PLUGIN_BASENAME, $plugin_admin, 'add_plugin_action_links' );
	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    2.0.0
	 * @access   private
	 */
	private function define_public_hooks()
	{
		$plugin_public = new Drag_Drop_Menu_Items_Public( $this->get_plugin_name(), $this->get_version() );

		// $this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		// $this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    2.0.0
	 * @access   public
	 */
	public function run()
	{
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     2.0.0
	 * @access    public
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name()
	{
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     2.0.0
	 * @access    public
	 * @return    Drag_Drop_Menu_Items_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader()
	{
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     2.0.0
	 * @access    public
	 * @return    string    The version number of the plugin.
	 */
	public function get_version()
	{
		return $this->version;
	}

	/**
	 * Retrieves an option value from the WordPress options table.
	 *
	 * This function retrieves a specific option value from a given section within the WordPress options table.
	 * If the option is not found, it returns a default value.
	 *
	 * @since    2.0.0
	 * @access   public
	 * @param    string $option  			The name of the option to retrieve.
	 * @param    string $section 			The name of the option section (the key under which options are stored in the database).
	 * @param    mixed  $default Optional. 	The default value to return if the option is not found. Defaults to an empty string.
	 * @return   mixed 						The option value, or the default value if the option is not set.
	 */
	public static function get_option( $option, $section, $default = '' )
	{
		// Retrieve the options array for the given section.
		$options = get_option( $section );

		// Check if the option exists within the retrieved options array.
		if ( isset( $options[$option] ) )
		{
			// Return the option value.
			return $options[$option];
		}

		// If the option is not found, return the default value.
		return $default;
	}
}
