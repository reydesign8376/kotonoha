const swiper = new Swiper(".closingSlid-section .swiper", {
  loop: true, // ループ有効
  slidesPerView: 2.5,
  breakpoints: {
    1024:{
slidesPerView: 4.5,
    },
  },
  speed: 10000, // ループの時間
  allowTouchMove: false, // スワイプ無効
  autoplay: {
    delay: 0, // 途切れなくループ
  },
});
