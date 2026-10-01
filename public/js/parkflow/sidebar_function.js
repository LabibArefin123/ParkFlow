document.addEventListener("DOMContentLoaded", function () {
    const sidebar = document.getElementById("parkflowSidebar");
    const overlay = document.getElementById("parkflowSidebarOverlay");
    const toggle = document.getElementById("parkflowSidebarToggle");
    const close = document.getElementById("parkflowSidebarClose");

    function openSidebar() {
        if (sidebar) sidebar.classList.add("open");
        if (overlay) overlay.classList.add("show");
        document.body.classList.add("sidebar-open");
    }

    function closeSidebar() {
        if (sidebar) sidebar.classList.remove("open");
        if (overlay) overlay.classList.remove("show");
        document.body.classList.remove("sidebar-open");
    }

    if (toggle) {
        toggle.addEventListener("click", openSidebar);
    }

    if (close) {
        close.addEventListener("click", closeSidebar);
    }

    if (overlay) {
        overlay.addEventListener("click", closeSidebar);
    }

    document
        .querySelectorAll(".parkflow-sidebar-link")
        .forEach(function (link) {
            link.addEventListener("click", function () {
                if (window.innerWidth <= 768) {
                    closeSidebar();
                }
            });
        });

    window.addEventListener("resize", function () {
        if (window.innerWidth > 768) {
            closeSidebar();
        }
    });
});
