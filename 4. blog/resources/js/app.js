import './bootstrap';

import Alpine from 'alpinejs';
import Choices from 'choices.js';

window.Alpine = Alpine;

Alpine.start();

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
            console.log("title error");
            showError(titleInput, "Post title is required.");
            isValid = false;
        } else if (titleInput.value.length > 100) {
            console.log("title error");
            showError(titleInput, "Post title cannot exceed 100 characters.");
            isValid = false;
        }

        // Validate body
        const wordCount = bodyInput.value.trim().split(/\s+/).length;
        if (!bodyInput.value.trim()) {
            console.log("body error");
            showError(bodyInput, "Post body is required.");
            isValid = false;
        } else if (wordCount < 100) {
            console.log("body error");
            displayError(bodyInput, `Body must have at least 100 words. Current word count: ${wordCount}`);
            isValid = false;
        }

        // Prevent form submission if validation fails
        if (!isValid) {
            console.log("no default");
            event.preventDefault();
        }
        console.log("default");
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

        // Function to update the word count indicator
        function updateWordCount() {
            const wordCount = textarea.value.trim().split(/\s+/).filter((word) => word.length > 0).length;

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
        }

        // Add input event listener for live word count updates
        textarea.addEventListener("input", updateWordCount);

        // Trigger the update function when the page loads to set initial word count
        updateWordCount(); // This will update the word count on page load

    });

    // Handling Categories
    const categorySelect = document.getElementById('cat_id');
    const categoryChoices = new Choices(categorySelect, {
        searchEnabled: true,  // Optional: Enable searching within the dropdown
        removeItemButton: true,  // Optional: Show button to remove selection (only useful if multi-select)
    });

    // Handling Tags
    const tagSelect = document.getElementById("tags");
    const tagLimitMessage = document.getElementById("tag-limit-message");

    // Initialize Choices.js with max item limit
    const choices = new Choices(tagSelect, {
        removeItemButton: true,
        maxItemCount: 5, // Limit to 5 tags
        searchEnabled: true,
        placeholderValue: "Select up to 5 tags",
    });

    // Listen for item add/remove events to manage error message
    tagSelect.addEventListener("change", function () {
        if (choices.getValue(true).length > 5) {
            // Show error message
            tagLimitMessage.classList.remove("hidden");
        } else {
            // Hide error message
            tagLimitMessage.classList.add("hidden");
        }
    });
});
