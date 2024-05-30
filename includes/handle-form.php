<?php
if (!defined('ABSPATH')) {
    exit;
}

function cv_maker_handle_form_submission() {
    if (!isset($_POST['cv_maker_nonce_field']) || !wp_verify_nonce($_POST['cv_maker_nonce_field'], 'cv_maker_nonce')) {
        wp_die('Security check failed.');
    }

    $first_name = sanitize_text_field($_POST['first_name']);
    $last_name = sanitize_text_field($_POST['last_name']);
    $location = sanitize_text_field($_POST['location']);
    $age = intval($_POST['age']);
    $gender = sanitize_text_field($_POST['gender']);
    $email = sanitize_email($_POST['email']);
    $phone = sanitize_text_field($_POST['phone']);
    $summary = sanitize_textarea_field($_POST['summary']);

    // Add your existing PDF generation code here

    // Redirect back to the form page with a success message
    wp_redirect(add_query_arg('cv_maker_success', '1', wp_get_referer()));
    exit;
}
add_action('admin_post_cv_maker_form', 'cv_maker_handle_form_submission');
add_action('admin_post_nopriv_cv_maker_form', 'cv_maker_handle_form_submission');
