<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php wp_head(); ?>
        <style>
            :root {
                --header-bg: <?php echo get_theme_mod('header_bg_color', '#ffffff'); ?>;
                --sidebar-bg: <?php echo get_theme_mod('sidebar_bg_color', '#F1F5F9'); ?>;
                --main-bg: <?php echo get_theme_mod('main_bg_color', '#ffffff'); ?>;
                --footer-bg: <?php echo get_theme_mod('footer_bg_color', '#ffffff'); ?>;
                --category-bg: <?php echo get_theme_mod('category_bg_color', '#F8FAFC '); ?>;
                --hover-color: <?php echo get_theme_mod('link_hover_color', '#00BFFF'); ?>;
                --category-hover: <?php echo get_theme_mod('category_hover_color', '#ff9900'); ?>;
            }
        </style>
    </head>
    <body <?php body_class(); ?>>
        <header class="site-header">
            <div id="menu-toggle">
                <i class="fa fa-bars"></i>
                <i class="fa fa-times icon-close"></i>
            </div>
            <div id="sidebar-overlay" class="hide">
                <aside class="sidebar">
                    <?php get_sidebar(); ?>
               </aside>
            </div>
            <div class="logo-container">
                <?php 
                    if (function_exists('the_custom_logo')) {
                        the_custom_logo(); 
                    }
                ?>
            </div>
            <div id="search-toggle">
                <i class="fa fa-search"></i>
                <i class="fa fa-times icon-close"></i>
            </div>
            <div id="search-overlay" class="hide">
                <?php get_search_form(); ?>
            </div>
        </header>
