<?php
// shortcodes/customize.php
function mytheme_customize_register($wp_customize)
{
    // アルバム
    $wp_customize->add_section('mytheme_album_section', array(
        'title'    => __('アルバムスライド', 'mytheme'),
        'priority' => 50,
    ));

    for ($i = 1; $i <= 6; $i++) {
        $wp_customize->add_setting("mytheme_custom_album_image_$i", array(
            'default'   => "http://studio-kotonoha.com/wp-content/uploads/2025/06/EFE2CDC4-8D1E-4A74-B7BF-CB0CEDD669F8.jpg",
            'transport' => 'refresh',
        ));

        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, "mytheme_custom_album_image_control_$i", array(
            'label'      => __("画像をアップロード $i", 'mytheme'),
            'section'    => 'mytheme_album_section',
            'settings'   => "mytheme_custom_album_image_$i",
        )));
    }
}
add_action('customize_register', 'mytheme_customize_register');
