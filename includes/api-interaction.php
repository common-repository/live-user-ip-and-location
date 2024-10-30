<?php

if (!defined('ABSPATH')) {
    exit;
}

// Define your API key
$luipl_api_key = sanitize_text_field(get_option('luipl_location_api_key'));

/**
 * Get user location information.
 *
 * @return array|false The user location data or false on failure.
 */
function luipl_get_user_location()
{
    // Get user IP address
    $luipl_user_ip = sanitize_text_field($_SERVER['REMOTE_ADDR']);

    // Get the global API key
    global $luipl_api_key;

    // Validate the API key and user IP
    if (empty($luipl_api_key) || !filter_var($luipl_user_ip, FILTER_VALIDATE_IP)) {
        return false;
    }

    // Make API request to IP with API key
    $luipl_api_url = esc_url_raw('https://ipapi.co/' . $luipl_user_ip . '/json/?key=' . $luipl_api_key);
    $response = wp_remote_get($luipl_api_url);

    // Check for error
    if (is_wp_error($response)) {
        return false;
    }

    // Get the body of the response
    $body = wp_remote_retrieve_body($response);

    // Check if the body is a valid JSON
    $data = json_decode($body, true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        return false;
    }

    // Escape and return the entire API response
    return array_map('esc_html', $data);
}
?>