document.addEventListener('DOMContentLoaded', () => {
    const counters = document.querySelectorAll('.count-up');
    const duration = 1200; // Total animation time in ms (matches bar animation)
    const frameRate = 1000 / 60; // 60 FPS
    const totalFrames = Math.round(duration / frameRate);

    counters.forEach(counter => {
        const target = parseInt(counter.getAttribute('data-target'), 10);
        if (isNaN(target)) return;
        
        let frame = 0;
        const increment = target / totalFrames;
        let current = 0;

        const updateCounter = () => {
            frame++;
            current += increment;
            
            // Use ease-out function for a smoother finish
            const progress = frame / totalFrames;
            const easeOutQuad = 1 - (1 - progress) * (1 - progress);
            const currentValue = Math.round(target * easeOutQuad);

            if (frame < totalFrames) {
                counter.innerText = currentValue;
                requestAnimationFrame(updateCounter);
            } else {
                counter.innerText = target;
            }
        };

        updateCounter();
    });
});
