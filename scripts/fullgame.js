//carousel scripts
let offset = 0;
const sliderLine = document.querySelector('.carousel-line');
const width = 1003;

document.querySelector('.slider-next').addEventListener('click', function(){
    offset = offset + width;
    if (offset > width*2) {
        offset = 0;
    }
    sliderLine.style.left = -offset + 'px';
});

document.querySelector('.slider-prev').addEventListener('click', function () {
    offset = offset - width;
    if (offset < 0) {
        offset = width*2;
    }
    sliderLine.style.left = -offset + 'px';
});

//modal scripts
document.getElementById('openModalBtn').addEventListener('click', openModal);
function openModal() {
    const modal = document.getElementById('modal');
    modal.style.display = 'flex';
    modal.style.zIndex = '1';
}
function closeModal() {
    document.getElementById('modal').style.display = 'none';
}
//delete comfirmation
function confirmDelete(reviewId, gameId, user_id) {
// Use the window.confirm() method to show a confirmation dialog
const isConfirmed = window.confirm("Are you sure you want to delete this review?");

// If the user clicks "OK" in the confirmation dialog, proceed with the delete action
if (isConfirmed) {
    // Redirect to the delete action, passing the review_id and game_id
    window.location.href = `http://localhost/project_two/review/reviewDelete.php?review_id=${reviewId}&user_id=${user_id}&game_id=${gameId}`;
}
}