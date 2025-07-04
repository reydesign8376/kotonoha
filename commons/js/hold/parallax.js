      //パララックス
            const items = document.querySelectorAll(".parallaxInner");

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

            items.forEach((item, index) => {
                item.style.transitionDelay = `${index * 0.2}s`;
                observer.observe(item);
            });
