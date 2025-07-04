<?php
// shortcodes/review.php

function get_post_review()
{
    $args = array(
        'post_type'      => 'review',
        'posts_per_page' => -1
    );

    $query = new WP_Query($args);

    ob_start(); // 出力バッファリングを開始

    if ($query->have_posts()) {
?>
        <div class="swiper review_container">
            <ul class="swiper-wrapper review_list ">
                <?php while ($query->have_posts()) : $query->the_post(); ?>
                    <li class="swiper-slide review_item">
                        <div class="icon">
                            <?php
                            $image = get_field('review_icon');
                            if (!empty($image)): ?>
                                <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                            <?php else: ?>
                                <img src="http://studio-kotonoha.com/wp-content/uploads/2025/05/noimg.png" alt="No Image" />
                            <?php endif; ?>
                        </div>
                        <h3><?php the_title(); ?></h3>
                        <div class="star">
                            <?php
                            $star = get_field('review_star');
                            if (!empty($star)) {
                                echo esc_html($star);
                            } else {
                                echo '★★★★★';
                            }
                            ?>
                        </div>
                        <?php
                        $review = get_field('review_contents');
                        $trimmed = mb_substr($review, 0, 380);
                        if (mb_strlen($review) > 380) {
                            $trimmed .= '...';
                        }
                        echo '<p>' . nl2br(esc_html($trimmed)) . '</p>';
                        ?>

                        <?php
                        $more = get_field('review_more');
                        if (!empty($more)): ?>
                            <details>
                                <summary>More</summary>
                                <p><?php echo nl2br($more); ?></p>
                            </details>
                        <?php endif; ?>
                    </li>
                <?php endwhile; ?>
            </ul>
            <!-- 矢印 -->
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>
<?php
    } else {
        echo '<p>No information found.</p>';
    }

    wp_reset_postdata();

    return ob_get_clean();
}

add_shortcode('sc_review', 'get_post_review');
