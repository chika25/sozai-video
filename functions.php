<?php
// load styles
function my_theme_assets() {
    // Load Font Awesome 4.7
    wp_enqueue_style( 'font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css' );
    wp_enqueue_style( 'my-main-style', get_stylesheet_uri() );
}
add_action( 'wp_enqueue_scripts', 'my_theme_assets' );

function sozai_video_scripts() {
    // 1. Register and Enqueue main.js
    wp_enqueue_script( 
        'sozai-main', 
        get_template_directory_uri() . '/assets/js/main.js', 
        array(), 
        '1.0.0', 
        true 
    );

    // 2. Attach the AJAX URL to that specific handle
    wp_localize_script( 'sozai-main', 'sozai_ajax', array(
        'ajaxurl' => admin_url( 'admin-ajax.php' )
    ));
}
add_action( 'wp_enqueue_scripts', 'sozai_video_scripts' );

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

// Add expert to static page built page
add_action('init', function() {
    add_post_type_support('page', 'excerpt');
});

// SEO Meta Data for Header
function theme_custom_seo_meta() {
    // 1. HOME PAGE: Use Customizer Settings
    if ( is_front_page() ) {
        $home_title = get_theme_mod('home_seo_title', get_bloginfo('name'));
        $home_desc  = get_theme_mod('home_seo_desc', get_bloginfo('description'));
        
        echo '<title>' . esc_html($home_title) . '</title>' . "\n";
        echo '<meta name="description" content="' . esc_attr($home_desc) . '">' . "\n";

        ?>
        <script type="application/ld+json">
        {
        "@context": "https://schema.org",
        "@type": "WebSite",
        "name": "SozAI-Video",
        "url": "<?php echo esc_url( get_site_url()); ?>",
        "description": "<?php echo esc_js($home_desc); ?>",
        "publisher": {
            "@type": "Organization",
            "name": "SozAI-Video",
            "logo": "<?php echo esc_url( get_site_url() . '/wp-content/uploads/2025/12/cropped-logo-Video--192x192.png' ); ?>",
        },
        "potentialAction": {
            "@type": "SearchAction",
            "target": "https://yoursite.com/?s={search_term_string}",
            "query-input": "required name=search_term_string"
        }
        }
        </script>
        <?php
    }

    // 2. CATEGORY PAGE: Use Category Name/Description
    elseif ( is_tax() || is_category() ) {
        $current_term = get_queried_object();
        $cat_title = single_cat_title('', false) . ' - フリー動画素材';
        $cat_desc  = term_description();

        if ( !empty($cat_desc) ) {
            $content = wp_strip_all_tags($cat_desc);
        } 
        else {
            $content = "【商用OK】" . $cat_title . "の高品質なAI動画素材を無料で配布中。登録不要でYouTubeや制作の背景にすぐ使えます。SozAI-Videoで今すぐダウンロード。";
        }
        echo '<title>' . esc_html($cat_title) . '</title>' . "\n";
        echo '<meta name="description" content="' . esc_attr($content) . '">' . "\n";

        // Get array of videos in the category
        $video_items = array();
        $args = array(
            'post_type'      => 'video', 
            'posts_per_page' => 10,      
            'tax_query'      => array(
                array(
                    'taxonomy' => $current_term->taxonomy, 
                    'field'    => 'slug',
                    'terms'    => $current_term->slug,
                ),
            ),
        );

        $video_query = new WP_Query($args);

        if ( $video_query->have_posts() ) {
            $position = 1;
            while ( $video_query->have_posts() ) {
                $video_query->the_post();
                $video_items[] = array(
                    "@type"    => "ListItem",
                    "position" => $position,
                    "url"      => get_permalink(),
                    "name"     => get_the_title()
                );
                $position++;
            }
            wp_reset_postdata();
        }

        ?>
        <script type="application/ld+json">
        {
        "@context": "https://schema.org",
        "@type": "CollectionPage",
        "name": "<?php echo esc_js($cat_title); ?>",
        "description": "<?php echo esc_js($content); ?>",,
        "mainEntity": {
            "@type": "ItemList",
            "itemListElement": <?php echo json_encode($video_items, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); ?>
        }
        }
        </script>
        <?php
    }

    // 3. SINGLE VIDEO PAGE: Use Post Title & Video Schema
    elseif ( is_singular('video') ) { 
        $page_title = get_the_title() . ' | 無料ダウンロード';
        $page_desc  = get_the_excerpt(); 

        if ( empty($page_desc) ) {
            $desc= "【商用OK】" .  $page_title . "の高品質なAI動画素材を無料で配布中。登録不要でYouTubeや制作の背景にすぐ使えます。SozAI-Videoで今すぐダウンロード。";
        }
        echo '<title>' . esc_html($page_title) . '</title>' . "\n";
        echo '<meta name="description" content="' . esc_attr($desc) . '">' . "\n";

        // INJECT VIDEO SCHEMA (JSON-LD)
        $thumb = get_post_meta(get_the_ID(), '_thumbnail', true);
        $url = get_post_meta(get_the_ID(), '_video_url', true); 
        
        ?>
        <script type="application/ld+json">
        {
          "@context": "https://schema.org",
          "@type": "VideoObject",
          "name": "<?php echo esc_js(get_the_title()); ?>",
          "description": "<?php echo esc_js($desc); ?>",
          "thumbnailUrl": "<?php echo esc_url($thumb); ?>",
          "uploadDate": "<?php echo get_the_date('c'); ?>",
          "contentUrl": "<?php echo esc_url($url); ?>"
        }
        </script>
        <?php
    }
    elseif ( is_page() ) {
        $page_static_title = get_the_title();
        $static_desc = get_the_excerpt();

        if ( empty($static_desc) ) {
            $static_desc= esc_html($page_static_title) . "| SozAI-Video";
        }
        
        echo '<title>' . esc_html($page_static_title) . '|SozAI-Video-'. '</title>' . "\n";
        echo '<meta name="description" content="' . esc_attr($static_desc) . '">';

        ?>
        <script type="application/ld+json">
        {
        "@context": "https://schema.org",
        "@type": "<?php echo esc_js($page_static_title); ?>",
        "mainEntity": {
            "@type": "Organization",
            "name": "SozAI-Video",
            "url": "<?php echo esc_url( get_site_url()); ?>",
            "logo": "<?php echo esc_url( get_site_url() . '/wp-content/uploads/2025/12/cropped-logo-Video--192x192.png' ); ?>",
            "description": "<?php echo esc_js($static_desc); ?>",
            "knowsAbout": ["AI動画素材",
                            "AI Video Assets",
                            "フリー動画素材",
                            "Stock Footage",
                            "YouTube動画素材"],
            "areaServed": "JP"
        }
        }
        </script>
        <?php
    }
}
add_action( 'wp_head', 'theme_custom_seo_meta', 1 );

