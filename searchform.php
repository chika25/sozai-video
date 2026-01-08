<?php $unique_id = 'search-form-' . uniqid(); ?>

<form role="search" method="get" name="search" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <label for="<?php echo $unique_id; ?>">
        <span class="screen-reader-text">検索:</span>
        <input type="search" id="<?php echo $unique_id; ?>" class="search-field" placeholder="" value="<?php echo get_search_query(); ?>" name="s" />
    </label>
    <button type="submit" class="search-submit">
        <i class="fa fa-search"></i> </button>
</form>