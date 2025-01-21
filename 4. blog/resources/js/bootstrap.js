import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// Editable functionality
window.makeEditable = (element) => {
    if (!element.dataset.originalContent) {
        element.dataset.originalContent = element.innerText.trim();
    }
    element.contentEditable = "true";
    element.focus();
    console.log("Editable");
    element.classList.add('bg-yellow-100'); // Highlight the editable cell
};

window.handleEnter = (event, element, model) => {
    if (event.key === "Enter") {
        event.preventDefault(); // Prevent newline in contenteditable
        console.log("Enter key handled");
        window.saveChanges(element, model);
    }
};

window.saveChanges = async (element, model) => {
    const itemId = element.getAttribute('data-id'); // Fetch the model ID
    const originalContent = element.dataset.originalContent || element.innerText.trim();
    const updatedContent = element.innerText.trim();

    console.log(`${itemId}, ${updatedContent}, ${originalContent}`); // Debugging line

    // Prevent saving if there's no change
    if (originalContent === updatedContent) {
        console.log("No changes made");
        element.contentEditable = "false";
        element.classList.remove('bg-yellow-100');
        return;
    }

    try {
        axios.put(`/${model}/${itemId}`, { name: updatedContent })
            .then(response => {
                if (response.status === 200) {
                    console.log("Changes saved successfully");

                    element.contentEditable = "false";
                    element.classList.remove('bg-yellow-100');

                    element.dataset.originalContent = updatedContent; // Update the stored original content
                } else {
                    throw new Error('Update failed');
                }
            })
            .catch(error => {
                console.error(error.response?.data?.message || error.message);

                element.innerText = originalContent;
                element.contentEditable = "false";
                element.classList.remove('bg-yellow-100');
            });
    } catch (error) {
        console.error(error);
        element.innerText = originalContent;
        element.contentEditable = "false";
        element.classList.remove('bg-yellow-100');
    }
};