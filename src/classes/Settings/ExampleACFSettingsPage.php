<?php 

namespace WpStarterPlugin\Settings;

class ExampleACFSettingsPage {

	const PAGE_TITLE = 'Theme General Settings';
	const MENU_TITLE = 'Theme Settings';
	const MENU_SLUG  = 'theme-general-settings';

	public function __construct() {
		if( function_exists('acf_add_options_page') ) {
			acf_add_options_page(array(
			'page_title' 	=> self::PAGE_TITLE,
			'menu_title'	=> self::MENU_TITLE,
			'menu_slug' 	=> self::MENU_SLUG,
			'capability'	=> 'edit_posts',
			'redirect'	=> false
			));
		
			acf_add_options_sub_page(array(
				'page_title' 	=> 'Theme Header Settings',
				'menu_title'	=> 'Header',
				'parent_slug'	=> self::MENU_SLUG,
			));
		
			acf_add_options_sub_page(array(
				'page_title' 	=> 'Theme Footer Settings',
				'menu_title'	=> 'Footer',
				'parent_slug'	=> self::MENU_SLUG,
			));

			$this->add_fields();
		}
	}

	public function add_fields() {
		if( function_exists('acf_add_local_field_group') ):
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
