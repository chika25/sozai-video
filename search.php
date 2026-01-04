<?php get_header(); ?>
<?php get_template_part('template-parts/category-slider'); ?>
<div class="layout-wrapper">
    <aside class="sidebar">
        <?php get_sidebar(); ?>
    </aside>
    <main class="main-content">
        <div class="main-wrapper">
            <?php get_template_part('template-parts/content-breadcrumbs'); ?>
            
            <h1 class="main-seo-title">
                <?php echo '「' . get_search_query() . '」' . 'のフリー動画素材' ?>
            </h1>

            <section class="video-section">
                <div class="video-grid">
                    <artivle class="video-card">
                        
                    </artivle>
                </div>
            </section>
        </div>
    </main>
</div>
<?php get_footer(); ?>