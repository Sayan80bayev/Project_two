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
