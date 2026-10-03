document.addEventListener("DOMContentLoaded", function () {
    const wrapper = document.getElementById("parkflowAccountWrapper");
    const toggle = document.getElementById("parkflowAccountToggle");
    const dropdown = document.getElementById("parkflowAccountDropdown");
    if (!wrapper || !toggle || !dropdown) return;
    function openDropdown() {
        dropdown.classList.add("is-open");
        toggle.setAttribute("aria-expanded", "true");
    }
    function closeDropdown() {
        dropdown.classList.remove("is-open");
        toggle.setAttribute("aria-expanded", "false");
    }
    toggle.addEventListener("click", function (event) {
        event.stopPropagation();
        dropdown.classList.contains("is-open")
            ? closeDropdown()
            : openDropdown();
    });
    document.addEventListener("click", function (event) {
        if (!wrapper.contains(event.target)) closeDropdown();
    });
    document.addEventListener("keydown", function (event) {
        if (event.key === "Escape") {
            closeDropdown();
            toggle.focus();
        }
    });
});
