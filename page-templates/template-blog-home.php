<?php
/**
 * Template Name: Blog Home Template
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
            
            <section class="page-content">
                <?php while ( have_posts() ) : the_post(); ?>

                    <h1 class="entry-title">
                        <?php the_title(); ?>
                    </h1>

                    <p>準備中</p>

                <?php endwhile; ?>
            </section>
        </div>
    </main>
</div>
<?php get_footer(); ?>