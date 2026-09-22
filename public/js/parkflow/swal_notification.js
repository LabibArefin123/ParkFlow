/* =========================================================
   ParkFlow Premium Notifications
   ========================================================= */

document.addEventListener("DOMContentLoaded", function () {
    if (typeof Swal === "undefined") {
        return;
    }

    window.ParkFlowNotify = function (type, title, message) {
        const config = {
            success: {
                icon: "fa-solid fa-circle-check",
                className: "parkflow-toast",
            },
            error: {
                icon: "fa-solid fa-circle-xmark",
                className: "parkflow-toast parkflow-toast-error",
            },
            warning: {
                icon: "fa-solid fa-triangle-exclamation",
                className: "parkflow-toast parkflow-toast-warning",
            },
            info: {
                icon: "fa-solid fa-circle-info",
                className: "parkflow-toast parkflow-toast-info",
            },
        };

        const selected = config[type] || config.info;

        Swal.fire({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            showCloseButton: false,
            timer: 4500,
            timerProgressBar: false,
            customClass: {
                popup: selected.className,
            },
            html: `
                <div class="parkflow-toast-body">
                    <div class="parkflow-toast-icon">
                        <i class="${selected.icon}"></i>
                    </div>

                    <div class="parkflow-toast-content">
                        <div class="parkflow-toast-title">
                            ${title}
                        </div>

                        <div class="parkflow-toast-message">
                            ${message}
                        </div>
                    </div>

                    <button
                        type="button"
                        class="parkflow-toast-close"
                        aria-label="Close notification"
                        onclick="Swal.close()"
                    >
                        <i class="fa-solid fa-xmark"></i>
                    </button>

                    <div class="parkflow-toast-progress">
                        <span></span>
                    </div>
                </div>
            `,
        });
    };
});
