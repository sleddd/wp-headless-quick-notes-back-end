<?php 

namespace QuickNotes\Settings;

/**
 * Example for settings menu page using Advanced Custom Fields.
 */
class ExampleACFSettingsPage {
	
	/**
	 * Declares setting page title, menu title, and slug.
	 */
	const PAGE_TITLE = 'Theme General Settings';
	const MENU_TITLE = 'Theme Settings';
	const MENU_SLUG  = 'theme-general-settings';

	private function __construct() {}

	/* 
	* Registers acf options page.
	*/
	public static function init() {
		if( function_exists('acf_add_options_page') ) {
			acf_add_options_page(array(
			'page_title' 	=> ExampleACFSettingsPage::PAGE_TITLE,
			'menu_title'	=> ExampleACFSettingsPage::MENU_TITLE,
			'menu_slug' 	=> ExampleACFSettingsPage::MENU_SLUG,
			'capability'	=> 'edit_posts',
			'redirect'	=> false
			));
		
			acf_add_options_sub_page(array(
				'page_title' 	=> 'Theme Header Settings',
				'menu_title'	=> 'Header',
				'parent_slug'	=> ExampleACFSettingsPage::MENU_SLUG,
			));
		
			acf_add_options_sub_page(array(
				'page_title' 	=> 'Theme Footer Settings',
				'menu_title'	=> 'Footer',
				'parent_slug'	=> ExampleACFSettingsPage::MENU_SLUG,
			));

			ExampleACFSettingsPage::add_fields();
		}
	}

	/**
	 * Registers/declares menu page ACF fields by local field group.
	 */
	public static function add_fields() {
		if( function_exists( 'acf_add_local_field_group') ):
			acf_add_local_field_group(array(
				'key' => 'group_acf_theme_settings_test',
				'title' => 'test',
				'fields' => array(
					array(
						'key' => 'field_test_text_acf',
						'label' => 'test',
						'name' => 'test_text_field_acf',
						'type' => 'text',
						'conditional_logic' => 0,
					),
				),
				'location' => array(
					array(
						array(
							'param' => 'options_page',
							'operator' => '==',
							'value' => 'theme-general-settings',
						),
					),
				),
			));
		endif;	
	}

}
