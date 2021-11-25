<?php namespace WpStarterPlugin\Cpts;

// Takes in post type name, args, and labels returning formatted args for 
// registering a post type.
function get_post_type_args( $name = false, $args = array(), $labels = array() ) {
	if ( ! $name ) {
		return;
	}
	$name   = ucwords( str_replace( '_', ' ', $name ) );
	$plural = $name . 's';

	$labels = array_merge(
		array(
			'name'               => _x( $plural, 'post type general name' ),
			'singular_name'      => _x( $name, 'post type singular name' ),
			'add_new'            => _x( 'Add New', strtolower( $name ) ),
			'add_new_item'       => __( 'Add New ' . $name ),
			'edit_item'          => __( 'Edit ' . $name ),
			'new_item'           => __( 'New ' . $name ),
			'all_items'          => __( 'All ' . $plural ),
			'view_item'          => __( 'View ' . $name ),
			'search_items'       => __( 'Search ' . $plural ),
			'not_found'          => __( 'No ' . strtolower( $plural ) . ' found' ),
			'not_found_in_trash' => __( 'No ' . strtolower( $plural ) . ' found in Trash' ),
			'parent_item_colon'  => '',
			'menu_name'          => $plural,
		),
		$labels
	);

	$args = array_merge(
		array(
			'label'             => $plural,
			'labels'            => $labels,
			'public'            => true,
			'show_ui'           => true,
			'supports'          => array( 'title', 'editor' ),
			'show_in_nav_menus' => true,
			'_builtin'          => false,
		),
		$args
	);

	return $args;

}

// Takes in taxonomy name, args, and labels returning formatted args for 
// registering a custom taxonomy.
function get_taxonomy_args( $name, $args = array(), $labels = array() ) {
	$name   = ucwords( str_replace( '_', ' ', $name ) );
	$plural = $name . 's';

	$labels = array_merge(
		array(
			'name'              => _x( $plural, 'taxonomy general name' ),
			'singular_name'     => _x( $name, 'taxonomy singular name' ),
			'search_items'      => __( 'Search ' . $plural ),
			'all_items'         => __( 'All ' . $plural ),
			'parent_item'       => __( 'Parent ' . $name ),
			'parent_item_colon' => __( 'Parent ' . $name . ':' ),
			'edit_item'         => __( 'Edit ' . $name ),
			'update_item'       => __( 'Update ' . $name ),
			'add_new_item'      => __( 'Add New ' . $name ),
			'new_item_name'     => __( 'New ' . $name . ' Name' ),
			'menu_name'         => __( $name ),
		),
		$labels
	);

	$args = array_merge(

		array(
			'label'             => $plural,
			'labels'            => $labels,
			'public'            => true,
			'show_ui'           => true,
			'show_in_nav_menus' => true,
			'_builtin'          => false,
		),
		$args
	);

	return $args;

}

// Takes in custom post type name, args, and labels and registers a post type.
function register_post_type( $post_type_name = false, $args = array(), $labels = array() ) {
	if ( ! $post_type_name ) {
		// Must have a post type name.
		return;
	}
	$args = get_post_type_args( $post_type_name, $args, $labels );

	add_action(
		'init',
		function() use ( $post_type_name, $args ) {
			\register_post_type( $post_type_name, $args );
		}
	);
}

/// Takes in custom taxonomy type name, args, labels, and post type name, then registers the taxonomy.
function add_taxonomy( $taxonomy_name = false, $post_type_name = false, $args = array(), $labels = array() ) {

	if ( ! $post_type_name || ! $taxonomy_name ) {
		// Must have a post type and taxonomy name.
		return;
	}

	$post_type_name = strtolower( str_replace( '_', ' ', $post_type_name ) );

	$args = get_taxonomy_args( $taxonomy_name, $args, $labels );

	if ( ! taxonomy_exists( $taxonomy_name ) ) {
		// Add the taxonomy to the post type.
		add_action(
			'init',
			function() use ( $taxonomy_name, $post_type_name, $args ) {
				 \register_taxonomy( $taxonomy_name, $post_type_name, $args );
			}
		);
	} else {
		// The taxonomy already exists, attach existing taxonomy to post type.
		add_action(
			'init',
			function() use ( $taxonomy_name, $post_type_name ) {
				\register_taxonomy_for_object_type( $taxonomy_name, $post_type_name );
			}
		);
	}
}
