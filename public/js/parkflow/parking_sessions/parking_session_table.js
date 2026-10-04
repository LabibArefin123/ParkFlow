function initSessionCounters() {
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
}

function initSessionTable() {
    document
        .querySelectorAll(".sessions-table tbody tr")
        .forEach(function (row) {
            row.addEventListener("mouseenter", function () {
                row.classList.add("session-row-hover");
            });

            row.addEventListener("mouseleave", function () {
                row.classList.remove("session-row-hover");
            });
        });
}
