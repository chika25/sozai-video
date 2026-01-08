document.addEventListener('DOMContentLoaded', function() {
    const button = document.getElementById('load-more-videos');
    const container = document.querySelector('.video-grid');

    if (!button || !container) return;

    button.addEventListener('click', function() {
        // 1. Get current state from button attributes
        const currentPage = parseInt(button.getAttribute('data-page')) || 1;
        const maxPages = parseInt(button.getAttribute('data-max')) || 1;
        
        // Use || '' to ensure we send a string, not 'null'
        const term = button.getAttribute('data-term') || '';
        const tax = button.getAttribute('data-tax') || '';
        const search = button.getAttribute('data-search') || '';

        // 2. Prepare Data
        const formData = new FormData();
        formData.append('action', 'load_more_videos');
        formData.append('page', currentPage + 1);
        formData.append('term', term);
        formData.append('tax', tax);
        formData.append('search', search);

        button.textContent = '読み込み中...';
        // Prevent double clicks
        button.disabled = true; 

        fetch(sozai_ajax.ajaxurl, {
            method: 'POST',
            body: formData
        })
        .then(res => res.text())
        .then(html => {
            const cleanHtml = html.trim();

            // WordPress AJAX returns '0' on failure, check for that
            if (cleanHtml !== "0" && cleanHtml !== "DONE" && cleanHtml.length > 0) {
                container.insertAdjacentHTML('beforeend', cleanHtml);
                
                button.setAttribute('data-page', currentPage + 1);
                button.textContent = 'もっと見る';
                button.disabled = false;

                if (currentPage + 1 >= maxPages) {
                    button.remove();
                }
            } else {
                // No more posts found
                button.remove();
            }
        })
        .catch(error => {
            console.error("Fetch Error:", error);
            button.textContent = 'エラーが発生しました';
            button.disabled = false;
        });
    });
});

// Video Hover Preview
document.addEventListener('DOMContentLoaded', function() {
    const previewVideos = document.querySelectorAll('.hover-preview');

    previewVideos.forEach(video => {
        const container = video.closest('.video-container');

        container.addEventListener('mouseenter', () => {
            // Start playing
            const playPromise = video.play();
            
            // Browsers sometimes block play() if not initialized correctly
            if (playPromise !== undefined) {
                playPromise.catch(error => {
                    console.log("Autoplay prevented or video failed to load");
                });
            }
        });

        container.addEventListener('mouseleave', () => {
            // Pause and reset to the beginning (or leave at current frame)
            video.pause();
            // Reset to start so poster shows again
            video.currentTime = 0; 
        });
    });
});

// Toggle Menu and Searchbar
document.addEventListener('DOMContentLoaded', function() {
    const menuIcon = document.getElementById("menu-toggle");
    const searchIcon = document.getElementById("search-toggle");
    const menuOverlay = document.getElementById("sidebar-overlay");
    const searchOverlay = document.getElementById("search-overlay");

    menuIcon.addEventListener('click', function() {
        this.classList.toggle('open');
        menuOverlay.classList.toggle('show');
        menuOverlay.classList.toggle('hide');

        searchIcon.classList.toggle('hidden');
        document.body.classList.toggle('no-scroll');
    });

    searchIcon.addEventListener('click', function() {
        this.classList.toggle('open');
        searchOverlay.classList.toggle('show');
        searchOverlay.classList.toggle('hide');

        menuIcon.classList.toggle('hidden');
        document.body.classList.toggle('no-scroll');
    });
});