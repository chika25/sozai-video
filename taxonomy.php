<?php get_header(); ?>
<?php get_template_part('template-parts/category-slider'); ?>
<div class="layout-wrapper">
    <aside class="sidebar">
        <?php get_sidebar(); ?>
    </aside>
    <main class="main-content">
        <div class="main-wrapper">
            <?php get_template_part('template-parts/content-breadcrumbs'); ?>
            
            <?php 
            $current_term = single_term_title('', false);
            $unique_desc  = term_description();
            $taxonomy_text = get_theme_mod('taxonomy_h1_text', 'のAI動画素材 (登録不要・商用利用Ok)|SozAI-Video'); 
            ?>
            
            <?php if ( $taxonomy_text ): ?>
                <h1 class="main-seo-title">  
                    <?php echo $current_term, esc_html( $taxonomy_text ); ?>
                </h1>
            <?php endif; ?>
    
            <?php if ( $unique_desc ) : ?>
                <p class="main-seo-text">
                    <?php echo esc_html( wp_strip_all_tags( $unique_desc ) ); ?>
                </p>
            <?php endif; ?>

            <section class="video-section">
                
                <?php
                // Setup Query Arguments
                $current_term = get_queried_object();
                $num_display = 6;

                if ( $current_term instanceof WP_Term ) {
                    $args = array(
                        'post_type'      => 'video',
                        'posts_per_page' => $num_display,
                        'tax_query'      => array(
                            array(
                                'taxonomy' => $current_term->taxonomy, 
                                'field'    => 'slug',
                                'terms'    => $current_term->slug,
                            ),
                        ),
                    );
                    $video_query = new WP_Query( $args );
                } else {
                    $video_query = new WP_Query(); 
                }

                if ( $video_query->have_posts() ) : ?>

                    <!-- loop the videos -->
                    <div class="video-grid">
                        <?php while ( $video_query->have_posts() ) : $video_query->the_post(); ?>
                            <?php get_template_part('template-parts/video-content'); ?>
                        <?php endwhile; ?>
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