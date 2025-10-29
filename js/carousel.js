let aktuellSlideIndex = 0;
const slides = document.querySelectorAll(".carousel-slide");
const dots = document.querySelectorAll(".dot");

function slideAnzeigen(index) {
    // Versteckt slides
    slides.forEach((slide) => slide.classList.remove("active"));
    dots.forEach((dot) => dot.classList.remove("active"));

    // Zeigt nächste slide
    slides[index].classList.add("active");
    dots[index].classList.add("active");
}

function slideAendern(direction) {
    aktuellSlideIndex += direction;

    // Grenzen
    if (aktuellSlideIndex >= slides.length) {
        aktuellSlideIndex = 0;
    } else if (aktuellSlideIndex < 0) {
        aktuellSlideIndex = slides.length - 1;
    }

    slideAnzeigen(aktuellSlideIndex);
}

function aktuellSlide(index) {
    aktuellSlideIndex = index - 1;
    slideAnzeigen(aktuellSlideIndex);
}

//------------------------------------ Event Listeners ------------------------------ //

const prevButton = document.querySelector(".carousel-btn.prev");
const nextButton = document.querySelector(".carousel-btn.next");

prevButton.addEventListener("click", () => slideAendern(-1));
nextButton.addEventListener("click", () => slideAendern(1));

const dotListe = document.querySelectorAll(".dot");
for (let i = 0; i < dotListe.length; i++) {
    let dot = dotListe[i];
    dot.addEventListener("click", () => aktuellSlide(i + 1));
}
