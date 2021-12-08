<?php namespace WpStarterPlugin;

/**
 * Manages plugin initialization for scripts, styles, and hooks.
 */
class WpStarterPlugin {

	public static $POST_TYPES = array();

	public function __construct() {
		$this->init();
	}

	/**
	 * Used to create instances of any needed objects or class properties
	 * and to register needed WordPress hooks, actions, and filters
	 */
	public function init() {
		// Register activation and deactivation hooks
		register_activation_hook( WP_STARTER_PLUGIN_PATH . 'wp-starter-plugin.php', array( $this, 'activate_plugin' ) );
		register_deactivation_hook( WP_STARTER_PLUGIN_PATH . 'wp-starter-plugin.php', array( $this, 'deactivate_plugin' ) );

		// Register custom post types.
		$this->register_cpts();

		// Register custom blocks.
		add_action( 'init', array( $this, 'register_blocks' ) );

		// Enqueue scripts and styles
		add_action( 'wp_enqueue_styles', array( $this, 'enqueue_frontend_styles' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_frontend_scripts' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_backend_scripts' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_backend_styles' ) );

		// Add browsersync
		add_action( 'wp_footer', array( $this, 'add_browser_sync' ));

		// Add settings pages 
		$this->register_settings_pages();

		// Hide the ACF admin menu item.
		add_filter('acf/settings/show_admin', function( $show_admin ) { return false; });
	}

	public function register_settings_pages() {
		new \WpStarterPlugin\Settings\ExampleSettingsPage();
		new \WpStarterPlugin\Settings\ExampleSettingsSubPage();
		//new \WpStarterPlugin\Settings\ExampleACFSettingsPage();
	}

	public function register_cpts() {
		self::$POST_TYPES['example'] = new \WpStarterPlugin\PostTypes\ExamplePostType();
	}

	public function register_blocks() {
		wp_enqueue_style(
			'wpstarterplugin-blockcss', // Handle.
			WP_STARTER_PLUGIN_URL . 'dist/css/blocks.css'
		);
		wp_enqueue_script(
			'wpstarterplugin-blockjs', // Handle.
			WP_STARTER_PLUGIN_URL . 'dist/js/blocks.js',
			array( 'wp-blocks', 'wp-i18n', 'wp-element', 'wp-editor', 'wp-components' ),
			null,
			true
		);
		wp_localize_script(
			'wpstarterplugin-blockjs',
			'wpstarterplugin',
			array(
				'pluginDirPath' => WP_STARTER_PLUGIN_PATH,
				'pluginDirUrl'  => WP_STARTER_PLUGIN_URL,
			)
		);
	}

	/**
	 *  Manages tasks done on plugin activation.
	 */
	public function activate_plugin() {

	}

	/**
	 * Manages tasks done on plugin deactivation.
	 */
	public function deactivate_plugin() {
	}

	/**
	 * Manages registering frontend plugin styles.
	 */
	public function enqueue_frontend_styles() {
		wp_enqueue_style( 'wpstarterplugin-styles', WP_STARTER_PLUGIN_URL . 'dist/css/frontend.css', rand(), false, 'all' );
	}

	/**
	 * Manages registering backend styles.
	 */
	public function enqueue_backend_styles() {
		wp_enqueue_style( 'wpstarterplugin-styles', WP_STARTER_PLUGIN_URL . 'dist/css/backend.css', rand(), false, 'all' );
	}

	/**
	 * Manages registering plugin frontend scripts and script localization.
	 */
	public function enqueue_frontend_scripts() {
		wp_enqueue_script( 'wpstarterplugin-scripts', WP_STARTER_PLUGIN_URL . 'dist/js/frontend.js', 'jquery', rand(), true );
		$nonce = wp_create_nonce( 'ajax_nonce' );
		wp_localize_script(
			'wpstarterplugin-frontend-scripts',
			'wpstarterplugin',
			array(
				'ajaxurl' => admin_url( 'admin-ajax.php' ),
				'nonce'   => $nonce,
			)
		);
	}

	/**
	 * Manages registering backend scripts and script localization.
	 */
	public function enqueue_backend_scripts() {
		wp_enqueue_script( 'wpstarterplugin-scripts', WP_STARTER_PLUGIN_URL . 'dist/js/backend.js', 'jquery', rand(), true );
		$nonce = wp_create_nonce( 'ajax_nonce' );
		wp_localize_script(
			'wpstarterplugin-backend-scripts',
			'wpstarterplugin',
			array(
				'ajaxurl' => admin_url( 'admin-ajax.php' ),
				'nonce'   => $nonce,
			)
		);
	}

	public function add_browser_sync() {
		echo '<script id="__bs_script__">//<![CDATA[
			document.write("<script async src=' . 'http://HOST:62584/browser-sync/browser-sync-client.js?v=2.27.7' . '><\/script>".replace("HOST", location.hostname));
		    //]]></script>';
	}
}
