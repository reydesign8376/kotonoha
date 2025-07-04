
const bottomMenu = document.querySelector(".floatingC_wrap");
    const appearTarget = document.querySelector(".appear");
    let lastScrollY = window.scrollY;
    let isFloatingVisible = false; // 一度表示したかどうか

    // 初期状態で非表示
    bottomMenu.style.display = "none";

    // Intersection Observer で .appear に入ったら表示
    if (appearTarget) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting && !isFloatingVisible) {
                    bottomMenu.style.display = "block";
                    isFloatingVisible = true;
                }
            });
        });
        observer.observe(appearTarget);
    }

    // スクロールによる .hide 切り替え
    window.addEventListener("scroll", function () {
        if (!isFloatingVisible) return; // まだ表示されてないなら処理しない

        let currentScrollY = window.scrollY;

        if (currentScrollY > lastScrollY) {
            bottomMenu.classList.add("hide"); // 下スクロール
        } else {
            bottomMenu.classList.remove("hide"); // 上スクロール
        }

        lastScrollY = currentScrollY;
    });
