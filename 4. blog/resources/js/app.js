import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

document.addEventListener("DOMContentLoaded", function () {
    const dropdownToggle = document.getElementById("dropdown-toggle");
    const dropdownMenu = document.getElementById("dropdown-menu");

    dropdownToggle.addEventListener("click", function (event) {
        event.stopPropagation(); // Prevent event bubbling
        dropdownMenu.classList.toggle("hidden");
    });

    // Close the dropdown if clicked outside
    document.addEventListener("click", function () {
        if (!dropdownMenu.classList.contains("hidden")) {
            dropdownMenu.classList.add("hidden");
        }
    });
});
