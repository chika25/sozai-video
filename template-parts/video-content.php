<?php 
    $cf_url = "https://d39p1mizur7cgj.cloudfront.net";
    $filename = get_post_meta(get_the_ID(), '_video_name', true);
    $preview_video = $cf_url . "/videos/previews/" . $filename . ".mp4";
    $thumbnail = $cf_url . "/images/thumbs/" . $filename . "-thumbnail" . ".webp";
    $alttext = get_post_meta(get_the_ID(), '_alt_text', true);
?>  

<article class="video-card">
    <a href="<?php echo esc_url( get_permalink() ); ?>">
        <div class="video-container">
            <?php if ( ! empty( $preview_video ) ) : ?>
                <video 
                    class="hover-preview" 
                    muted 
                    loop 
                    preload="metadata" 
                    poster="<?php echo esc_url($thumbnail); ?>"
                    aria-label="<?php echo esc_html($alttext); ?>"
                    playsinline
                >
                    <source src="<?php echo esc_url($preview_video); ?>" type="video/mp4">
                </video>
            <?php endif; ?>
            <div class="video-overlay">
                <h3 class="video-title"> <?php echo get_the_title(); ?></h3>
            </div>
        </div>
    </a>
</article>