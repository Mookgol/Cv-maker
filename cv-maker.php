<?php
/*
Plugin Name: CV Maker
Description: A plugin to generate CVs and download them as PDFs.
Version: 1.0
Author: Chuma Mqeke
*/

// Prevent direct access
// if (!defined('ABSPATH')) {
//     exit;
// }

// Define constants
define('CV_MAKER_PATH', plugin_dir_path(__FILE__));
define('CV_MAKER_URL', plugin_dir_url(__FILE__));

// Include necessary files
require_once CV_MAKER_PATH . 'includes/handle-form.php';

// Enqueue scripts and styles
function cv_maker_enqueue_scripts() {
    wp_enqueue_style('cv-maker-style', CV_MAKER_URL . './style.css');
    wp_enqueue_script('cv-maker-script', CV_MAKER_URL . './app.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'cv_maker_enqueue_scripts');

// Create a shortcode to display the form
function cv_maker_form_shortcode() {
    ob_start();
    include CV_MAKER_PATH . './index.php';
    return ob_get_clean();
}
add_shortcode('cv_maker_form', 'cv_maker_form_shortcode');
?>
