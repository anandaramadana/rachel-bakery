const scrollRevealOption = {
    distance: "50px",
    origin: "bottom",
    duration: 1000,
};

ScrollReveal().reveal(".header-container .section-subheader", {
    ...scrollRevealOption,
  });

ScrollReveal().reveal(".header-container h1", {
    ...scrollRevealOption,
    delay: 500,
});

ScrollReveal().reveal(".header-container .carousel-btn", {
    ...scrollRevealOption,
    delay: 1000,
});
