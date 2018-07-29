<?php

function pll_e($str) {
    echo $str;
}

function pll_current_language() {
    return '';
}

/*
 * Allow svg
 */

function cc_mime_types($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}

add_filter('upload_mimes', 'cc_mime_types');
/**
 * Functions main file
 */
// Setup
if (!function_exists('theme_setup')) {

    function theme_setup() {
        // Add feed links
        add_theme_support('automatic-feed-links');
        // Add title tag
        add_theme_support('title-tag');
        // Post thumbs support
        add_theme_support('post-thumbnails');
    }

}
add_action('after_setup_theme', 'theme_setup');

/**
 * Register sidebar area
 */
function sidebar() {
    register_sidebar(array(
        'name' => 'Sidebar',
        'id' => 'sidebar',
        'description' => '',
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));
}

add_action('widgets_init', 'sidebar');

function init_front_assets() {
    //wp_deregister_script('jquery');
    wp_enqueue_script('jquery');
    wp_enqueue_style('app', '/assets/css/app.css', array(), filemtime(
                    get_template_directory() . '/assets/css/app.css'));
    wp_enqueue_script('app', '/assets/jsdist/app.js', array(), filemtime(
                    get_template_directory() . '/assets/jsdist/app.js'), true);
}

add_action('wp_enqueue_scripts', 'init_front_assets');

function adminJs() {
    echo '<script>';
    echo 'var site_url = "' . site_url('/') . '";';
    echo 'var ajax_url = "' . site_url('ajax') . '";';
    echo '</script>';
}

add_action('admin_head', 'adminJs');

/**
 * Template assets
 */
function asset($value) {
    return site_url() . "/assets/" . $value;
}

function _asset($value) {
    echo asset($value);
}

//remove api links from header: https://wordpress.stackexchange.com/questions/211467/remove-json-api-links-in-header-html
function remove_json_api() {
    // Remove the REST API lines from the HTML Header
    remove_action('wp_head', 'rest_output_link_wp_head', 10);
    remove_action('wp_head', 'wp_oembed_add_discovery_links', 10);
    // Remove the REST API endpoint.
    remove_action('rest_api_init', 'wp_oembed_register_route');
    // Turn off oEmbed auto discovery.
    add_filter('embed_oembed_discover', '__return_false');
    // Don't filter oEmbed results.
    remove_filter('oembed_dataparse', 'wp_filter_oembed_result', 10);
    // Remove oEmbed discovery links.
    remove_action('wp_head', 'wp_oembed_add_discovery_links');
    // Remove oEmbed-specific JavaScript from the front-end and back-end.
    remove_action('wp_head', 'wp_oembed_add_host_js');
    // Remove all embeds rewrite rules.
    //add_filter( 'rewrite_rules_array', 'disable_embeds_rewrites',10);
}

add_action('after_setup_theme', 'remove_json_api');

function disable_json_api() {
    // Filters for WP-API version 1.x
    add_filter('json_enabled', '__return_false');
    add_filter('json_jsonp_enabled', '__return_false');
    // Filters for WP-API version 2.x
    add_filter('rest_enabled', '__return_false');
    add_filter('rest_jsonp_enabled', '__return_false');
}

add_action('after_setup_theme', 'disable_json_api');

function remove_dns_prefetch($hints, $relation_type) {
    if ('dns-prefetch' === $relation_type) {
        return array_diff(wp_dependencies_unique_hosts(), $hints);
    }
    return $hints;
}

add_filter('wp_resource_hints', 'remove_dns_prefetch', 10, 2);
/**
 * Login session expire longer
 */
add_filter('auth_cookie_expiration', 'my_expiration_filter', 99, 3);

function my_expiration_filter($seconds, $user_id, $remember) {
    //if "remember me" is checked;
    if ($remember) {
        //WP defaults to 2 weeks;
        $expiration = 14 * 24 * 60 * 60; //UPDATE HERE;
    } else {
        //WP defaults to 48 hrs/2 days;
        $expiration = 2 * 24 * 60 * 60; //UPDATE HERE;
    }
    //http://en.wikipedia.org/wiki/Year_2038_problem
    if (PHP_INT_MAX - time() < $expiration) {
        //Fix to a little bit earlier!
        $expiration = PHP_INT_MAX - time() - 5;
    }
    return $expiration;
}

require 'libs/mail.php';