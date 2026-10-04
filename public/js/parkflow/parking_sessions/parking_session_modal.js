function initSessionModal() {
    const sessionModal = document.getElementById("sessionDetailsModal");

    if (!sessionModal) return;

    const modalFields = {
        sessionId: "modalSessionId",
        vehicle: "modalVehicle",
        vehicleType: "modalVehicleType",
        owner: "modalOwner",
        phone: "modalPhone",
        spot: "modalSpot",
        floor: "modalFloor",
        location: "modalLocation",
        entry: "modalEntry",
        exit: "modalExit",
        entryGate: "modalEntryGate",
        exitGate: "modalExitGate",
        duration: "modalDuration",
        fee: "modalFee",
        discount: "modalDiscount",
        amount: "modalAmount",
        status: "modalStatus",
        paymentMethod: "modalPaymentMethod",
        paymentStatus: "modalPaymentStatus",
        transaction: "modalTransaction",
    };

    function setModalValue(id, value) {
        const element = document.getElementById(id);

        if (element) {
            element.textContent = value || "-";
        }
    }

    function openSessionModal(row) {
        Object.entries(modalFields).forEach(([key, id]) => {
            setModalValue(id, row.dataset[key] || "-");
        });

        setModalValue("modalVehicleNumber", row.dataset.vehicle || "Vehicle");

        const status = document.getElementById("modalStatus");

        if (status) {
            status.className = "session-modal-status";

            const statusClass = (row.dataset.status || "").toLowerCase();

            if (["active", "completed", "cancelled"].includes(statusClass)) {
                status.classList.add(statusClass);
            }
        }

        const fullViewLink = document.getElementById("modalViewFull");
        const viewLink = row.querySelector(".session-view-btn");

        if (fullViewLink && viewLink) {
            fullViewLink.href = viewLink.href;
        }

        sessionModal.classList.add("is-open");
        sessionModal.setAttribute("aria-hidden", "false");
        document.body.classList.add("session-modal-active");
    }

    function closeSessionModal() {
        sessionModal.classList.remove("is-open");
        sessionModal.setAttribute("aria-hidden", "true");
        document.body.classList.remove("session-modal-active");
    }

    document
        .querySelectorAll(".sessions-table tbody tr")
        .forEach(function (row) {
            row.addEventListener("click", function (event) {
                if (event.target.closest("a,button")) return;

                openSessionModal(row);
            });

            row.setAttribute("tabindex", "0");
            row.setAttribute("role", "button");
            row.setAttribute("aria-label", "Open parking session details");

            row.addEventListener("keydown", function (event) {
                if (event.key === "Enter" || event.key === " ") {
                    event.preventDefault();
                    openSessionModal(row);
                }
            });
        });

    sessionModal
        .querySelectorAll("[data-modal-close]")
        .forEach(function (button) {
            button.addEventListener("click", closeSessionModal);
        });

    document.addEventListener("keydown", function (event) {
        if (
            event.key === "Escape" &&
            sessionModal.classList.contains("is-open")
        ) {
            closeSessionModal();
        }
    });
}
