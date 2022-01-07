<?php namespace QuickNotes\ACF;

class JournalTopicFields {

    private function __construct() {}

    public static function init() {
        if ( function_exists( 'acf_add_local_field_group') ) {
        acf_add_local_field_group(array(
            'key' => 'group_journal_topic',
            'title' => 'Journal Topic Options',
            'fields' => array(
                array(
                    'key'   => 'field_journal_topic_icon',
                    'label' => __('Topic Icon', 'QuickNotes'),
                    'name'  => 'journal_topic_field_icon',
                    'type'  => 'text',
                    'show_in_graphql' => 1,
                ),
                array(
                    'key'   => 'field_journal_topic_color',
                    'label' => __('Topic Color', 'QuickNotes'),
                    'name'  => 'journal_topic_field_color',
                    'type'  => 'color_picker',
                    'show_in_graphql' => 1,
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'taxonomy',
                        'operator' => '==',
                        'value' => \QuickNotes\PostTypes\Journal::POST_TYPE_TAX[0],
                    ),
                ),
            ),
            'show_in_graphql' => 1,
            'graphql_field_name' => 'customFields',
            'map_graphql_types_from_location_rules' => 1,
            'graphql_types' => array(
                0 => 'Topic',
            ),
        ));
    }}
}