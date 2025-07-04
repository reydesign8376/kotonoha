<?php

/* 子テーマのfunctions.phpは、親テーマのfunctions.phpより先に読み込まれることに注意してください。 */


/**
 * 親テーマのfunctions.phpのあとで読み込みたいコードはこの中に。
 */
// add_filter('after_setup_theme', function(){
// }, 11);


/**
 * 子テーマでのファイルの読み込み
 */
add_action('wp_enqueue_scripts', function () {

    $timestamp = date('Ymdgis', filemtime(get_stylesheet_directory() . '/style.css'));
    wp_enqueue_style('child_style', get_stylesheet_directory_uri() . '/style.css', [], $timestamp);

    /* その他の読み込みファイルはこの下に記述 */
}, 11);

// ショートコード
$shortcodes_dir = get_stylesheet_directory() . '/shortcodes/';
foreach (glob($shortcodes_dir . '*.php') as $file) {
    include $file;
}

// カスタマイズ
$customize_dir = get_stylesheet_directory() . '/customize/';
foreach (glob($customize_dir . '*.php') as $file) {
    include $file;
}

// js,cssライブラリの読み込み
function enqueue_all_assets()
{
    $theme_dir = get_stylesheet_directory();
    $theme_uri = get_stylesheet_directory_uri();

    // style.css（子テーマ用）
    $timestamp = date('Ymdgis', filemtime($theme_dir . '/style.css'));
    wp_enqueue_style('child_style', $theme_uri . '/style.css', [], $timestamp);

    // GSAP
    wp_enqueue_script(
        'gsap',
        'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js',
        array(),
        '3.12.2',
        true
    );

    // GSAPScrollTrigger
    wp_enqueue_script(
        'gsap-scrolltrigger',
        'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js',
        array('gsap'),
        '3.12.2',
        true
    );

    // Swiper CSS
    wp_enqueue_style(
        'swiper',
        'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css',
        array(),
        '11'
    );

    // Swiper JS
    wp_enqueue_script(
        'swiper',
        'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js',
        array(),
        '11',
        true
    );

    // commons/css/*.css を読み込み
    foreach (glob($theme_dir . '/commons/css/*.css') as $css_file_path) {
        $handle = 'commons-' . basename($css_file_path, '.css');
        $css_file_uri = $theme_uri . '/commons/css/' . basename($css_file_path);
        wp_enqueue_style($handle, $css_file_uri);
    }

    // commons/js/*.js を読み込み（GSAP依存）
    foreach (glob($theme_dir . '/commons/js/*.js') as $js_file_path) {
        $handle = 'commons-' . basename($js_file_path, '.js');
        $js_file_uri = $theme_uri . '/commons/js/' . basename($js_file_path);
        wp_enqueue_script($handle, $js_file_uri, array('gsap'), null, true);
    }
}
add_action('wp_enqueue_scripts', 'enqueue_all_assets', 11);

// svg
function allow_svg_uploads($mimes)
{
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'allow_svg_uploads');

// Classic Editorを使用
add_filter('use_block_editor_for_post_type', 'custom_use_block_editor_for_post_type', 10, 2);
function custom_use_block_editor_for_post_type($use_block_editor, $post_type)
{
    if ($post_type === 'page') {
        return true;
    }
    if ($post_type === 'review') {
        return false;
    }
    return $use_block_editor;
}

// アーカイブURLからcategoryを削除
function remcat_function($link) {
return str_replace("/category/", "/", $link);
}
add_filter('user_trailingslashit', 'remcat_function');
function remcat_flush_rules() {
global $wp_rewrite;
$wp_rewrite->flush_rules();
}
add_action('init', 'remcat_flush_rules');
function remcat_rewrite($wp_rewrite) {
$new_rules = array('(.+)/page/(.+)/?' => 'index.php?category_name='.$wp_rewrite->preg_index(1).'&paged='.$wp_rewrite->preg_index(2));
$wp_rewrite->rules = $new_rules + $wp_rewrite->rules;
}
add_filter('generate_rewrite_rules', 'remcat_rewrite');

// 管理画面メニューの並び替え
function my_custom_menu_order($menu_order)
{
    if (!$menu_order) return true;
    return array(
        'index.php',
        'separator1',
        'upload.php', //メディア
        'edit.php', //投稿
        'edit.php?post_type=review',
        'wpcf7',
        'booking-package%2Findex.php',
        'separator2',
        'plugins.php', //プラグイン
        'users.php', //ユーザー
        'edit.php?post_type=page', //固定ページ
        'themes.php', //外観
        'tools.php', //ツール
        'options-general.php', //設定
        'edit-comments.php', //コメント
    );
}
add_filter('custom_menu_order', 'my_custom_menu_order');
add_filter('menu_order', 'my_custom_menu_order');

// タグマネ
function add_google_tag_manager_head() {
?>
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-K5MVNK37');</script>
<!-- End Google Tag Manager -->
<?php
}
add_action('wp_head', 'add_google_tag_manager_head');

function add_google_tag_manager_body() {
?>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-K5MVNK37"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<?php
}
add_action('wp_body_open', 'add_google_tag_manager_body');