import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

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

window.handleEnter = (event, element) => {
    if (event.key === "Enter") {
        event.preventDefault(); // Prevent newline in contenteditable
        console.log("Enter key handled");
        window.saveChanges(element);
    }
};

window.saveChanges = async (element) => {
    const subjectId = element.getAttribute('data-id'); // Fetch the subject ID
    const originalContent = element.dataset.originalContent || element.innerText.trim();
    const updatedContent = element.innerText.trim();

    console.log(`${subjectId}, ${updatedContent}, ${originalContent}`); // Debugging line

    // Prevent saving if there's no change
    if (originalContent === updatedContent) {
        console.log("No changes made");
        element.contentEditable = "false";
        element.classList.remove('bg-yellow-100');
        return;
    }

    try {
        axios.put(`/subject/${subjectId}`, { name: updatedContent })
            .then(response => {
                if (response.status === 200) {
                    // Successfully saved changes
                    console.log("Changes saved successfully");

                    // Make the content non-editable again
                    element.contentEditable = "false";
                    element.classList.remove('bg-yellow-100');

                    // Show success toast
                    showToast('Subject updated successfully!', 'success');

                    // Update the stored original content with the new content
                    element.dataset.originalContent = updatedContent; // Update the stored original content
                } else {
                    // If the response status is not 200, handle it as an error
                    console.error("Failed to save changes");
                    throw new Error('Update failed');
                }
            })
            .catch(error => {
                console.error(error.response?.data?.message || error.message);

                // Revert changes on error
                element.innerText = originalContent;
                element.contentEditable = "false";
                element.classList.remove('bg-yellow-100');

                // Show error toast
                showToast('Failed to update subject. Please try again.', 'error');
            });
    } catch (error) {
        console.error(error);

        // Revert changes on error
        element.innerText = originalContent;
        element.contentEditable = "false";
        element.classList.remove('bg-yellow-100');

        // Show error toast
        showToast('Failed to update subject. Please try again.', 'error');
    }

};


window.showToast = (message, type) => {
    const toast = document.createElement('div');
    toast.className = `fixed top-4 right-4 px-4 py-2 rounded shadow-lg text-white ${
        type === 'success' ? 'bg-green-500' : 'bg-red-500'
    }`;
    toast.innerText = message;

    document.body.appendChild(toast);

    setTimeout(() => {
        toast.remove();
    }, 3000); // Remove toast after 3 seconds
};