$(function () {

    // ================= HEADER SCROLL =================
    $(window).scroll(function () {
        if ($(window).scrollTop() >= 60) {
            $("header").addClass("fixed-header");
        } else {
            $("header").removeClass("fixed-header");
        }
    });


    // ================= TOOLTIP =================
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    tooltipTriggerList.forEach((el) => {
        new bootstrap.Tooltip(el);
    });


    // ================= COUNT =================
    $('.count').each(function () {
        $(this).prop('Counter', 0).animate({
            Counter: $(this).text()
        }, {
            duration: 1000,
            easing: 'swing',
            step: function (now) {
                $(this).text(Math.ceil(now));
            }
        });
    });


    // ================= SCROLL TO TOP =================
    function scrollToTop() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    }

    const btn = document.getElementById("scrollToTopBtn");

    // ✅ SAFE CHECK
    if (btn) {
        btn.addEventListener("click", scrollToTop);

        window.addEventListener("scroll", function () {
            if (document.documentElement.scrollTop > 100 || document.body.scrollTop > 100) {
                btn.style.display = "flex";
            } else {
                btn.style.display = "none";
            }
        });
    }


    // ================= AOS =================
    if (typeof AOS !== "undefined") {
        AOS.init({
            once: true,
        });
    }


    // ================= NAV HIGHLIGHT =================
    const sections = document.querySelectorAll("section[id]");

    function navHighlighter() {

        let scrollY = window.pageYOffset;

        sections.forEach(current => {
            const sectionHeight = current.offsetHeight;
            const sectionTop = current.offsetTop - 100;
            const sectionId = current.getAttribute("id");

            if (!sectionId) return;

            const navLink = document.querySelector(
                `.navbar-collapse a[href*="${sectionId}"]`
            );

            // ✅ MOST IMPORTANT FIX
            if (!navLink) return;

            if (
                scrollY > sectionTop &&
                scrollY <= sectionTop + sectionHeight
            ) {
                navLink.classList.add("active");
            } else {
                navLink.classList.remove("active");
            }
        });
    }

    // Run safely
    if (sections.length) {
        window.addEventListener("scroll", navHighlighter);
        navHighlighter();
    }

});