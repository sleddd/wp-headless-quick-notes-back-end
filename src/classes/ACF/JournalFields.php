<?php namespace WpStarterPlugin\ACF;

class JournalFields {

    private function __construct() {}

    public static function init() {
        if ( function_exists( 'acf_add_local_field_group') ) {
        acf_add_local_field_group(array(
            'key' => 'group_journal_entry',
            'title' => 'Journal Entry',
            'fields' => array(
                array(
                    'key'   => 'field_journal_entry_title',
                    'label' => __('Entry Title', 'wpstarterplugin'),
                    'name'  => 'journal_entry_field_title',
                    'type'  => 'text',
                    'show_in_graphql' => 1,
                ),
                array(
                    'key'   => 'field_journal_entry_image',
                    'label' => __('Entry Image', 'wpstarterplugin'),
                    'name'  => 'journal_entry_field_image',
                    'type'  => 'image',
                    'return_format' => 'Return Format',
                    'preview_size' => 'thumbnail',
                    'allowed_file_types' => array('jpg','png','gif'),
                    'show_in_graphql' => 1,
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => \WpStarterPlugin\PostTypes\Journal::POST_TYPE_NAME,
                    ),
                ),
            ),
            'show_in_graphql' => 1,
            'graphql_field_name' => 'customFields',
            'map_graphql_types_from_location_rules' => 1,
            'graphql_types' => array(
                0 => 'Journal',
            ),
        ));
    }}
}