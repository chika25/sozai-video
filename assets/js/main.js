document.addEventListener('DOMContentLoaded', function() {
    const button = document.getElementById('load-more-videos');
    const container = document.querySelector('.video-grid');

    if (!button || !container) return;

    button.addEventListener('click', function() {
        let currentPage = parseInt(button.getAttribute('data-page'));
        let maxPages = parseInt(button.getAttribute('data-max'));

        let term = button.getAttribute('data-term');
        let tax = button.getAttribute('data-tax');

        let formData = new FormData();
        formData.append('action', 'load_more_videos');
        formData.append('page', currentPage + 1);
        formData.append('term', term); // slug
        formData.append('tax', tax);   // taxonomy name

        button.textContent = '読み込み中...';

        // Fetch using the dynamic URL from localize_script
        fetch(sozai_ajax.ajaxurl, {
            method: 'POST',
            body: formData
        })
        .then(res => res.text())
        .then(html => {
            // Trim the response to remove '0' or extra whitespace
            const cleanHtml = html.trim();

            if (cleanHtml !== "0" && cleanHtml.length > 0) {
                container.insertAdjacentHTML('beforeend', cleanHtml);
                button.setAttribute('data-page', currentPage + 1);
                button.textContent = 'もっと見る';

                if (currentPage + 1 >= maxPages) {
                    button.remove();
                }
            } else {
                console.error("AJAX Error: Server returned 0. Check PHP hooks.");
                button.textContent = 'エラーが発生しました';
            }
        })
        .catch(error => {
            console.error("Fetch Error:", error);
        });
    });
});