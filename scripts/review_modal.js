// Event listener for opening modals
document.querySelectorAll('.three-dots-button.openModalBtn').forEach(function(button) {
    button.addEventListener('click', openModal);
});

// Function to open modals
function openModal(event) {
    const button = event.currentTarget;
    const modal = button.nextElementSibling; // Assuming the modal is the next sibling
    modal.style.display = 'flex';
    modal.style.zIndex = '1';
}

// Function to close modals
function closeModal(event) {
    const closeBtn = event.currentTarget;
    const modal = closeBtn.closest('.modal');
    modal.style.display = 'none';
}

// Function for delete confirmation
function confirmDelete(reviewId, userId, gameId) {
    const isConfirmed = window.confirm("Are you sure you want to delete this review?");
    if (isConfirmed) {
        window.location.href = `http://localhost/project_two/review/reviewDelete.php?review_id=${reviewId}&user_id=${userId}&game_id=${gameId}`;
    }
}