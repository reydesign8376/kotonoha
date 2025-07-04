const swiper = new Swiper('.swiper.review_container', {
    loop: true,
    autoplay: { delay: 5000, disableOnInteraction: false },
	speed: 3000,
    slidesPerView: 1.2,
    spaceBetween: 20,
    pagination: { el: '.swiper-pagination', clickable: true },
    navigation: { nextEl: '.swiper-button-next', prevEl: '.swiper-button-prev' },
    breakpoints: {
        768: { slidesPerView: 3 }
    }
});
