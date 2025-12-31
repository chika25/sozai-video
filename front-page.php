<?php get_header(); ?>
<?php get_template_part('category-slider'); ?>
<div class="layout-wrapper">
    <aside class="sidebar">
        <?php get_sidebar(); ?>
    </aside>
    <main class="main-content">
        <div class="main-wrapper">
            <?php 
            $header_text = get_theme_mod('homepage_h1_text', '登録不要、商用利用OKのAI動画素材サイト｜SozAI-Video-'); 
            $desc_text = get_theme_mod('homepage_text', 'IF YOU SEE THIS, THE CODE IS WORKING'); 
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