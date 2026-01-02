<?php get_header(); ?>
<?php get_template_part('category-slider'); ?>
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
            
            <h1 class="main-seo-title">
                <?php if ( $taxonomy_text ): ?>
                    <?php echo $current_term, esc_html( $taxonomy_text ); ?>
                <?php endif; ?>
            </h1>
    
            <p class="main-seo-text">
                <?php 
                    if ( ! empty( $unique_desc ) ) {
                        echo esc_html( wp_strip_all_tags( $unique_desc ) );
                    } else {
                        $global_desc = get_theme_mod('taxonomy_text', 'の高品質なAI動画素材を豊富に取り揃えています。');
                        echo esc_html($current_term) . esc_html($global_desc);
                    }
                ?>
            </p>

            <section class="video-section">
                <div class="video-grid">
                    <artivle class="video-card">
                        <a href="">
                            <div class="video-container">
                                <video>

                                </video>
                                <div class="video-overlay">
                                    <h3 class="video-title"></h3>
                                </div>
                            </div>
                        </a>
                    </artivle>

                    <artivle class="video-card">
                        <a href="">
                            <div class="video-container">
                                <video>
                                    
                                </video>
                                <div class="video-overlay">
                                    <h3 class="video-title"></h3>
                                </div>
                            </div>
                        </a>
                    </artivle>

                    <artivle class="video-card">
                        <a href="">
                            <div class="video-container">
                                <video>
                                    
                                </video>
                                <div class="video-overlay">
                                    <h3 class="video-title"></h3>
                                </div>
                            </div>
                        </a>
                    </artivle>

                    <artivle class="video-card">
                        <a href="">
                            <div class="video-container">
                                <video>
                                    
                                </video>
                                <div class="video-overlay">
                                    <h3 class="video-title"></h3>
                                </div>
                            </div>
                        </a>
                    </artivle>


                    <artivle class="video-card">
                        <a href="">
                            <div class="video-container">
                                <video>
                                    
                                </video>
                                <div class="video-overlay">
                                    <h3 class="video-title"></h3>
                                </div>
                            </div>
                        </a>
                    </artivle>

                    <artivle class="video-card">
                        <a href="">
                            <div class="video-container">
                                <video>
                                    
                                </video>
                                <div class="video-overlay">
                                    <h3 class="video-title"></h3>
                                </div>
                            </div>
                        </a>
                    </artivle>

                    <artivle class="video-card">
                        <a href="">
                            <div class="video-container">
                                <video>
                                    
                                </video>
                                <div class="video-overlay">
                                    <h3 class="video-title"></h3>
                                </div>
                            </div>
                        </a>
                    </artivle>

                    <artivle class="video-card">
                        <a href="">
                            <div class="video-container">
                                <video>
                                    
                                </video>
                                <div class="video-overlay">
                                    <h3 class="video-title"></h3>
                                </div>
                            </div>
                        </a>
                    </artivle>

                    <artivle class="video-card">
                        <a href="">
                            <div class="video-container">
                                <video>
                                    
                                </video>
                                <div class="video-overlay">
                                    <h3 class="video-title"></h3>
                                </div>
                            </div>
                        </a>
                    </artivle>

                </div>
                <button class="read-more-button">もっと見る</button>
            </section>
        </div>
    </main>
</div>
<?php get_footer(); ?>