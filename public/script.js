document.addEventListener('DOMContentLoaded', () => {
    const accordionHeaders = document.querySelectorAll('.accordion-header');

    accordionHeaders.forEach(header => {
        // Initialize expanded state on load
        if (header.getAttribute('aria-expanded') === 'true') {
            const content = header.nextElementSibling;
            content.style.maxHeight = content.scrollHeight + "px";
        }

        header.addEventListener('click', () => {
            const content = header.nextElementSibling;
            const isExpanded = header.getAttribute('aria-expanded') === 'true';

            // Optional: Close all other open accordions (Accordion behavior vs Collapsible)
            // Uncomment the following lines if you want only one item open at a time
            /*
            document.querySelectorAll('.accordion-header').forEach(otherHeader => {
                if (otherHeader !== header) {
                    otherHeader.setAttribute('aria-expanded', 'false');
                    otherHeader.nextElementSibling.style.maxHeight = null;
                }
            });
            */

            // Toggle current accordion state
            header.setAttribute('aria-expanded', !isExpanded);

            // Animate max-height
            if (!isExpanded) {
                // Expanding
                content.style.maxHeight = content.scrollHeight + "px";
            } else {
                // Collapsing
                content.style.maxHeight = null;
            }
        });
    });
});
