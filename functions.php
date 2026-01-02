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

// change text for main page, taxonomy page
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

    // --- H2 TITLE TEXT ---
    $wp_customize->add_setting( 'h2_title_text' , array(
        'default'   => '新着動画素材',
        'transport' => 'refresh',
    ) );
    $wp_customize->add_control( 'h2_title_text_control', array(
        'label'    => 'Homepage H2 Title Text',
        'section'  => 'sozai_seo_section',
        'settings' => 'h2_title_text',
        'type'     => 'text', 
    ) );

    
    // --- TAXONOMY TITLE Suffix ---
    $wp_customize->add_setting( 'taxonomy_h1_text' , array(
        'default'   => 'のAI動画素材 (登録不要・商用利用Ok)|SozAI-Video',
        'transport' => 'refresh',
    ) );
    $wp_customize->add_control( 'taxonomy_h1_text_control', array(
        'label'    => 'Taxonomy Title',
        'section'  => 'sozai_seo_section',
        'settings' => 'taxonomy_h1_text',
        'type'     => 'text', 
    ) );

    // --- Details Page TITLE Suffix ---
    $wp_customize->add_setting( 'details_h1_text' , array(
        'default'   => 'の登録不要、商用利用OKのAI動画素材|SozAI-Video-',
        'transport' => 'refresh',
    ) );
    $wp_customize->add_control( 'details_h1_text_control', array(
        'label'    => 'Details Page Title Suffix',
        'section'  => 'sozai_seo_section',
        'settings' => 'details_h1_text',
        'type'     => 'text', 
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

// 1. REGISTER THE VIDEO POST TYPE
function register_sozai_video_post_type() {
    $args = array(
        'labels'      => array(
            'name'          => 'Videos', 
            'singular_name' => 'Video',
            'add_new'       => 'Add New Video',
            'add_new_item'  => 'Add New Video',
            'edit_item'     => 'Edit Video',
        ),
        'public'      => true,
        'has_archive' => true,
        'menu_icon'   => 'dashicons-video-alt3',
        'supports'    => array('title', 'editor', 'thumbnail', 'excerpt'),
        'rewrite'     => array('slug' => 'videos'),
        'show_in_rest'=> true, 
    );
    register_post_type('video', $args);
}
add_action('init', 'register_sozai_video_post_type');

// 2. REGISTER ALL TAXONOMIES FOR VIDEOS
function register_video_taxonomies() {
    // Categories (Hierarchical like folders)
    register_taxonomy('video_category', 'video', array(
        'label'        => 'Video Categories',
        'hierarchical' => true,
        'show_ui'      => true,
        'show_admin_column' => true,
        'show_in_rest' => true,
        'rewrite'     => array('slug' => 'video-category'),
    ));

    // Keywords (Non-hierarchical like tags/pills)
    $keyword_labels = array(
        'name'              => 'Keywords',
        'singular_name'     => 'Keyword',
        'search_items'      => 'Search Keywords',
        'all_items'         => 'All Keywords',
        'add_new_item'      => 'Add New Keyword',
        'menu_name'         => 'Keywords',
    );

    register_taxonomy('video_keyword', 'video', array(
        'labels'            => $keyword_labels,
        'hierarchical'      => true, 
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'keyword' ),
        'show_in_rest'      => true,
    ));
}
add_action('init', 'register_video_taxonomies');

// Custom Video Details 
function sozai_add_video_specs_metabox() {
    add_meta_box(
        'video_specs_box',           
        '動画の詳細情報 (Technical Specs)', 
        'sozai_display_video_specs', 
        'video',                     
        'side',                      
        'default'                    
    );
}
add_action('add_meta_boxes', 'sozai_add_video_specs_metabox');

// get the data for each video
function sozai_display_video_specs($post) {
    $resolution = get_post_meta($post->ID, '_video_resolution', true);
    $format     = get_post_meta($post->ID, '_video_format', true);
    $fps        = get_post_meta($post->ID, '_video_fps', true);

    wp_nonce_field('sozai_video_specs_nonce', 'video_specs_nonce');

    echo '<p><label>解像度:</label><br>';
    echo '<input type="text" name="video_resolution" value="' . esc_attr($resolution) . '" placeholder="Full HD (1920x1080)" style="width:100%;"></p>';

    echo '<p><label>ファイル形式:</label><br>';
    echo '<input type="text" name="video_format" value="' . esc_attr($format) . '" placeholder="MP4 (H.264)" style="width:100%;"></p>';

    echo '<p><label>フレームレート (FPS):</label><br>';
    echo '<input type="text" name="video_fps" value="' . esc_attr($fps) . '" placeholder="30fps" style="width:100%;"></p>';
}

function sozai_save_video_specs($post_id) {
    // 1. Security Check (Nonce)
    if (!isset($_POST['video_specs_nonce']) || !wp_verify_nonce($_POST['video_specs_nonce'], 'sozai_video_specs_nonce')) {
        return;
    }

    // 2. Check if it's an autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

    // 3. Check user permissions
    if (!current_user_can('edit_post', $post_id)) return;

    // 4. Check if we are actually editing a 'video' post type
    // This is safer than using 'save_post_video' in some environments
    if (get_post_type($post_id) !== 'video') return;

    // 5. SAVE THE DATA
    if (isset($_POST['video_resolution'])) {
        update_post_meta($post_id, '_video_resolution', sanitize_text_field($_POST['video_resolution']));
    }
    if (isset($_POST['video_format'])) {
        update_post_meta($post_id, '_video_format', sanitize_text_field($_POST['video_format']));
    }
    if (isset($_POST['video_fps'])) {
        update_post_meta($post_id, '_video_fps', sanitize_text_field($_POST['video_fps']));
    }
}
// Use the universal 'save_post' hook
add_action('save_post', 'sozai_save_video_specs');

function sozai_register_video_metadata() {
    $meta_fields = array('_video_resolution', '_video_format', '_video_fps');

    foreach ($meta_fields as $field) {
        register_post_meta('video', $field, array(
            'show_in_rest' => true,
            'single'       => true,
            'type'         => 'string',
            'auth_callback' => function() {
                return current_user_can('edit_posts');
            }
        ));
    }
}
add_action('init', 'sozai_register_video_metadata');
?>