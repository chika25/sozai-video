<div class="category-container">
   <?php
    $terms = get_terms( array(
        'taxonomy' => 'video_category',
        'hide_empty' => false,
    ) );

    // Check if terms exist and there is no error before looping
    if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
        foreach ( $terms as $term ) {
            echo '<a href="' . get_term_link( $term ) . '" class="category-chip">' . $term->name . '</a>';
        }
    }
    ?>
</div>