<div class="secondary-sidebar-container">
    <?php 
    // Get the ID of your Terms page (you find this in the Pages dashboard)
    $terms_page_id = 42; // Change this to your actual page ID
    ?>
    
    <a href="<?php echo get_permalink($terms_page_id); ?>" class="sidebar-link">
        利用規約
    </a>

    <?php 
            $site_url = "https://sozaiai.com";
            $site_name = "姉妹サイト：SozAI (画像素材)";
            
            echo '<a href="' . $site_url . '" class="sidebar-link" target="_blank" rel="noopener noreferrer">' . $site_name . '</a>';
    ?>
</div>