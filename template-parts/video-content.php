<?php 
    $url = get_post_meta(get_the_ID(), '_video_url', true); 
    $thumbnail = get_the_post_thumbnail_url(get_the_ID(), 'large');
?>  

<article class="video-card">
    <a href="<?php echo esc_url( get_permalink() ); ?>">
        <div class="video-container">
            <?php if ( ! empty( $url ) ) : ?>
                <video 
                    class="hover-preview" 
                    muted 
                    loop 
                    preload="metadata" 
                    poster="<?php echo esc_url($thumbnail_url); ?>"
                    playsinline
                >
                    <source src="<?php echo esc_url($url); ?>" type="video/mp4">
                </video>
            <?php endif; ?>
            <div class="video-overlay">
                <h3 class="video-title"> <?php echo get_the_title(); ?></h3>
            </div>
        </div>
    </a>
</article>