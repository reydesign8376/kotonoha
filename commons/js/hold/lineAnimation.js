        gsap.registerPlugin(ScrollTrigger); //ScrollTriggerの登録
        document.querySelectorAll('.lineAnimation svg path').forEach((path) => {
            const length = path.getTotalLength(); //線の長さ
            path.style.strokeDasharray = length;
            path.style.strokeDashoffset = 0; // 最初は線が表示されている状態

            gsap.to(path, {
                scrollTrigger: {
                    trigger: path.closest(".lineAnimation"), //ターゲット
                    start: "top 80%", // 表示開始位置
                },
                strokeDashoffset: -length,
                duration: 10,//早さ
				delay: 2,
                ease: "none",
            });
        });
