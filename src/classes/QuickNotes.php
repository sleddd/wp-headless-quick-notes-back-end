<?php namespace QuickNotes;

/**
 * Manages plugin initialization.
 */
class QuickNotes {

	/**
	 * Holds an instance of the plugin.
	 *
	 * @var object $instance Instance of plugin.
	 */
	public static $instance = null;

	/**
	 * Prevents initialization in outer code.
	 */
	private function __construct() {}

	/**
	 * Returns instance of the plugin.
	 */
	public static function get_instance() {
		if ( self::$instance == null ) {
			self::$instance = new QuickNotes();
		}
		return self::$instance;
	}

	/**
	 * Registers any needed WordPress hooks, actions, filters.
	 */
	public static function init() {

		$plugin = self::get_instance();

		// Register activation and deactivation hooks
		register_activation_hook( QUICK_NOTES_PATH . 'wp-starter-plugin.php', array( __NAMESPACE__ . '\\QuickNotes', 'activate_plugin' ) );
		register_deactivation_hook( QUICK_NOTES_PATH . 'wp-starter-plugin.php', array( __NAMESPACE__ . '\\QuickNotes', 'deactivate_plugin' ) );

		// Register custom post types.
		$plugin::register_cpts();

		// Register custom post types.
		$plugin::register_custom_fields();

		// Register graphQL extensions 
		$plugin::extend_graphQL();

		// Register custom blocks.
		add_action( 'init', array( __NAMESPACE__ . '\\QuickNotes', 'register_blocks' ) );

		// Enqueue scripts and styles.
		add_action( 'wp_enqueue_styles', array( __NAMESPACE__ . '\\QuickNotes', 'enqueue_frontend_styles' ) );
		add_action( 'wp_enqueue_scripts', array( __NAMESPACE__ . '\\QuickNotes', 'enqueue_frontend_scripts' ) );
		add_action( 'admin_enqueue_scripts', array( __NAMESPACE__ . '\\QuickNotes', 'enqueue_backend_scripts' ) );
		add_action( 'admin_enqueue_scripts', array( __NAMESPACE__ . '\\QuickNotes', 'enqueue_backend_styles' ) );

		// Add browsersync.
		add_action( 'wp_footer', array( __NAMESPACE__ . '\\QuickNotes', 'add_browser_sync' ) );

		// Add settings pages.
		$plugin::register_settings_pages();

		// Hide the ACF admin menu item.
		add_filter(
			'acf/settings/show_admin',
			function( $show_admin ) {
				return false;
			}
		);

		return $plugin;
	}

	/**
	 *  Manages tasks done on plugin activation.
	 */
	public static function activate_plugin() {}

	/**
	 * Manages tasks done on plugin deactivation.
	 */
	public static function deactivate_plugin() {}

	/**
	 * Registration for custom settings pages.
	 */
	public static function register_settings_pages() {
		//\QuickNotes\Settings\ExampleSettingsPage::init();
		//\QuickNotes\Settings\ExampleSettingsSubPage::init();
		//\QuickNotes\Settings\ExampleACFSettingsPage::init();
	}

	/**
	 * Registration for custom post types.
	 */
	public static function register_cpts() {
		PostTypes\Journal::init();
	}

	/**
	 * Registration for custom fields.
	 */
	public static function register_custom_fields() {
		ACF\JournalFields::init();
		ACF\JournalTopicFields::init();
	}

	/**
	 * Registration for graphQL extensions 
	 */
	public static function extend_graphQL() {
		add_action('graphql_input_fields', function ($fields, $type_name, $config) {
			if ($type_name === 'UpdateJournalInput' || $type_name === 'CreateJournalInput' || $type_name === 'deleteJournalInput') {
				$fields = array_merge($fields, [
					'journal_entry_field_title' => ['type' => 'String']
				]);
			}
			return $fields;
		}, 20, 3);
		
		add_action( 'graphql_post_object_mutation_update_additional_data', function( $post_id, $input, $post_type_object, $mutation_name, $context, $info, $default_post_status, $intended_post_status ) {
			if ( isset( $input['journal_entry_field_title'] ) ) {
				update_field( 'journal_entry_field_title', $input['journal_entry_field_title'], $post_id );
			}
		}, 10, 8 );
		
	}


	/**
	 * Registration for block scripts and styles.
	 * Blocks themselves are registered in scripts.
	 */
	public static function register_blocks() {
		wp_enqueue_style(
			'QuickNotes-blockcss',
			QUICK_NOTES_URL . 'dist/css/blocks.css'
		);
		wp_enqueue_script(
			'QuickNotes-blockjs',
			QUICK_NOTES_URL . 'dist/js/blocks.js',
			array( 'wp-blocks', 'wp-i18n', 'wp-element', 'wp-editor', 'wp-components' ),
			null,
			true
		);
		wp_localize_script(
			'QuickNotes-blockjs',
			'QuickNotes',
			array(
				'pluginDirPath' => QUICK_NOTES_PATH,
				'pluginDirUrl'  => QUICK_NOTES_URL,
			)
		);
	}

	/**
	 * Registration for frontend plugin styles.
	 */
	public static function enqueue_frontend_styles() {
		wp_enqueue_style( 'QuickNotes-styles', QUICK_NOTES_URL . 'dist/css/frontend.css', rand(), false, 'all' );
	}

	/**
	 * Registration for backend styles.
	 */
	public static function enqueue_backend_styles() {
		wp_enqueue_style( 'QuickNotes-styles', QUICK_NOTES_URL . 'dist/css/backend.css', rand(), false, 'all' );
	}

	/**
	 * Registration for frontend scripts and script localization.
	 */
	public static function enqueue_frontend_scripts() {
		wp_enqueue_script( 'QuickNotes-scripts', QUICK_NOTES_URL . 'dist/js/frontend.js', 'jquery', rand(), true );
		$nonce = wp_create_nonce( 'ajax_nonce' );
		wp_localize_script(
			'QuickNotes-frontend-scripts',
			'QuickNotes',
			array(
				'ajaxurl' => admin_url( 'admin-ajax.php' ),
				'nonce'   => $nonce,
			)
		);
	}

	/**
	 * Registration for backend scripts.
	 */
	public static function enqueue_backend_scripts() {
		wp_enqueue_script( 'QuickNotes-scripts', QUICK_NOTES_URL . 'dist/js/backend.js', 'jquery', rand(), true );
		$nonce = wp_create_nonce( 'ajax_nonce' );
		wp_localize_script(
			'QuickNotes-backend-scripts',
			'QuickNotes',
			array(
				'ajaxurl' => admin_url( 'admin-ajax.php' ),
				'nonce'   => $nonce,
			)
		);
	}

	/**
	 * Echoes browsersync custom script tag.
	 */
	public static function add_browser_sync() {
		// echo '<script id="__bs_script__">//<![CDATA[
			// document.write("<script async src=' . 'http://HOST:62584/browser-sync/browser-sync-client.js?v=2.27.7' . '><\/script>".replace("HOST", location.hostname));
			// ]]></script>';
	}
}
