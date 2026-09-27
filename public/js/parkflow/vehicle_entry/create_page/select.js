document.addEventListener("DOMContentLoaded", function () {
    const locationSelect = document.getElementById("parking_location_id");
    const spotSelect = document.getElementById("parking_spot_id");
    const spotPreview = document.getElementById("spotPreview");
    const options = [...spotSelect.querySelectorAll("option[data-location]")];

    function filterSpots() {
        const locationId = locationSelect.value;
        const selectedSpot = spotSelect.value;

        options.forEach((option) => {
            option.hidden = locationId !== option.dataset.location;
        });

        if (!locationId) {
            spotSelect.value = "";
            updatePreview();
            return;
        }

        if (
            !options.some(
                (option) =>
                    option.dataset.location === locationId &&
                    option.value === selectedSpot,
            )
        ) {
            spotSelect.value = "";
        }

        updatePreview();
    }

    function updatePreview() {
        const option = spotSelect.options[spotSelect.selectedIndex];

        if (!option || !option.value) {
            spotPreview.innerHTML = `
                <div class="spot-preview-icon">
                    <i class="fas fa-square-parking"></i>
                </div>
                <div>
                    <strong>Select a parking space</strong>
                    <span>Available spaces will appear after selecting a location.</span>
                </div>
            `;
            return;
        }

        spotPreview.innerHTML = `
            <div class="spot-preview-icon selected">
                <i class="fas fa-check"></i>
            </div>
            <div>
                <strong>${option.textContent.trim()}</strong>
                <span>This parking space is available for entry.</span>
            </div>
        `;
    }

    locationSelect.addEventListener("change", filterSpots);
    spotSelect.addEventListener("change", updatePreview);

    filterSpots();
});
