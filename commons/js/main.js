// ------------------------------
// ① オープニングアニメーション
// ------------------------------
const pageOpening = document.querySelector('.pageOpening');
if (pageOpening) {
  const openingDuration = 2000;

  setTimeout(() => {
    pageOpening.classList.add('hidden');

    setTimeout(() => {
      pageOpening.classList.add('removed');
    }, 1000);
  }, openingDuration);
}

// ------------------------------
// ③ 水彩アニメーション
// ------------------------------
const suibokuTargets = document.querySelectorAll(".suibokuAnimation");

if (suibokuTargets.length > 0) {
  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add("visible");
      }
    });
  }, {
    threshold: 0.3
  });

  suibokuTargets.forEach(el => observer.observe(el));
}

// ------------------------------
// ④ パララックスアニメーション
// ------------------------------
const parallaxItems = document.querySelectorAll(".parallaxInner");

if (parallaxItems.length > 0) {
  const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        const target = entry.target;
        target.classList.add("visible");
        observer.unobserve(target);
      }
    });
  }, {
    threshold: 0.1
  });

  parallaxItems.forEach((item, index) => {
    item.style.transitionDelay = `${index * 0.2}s`;
    observer.observe(item);
  });
}
