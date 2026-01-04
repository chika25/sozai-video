<?php get_header(); ?>
<?php get_template_part('template-parts/category-slider'); ?>
<div class="layout-wrapper">
    <aside class="sidebar">
        <?php get_sidebar(); ?>
    </aside>
    <main class="main-content">
        <div class="main-wrapper">
            <?php get_template_part('template-parts/content-breadcrumbs'); ?>
            
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
                </div>
            </section>
        </div>
    </main>
</div>
<?php get_footer(); ?>