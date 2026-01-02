<?php
$b_post_id = get_the_ID();
?>

<nav class="breadcrumbs" aria-label="Breadcrumb" style="display:block !important;">
    <div class="breadcrumb-container">
        <a href="<?php echo home_url(); ?>" class="breadcrumb-link">Home</a>
        <span class="breadcrumb-sep"> / </span>

        <?php 
        if ( is_singular('video') ) {
            // Get terms for the current video
            $b_cats = get_the_terms( $b_post_id, 'video_category' );
            
            if ( ! empty( $b_cats ) && ! is_wp_error( $b_cats ) ) {
                $b_first = reset( $b_cats ); 
                echo '<a href="' . esc_url( get_term_link( $b_first ) ) . '" class="breadcrumb-link">' . esc_html( $b_first->name ) . '</a>';
                echo '<span class="breadcrumb-sep"> / </span>';
            }

            // Get and clean the title
            $b_raw_title = get_the_title($b_post_id);
            $b_clean_title = str_replace(array('Private: ', '非公開: '), '', $b_raw_title);
            echo '<span class="breadcrumb-current">' . esc_html( $b_clean_title ) . '</span>';

        } elseif ( is_tax() || is_category() ) {
            echo '<span class="breadcrumb-current">' . single_term_title( '', false ) . '</span>';
        } elseif ( is_page() ) {
            echo '<span class="breadcrumb-current">' . get_the_title() . '</span>';
        }
        ?>
    </div>
</nav>