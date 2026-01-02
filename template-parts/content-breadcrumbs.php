<?php
// hides on home page
if ( is_front_page()) {
    return; 
}
?>

<nav class="breadcrumbs" aria-label="Breadcrumb">
    <div class="breadcrumb-container">
        <a href="<?php echo home_url(); ?>" class="breadcrumb-link">Home</a>
        <span class="breadcrumb-sep">/</span>

        <?php 
        if ( is_single() ) {
            // get Video Category first
            $terms = get_the_terms( get_the_ID(), 'video_category' );
            
            // Fallback: If no category, try keywords
            if ( ! $terms || is_wp_error( $terms ) ) {
                $terms = get_the_terms( get_the_ID(), 'video_keyword' );
            }

            // Fallback: If still no terms, check standard blog categories
            if ( ! $terms || is_wp_error( $terms ) ) {
                $terms = get_the_terms( get_the_ID(), 'category' );
            }

            if ( ! empty( $terms ) ) {
                $first_term = array_shift( $terms );
                echo '<a href="' . esc_url( get_term_link( $first_term ) ) . '" class="breadcrumb-link">' . esc_html( $first_term->name ) . '</a>';
                echo '<span class="breadcrumb-sep">/</span>';
            }

            echo '<span class="breadcrumb-current">' . get_the_title() . '</span>';

        } elseif ( is_tax('video_category') || is_tax('video_keyword') || is_category() ) {
            // 3. Archive Pages (Category or Keyword lists)
            echo '<span class="breadcrumb-current">' . single_term_title( '', false ) . '</span>';

        } elseif ( is_page() ) {
            // 4. Static Pages
            echo '<span class="breadcrumb-current">' . get_the_title() . '</span>';
        }
        ?>
    </div>
</nav>