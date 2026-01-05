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