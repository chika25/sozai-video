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

// change text for main page
function sozai_customize_register( $wp_customize ) {
    // Add the section
    $wp_customize->add_section( 'sozai_seo_section' , array(
        'title'    => 'SEO Settings',
        'priority' => 30,
    ) );

    // --- H1 title ---
    $wp_customize->add_setting( 'homepage_h1_text' , array(
        'default'   => '登録不要、商用利用OKのAI動画素材サイト｜SozAI-Video-',
        'transport' => 'refresh',
    ) );
    $wp_customize->add_control( 'homepage_h1_control', array(
        'label'    => 'Homepage H1 Title',
        'section'  => 'sozai_seo_section',
        'settings' => 'homepage_h1_text',
        'type'     => 'text',
    ) );

    // --- DESCRIPTION PARAGRAPH ---
    $wp_customize->add_setting( 'homepage_text' , array(
        'default'   => '',
        'transport' => 'refresh',
    ) );
    $wp_customize->add_control( 'homepage_text_control', array(
        'label'    => 'Homepage Description',
        'section'  => 'sozai_seo_section',
        'settings' => 'homepage_text',
        'type'     => 'textarea', 
    ) );
}
add_action( 'customize_register', 'sozai_customize_register' );

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

// custom tags
// 1. REGISTER THE VIDEO POST TYPE
function register_sozai_video_post_type() {
    $labels = array(
        'name'               => 'Videos',
        'singular_name'      => 'Video',
        'add_new'            => 'Add New Video', // Keep this as "Video"
        'add_new_item'       => 'Add New Video',
        'edit_item'          => 'Edit Video',
        'menu_name'          => 'Videos',
    );

    $args = array(
        'labels'              => $labels,
        'public'              => true,
        'has_archive'         => true,
        'menu_icon'           => 'dashicons-video-alt3',
        'supports'            => array('title', 'editor', 'thumbnail', 'excerpt'),
        'rewrite'             => array('slug' => 'videos'),
        'show_in_rest'        => true, 
    );

    register_post_type('video', $args);
}
add_action('init', 'register_sozai_video_post_type');


// 2. REGISTER THE KEYWORDS TAXONOMY
function register_video_keywords_taxonomy() {
    $labels = array(
        'name'              => 'Keywords',
        'singular_name'     => 'Keyword',
        'search_items'      => 'Search Keywords',
        'all_items'         => 'All Keywords',
        'edit_item'         => 'Edit Keyword',
        'update_item'       => 'Update Keyword',
        'add_new_item'      => 'Add New Keyword',
        'menu_name'         => 'Keywords',
    );

    $args = array(
        'hierarchical'      => false, // Set to false so it acts like TAGS (pills)
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'keyword' ),
        'show_in_rest'      => true,
    );

    // This links the Keywords to the 'video' post type specifically
    register_taxonomy( 'video_keyword', array( 'video' ), $args );
}
add_action( 'init', 'register_video_keywords_taxonomy' );
?>