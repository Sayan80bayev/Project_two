
const genres = document.querySelectorAll('.genre-container a');

genres.forEach(genre => {
    genre.addEventListener('click', activeDeactive);
});

function activeDeactive(){
    genres.forEach(g => {
        if(g !== genre || genre.classList.contains('genre-active')){
            g.classList.remove('genre-active');
        }
    });

    genre.classList.add('genre-active');
}



