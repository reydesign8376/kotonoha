//水彩アニメーション.
document.addEventListener("DOMContentLoaded", function () {
            const targets = document.querySelectorAll(".suibokuAnimation");

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add("visible");
                    }
                });
            }, {
                threshold: 0.3
            });

            targets.forEach(el => observer.observe(el));
        });
