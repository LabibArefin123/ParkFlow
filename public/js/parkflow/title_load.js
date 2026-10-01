document.addEventListener("DOMContentLoaded", function () {
    const titleElement = document.querySelector("title");
    const pageTitle = document.body.dataset.pageTitle;

    if (!titleElement) return;

    const defaultTitle = "ParkFlow";

    if (pageTitle && pageTitle.trim() !== "") {
        titleElement.textContent = `${pageTitle.trim()} | ${defaultTitle}`;
    }
});
