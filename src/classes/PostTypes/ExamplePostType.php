<?php namespace WpStarterPlugin\PostTypes;

/**
 * Example custom post type.
 * 
 * Provides example of how to add a custom post type.
 * Uses /src/lib/postTypes.php functions.
 */
class ExamplePostType {

	public static $instance = null;

	/** 
	 * Declares post type and taxonomy names.
	 */ 
	const POST_TYPE_NAME = 'Example';
	const POST_TYPE_TAX  = array( 'Genre', 'Topic' );

	private function __construct() {}

	/**
	 * Registers custom post type.
	 */
	public static function init() {
		register_post_type( ExamplePostType::POST_TYPE_NAME );
		foreach ( ExamplePostType::POST_TYPE_TAX as $genre ) {
			add_taxonomy( $genre, ExamplePostType::POST_TYPE_NAME );
		}
		ExamplePostType::add_post_type_custom_fields();
	}

	/**
	 * Adds custom metabox for post type.
	 */
	public static function add_post_type_custom_fields() {
		add_meta_box(
			'Example - Book Information',
			array(
				'Title'        => array(
					'type' => 'text',
					'desc' => 'Add a book title.',
				),
				'Author'       => array( 'type' => 'text' ),
				'Year written' => array( 'type' => 'text' ),
				'Synopsis'     => array( 'type' => 'textarea' ),
				'Stock'        => array(
					'type'    => 'checkbox',
					'options' => array(
						'In Stock'  => 'in',
						'Backorder' => 'backorder',
					),
				),
				'Condition'    => array(
					'type'    => 'select',
					'options' => array(
						'New'  => 'new',
						'Used' => 'used',
					),
				),
				'Format'       => array(
					'type'    => 'radio',
					'options' => array(
						'Hardback'  => 'hardback',
						'Paperback' => 'paperback',
					),
				),
			),
			'normal',
			'default',
			ExamplePostType::POST_TYPE_NAME
		);
	}
}
