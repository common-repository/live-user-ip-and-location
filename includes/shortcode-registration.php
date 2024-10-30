<?php

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Register shortcodes for individual fields and all fields.
 */
function luipl_register_field_shortcodes()
{
    // Define the fields and their corresponding shortcodes
    $fields = array(
        'ip' => 'luipl_ip',
        'network' => 'luipl_network',
        'version' => 'luipl_version',
        'city' => 'luipl_city',
        'region' => 'luipl_region',
        'region_code' => 'luipl_region_code',
        'country' => 'luipl_country',
        'country_name' => 'luipl_country_name',
        'country_code' => 'luipl_country_code',
        'country_code_iso3' => 'luipl_country_code_iso3',
        'country_capital' => 'luipl_country_capital',
        'country_tld' => 'luipl_country_tld',
        'continent_code' => 'luipl_continent_code',
        'in_eu' => 'luipl_in_eu',
        'postal' => 'luipl_postal',
        'latitude' => 'luipl_latitude',
        'longitude' => 'luipl_longitude',
        'timezone' => 'luipl_timezone',
        'utc_offset' => 'luipl_utc_offset',
        'country_calling_code' => 'luipl_country_calling_code',
        'currency' => 'luipl_currency',
        'currency_name' => 'luipl_currency_name',
        'languages' => 'luipl_languages',
        'country_area' => 'luipl_country_area',
        'country_population' => 'luipl_country_population',
        'asn' => 'luipl_asn',
        'org' => 'luipl_org'
    );

    // Register individual field shortcodes
    foreach ($fields as $field => $shortcode) {
        add_shortcode($shortcode, function () use ($field) {
            $data = luipl_get_user_location();
            return isset($data[$field]) ? esc_html($data[$field]) : '';
        });
    }

    // Register shortcode to display all fields
    add_shortcode('luipl_all_fields', function () {
        $data = luipl_get_user_location();
        if (!$data) {
            return '';
        }

        $output = '<table border="1">';
        foreach ($data as $key => $value) {
            $output .= '<tr>';
            $output .= '<td><strong>' . esc_html($key) . '</strong></td>';
            $output .= '<td>' . esc_html($value) . '</td>';
            $output .= '</tr>';
        }
        $output .= '</table>';
        return $output;
    });
}
add_action('init', 'luipl_register_field_shortcodes');
?>