window.addEventListener("parkflowLoginReady", function () {
    const login = window.ParkFlowLogin;
    const { loginForm, notification } = login.elements;
    const { infoSvg } = login.icons;
    if (!loginForm) return;
    loginForm.addEventListener("submit", function (event) {
        const email = login.elements.email?.value.trim();
        const password = login.elements.password?.value;
        if (!email || !password) {
            event.preventDefault();
            login.showNotification(
                "error",
                "Missing Details",
                "Please enter your email and password.",
                login.icons.sadSvg,
            );
            return;
        }
        if (!login.validateEmail()) {
            event.preventDefault();
            return;
        }
        login.showNotification(
            "default",
            "Signing In 🚀",
            "Verifying your credentials securely...",
            infoSvg,
        );
    });
    login.showNotification(
        notification.dataset.type || "default",
        notification.dataset.type === "success"
            ? "Welcome Back!"
            : "Welcome to ParkFlow",
        notification.dataset.message ||
            "Enter your account details to continue.",
        infoSvg,
    );
});
