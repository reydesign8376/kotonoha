// オープニングアニメーション
window.addEventListener('DOMContentLoaded', () => {
  const pageOpening = document.querySelector('.pageOpening');
  if (!pageOpening) return;

  const openingDuration = 2000;

  setTimeout(() => {
    pageOpening.classList.add('hidden');

    setTimeout(() => {
      pageOpening.classList.add('removed');
    }, 1000); // .hidden の transition と合わせて 1秒後
  }, openingDuration);
});
