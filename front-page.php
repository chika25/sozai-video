<?php get_header(); ?>
<?php get_template_part('category-slider'); ?>
<div class="layout-wrapper">
    <aside class="sidebar">
        <?php get_sidebar(); ?>
    </aside>
    <main class="main-content">
         <?php 
        $header_text = get_theme_mod('homepage_h1_text', '登録不要、商用利用OKのAI動画素材サイト｜SozAI-Video-'); 
        $desc_text = get_theme_mod('homepage_text', 'IF YOU SEE THIS, THE CODE IS WORKING'); 

        if ( $header_text ) : ?>
            <h1 class="main-seo-title">
                <?php echo esc_html( $header_text ); ?>
            </h1>

        <?php endif; ?>

        <?php 
        if ( $desc_text ) : ?>
            <p class="main-seo-text">
                <?php echo nl2br(esc_html( $desc_text )); ?>
            </p>
        <?php endif; ?>
    </main>
</div>
<?php get_footer(); ?>