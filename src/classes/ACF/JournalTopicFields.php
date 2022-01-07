<?php namespace WpStarterPlugin\ACF;

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
                    'label' => __('Topic Icon', 'wpstarterplugin'),
                    'name'  => 'journal_topic_field_icon',
                    'type'  => 'text',
                ),
                array(
                    'key'   => 'field_journal_topic_color',
                    'label' => __('Topic Color', 'wpstarterplugin'),
                    'name'  => 'journal_topic_field_color',
                    'type'  => 'color_picker',
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'taxonomy',
                        'operator' => '==',
                        'value' => \WpStarterPlugin\PostTypes\Journal::POST_TYPE_TAX[0],
                    ),
                ),
            ),
        ));
    }}
}