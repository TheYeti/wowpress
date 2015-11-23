<?php
/*
Plugin Name: WowPress
Plugin URI: http://theyeticave.net
Description: Adds WordPress shortcode and href links to World of Warcraft items from Wowhead
Author: Matt 'The Yeti' Burnett
Author URI: http://www.yeticavestudio.com
Version: 1.0.0
*/

function wowpress_header() {
    wp_enqueue_script('power', '//static.wowhead.com/widgets/power.js');
    wp_enqueue_script('wowpress', plugins_url('wowpress.js', __FILE__));
}

function wowpress_shortcode($atts) {
    $a = shortcode_atts( array(
        'id' => '19019',
        'extra' => '',
    ), $atts);
    if (isset($a['extra']))
        return '<a class="wowpress" href="http://www.wowhead.com/item=' . $a['id'] . '" rel="' . $a['extra'] . '" style="text-decoration: none;">item</a>';
    return '<a class="wowpress" href="http://www.wowhead.com/item=' . $a['id'] . '" style="text-decoration: none;">item</a>';
}

function wowpress_add_stylesheet() {
    wp_register_style('wowpress-style', plugins_url('style.css', __FILE__));
    wp_enqueue_style('wowpress-style');
}

add_action('wp_head', 'wowpress_header');
add_action('wp_enqueue_scripts', 'wowpress_add_stylesheet');
add_action('wp_enqueue_scripts', 'wowpress_header');
add_shortcode('wowpress', 'wowpress_shortcode');