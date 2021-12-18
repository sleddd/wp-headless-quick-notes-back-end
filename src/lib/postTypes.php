<?php namespace WpStarterPlugin\PostTypes;

/**
 * Get formatted set of arguments for a post type name.
 *
 * @param   string $name   Name of post type.
 * @param   array  $args   Optional. Custom post type arguments.
 * @param   array  $labels Optional. Custom post type labels.
 * @return  array  Formatted post type arguments merged with defaults.
 */
function get_post_type_args( $name = '', $args = array(), $labels = array() ) {
	if ( empty( $name ) ) {
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


/**
 * Get formatted set of arguments for a taxonomy.
 *
 * @param   string $name   Name of taxonomy.
 * @param   array  $args   Optional. Custom taxonomy arguments.
 * @param   array  $labels Optional. Custom taxonomy labels.
 * @return  array  Formatted taxonomy arguments merged with defaults.
 */
function get_taxonomy_args( $name = '', $args = array(), $labels = array() ) {
	if ( empty( $name ) ) {
		return;
	}
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


/**
 * Registers a post type.
 *
 * @param   string $name   Name of post type.
 * @param   array  $args   Optional. Custom post type arguments.
 * @param   array  $labels Optional. Custom post type labels.
 * @return  void
 */
function register_post_type( $post_type_name = '', $args = array(), $labels = array() ) {
	if ( empty( $post_type_name ) ) {
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


/**
 * Adds a taxonomy to a post type.
 *
 * @param   string $taxonomy_name    Name of taxonomy.
 * @param   string $post_type_name   Name of post type.
 * @param   array  $args   Optional. Custom taxonomy arguments.
 * @param   array  $labels Optional. Custom taxonomy labels.
 * @return  void
 */
function add_taxonomy( $taxonomy_name = '', $post_type_name = '', $args = array(), $labels = array() ) {

	if ( empty( $post_type_name ) || empty( $taxonomy_name ) ) {
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


/**
 * Adds a meta box to a post type.
 *
 * @param   string $title     Title for meta box.
 * @param   array  $fields    Optional. Metabox fields properties.
 * @param   string $context   Optional. Where the metabox is displayed ( normal, side, advanced ).
 * @param   string $priority  Optional. Where in the context the metabox shows (high, core, default, low).
 * @param   string $post_type_name  Name of post type.
 * @return  void
 */
function add_meta_box( $title = '', $fields = array(), $context = 'normal', $priority = 'default', $post_type_name = '' ) {

	if ( empty( $title ) || empty( $post_type_name ) ) {
		return;
	}

	if ( ! empty( $title ) ) {

		$post_type_name = strtolower( str_replace( '_', ' ', $post_type_name ) );

		$box_id       = strtolower( str_replace( ' ', '_', $title ) );
		$box_title    = ucwords( str_replace( '_', ' ', $title ) );
		$box_context  = $context;
		$box_priority = $priority;

		global $custom_fields;
		$custom_fields[ $title ] = $fields;

		add_action(
			'admin_init',
			function() use ( $box_id, $box_title, $post_type_name, $box_context, $box_priority, $fields ) {
				\add_meta_box(
					$box_id,
					$box_title,
					function ( $post, $data ) {
						 global $post;

						// Nonce field for some validation
						wp_nonce_field( plugin_basename( __FILE__ ), 'custom_post_type' );

						// Get all inputs from $data
						$custom_fields = $data['args'][0];

						// Get the saved values
						$meta = get_post_custom( $post->ID );

						// Check the array and loop through it
						if ( ! empty( $custom_fields ) ) {
							echo '<div class="wp_starter_plugin_custom_meta">';
							/* Loop through $custom_fields */
							foreach ( $custom_fields as $label => $field ) {
								$field_id_name = strtolower( str_replace( ' ', '_', $data['id'] ) ) . '_' . strtolower( str_replace( ' ', '_', $label ) );
								switch ( $field['type'] ) {
									case 'text':
										echo '<label for="' . $field_id_name . '">' . $label . '</label><input type="text" name="' . $field_id_name . '" id="' . $field_id_name . '" value="' . $meta[ $field_id_name ][0] . '" />';
										if ( array_key_exists( 'desc', $field ) ) {
											echo '<span class="description">' . $field['desc'] . '</span>';
										}
										break;
									case 'textarea':
										echo '<label for="' . $field_id_name . '">' . $label . '</label><textarea name="' . $field_id_name . '" id="' . $field_id_name . '">' . $meta[ $field_id_name ][0] . '</textarea>';
										if ( array_key_exists( 'desc', $field ) ) {
											echo '<span class="description">' . $field['desc'] . '</span>';
										}
										break;
									case 'checkbox':
										echo '<label for="' . $field_id_name . '">' . $label . '</label>';
										if ( array_key_exists( 'options', $field ) ) {
											$options_count = 0;
											$saved_options = maybe_unserialize( $meta[ $field_id_name ][0] );
											echo '<div class="fieldset">';
											foreach ( $field['options'] as $label => $value ) {
												$checked = $saved_options[ $options_count ] === $value ? 'checked="checked"' : '';
												echo '<label for="' . $field_id_name . '">' . $label . '</label><input type="checkbox" name="' . $field_id_name . '[' . $options_count . ']" id="' . $field_id_name . '" value="' . $value . '"' . $checked . '/>';
												$options_count++;
											}
											echo '</div>';
										}
										if ( array_key_exists( 'desc', $field ) ) {
											echo '<span class="description">' . $field['desc'] . '</span>';
										}
										break;
									case 'radio':
										echo '<label for="' . $field_id_name . '">' . $label . '</label>';
										echo '<div class="fieldset">';
										foreach ( $field['options'] as $label => $value ) {
											$checked = $meta[ $field_id_name ][0] === $value ? 'checked="checked"' : '';
											echo '<label for="' . $field_id_name . '">' . $label . '</label><input type="radio" name="' . $field_id_name . '" id="' . $field_id_name . '" value="' . $value . '"' . $checked . '/>';
										}
										echo '</div>';
										if ( array_key_exists( 'desc', $field ) ) {
											echo '<span class="description">' . $field['desc'] . '</span>';
										}
										break;
									case 'select':
										echo '<label for="' . $field_id_name . '">' . $label . '</label>';
										echo '<select name="' . $field_id_name . '" id="' . $field_id_name . '">';
										foreach ( $field['options'] as $label => $value ) {
											echo '<option', $meta[ $field_id_name ][0] == $value ? ' selected="selected"' : '', ' value="' . $value . '">' . $label . '</option>';
										}
										echo '</select>';
										if ( array_key_exists( 'desc', $field ) ) {
											echo '<span class="description">' . $field['desc'] . '</span>';
										}
										break;
								}
							}
							echo '</div>';
						}
					},
					$post_type_name,
					$box_context,
					$box_priority,
					array( $fields )
				);
			}
		);

		// Save post fields
		add_action(
			'save_post',
			function() use ( $post_type_name ) {
				 // Deny the WordPress autosave function
				if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
					return;
				}

				if ( ! wp_verify_nonce( $_POST['custom_post_type'], plugin_basename( __FILE__ ) ) ) {
					return;
				}

				 global $post;

				if ( isset( $_POST ) && isset( $post->ID ) && get_post_type( $post->ID ) == $post_type_name ) {
					global $custom_fields;

					// Loop through each meta box
					foreach ( $custom_fields as $title => $fields ) {
						// Loop through all fields
						foreach ( $fields as $label => $type ) {
							$field_id_name = strtolower( str_replace( ' ', '_', $title ) ) . '_' . strtolower( str_replace( ' ', '_', $label ) );
							$old           = get_post_meta( $post_id, $field_id_name, true );
							$new           = $_POST[ $field_id_name ];
							if ( '' == $new && $old ) {
								delete_post_meta( $post_id, $field_id_name, $_POST[ $field_id_name ] );
							} else {
								update_post_meta( $post->ID, $field_id_name, $_POST[ $field_id_name ] );
							}
						}
					}
				}
			}
		);

	}

}