// change text for main page, taxonomy page
function sozai_customize_register( $wp_customize ) {
    // get the number of videos display
    $wp_customize->add_section( 'sozai_settings_section' , array(
        'title'      => __( 'Global Post Settings', 'sozai' ),
        'priority'   => 30,
    ) );

    $wp_customize->add_setting( 'num_display_setting', array(
        'default'   => 6, 
        'transport' => 'refresh',
    ) );

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'num_display_control', array(
        'label'      => __( 'Number of Videos to Display', 'sozai' ),
        'section'    => 'sozai_settings_section',
        'settings'   => 'num_display_setting',
        'type'       => 'number',
    ) ) );

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

    // 3. Category slider Background
    $wp_customize->add_setting('category_bg_color', array('default' => '#F8FAFC'));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'category_bg_color', array(
        'label' => 'Category Slider Background',
        'section' => 'theme_colors',
    )));

    // 4. Footer Hover Color
    $wp_customize->add_setting('link_hover_color', array('default' => '#00BFFF'));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'link_hover_color', array(
        'label' => 'Footer Link Hover Color',
        'section' => 'theme_colors',
    )));

    // 5. Category Hover Color
    $wp_customize->add_setting('category_hover_color', array('default' => '#ff9900'));
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
        'supports'    => array('title', 'editor', 'excerpt'),
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
    $url        = get_post_meta($post->ID, '_video_url', true);
    $thumbnail  = get_post_meta($post->ID, '_thumbnail', true);
    $alt        = get_post_meta($post->ID, '_alt_text', true);

    wp_nonce_field('sozai_video_specs_nonce', 'video_specs_nonce');

    echo '<p><label>解像度:</label><br>';
    echo '<input type="text" name="video_resolution" value="' . esc_attr($resolution) . '" placeholder="Full HD (1920x1080)" style="width:100%;"></p>';

    echo '<p><label>ファイル形式:</label><br>';
    echo '<input type="text" name="video_format" value="' . esc_attr($format) . '" placeholder="MP4 (H.264)" style="width:100%;"></p>';

    echo '<p><label>フレームレート (FPS):</label><br>';
    echo '<input type="text" name="video_fps" value="' . esc_attr($fps) . '" placeholder="30fps" style="width:100%;"></p>';

    echo '<p><label>URL:</label><br>';
    echo '<input type="text" name="video_url" value="' . esc_attr($url) . '" placeholder="" style="width:100%;"></p>';

    echo '<p><label>Alt テキスト:</label><br>';
    echo '<input type="text" name="alt" value="' . esc_attr($alt) . '" placeholder="" style="width:100%;"></p>';

    echo '<p><label>Thumbnail URL:</label><br>';
    echo '<input type="text" name="thumbnail" value="' . esc_attr($url) . '" placeholder="" style="width:100%;"></p>';
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
    if (isset($_POST['video_url'])) {
        update_post_meta($post_id, '_video_url', sanitize_text_field($_POST['video_url']));
    }
    if (isset($_POST['alt'])) {
        update_post_meta($post_id, '_alt_text', sanitize_text_field($_POST['alt']));
    }
    if (isset($_POST['thumbnail'])) {
        update_post_meta($post_id, '_thumbnail', sanitize_text_field($_POST['thumbnail']));
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

// read more button
function sozai_render_load_more_button($query) {
    if ( $query->max_num_pages > 1 ) {
        $term_slug = '';
        $taxonomy = '';
         // Capture the current search term
        $search_query = get_search_query();

        if ( is_tax() || is_category() || is_tag() ) {
            $obj = get_queried_object();
            $term_slug = $obj->slug;
            $taxonomy = $obj->taxonomy;
        }
        
        echo '<button id="load-more-videos" 
                data-page="1" 
                data-max="' . $query->max_num_pages . '" 
                data-term="' . esc_attr($term_slug) . '" 
                data-tax="' . esc_attr($taxonomy) . '" 
                data-search="' . esc_attr($search_query) . '" 
                class="load-more-button">もっと見る</button>';
    }
}


// AJAX for load more videos
function sozai_load_more_ajax_handler() {
    $paged = isset($_POST['page']) ? intval($_POST['page']) : 1;
    $search_term = isset($_POST['search']) ? sanitize_text_field($_POST['search']) : '';
    
    $args = array(
        'post_type'      => 'video',
        'posts_per_page' => get_theme_mod('num_display_setting', 6),
        'paged'          => $paged,
    );

    if (!empty($search_term)) {
    $video_ids = sozai_get_video_search_ids($search_term);
    $args['post__in'] = $video_ids;
    // Critical for consistency!
    $args['orderby']  = 'post__in'; 
}

    $query = new WP_Query($args);
    if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post();
            get_template_part('template-parts/video-content', 'video');
        endwhile;
    else :
        echo 'DONE'; 
    endif;

    wp_reset_postdata();
    wp_die();
}
add_action('wp_ajax_load_more_videos', 'sozai_load_more_ajax_handler');
add_action('wp_ajax_nopriv_load_more_videos', 'sozai_load_more_ajax_handler');


function sozai_get_video_search_ids($search_term) {
    if (empty($search_term)) return array();

    // 1. Find IDs matching Title/Content (Standard search)
    $search_ids = get_posts(array(
        'post_type'   => 'video',
        's'           => $search_term,
        'numberposts' => -1,
        'fields'      => 'ids',
        'post_status' => 'publish'
    ));

    // 2. Find Category/Keyword IDs (Fuzzy match)
    $matched_terms = get_terms(array(
        'taxonomy'   => array('video_category', 'video_keyword'),
        'name__like' => $search_term,
        'fields'     => 'ids',
    ));

    $tax_ids = array();
    if (!empty($matched_terms)) {
        $tax_ids = get_posts(array(
            'post_type'   => 'video',
            'numberposts' => -1,
            'fields'      => 'ids',
            'post_status' => 'publish',
            'tax_query'   => array(
                'relation' => 'OR',
                array('taxonomy' => 'video_category', 'field' => 'term_id', 'terms' => $matched_terms),
                array('taxonomy' => 'video_keyword', 'field' => 'term_id', 'terms' => $matched_terms),
            ),
        ));
    }

    // Merge and force unique IDs as integers
    $all_ids = array_unique(array_merge((array)$search_ids, (array)$tax_ids));
    
    // Return sorted IDs to prevent weird database ordering issues
    return !empty($all_ids) ? array_map('intval', $all_ids) : array(0);
}
?>