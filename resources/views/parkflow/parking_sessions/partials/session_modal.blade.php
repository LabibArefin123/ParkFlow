<div class="session-modal" id="sessionDetailsModal" aria-hidden="true">
    <div class="session-modal-backdrop" data-modal-close></div>

    <div class="session-modal-dialog" role="dialog" aria-modal="true" aria-labelledby="sessionModalTitle">

        <div class="session-modal-header">
            <div class="session-modal-heading">
                <div class="session-modal-icon">
                    <i class="fa-solid fa-car-side"></i>
                </div>
                <div>
                    <span class="session-modal-eyebrow">PARKFLOW • SESSION DETAILS</span>
                    <h2 id="sessionModalTitle">Parking Session</h2>
                    <p id="modalVehicleNumber">Vehicle information</p>
                </div>
            </div>

            <button type="button" class="session-modal-close" data-modal-close aria-label="Close modal">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>

        <div class="session-modal-body">
            <div class="session-modal-status-row">
                <div>
                    <span class="session-modal-label">Session Status</span>
                    <span class="session-modal-status" id="modalStatus">Active</span>
                </div>
                <div class="session-modal-id">
                    <span>SESSION ID</span>
                    <strong id="modalSessionId">#---</strong>
                </div>
            </div>

            <div class="session-modal-section">
                <div class="session-modal-section-title">
                    <i class="fa-solid fa-user"></i>
                    Vehicle & Customer
                </div>

                <div class="session-modal-grid">
                    <div class="session-modal-field">
                        <span>Registration Number</span>
                        <strong id="modalVehicle">-</strong>
                    </div>
                    <div class="session-modal-field">
                        <span>Vehicle Type</span>
                        <strong id="modalVehicleType">-</strong>
                    </div>
                    <div class="session-modal-field">
                        <span>Owner Name</span>
                        <strong id="modalOwner">-</strong>
                    </div>
                    <div class="session-modal-field">
                        <span>Phone Number</span>
                        <strong id="modalPhone">-</strong>
                    </div>
                </div>
            </div>

            <div class="session-modal-section">
                <div class="session-modal-section-title">
                    <i class="fa-solid fa-location-dot"></i>
                    Parking Information
                </div>

                <div class="session-modal-grid">
                    <div class="session-modal-field">
                        <span>Parking Location</span>
                        <strong id="modalLocation">-</strong>
                    </div>
                    <div class="session-modal-field">
                        <span>Parking Spot</span>
                        <strong id="modalSpot">-</strong>
                    </div>
                    <div class="session-modal-field">
                        <span>Floor</span>
                        <strong id="modalFloor">-</strong>
                    </div>
                    <div class="session-modal-field">
                        <span>Entry Gate</span>
                        <strong id="modalEntryGate">-</strong>
                    </div>
                    <div class="session-modal-field">
                        <span>Exit Gate</span>
                        <strong id="modalExitGate">-</strong>
                    </div>
                </div>
            </div>

            <div class="session-modal-section">
                <div class="session-modal-section-title">
                    <i class="fa-regular fa-clock"></i>
                    Session Timeline
                </div>

                <div class="session-modal-timeline">
                    <div class="session-timeline-item">
                        <span class="session-timeline-dot entry"></span>
                        <div>
                            <span>Vehicle Entry</span>
                            <strong id="modalEntry">-</strong>
                        </div>
                    </div>
                    <div class="session-timeline-item">
                        <span class="session-timeline-dot exit"></span>
                        <div>
                            <span>Vehicle Exit</span>
                            <strong id="modalExit">-</strong>
                        </div>
                    </div>
                </div>

                <div class="session-modal-duration">
                    <i class="fa-solid fa-hourglass-half"></i>
                    <span>Parking Duration</span>
                    <strong id="modalDuration">-</strong>
                </div>
            </div>

            <div class="session-modal-section">
                <div class="session-modal-section-title">
                    <i class="fa-solid fa-receipt"></i>
                    Payment Summary
                </div>

                <div class="session-payment-list">
                    <div><span>Parking Fee</span><strong>৳<span id="modalFee">0.00</span></strong></div>
                    <div><span>Discount</span><strong>৳<span id="modalDiscount">0.00</span></strong></div>
                    <div class="session-payment-total">
                        <span>Total Amount</span>
                        <strong>৳<span id="modalAmount">0.00</span></strong>
                    </div>
                </div>

                <div class="session-modal-grid session-payment-meta">
                    <div class="session-modal-field">
                        <span>Payment Method</span>
                        <strong id="modalPaymentMethod">-</strong>
                    </div>
                    <div class="session-modal-field">
                        <span>Payment Status</span>
                        <strong id="modalPaymentStatus">-</strong>
                    </div>
                    <div class="session-modal-field">
                        <span>Transaction ID</span>
                        <strong id="modalTransaction">-</strong>
                    </div>
                </div>
            </div>
        </div>

        <div class="session-modal-footer">
            <button type="button" class="session-modal-dismiss" data-modal-close>
                <i class="fa-solid fa-xmark"></i>
                Close
            </button>

            <a href="#" id="modalViewFull" class="session-modal-view">
                View Full Session
                <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>
    </div>
</div>
