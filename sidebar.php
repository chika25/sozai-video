<div class="secondary-sidebar-container">
    <?php 
    $terms_page_id = 15; 
    ?>
    
    <a href="<?php echo get_permalink($terms_page_id); ?>" class="sidebar-link">
        利用規約
    </a>

    <div class="keyword-list-container">
        <p class="sidebar-title">オススメキーワード</p>
        <div class="keyword-list">
            <?php
            $terms = get_terms(array(
                'taxonomy'   => 'video_keyword',
                'hide_empty' => false, // Set to true once you have real videos assigned
            ));

            if (!empty($terms) && !is_wp_error($terms)) :
                foreach ($terms as $term) : 
                    $term_link = get_term_link($term); 
                    ?>
                    
                    <a href="<?php echo esc_url($term_link); ?>" class="keyword-pill">
                        <?php echo esc_html($term->name); ?>
                    </a>

                <?php endforeach;
            else :
                echo '<p>No keywords added yet.</p>';
            endif;
            ?>
        </div>
    </div>

    <?php 
            $site_url = "https://sozaiai.com";
            $site_name = "姉妹サイト：SozAI (画像素材)";
            
            echo '<a href="' . $site_url . '" class="sidebar-link" target="_blank" rel="noopener noreferrer">' . $site_name . '</a>';
    ?>
</div>