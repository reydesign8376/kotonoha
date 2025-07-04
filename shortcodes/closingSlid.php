<?php
// shortcodes/closingSlid.php
// [closingSlid]
function get_closingSlid()
{
    ob_start();
?>
    <div class="closingSlid-section">
        <div class="swiper">
            <div class="swiper-wrapper">
                <?php
                for ($i = 1; $i <= 6; $i++) {
                    $image_url = get_theme_mod('mytheme_custom_album_image_' . $i);
                    if (!empty($image_url)) :
                ?>
                        <div class="swiper-slide">
                            <img src="<?php echo esc_url($image_url); ?>" alt="コトノハ書道">
                        </div>
                <?php
                    endif;
                }
                ?>
            </div>
        </div>
    </div>
<?php
    return ob_get_clean();
}
add_shortcode('closingSlid', 'get_closingSlid');
