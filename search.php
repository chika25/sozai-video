<?php get_header(); ?>
<?php get_template_part('template-parts/category-slider'); ?>
<div class="layout-wrapper">
    <aside class="sidebar">
        <?php get_template_part('template-parts/sidebar'); ?>
    </aside>
    <main class="main-content">
        <div class="main-wrapper">
            <?php get_template_part('template-parts/content-breadcrumbs'); ?>
            
            <h1 class="main-seo-title">
                <?php echo '「' . get_search_query() . '」' . 'のフリー動画素材' ?>
            </h1>

            <section class="video-section">
                <?php
                $search_query = get_search_query();
                $video_ids = sozai_get_video_search_ids($search_query);

                $args = array(
                    'post_type'      => 'video',
                    'posts_per_page' => get_theme_mod('num_display_setting', 6),
                    'post__in'       => !empty($video_ids) ? $video_ids : array(0),
                    'orderby'        => 'post__in', // Keeps the most relevant first
                );

                $video_query = new WP_Query($args);

                if ( $video_query->have_posts() ) : ?>
                    <div class="video-grid">
                        <?php while ( $video_query->have_posts() ) : $video_query->the_post(); ?>
                            <?php get_template_part('template-parts/video-content'); ?>
                        <?php endwhile; ?>
                    </div>
                    
                    <?php sozai_render_load_more_button($video_query); ?>
                    <?php wp_reset_postdata(); ?>

                <?php else : ?>
                    <p>「<?php echo esc_html($search_query); ?>」に一致するビデオが見つかりませんでした。</p>
                <?php endif; ?>
            </section>
        </div>
    </main>
</div>
<?php get_footer(); ?>