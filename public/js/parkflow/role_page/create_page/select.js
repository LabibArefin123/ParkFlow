document.addEventListener("DOMContentLoaded", function () {
    const selectAll = document.getElementById("selectAllPermissions");
    const checkboxes = document.querySelectorAll(".permission-checkbox");

    if (selectAll) {
        selectAll.addEventListener("change", function () {
            checkboxes.forEach(function (checkbox) {
                checkbox.checked = selectAll.checked;
            });
        });

        checkboxes.forEach(function (checkbox) {
            checkbox.addEventListener("change", function () {
                selectAll.checked = [...checkboxes].every(function (item) {
                    return item.checked;
                });
            });
        });
    }
});
