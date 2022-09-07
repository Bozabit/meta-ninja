<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://luckyseed.io/people/bozabit
 * @since      1.0.0
 *
 * @package    Meta_Ninja
 * @subpackage Meta_Ninja/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Meta_Ninja
 * @subpackage Meta_Ninja/admin
 * @author     Bozabit <bozabit@luckyseed.com>
 */
class Meta_Ninja_Admin
{

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct($plugin_name, $version)
	{

		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles()
	{

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Meta_Ninja_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Meta_Ninja_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/meta-ninja-admin.css', array(), $this->version, 'all');
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts()
	{

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Meta_Ninja_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Meta_Ninja_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/meta-ninja-admin.js', array('jquery'), $this->version, false);
	}

	public function add_admin_menu()
	{
		$capability = 'activate_plugins';
		add_menu_page("Meta Ninja", "Meta Ninja", $capability, 'meta-ninja-admin-app', array($this, 'insert_react_admin_app'), '', '999');
	}

	public function insert_react_admin_app()
	{
		$react = new Meta_Ninja_React();
		$react->add_react_scripts();

		require_once plugin_dir_path(__FILE__) . 'partials/meta-ninja-admin-display.php';
	}
}