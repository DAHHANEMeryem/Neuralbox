document.addEventListener("DOMContentLoaded", function () {
    const observerOptions = {
        threshold: 0.2 // Déclenche l'animation quand 20% de la section est visible
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-visible');
            }
        });
    }, observerOptions);

    // On cible toutes les sections "About"
    document.querySelectorAll('.about-us-section').forEach(section => {
        observer.observe(section);
    });
});


document.addEventListener("DOMContentLoaded", function () {

    // ===== REVEAL =====
    const revealObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-visible');
                revealObserver.unobserve(entry.target);
            }
        });
    }, { threshold: 0.15 });

    document.querySelectorAll('.reveal').forEach(el => 
        revealObserver.observe(el)
    );

    const target = document.querySelector('.animated-steps');
    if (target) {
        revealObserver.observe(target);
    }

    // ===== LIGHTBOX =====
    const lightbox = document.getElementById("videoLightbox");
    const video = document.getElementById("player");

    window.openVideo = function () {
        if (!lightbox || !video) return;

        lightbox.style.display = "block";

        setTimeout(() => {
            lightbox.style.opacity = "1";
        }, 50);

        document.body.classList.add("no-scroll");
        video.play();
    };

    window.closeVideo = function () {
        if (!lightbox || !video) return;

        lightbox.style.opacity = "0";

        setTimeout(() => {
            lightbox.style.display = "none";
            video.pause();
            video.currentTime = 0;
            document.body.classList.remove("no-scroll");
        }, 300);
    };

    if (lightbox) {
        lightbox.addEventListener('click', function (e) {
            if (e.target === lightbox) {
                closeVideo();
            }
        });
    }

    // ===== HERO VIDEO =====
    const heroVideo = document.getElementById("heroBoxVideo");
    if (heroVideo) {
        heroVideo.play().catch(() => {});
    }
});