document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".password-toggle").forEach(function (button) {
        button.addEventListener("click", function () {
            const input = document.getElementById(this.dataset.target);
            const icon = this.querySelector("i");

            if (input.type === "password") {
                input.type = "text";
                icon.classList.remove("fa-eye");
                icon.classList.add("fa-eye-slash");
            } else {
                input.type = "password";
                icon.classList.remove("fa-eye-slash");
                icon.classList.add("fa-eye");
            }
        });
    });

    const password = document.getElementById("password");
    const strength = document.getElementById("passwordStrength");
    const strengthText = document.getElementById("passwordStrengthText");
    const strengthFill = document.getElementById("passwordStrengthFill");

    if (password) {
        password.addEventListener("input", function () {
            const value = this.value;
            let score = 0;

            if (value.length >= 8) score++;
            if (value.length >= 12) score++;
            if (/[A-Z]/.test(value)) score++;
            if (/[0-9]/.test(value)) score++;
            if (/[^A-Za-z0-9]/.test(value)) score++;

            strength.classList.remove(
                "strength-weak",
                "strength-medium",
                "strength-strong",
            );

            if (!value) {
                strengthText.textContent = "Enter password";
                strengthFill.style.width = "0%";
                return;
            }

            if (score <= 2) {
                strength.classList.add("strength-weak");
                strengthText.textContent = "Weak";
                strengthFill.style.width = "33%";
            } else if (score <= 3) {
                strength.classList.add("strength-medium");
                strengthText.textContent = "Medium";
                strengthFill.style.width = "66%";
            } else {
                strength.classList.add("strength-strong");
                strengthText.textContent = "Strong";
                strengthFill.style.width = "100%";
            }
        });
    }
});
