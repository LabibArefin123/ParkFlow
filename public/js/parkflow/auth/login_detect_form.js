window.addEventListener("parkflowLoginReady", function () {
    const login = window.ParkFlowLogin;

    const { loginForm } = login.elements;

    const { infoSvg } = login.icons;

    loginForm?.addEventListener("submit", function (event) {
        const emailValid = login.validateEmail();

        const passwordValid = login.validatePassword();

        if (!emailValid || !passwordValid) {
            event.preventDefault();

            return;
        }

        clearTimeout(login.timers.verification);

        login.showNotification(
            "default",
            "Signing In 🚀",
            "Verifying your credentials securely...",
            infoSvg,
        );
    });

    login.showNotification(
        login.elements.notification.dataset.type || "default",

        "Welcome to ParkFlow 🚗",

        login.elements.notification.dataset.message ||
            "Enter your account details to continue.",

        infoSvg,
    );
});
