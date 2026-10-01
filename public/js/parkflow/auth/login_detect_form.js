window.addEventListener("parkflowLoginReady", function () {
    const login = window.ParkFlowLogin;

    const { loginForm, notification } = login.elements;

    const { infoSvg } = login.icons;

    loginForm?.addEventListener("submit", async function (event) {
        event.preventDefault();

        const emailValid = login.validateEmail();

        if (!emailValid) {
            return;
        }

        if (!login.state.emailAccountExists) {
            login.showNotification(
                "error",
                "Email Not Found",
                "Please enter a registered email address.",
                login.icons.sadSvg,
            );

            return;
        }

        const passwordValid = await login.validatePassword();

        if (!passwordValid) {
            return;
        }

        clearTimeout(login.timers.verification);

        login.showNotification(
            "default",
            "Signing In 🚀",
            "Verifying your credentials securely...",
            infoSvg,
        );

        /*
         * Now submit the actual Laravel login form.
         */
        loginForm.submit();
    });

    login.showNotification(
        notification.dataset.type || "default",

        "Welcome to ParkFlow 🚗",

        notification.dataset.message ||
            "Enter your account details to continue.",

        infoSvg,
    );
});
