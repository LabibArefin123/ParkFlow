function initSessionSearch() {
    const searchInput = document.querySelector(".session-search input");

    if (searchInput) {
        searchInput.addEventListener("input", function () {
            this.classList.toggle(
                "search-active",
                this.value.trim().length > 0,
            );
        });
    }
}

function initSessionFilter() {
    const filterForm = document.querySelector(".session-toolbar");

    if (!filterForm) return;

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
