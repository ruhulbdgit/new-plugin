<?php

/*
 * Plugin Name:       New Plugin
 * Plugin URI:       #
 * Description:       Handle the basics with this plugin.
 * Version:           1.10.3
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Ruhul Siddiki
 * Author URI:       #
 * License:           GPL v2 or later
 * License URI:       #
 * Update URI:        #
 * Text Domain:       new-basics-plugin
 * Domain Path:       /languages
 * Requires Plugins:  #
 */

//define a constant for make a file connect
define("PLUGIN_DIR_PATH", plugin_dir_path(__FILE__));

//define a  constant for link with js + css
define("PLUGIN_DIR_URL", plugin_dir_url(__FILE__));



//Register a custom menu pagw with Dashicons 
function register_my_custom_menu_page()
{
    // add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );
    add_menu_page('New Plugin Title', 'New Plugin', 'manage_options', 'new_plugin', 'test_test_test', 'dashicons-welcome-widgets-menus', 90);
}
add_action('admin_menu', 'register_my_custom_menu_page');


function wpdocs_register_my_custom_submenu_page()
{
    add_submenu_page(
        'new_plugin',
        'New Plugin Submenu',
        'New Plugin Submenu',
        'manage_options',
        'new_plugin_submenu',
        'wpdocs_my_custom_submenu_page_callback'
    );
}

function test_test_test()
{
    include PLUGIN_DIR_PATH . '/views/submenu.php';
}
add_action('admin_menu', 'test_test_test');

function wpdocs_my_custom_submenu_page_callback()
{
    //echo '<div class="wrap"><div id="icon-tools" class="icon32"></div>';
    echo '<h2>My Plugin  Submenu Page</h2>';
    //echo '</div>';
}
add_action('admin_menu', 'wpdocs_register_my_custom_submenu_page');

//wp enque style
/**
 * Proper way to enqueue scripts and styles
 */
function load_plugin_scripts()
{
    wp_enqueue_style(
        'first-style',
        PLUGIN_DIR_URL . 'css/style.css',
        array(),
        '1.0.0'
    );
}
add_action('wp_enqueue_scripts', 'load_plugin_scripts');
