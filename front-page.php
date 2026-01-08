<?php get_header(); ?>
<?php get_template_part('template-parts/category-slider'); ?>
<div class="layout-wrapper">
    <aside class="sidebar">
        <?php get_template_part('template-parts/sidebar'); ?>
    </aside>
    <main class="main-content">
        <div class="main-wrapper">
            <?php get_template_part('template-parts/breadcrumbs'); ?>

            <?php 
            $header_text = get_theme_mod('homepage_h1_text', '登録不要、商用利用OKのAI動画素材サイト|SozAI-Video-'); 
            $desc_text = get_theme_mod('homepage_text', '...'); 
            $h2_title = get_theme_mod('h2_title_text', '新着動画素材');
            ?>

            <?php if ( $header_text ): ?>
                <h1 class="main-seo-title">
                    <?php echo esc_html( $header_text ); ?>
                </h1>
            <?php endif; ?>

            <?php if ( $desc_text ) : ?>
                <p class="main-seo-text">
                    <?php echo nl2br(esc_html( $desc_text )); ?>
                </p>
            <?php endif; ?>

            <section class="video-section">
                <?php if ($h2_title) : ?>
                    <h2 class="h2-title-home"><?php echo esc_html( $h2_title); ?></h2>
                <?php endif; ?>
                
                <?php
                    // Define the arguments 
                    $num_display = get_theme_mod( 'num_display_setting', 6 );
                    $args = array(
                        'post_type'      => 'video', 
                        'posts_per_page' => $num_display,       
                        'orderby'        => 'date',  
                        'order'          => 'DESC',
                    );

                    // loop the videos
                    $video_query = new WP_Query( $args );
                    if ( $video_query->have_posts() ) : ?>
                        <div class="video-grid">
                            <?php while ( $video_query->have_posts() ) : $video_query->the_post(); ?>
                                <?php get_template_part('template-parts/video-content'); ?>
                            <?php endwhile ?>
                        </div>
                
                    <!-- load more button -->
                    <?php if ( $video_query->found_posts > $num_display ) : ?>
                        <?php sozai_render_load_more_button($video_query); ?>
                    <?php endif; ?>

                    <?php wp_reset_postdata(); ?>

                <?php else : ?>
                    <p>ビデオが見つかりませんでした。</p>
                <?php endif; ?>

            </section>
        </div>
    </main>
</div>
<?php get_footer(); ?>