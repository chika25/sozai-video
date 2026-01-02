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