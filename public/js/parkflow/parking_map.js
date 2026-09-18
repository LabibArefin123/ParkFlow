document.addEventListener("DOMContentLoaded", function () {
    const stats = document.querySelectorAll("[data-count]");
    const floorTabs = document.querySelectorAll(".floor-tab");
    const floorMaps = document.querySelectorAll(".floor-map");
    const searchInput = document.getElementById("parkingSpotSearch");
    const locationSelect = document.getElementById("parkingLocationSelect");
    const refreshButton = document.getElementById("parkingMapRefresh");
    const detailPanel = document.getElementById("spotDetailPanel");
    const closeDetail = document.getElementById("closeSpotDetail");

    function animateNumber(element) {
        const target = parseInt(element.dataset.count || 0);
        const duration = 900;
        const start = performance.now();

        function update(currentTime) {
            const progress = Math.min((currentTime - start) / duration, 1);
            const eased = 1 - Math.pow(1 - progress, 3);
            element.textContent = Math.floor(target * eased).toLocaleString();

            if (progress < 1) {
                requestAnimationFrame(update);
            } else {
                element.textContent = target.toLocaleString();
            }
        }

        requestAnimationFrame(update);
    }

    stats.forEach(function (element, index) {
        setTimeout(function () {
            animateNumber(element);
        }, index * 80);
    });

    floorTabs.forEach(function (tab) {
        tab.addEventListener("click", function () {
            const selectedFloor = this.dataset.floor;

            floorTabs.forEach(function (item) {
                item.classList.remove("active");
            });

            this.classList.add("active");

            floorMaps.forEach(function (map) {
                const isSelected = map.dataset.floorMap === selectedFloor;

                if (isSelected) {
                    map.style.display = "block";

                    const spots = map.querySelectorAll(".parking-spot");

                    spots.forEach(function (spot, index) {
                        spot.style.animation = "none";

                        requestAnimationFrame(function () {
                            spot.style.animation = `spotAppear .4s ease ${index * 30}ms both`;
                        });
                    });
                } else {
                    map.style.display = "none";
                }
            });

            if (searchInput) {
                searchInput.value = "";
                filterSpots("");
            }
        });
    });

    function filterSpots(value) {
        const search = value.toLowerCase().trim();
        const activeMap =
            document.querySelector('.floor-map[style*="display: block"]') ||
            document.querySelector('.floor-map:not([style*="display: none"])');

        if (!activeMap) {
            return;
        }

        const spots = activeMap.querySelectorAll(".parking-spot");

        spots.forEach(function (spot) {
            const number = spot.dataset.spot || "";
            const type = spot.dataset.type || "";
            const status = spot.dataset.status || "";

            const match =
                !search ||
                number.includes(search) ||
                type.includes(search) ||
                status.includes(search);

            spot.style.display = match ? "block" : "none";
        });
    }

    if (searchInput) {
        searchInput.addEventListener("input", function () {
            filterSpots(this.value);
        });
    }

    document.querySelectorAll(".parking-spot").forEach(function (spot) {
        spot.addEventListener("click", function () {
            document.getElementById("detailSpotNumber").textContent =
                this.dataset.number || "-";
            document.getElementById("detailLocation").textContent =
                this.dataset.location || "-";
            document.getElementById("detailFloor").textContent =
                this.dataset.floor || "-";
            document.getElementById("detailType").textContent = formatText(
                this.dataset.type,
            );
            document.getElementById("detailStatus").textContent = formatText(
                this.dataset.status,
            );

            const statusElement = document.getElementById("detailSpotStatus");
            const status = this.dataset.status;

            statusElement.className = "spot-detail-status";

            if (status === "available") {
                statusElement.innerHTML =
                    '<i class="fa-solid fa-circle-check"></i> Available';
                statusElement.style.background = "#ecfdf5";
                statusElement.style.color = "#059669";
            }

            if (status === "occupied") {
                statusElement.innerHTML =
                    '<i class="fa-solid fa-car-side"></i> Occupied';
                statusElement.style.background = "#fef2f2";
                statusElement.style.color = "#dc2626";
            }

            if (status === "reserved") {
                statusElement.innerHTML =
                    '<i class="fa-solid fa-bookmark"></i> Reserved';
                statusElement.style.background = "#fffbeb";
                statusElement.style.color = "#d97706";
            }

            if (status === "maintenance") {
                statusElement.innerHTML =
                    '<i class="fa-solid fa-wrench"></i> Maintenance';
                statusElement.style.background = "#f5f3ff";
                statusElement.style.color = "#7c3aed";
            }

            detailPanel.classList.add("show");
        });
    });

    function formatText(value) {
        if (!value) {
            return "-";
        }

        return value.replace(/[-_]/g, " ").replace(/\b\w/g, function (letter) {
            return letter.toUpperCase();
        });
    }

    if (closeDetail) {
        closeDetail.addEventListener("click", function () {
            detailPanel.classList.remove("show");
        });
    }

    document.addEventListener("click", function (event) {
        if (
            detailPanel &&
            detailPanel.classList.contains("show") &&
            !detailPanel.contains(event.target) &&
            !event.target.closest(".parking-spot")
        ) {
            detailPanel.classList.remove("show");
        }
    });

    if (refreshButton) {
        refreshButton.addEventListener("click", function () {
            refreshButton.classList.add("is-loading");
            refreshButton.disabled = true;

            document
                .querySelectorAll(".parking-spot")
                .forEach(function (spot, index) {
                    spot.style.animation = "none";

                    setTimeout(function () {
                        spot.style.animation = `spotAppear .45s ease ${index * 20}ms both`;
                    }, 20);
                });

            setTimeout(function () {
                refreshButton.classList.remove("is-loading");
                refreshButton.disabled = false;
            }, 800);
        });
    }

    if (locationSelect) {
        locationSelect.addEventListener("change", function () {
            const locationId = this.value;

            if (!locationId) {
                return;
            }

            const url = new URL(window.location.href);

            url.searchParams.set("location", locationId);

            document.body.classList.add("parking-map-loading");

            setTimeout(function () {
                window.location.href = url.toString();
            }, 250);
        });
    }
});
