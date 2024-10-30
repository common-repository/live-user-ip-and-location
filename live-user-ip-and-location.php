<?php
/*
Plugin Name: Live User IP and Location
Description: Get live user IP and Location information of the user to display everywhere in the website where you want.
Version: 1.0
Author: obedullah
Author URI: https://profiles.wordpress.org/obedullah/
License: GPL v3 or later
License URI: https://www.gnu.org/licenses/gpl-3.0.html
*/

if (!defined('ABSPATH')) {
    exit;
}

// Include shortcode registration file
require_once plugin_dir_path(__FILE__) . 'includes/shortcode-registration.php';

// Include API interaction file
require_once plugin_dir_path(__FILE__) . 'includes/api-interaction.php';

// Include the settings page file
require_once plugin_dir_path(__FILE__) . 'includes/settings-page.php';

// Add link next to Deactivate button on plugin page
function luipl_add_plugin_settings_link($links)
{
    $settings_link = '<a href="admin.php?page=luipl-location-settings">Settings</a>';
    array_unshift($links, $settings_link);
    return $links;
}
add_filter('plugin_action_links_' . plugin_basename(__FILE__), 'luipl_add_plugin_settings_link');
?>