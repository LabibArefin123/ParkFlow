document.addEventListener("DOMContentLoaded", function () {
    const amount = document.getElementById("amount");
    const totalAmount = document.getElementById("totalAmount");

    function updateAmount() {
        const value = parseFloat(amount.value) || 0;
        totalAmount.textContent = value.toFixed(2);
    }

    amount.addEventListener("input", updateAmount);
    updateAmount();
});
