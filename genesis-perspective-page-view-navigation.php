<?php
/**
 * Genesis Perspective Page View Navigation
 *
 * @package    Genesis_Perspective_Page_View_Navigation
 * @author     Craig Simpson <craig@craigsimpson.scot>
 * @license    GPL-2.0+
 *
 * @wordpress-plugin
 * Plugin Name:       Genesis Perspective Page View Navigation
 * Plugin URI:        https://github.com/craigsimps/genesis-perspective-page-view-navigation
 * Description:       Adds an off-canvas navigation area. When you click the menu button, the website will move to the left in perspective, and the menu will reveal itself.
 * Version:           1.0.0
 * Author:            Craig Simpson
 * Author URI:        https://craigsimpson.scot/
 * Text Domain:       genesis-perspective-page-view-navigation
 * Domain Path:       /languages
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 */

class Genesis_Perspective_Page_View_Navigation {

	/**
	 * Hold an instance of this object.
	 *
	 * @var Genesis_Perspective_Page_View_Navigation
	 *
	 * @since 1.0.0
	 */
	protected static $instance;

	/**
	 * Return the one true Genesis_Perspective_Page_View_Navigation
	 *
	 * @return Genesis_Perspective_Page_View_Navigation
	 *
	 * @since 1.0.0
	 */
	public static function get_instance() {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Genesis_Perspective_Page_View_Navigation constructor.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		add_action( 'init', [ $this, 'register_additional_menu' ] );
		add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_scripts' ], 5 );
		add_action( 'genesis_before', [ $this, 'open_wrapper' ] );
		add_action( 'genesis_after', [ $this, 'close_wrapper' ] );
	}

	/**
	 * Register our additional menu.
	 *
	 * @since 1.0.0
	 */
	public function register_additional_menu() {
		register_nav_menu( 'perspective-page-menu', __( 'Off Canvas Perspective Page Menu', 'genesis-perspective-page-view-navigation' ) );
	}

	/**
	 * Enqueue our scripts and styles, and pass config variables to our JS.
	 *
	 * @since 1.0.0
	 */
	public function enqueue_scripts() {

		$plugin_dir = plugin_dir_url( __FILE__ );

		$config = apply_filters(
			'genesis_perspective_page_view_navigation',
			[
				'icon'   => '<span class="dashicons dashicons-menu"></span>',
				'label'  => __( 'Menu', 'genesis-perspective-page-view-navigation' ),
				'append' => '.title-area',
			]
		);

		wp_enqueue_style( 'genesis-perspective-page-view-navigation', $plugin_dir . 'assets/css/genesis-perspective-page-view-navigation.css' );
		wp_register_script( 'modernizr', $plugin_dir . 'assets/js/modernizr.js', [], '1.0.0', false );
		wp_enqueue_script( 'genesis-perspective-page-view-navigation', $plugin_dir . 'assets/js/genesis-perspective-page-view-navigation.js', [
			'modernizr',
		], '1.0.0', true );
		wp_localize_script( 'genesis-perspective-page-view-navigation', 'config', $config );

	}

	/**
	 * Open the wrapping markup.
	 *
	 * @since 1.0.0
	 */
	public function open_wrapper() {
		include 'views/gppvn-open-wrapper.php';
	}

	/**
	 * Close the wrapping markup. Includes menu output.
	 *
	 * @since 1.0.0
	 */
	public function close_wrapper() {
		include 'views/gppvn-close-wrapper.php';
	}

}

$genesis_perspective_page_view_navigation = Genesis_Perspective_Page_View_Navigation::get_instance();
