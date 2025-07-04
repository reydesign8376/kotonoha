// 偶数は右から、奇数は左から遅延させる
gsap.registerPlugin(ScrollTrigger);
document.querySelectorAll(".fade_animation_org").forEach((el, index) => {
  const fromX = index % 2 === 0 ? 100 : -100;

  gsap.fromTo(
    el,
    {
      x: fromX,
      autoAlpha: 0,
    },
    {
      x: 0,
      autoAlpha: 1,
      duration: 1.5,
      delay: index * 0.2, // 遅延
      ease: "power2.out",
      scrollTrigger: {
        trigger: el,
        // toggleActions: "play none none reverse",
        start: "top 80%",
        // markers: true,
      },
    }
  );
});
