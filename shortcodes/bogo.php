<?php
// shortcodes/bogo.php
// [bogo_original]
function get_bogo_original()
{
    if (!function_exists('bogo_get_languages')) {
        return '<!-- Bogo not loaded yet -->';
    }

    $languages = bogo_get_languages();
    $current_lang = bogo_get_current_language();
    $output = '<form onchange="location = this.value;" class="bogo-language-switcher">';
    $output .= '<select>';

    foreach ($languages as $lang) {
        if ($lang->code !== $current_lang) {
            $label = $lang->code === 'ja' ? '🇯🇵日本語' : '🇺🇸English';
            $translated_id = bogo_get_translated_post_id(get_the_ID(), $lang->code);
            $lang_url = $translated_id ? get_permalink($translated_id) : home_url($lang->slug . '/');
            $output .= '<option value="' . esc_url($lang_url) . '">' . esc_html($label) . '</option>';
        }
    }

    $output .= '</select></form>';
    return $output;
}

// ショートコードの登録は「plugins_loaded」で
add_action('plugins_loaded', function () {
    add_shortcode('bogo_original', 'get_bogo_original');
});
