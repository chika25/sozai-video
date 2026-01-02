<?php get_header(); ?>
<?php get_template_part('category-slider'); ?>
<div class="layout-wrapper">
    <aside class="sidebar">
        <?php get_sidebar(); ?>
    </aside>
    <main class="main-content">
        <div class="main-wrapper">
            <?php get_template_part('template-parts/content-breadcrumbs'); ?>
            
            <?php while ( have_posts() ) : the_post();  ?>
                <?php 
                $current_term = get_the_title();
                $unique_desc  = get_the_content();
                $detail_header_suffix = get_theme_mod('details_h1_text', 'の登録不要、商用利用OKのAI動画素材|SozAI-Video-');
                $resolution = get_post_meta(get_the_ID(), '_video_resolution', true);
                $format = get_post_meta(get_the_ID(), '_video_format', true);
                $fps = get_post_meta(get_the_ID(), '_video_fps', true); 
                ?>

                <?php if ( $detail_header_suffix ): ?>
                    <h1 class="main-seo-title">
                        <?php echo $current_term, esc_html( $detail_header_suffix ); ?>
                    </h1>
                <?php endif; ?>

                <?php if ( $unique_desc ) : ?>
                    <p class="main-seo-text">
                        <?php echo esc_html( wp_strip_all_tags( $unique_desc ) ); ?>
                    </p>
                <?php endif; ?>

                <section class="video-hero">
                    <div class="video-hero__main">
                        <div class="video-hero__player">
                            <video controls poster="<?php  ?>">
                                <source src="" type="video/mp4">
                            </video>
                        </div>

                        <div class="video-keywords">
                            <p class="video-keywords__title">関連キーワード</p>
                            <div class="video-keywords__list">
                            <?php
                                    $terms = get_the_terms( get_the_ID(), 'video_keyword' );

                                    if ( $terms && ! is_wp_error( $terms ) ) :
                                        foreach ( $terms as $term ) : ?>
                                            <a href="<?php echo esc_url( get_term_link( $term ) ); ?>" class="kw-badge">
                                                <?php echo esc_html( $term->name ); ?>
                                            </a>
                                        <?php endforeach;
                                    endif;
                                    ?>
                            </div>
                        </div>
                        <a href="<?php echo esc_url($video_url); ?>" download class="btn-download">
                            無料ダウンロード
                        </a>  
                    </div>

                    <div class="video-details">
                        <div class="video-details__content">
                            <?php if($resolution):?>
                                <p><span class="label">解像度:</span>
                                <span class="value"><?php echo esc_html($resolution); ?></span></p>
                            <?php endif; ?>
                            <?php if($format):?>
                                <p><span class="label">形式:</span>
                                <span class="value"><?php echo esc_html($format); ?></span></p>
                            <?php endif; ?>
                            <?php if($fps):?>
                                <p><span class="label">FPS:</span>
                                <span class="value"><?php echo esc_html($fps); ?></span></p>
                            <?php endif; ?>
                        </div>
                    </div>
                </section>
            <?php endwhile; ?>
        </div>
    </main>
</div>
<?php get_footer(); ?>