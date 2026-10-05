(() => {
    const carousel = document.querySelector('.review-carousel');
    if (!carousel) {
        return;
    }

    const cards = Array.from(carousel.children);
    if (cards.length === 0) {
        return;
    }
    const pauseButton = document.querySelector('[data-review-pause]');
    const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)');
    let paused = reducedMotion.matches;

    function updatePauseButton() {
        pauseButton.textContent = paused ? 'Play' : 'Pause';
        pauseButton.setAttribute('aria-pressed', String(paused));
    }

    function moveReview(direction) {
        const leftEdge = cards[0].getBoundingClientRect().left;
        const currentIndex = cards.reduce((nearest, card, index) => {
            return Math.abs(card.getBoundingClientRect().left - leftEdge - carousel.scrollLeft)
                < Math.abs(cards[nearest].getBoundingClientRect().left - leftEdge - carousel.scrollLeft) ? index : nearest;
        }, 0);
        const atEnd = carousel.scrollLeft >= carousel.scrollWidth - carousel.clientWidth - 2;
        const nextIndex = direction > 0 && atEnd ? 0 : (currentIndex + direction + cards.length) % cards.length;
        carousel.scrollTo({
            left: cards[nextIndex].getBoundingClientRect().left - leftEdge,
            behavior: reducedMotion.matches ? 'auto' : 'smooth',
        });
    }

    document.querySelector('[data-review-previous]').addEventListener('click', () => moveReview(-1));
    document.querySelector('[data-review-next]').addEventListener('click', () => moveReview(1));
    pauseButton.addEventListener('click', () => {
        paused = !paused;
        updatePauseButton();
    });
    reducedMotion.addEventListener('change', () => {
        paused = reducedMotion.matches;
        updatePauseButton();
    });
    updatePauseButton();
    window.setInterval(() => {
        if (!paused && !document.hidden) {
            moveReview(1);
        }
    }, 4000);
})();
