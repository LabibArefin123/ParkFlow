document.addEventListener("DOMContentLoaded", function () {
    const page = document.querySelector(".vehicle-entry-page");
    const buttons = document.querySelectorAll(".view-toggle-btn");
    if (!page || !buttons.length) return;
    const savedView =
        localStorage.getItem("parkflowVehicleEntryView") || "normal";
    setView(savedView);
    buttons.forEach((button) => {
        button.addEventListener("click", function () {
            setView(this.dataset.view);
        });
    });
    function setView(view) {
        page.classList.toggle("table-mode", view === "table");
        buttons.forEach((button) => {
            button.classList.toggle("active", button.dataset.view === view);
        });
        localStorage.setItem("parkflowVehicleEntryView", view);
    }
});
