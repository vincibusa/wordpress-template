document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('booking-modal');
    const closeModalButton = document.getElementById('close-booking-modal');
    // Find the first focusable element within the modal.
    // This selector can be adjusted if the first element is different.
    const firstFocusableElement = modal ? modal.querySelector('input[type="text"], input[type="email"], input[type="tel"], input[type="date"], input[type="time"], select, textarea, button#close-booking-modal') : null;

    const openModalButtons = [
        document.getElementById('open-booking-modal-header'),
        document.getElementById('open-booking-modal-hero')
    ];

    function openModal() {
        if (modal) {
            modal.classList.remove('hidden');
            modal.setAttribute('aria-hidden', 'false'); // Modal is visible
            if (firstFocusableElement) {
                firstFocusableElement.focus(); // Set focus to the first focusable element
            }
        }
    }

    function closeModal() {
        if (modal) {
            modal.classList.add('hidden');
            modal.setAttribute('aria-hidden', 'true'); // Modal is hidden
        }
    }

    openModalButtons.forEach(button => {
        if (button) {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                openModal();
            });
        }
    });

    if (closeModalButton) {
        closeModalButton.addEventListener('click', closeModal);
    }

    if (modal) {
        // Initial state for ARIA
        modal.setAttribute('aria-hidden', 'true');

        modal.addEventListener('click', function (event) {
            // Close if the overlay (modal itself) is clicked
            if (event.target === modal) {
                closeModal();
            }
        });
    }

    // Close modal on Escape key press
    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape' && modal && !modal.classList.contains('hidden')) {
            closeModal();
        }
    });

    // Re-open modal if URL hash indicates an error/success message is being shown
    // This part is specific to the redirect-based feedback.
    // It checks for the hash AND the presence of a feedback message div.
    if (window.location.hash === '#booking-modal') {
        if (modal && modal.classList.contains('hidden')) { // Check if modal is currently hidden
             // Look for specific feedback message elements within the modal
            const feedbackMessage = modal.querySelector('.bg-green-100, .bg-red-100'); 
            if (feedbackMessage) { // Only open if a feedback message is found
                openModal();
            }
        }
    }
});
