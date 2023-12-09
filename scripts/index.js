const cards = document.querySelectorAll('.slider-card');

        // Add click event listeners to slider cards for selection
        cards.forEach(card => {
            card.addEventListener('click', () => {
                cards.forEach(c => {
                    if (c !== card) {
                        c.classList.remove('active');
                    }
                });

                card.classList.add('active');
            });
        });

        // Carousel-moving script
        let offset = 0;
        const sliderLine = document.querySelector('.carousel-line');
        const width = 500;
        let isUserInteracted = false; // Flag to track user interaction

        // Set the initial position of the carousel line
        sliderLine.style.top = offset + 'px';

        function moveSliderNext() {
            offset = offset - width;
            if (offset < -width * (document.querySelectorAll('.poster').length - 1)) {
                offset = 0;
            }
            sliderLine.style.top = offset + 'px';
            isUserInteracted = true; // Set the flag to true
        }

        function moveSliderPrev() {
            offset = offset + width;
            if (offset > 0) {
                offset = -width * (document.querySelectorAll('.poster').length - 1);
            }
            sliderLine.style.top = offset + 'px';
            isUserInteracted = true; // Set the flag to true
        }

        // Add click event listeners to carousel navigation buttons
        document.querySelector('.slider-next').addEventListener('click', function () {
            moveSliderNext();
        });

        document.querySelector('.slider-prev').addEventListener('click', function () {
            moveSliderPrev();
        });

        // Automatically move the slider every 7 seconds, but only if the user has not interacted
        setInterval(function () {
            if (!isUserInteracted) {
                moveSliderNext();
            }
            isUserInteracted = false; // Reset the flag after the automatic movement
        }, 7000);