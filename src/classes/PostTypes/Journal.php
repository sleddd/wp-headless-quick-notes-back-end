<?php namespace WpStarterPlugin\PostTypes;

/**
 * Example custom post type.
 * 
 * Provides example of how to add a custom post type.
 * Uses /src/lib/postTypes.php functions.
 */
class Journal {

	public static $instance = null;

	/** 
	 * Declares post type and taxonomy names.
	 */ 
	const POST_TYPE_NAME = 'journal';
	const POST_TYPE_TAX  = array( 'topic');

	private function __construct() {}

	/**
	 * Registers custom post type.
	 */
	public static function init() {
		// Adding post type.
		register_post_type( Journal::POST_TYPE_NAME,  array(
			'show_in_graphql' => true,  'hierarchical' => true,
			'graphql_single_name' => Journal::POST_TYPE_NAME,
			'graphql_plural_name' => Journal::POST_TYPE_NAME . 's'
		) );
		// Add post type taxonomies.
		foreach ( Journal::POST_TYPE_TAX as $genre ) {
			add_taxonomy( $genre, Journal::POST_TYPE_NAME, array( 
				'show_in_graphql' => true,
				'graphql_single_name' => $genre,
				'graphql_plural_name' => $genre . 's',
			) );
		}
		// Removing editor support.
		add_filter( 'init', function(){
			remove_post_type_support( Journal::POST_TYPE_NAME, 'editor' );
		}, 99);
	}
}
