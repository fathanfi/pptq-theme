<header class="entry-header container entry-header--style-gallery">
    <div class="max-w-screen-md mx-auto">
        <?php get_template_part('template-parts/single-header/single-header-content', null, ['has_excerpt' => 0]); ?>
    </div>

    <?php if (defined('_NCMAZ_FRONTEND_VERSION') && function_exists('get_field')) : ?>
        <?php
        $singleHeaderGalleryProps = (object)[];
        // OLD VERSION
        if (intval(_NCMAZ_FRONTEND_VERSION) < 4) {
            $singleHeaderGalleryProps->photos = [
                !empty(get_field('image_1')['url']) ? get_field('image_1')['url'] : "",
                !empty(get_field('image_2')['url']) ? get_field('image_2')['url'] : "",
                !empty(get_field('image_3')['url']) ? get_field('image_3')['url'] : "",
                !empty(get_field('image_4')['url']) ? get_field('image_4')['url'] : "",
                !empty(get_field('image_5')['url']) ? get_field('image_5')['url'] : "",
                !empty(get_field('image_6')['url']) ? get_field('image_6')['url'] : "",
                !empty(get_field('image_7')['url']) ? get_field('image_7')['url'] : "",
                !empty(get_field('image_8')['url']) ? get_field('image_8')['url'] : "",
            ];
            // FROM V4
        } else {
            $singleHeaderGalleryProps->photos = [
                get_field('image_1'),
                get_field('image_2'),
                get_field('image_3'),
                get_field('image_4'),
                get_field('image_5'),
                get_field('image_6'),
                get_field('image_7'),
                get_field('image_8'),
            ];
        }
        ?>
        <div data-is-react-component="HeaderSingleGallery" data-component-props="<?php echo esc_attr(json_encode($singleHeaderGalleryProps)); ?>"></div>
    <?php endif; ?>
</header><!-- .entry-header -->