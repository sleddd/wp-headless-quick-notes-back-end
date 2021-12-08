<?php namespace WpStarterPlugin\Settings;

/* Custom Settings Page Example
 * This is a custom settings page not using ACF.
 * Allows you to build from scratch, customize, and extend as needed.
 * */

class ExampleSettingsPage extends SettingsPage {

	public static $SETTINGS_PAGE = array(
		'menu_title' 	=> 'Main Page',
		'page_title' 	=> 'Page Title',
		'slug'  	=> 'theme_options',
		'capability' 	=> 'administrator',
		'template'   	=> 'wrapper',
	);

	public static $SETTINGS_SECTIONS = array(
		array(
			'title'       => 'Section One Example',
			'id'	      => 'tab_1',
			'description' => 'Section one description',
			'template'    => 'section',
		),
		array(
			'title'       => 'Section Two Example',
			'id'	      => 'tab_2',
			'description' => 'Section two description.',
			'template'    => 'section',
		),
	);

	public static $SETTINGS_TABS = array(
		array(
			'title'   => 'Tab 1',
			'slug'    => 'tab_1',
		),
		array(
			'title'   => 'Tab 2',
			'slug'    => 'tab_2',
		),
	);

	public static $SETTINGS_FIELDS = array(
		'option_textfield_test_tab1' => array(
			'type'        => 'text',
			'label'       => 'Text Field Test Tab 1',
			'description' => 'Text field description.',
			'section'     => 'tab_1',
		),
		'option_radio_test_tab1'     => array(
			'type'        => 'radio',
			'label'       => 'Radio Test',
			'description' => 'Radio test description.',
			'options'     => array(
				'radio_option_1' => array(
					'label' => 'Option 1',
					'value' => '1',
				),
				'radio_option_2' => array(
					'label' => 'Option 2',
					'value' => '2',
				),
			),
			'section'     => 'tab_1',
		),
		'option_textfield_test_tab2' => array(
			'type'        => 'text',
			'label'       => 'Text Field Test Tab 2',
			'description' => 'Text field description.',
			'section'     => 'tab_2',
		),
		'option_select_test_tab2'    => array(
			'type'        => 'select',
			'label'       => 'Select Test',
			'description' => 'Select test description.',
			'options'     => array(
				'select_option_1' => array(
					'label' => 'Option 1',
					'value' => '1',
				),
				'select_option_2' => array(
					'label' => 'Option 2',
					'value' => '2',
				),
			),
			'section'     => 'tab_2',
		),
	);

	public function __construct() {
		$this->add_page( self::$SETTINGS_PAGE );
		add_action( 'admin_init', array( $this, 'add_sections' ) );
		add_action( 'admin_init', array( $this, 'add_fields' ) );
	}
}
