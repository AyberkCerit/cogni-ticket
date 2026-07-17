document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('create-ticket-form');
    const submitBtn = document.getElementById('submit-btn');
    const descTextarea = document.getElementById('description');
    const charCountDisplay = document.getElementById('char-count');

    // Prevent Double Submission and Show Loading State
    if (form && submitBtn) {
        form.addEventListener('submit', (e) => {
            // Check if form is valid before locking
            if (form.checkValidity()) {
                submitBtn.classList.add('is-loading');
                // Allow the form to submit naturally
            }
        });
    }

    // Live Character Count for Description
    if (descTextarea && charCountDisplay) {
        const updateCharCount = () => {
            const count = descTextarea.value.length;
            charCountDisplay.textContent = `${count} chars`;
            
            // Optional: Change color if very long
            if (count > 500) {
                charCountDisplay.classList.add('text-primary');
                charCountDisplay.classList.remove('text-on-surface-variant/70');
            } else {
                charCountDisplay.classList.remove('text-primary');
                charCountDisplay.classList.add('text-on-surface-variant/70');
            }
        };

        // Run on mount
        updateCharCount();
        
        // Run on input
        descTextarea.addEventListener('input', updateCharCount);
    }
});
