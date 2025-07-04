// GsapScrollTrigger
gsap.registerPlugin(ScrollTrigger);

// ------------------------------
// ① 線アニメーション（.lineAnimation svg path）
// ------------------------------
document.querySelectorAll('.lineAnimation svg path').forEach((path) => {
  const length = path.getTotalLength();
  path.style.strokeDasharray = length;
  path.style.strokeDashoffset = 0;

  gsap.to(path, {
    scrollTrigger: {
      trigger: path.closest(".lineAnimation"),
      start: "top 80%",
    },
    strokeDashoffset: -length,
    duration: 10,
    delay: 2,
    ease: "none",
  });
});

// ------------------------------
// ② フェードインアニメーション（.fade_animation_org）
// ------------------------------
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
      delay: index * 0.2,
      ease: "power2.out",
      scrollTrigger: {
        trigger: el,
        start: "top 80%",
      },
    }
  );
});
