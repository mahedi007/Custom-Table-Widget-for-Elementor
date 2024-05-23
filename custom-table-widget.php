<?php
/**
 * Plugin Name: Custom Table Widget for Elementor
 * Description: A custom Elementor widget to create tables.
 * Version: 1.0.0
 * Author: Mahedi Hasan
 */

if (!defined('ABSPATH')) exit;

function custom_table_widget_includes() {
    require_once(__DIR__ . '/includes/widgets/table-widget.php');
}
add_action('elementor/widgets/widgets_registered', 'custom_table_widget_includes');

function custom_table_widget_enqueue_scripts() {
    wp_enqueue_script('custom-table-widget-js', plugins_url('/assets/js/table-widget.js', __FILE__), ['jquery'], false, true);
    wp_enqueue_style('custom-table-widget-css', plugins_url('/assets/css/table-widget.css', __FILE__));
}
add_action('wp_enqueue_scripts', 'custom_table_widget_enqueue_scripts');
