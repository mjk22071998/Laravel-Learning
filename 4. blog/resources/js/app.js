import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// Custom JS

document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("form");
    const titleInput = document.getElementById("title");
    const bodyInput = document.getElementById("body");

    form.addEventListener("submit", function (event) {
        /**
         * Form validation started
         */
        // Clear previous error messages
        const errorMessages = form.querySelectorAll(".error-message");
        errorMessages.forEach(msg => msg.remove());

        let isValid = true;

        // Validate title
        if (!titleInput.value.trim()) {
            showError(titleInput, "Post title is required.");
            isValid = false;
        } else if (titleInput.value.length > 100) {
            showError(titleInput, "Post title cannot exceed 100 characters.");
            isValid = false;
        }

        // Validate body
        const wordCount = bodyInput.value.trim().split(/\s+/).length;
        if (!bodyInput.value.trim()) {
            showError(bodyInput, "Post body is required.");
            isValid = false;
        } else if (wordCount < 100) {
            displayError(bodyInput, `Body must have at least 100 words. Current word count: ${wordCount}`);
            isValid = false;
        }

        // Prevent form submission if validation fails
        if (!isValid) {
            event.preventDefault();
        }
    });

    /**
     * Shows an error message below the input element
     * @param {HTMLElement} inputElement - The input element to display an error for
     * @param {string} message - The error message to display
     */
    function showError(inputElement, message) {
        const errorElement = document.createElement("p");
        errorElement.className = "error-message text-red-500 text-sm mt-1";
        errorElement.textContent = message;
        inputElement.insertAdjacentElement("afterend", errorElement);
    }

    /**
     * Min word count of text areas done
     */
    const textareas = document.querySelectorAll("textarea[data-min-words]");    
    textareas.forEach((textarea) => {
        const minWords = parseInt(textarea.dataset.minWords, 10);
        const wordCountIndicator = document.getElementById(`${textarea.id}-word-count`);

        textarea.addEventListener("input", function () {
            // Calculate current word count
            const wordCount = this.value.trim().split(/\s+/).filter((word) => word.length > 0).length;

            // Update word count indicator
            if (wordCountIndicator) {
                if (wordCount < minWords) {
                    wordCountIndicator.textContent = `Min: ${minWords} words (Current: ${wordCount})`;
                    wordCountIndicator.classList.remove("text-green-500");
                    wordCountIndicator.classList.add("text-red-500");
                } else {
                    wordCountIndicator.textContent = `Min: ${minWords} words (Achieved: ${wordCount})`;
                    wordCountIndicator.classList.remove("text-red-500");
                    wordCountIndicator.classList.add("text-green-500");
                }
            }
        });
    });
});
