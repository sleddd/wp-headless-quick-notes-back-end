<?php namespace WpStarterPlugin\Cpts;

/**
 * Handles the construction of Example custom post type
 */
class ExamplePostType {

	const POST_TYPE_NAME	= 'Example';
	const POST_TYPE_TAX	= ['Genre'];

	public function __construct() {
		register_post_type( self::POST_TYPE_NAME );
		foreach( self::POST_TYPE_TAX as $genre ) {
			add_taxonomy( $genre, self::POST_TYPE_NAME );
		}
		$this->add_post_type_custom_fields();
	}

	public function add_post_type_custom_fields() {
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
			self::POST_TYPE_NAME
		);
	}
}
