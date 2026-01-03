<?php
/**
 * Template Name: Contact US & Request
 */
get_header(); ?>
<?php get_template_part('category-slider'); ?>
<div class="layout-wrapper">
    <aside class="sidebar">
        <?php get_sidebar(); ?>
    </aside>
    <main class="main-content">
        <div class="main-wrapper">
            <?php get_template_part('template-parts/content-breadcrumbs'); ?>
            
            <div class="form-container">
                <?php while ( have_posts() ) : the_post(); ?>
                    <h1><?php the_title(); ?></h1>

                    <?php echo do_shortcode('[contact-form-7 id="da20f51" title="Contact form 1"]'); ?>
                    
                    <?php if ( get_the_title() == '素材リクエスト' ) : ?>
                        <p>素材リクエストありがとうございます。<br>
                        リクエストへの個別返信は行っておりませんが、制作の参考にさせていただきます。</p>
                    <?php else : ?>
                        <p>お問い合わせありがとうございます。当サイトに関するご意見はすべて確認させていただいております。<br>
                        個別のご返信にはお時間をいただく場合がございますが、ご了承ください。
                        </p>
                    <?php endif; ?>
                <?php endwhile; ?>
            </div>
        </div>
    </main>
</div>
<?php get_footer(); ?>