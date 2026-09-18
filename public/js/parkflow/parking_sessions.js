document.addEventListener("DOMContentLoaded", function () {
    const counters = document.querySelectorAll("[data-count]");

    counters.forEach(function (element, index) {
        const target = parseInt(element.dataset.count || 0);
        const duration = 800;
        const start = performance.now();

        setTimeout(function () {
            function animate(currentTime) {
                const progress = Math.min((currentTime - start) / duration, 1);
                const eased = 1 - Math.pow(1 - progress, 3);

                element.textContent = Math.floor(
                    target * eased,
                ).toLocaleString();

                if (progress < 1) {
                    requestAnimationFrame(animate);
                } else {
                    element.textContent = target.toLocaleString();
                }
            }

            requestAnimationFrame(animate);
        }, index * 100);
    });

    const searchInput = document.querySelector(".session-search input");

    if (searchInput) {
        searchInput.addEventListener("input", function () {
            this.classList.toggle(
                "search-active",
                this.value.trim().length > 0,
            );
        });
    }

    document
        .querySelectorAll(".sessions-table tbody tr")
        .forEach(function (row) {
            row.addEventListener("click", function (event) {
                if (event.target.closest("a,button")) {
                    return;
                }

                const link = row.querySelector(".session-view-btn");

                if (link) {
                    row.style.background = "#f8fafc";

                    setTimeout(function () {
                        window.location.href = link.href;
                    }, 120);
                }
            });
        });

    const filterForm = document.querySelector(".session-toolbar");

    if (filterForm) {
        filterForm.addEventListener("submit", function () {
            document.body.classList.add("sessions-filtering");

            const button = this.querySelector(".session-filter-btn");

            if (button) {
                button.disabled = true;

                button.innerHTML =
                    '<i class="fa-solid fa-spinner fa-spin me-1"></i> Filtering...';
            }
        });
    }
});
