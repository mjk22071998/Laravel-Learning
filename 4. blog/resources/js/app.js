import './bootstrap';
import './ckeditor5';

import Choices from 'choices.js';;

document.addEventListener("DOMContentLoaded", function () {

    // Handling Categories
    const categorySelect = document.getElementById('cat_id');
    const categoryChoices = new Choices(categorySelect, {
        searchEnabled: true,  // Optional: Enable searching within the dropdown
        removeItemButton: false,  // Optional: Show button to remove selection (only useful if multi-select)
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
