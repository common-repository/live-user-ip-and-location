<?php

if (!defined('ABSPATH')) {
    exit;
}

// Add plugin settings page to main nav bar
function luipl_add_plugin_settings_page()
{
    add_menu_page(
        'Live IP and Location Plugin Settings', // page title
        'IP Location', // menu title
        'manage_options', // capability
        'luipl-location-settings', // menu slug
        'luipl_render_plugin_settings_page', // callback function
        'dashicons-location', // location icon
        20 // position in menu
    );
}
add_action('admin_menu', 'luipl_add_plugin_settings_page');

// Render plugin settings page
function luipl_render_plugin_settings_page()
{
    $luipl_step_1 = plugins_url('/assets/images/step-1.webp', dirname(__FILE__));
    ?>

    <div class="wrap" style="background: white; padding: 40px; border-radius: 5px;">
        <h2>Live IP and Location Plugin Settings</h2>
        <h3><b>Step 1:</b> Get Your Free API Key from here <a href="https://ipapi.co/free/" target="_blank">IPAPI</a> and
            then click on <i>message us</i>.</h3>
        <img src="<?php echo esc_url($luipl_step_1); ?>" alt="Step 1" width="800" height="240"
            style="border: 2px solid #e6e6e6;">
        <h3><b>Step 2:</b> Fill the form and IPAPI will send you free API Key on your given email.</h3>
        <h3><b>Step 3:</b> Enter received API Key in the API Key field given below and save changes. That's it!</h3>
        <div style="width: 765px; margin-top: 20px; padding: 20px; border: 2px solid #e6e6e6">
            <form method="post" action="options.php">
                <?php
                settings_fields('luipl_location_settings_group');
                do_settings_sections('luipl-location-settings');
                ?>
                <input type="submit" class="button-primary" value="Save Changes">
            </form>
        </div>
        <h2>How to use Shortcodes?</h2>
        <p><b>Use the provided shortcodes according to your needs to display the user's IP and location on any post or
                page.</b>
        <ul>
            <?php
            $luipl_shortcodes = [
                'luipl_ip' => 'Displays the user\'s IP address.',
                'luipl_network' => 'Displays the user\'s network information.',
                'luipl_version' => 'Displays the IP version (IPv4 or IPv6).',
                'luipl_city' => 'Displays the user\'s city.',
                'luipl_region' => 'Displays the user\'s region.',
                'luipl_region_code' => 'Displays the user\'s region code.',
                'luipl_country' => 'Displays the user\'s country.',
                'luipl_country_name' => 'Displays the user\'s country name.',
                'luipl_country_code' => 'Displays the user\'s country code (ISO 3166-1 alpha-2).',
                'luipl_country_code_iso3' => 'Displays the user\'s country code (ISO 3166-1 alpha-3).',
                'luipl_country_capital' => 'Displays the capital city of the user\'s country.',
                'luipl_country_tld' => 'Displays the top-level domain of the user\'s country.',
                'luipl_continent_code' => 'Displays the code of the continent the user is located in.',
                'luipl_in_eu' => 'Indicates whether the user is in the European Union (true/false).',
                'luipl_postal' => 'Displays the user\'s postal code.',
                'luipl_latitude' => 'Displays the user\'s latitude.',
                'luipl_longitude' => 'Displays the user\'s longitude.',
                'luipl_timezone' => 'Displays the user\'s time zone.',
                'luipl_utc_offset' => 'Displays the user\'s UTC offset.',
                'luipl_country_calling_code' => 'Displays the calling code of the user\'s country.',
                'luipl_currency' => 'Displays the currency code of the user\'s country.',
                'luipl_currency_name' => 'Displays the name of the currency used in the user\'s country.',
                'luipl_languages' => 'Displays the languages spoken in the user\'s country.',
                'luipl_country_area' => 'Displays the area of the user\'s country in square kilometers.',
                'luipl_country_population' => 'Displays the population of the user\'s country.',
                'luipl_asn' => 'Displays the Autonomous System Number associated with the user\'s IP address.',
                'luipl_org' => 'Displays the organization associated with the user\'s IP address.',
                'luipl_all_fields' => 'Displays all available information fields about the user.',
            ];

            foreach ($luipl_shortcodes as $luipl_shortcode => $description) {
                echo '<li><strong>[' . esc_html($luipl_shortcode) . ']</strong> - ' . esc_html($description) . '</li>';
            }
            ?>
        </ul>
        </p>
    </div>
    <?php
}

// Register settings and fields
function luipl_register_plugin_settings()
{
    register_setting('luipl_location_settings_group', 'luipl_location_api_key', 'sanitize_text_field');
    add_settings_section('luipl_location_settings_section', '', '', 'luipl-location-settings');
    add_settings_field('luipl_location_api_key', 'API Key', 'luipl_render_api_key_field', 'luipl-location-settings', 'luipl_location_settings_section');
}
add_action('admin_init', 'luipl_register_plugin_settings');

// Render API key field
function luipl_render_api_key_field()
{
    $luipl_api_key = get_option('luipl_location_api_key');
    echo '<input type="text" style="width: 400px !important;" name="luipl_location_api_key" value="' . esc_attr($luipl_api_key) . '" />';
}
?>