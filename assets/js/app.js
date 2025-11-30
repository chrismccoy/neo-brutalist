/**
 * Handles gallery switching and interactions.
 */
(function() {
    'use strict';

    document.addEventListener('DOMContentLoaded', () => {
        // Single Item Gallery
        const thumbs = document.querySelectorAll('.thumb-trigger');
        const mainImage = document.getElementById('main-image');

        if (thumbs.length > 0 && mainImage) {
            thumbs.forEach(thumb => {
                thumb.addEventListener('click', (e) => {
                    e.preventDefault();
                    // Swap the src
                    const newSrc = thumb.getAttribute('href');
                    if (newSrc) {
                        mainImage.src = newSrc;
                    }
                });
            });
        }
    });

})();
