<?php
// load styles
function my_theme_assets() {
    wp_enqueue_style( 'my-main-style', get_stylesheet_uri() );
}
add_action( 'wp_enqueue_scripts', 'my_theme_assets' );

// change logo
function my_theme_setup() {
    add_theme_support('custom-logo', array(
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
    ));
}
add_action('after_setup_theme', 'my_theme_setup');

// footer menu
function my_theme_register_menus() {
    register_nav_menus(array(
        'footer-menu' => 'Footer Links Area',
    ));
}
add_action('init', 'my_theme_register_menus');

// Change color
function my_theme_customizer($wp_customize) {
    $wp_customize->add_section('theme_colors', array(
        'title' => 'Theme Colors',
    ));

    // 1. Header Background
    $wp_customize->add_setting('header_bg_color', array('default' => '#ffffff'));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'header_bg_color', array(
        'label' => 'Header Background',
        'section' => 'theme_colors',
    )));

    // 2. Sidebar Background
    $wp_customize->add_setting('sidebar_bg_color', array('default' => '#F1F5F9'));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'sidebar_bg_color', array(
        'label' => 'Sidebar Background',
        'section' => 'theme_colors',
    )));

    // 2. Main Background
    $wp_customize->add_setting('main_bg_color', array('default' => '#ffffff'));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'main_bg_color', array(
        'label' => 'Main Background',
        'section' => 'theme_colors',
    )));

    // 2. Footer Background
    $wp_customize->add_setting('footer_bg_color', array('default' => '#222222'));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'footer_bg_color', array(
        'label' => 'Footer Background',
        'section' => 'theme_colors',
    )));

    // 3. Footer Background
    $wp_customize->add_setting('category_bg_color', array('default' => '#F8FAFC'));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'category_bg_color', array(
        'label' => 'Category Slider Background',
        'section' => 'theme_colors',
    )));

    // 4. Hover Color
    $wp_customize->add_setting('link_hover_color', array('default' => '#808080'));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'link_hover_color', array(
        'label' => 'Link Hover Color',
        'section' => 'theme_colors',
    )));

    // 5. Category Hover Color
    $wp_customize->add_setting('category_hover_color', array('default' => '#96abc1ff'));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'category_hover_color', array(
        'label' => 'Category Hover Color',
        'section' => 'theme_colors',
    )));
}
add_action('customize_register', 'my_theme_customizer');

// Custom Taxonomy
function register_video_taxonomy() {
    register_taxonomy('video_category', 'post', array( 
        'label'        => 'Video Categories',
        'rewrite'      => array('slug' => 'video-category'),
        'hierarchical' => true, 
        'show_ui'      => true,
        'show_admin_column' => true,
    ));
}
add_action('init', 'register_video_taxonomy');

?>