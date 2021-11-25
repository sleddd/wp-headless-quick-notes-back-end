<?php namespace WpStarterPlugin;

/**
 * Manages plugin initialization for scripts, styles, and hooks.
 */
class WpStarterPlugin {

	public static $BOOK_CPT_NAME = 'Book';
	public static $BOOK_CPT_TAX_GENRE = 'Genre';

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

		// Enqueue scripts and styles
		add_action( 'wp_enqueue_styles', array( $this, 'enqueue_styles' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		//add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		//add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_styles' ) );

		$this->register_cpts();

	}

	public function register_cpts() { 
		//cpts\register_post_type(self::$BOOK_CPT_NAME);
		//cpts\add_taxonomy(self::$BOOK_CPT_TAX_GENRE, self::$BOOK_CPT_NAME);
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
	 * Manages registering plugin styles.
	 */
	public function enqueue_styles() {
		wp_enqueue_style( 'wpstarterplugin-styles', WP_STARTER_PLUGIN_URL . 'dist/styles.min.css', rand(), false, 'all' );
	}

	/**
	 * Manages registering plugin scripts and script localization.
	 */
	public function enqueue_scripts() {
		wp_enqueue_script( 'wpstarterplugin-scripts', WP_STARTER_PLUGIN_URL . 'dist/plugin.min.js', 'jquery', rand(), true );
		$nonce = wp_create_nonce( 'ajax_nonce' );
		wp_localize_script(
			'wpstarterplugin-scripts',
			'wpstarterplugin',
			array(
				'ajaxurl' => admin_url( 'admin-ajax.php' ),
				'nonce'   => $nonce,
			)
		);
	}
}
