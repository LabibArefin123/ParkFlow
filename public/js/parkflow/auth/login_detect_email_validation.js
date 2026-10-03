window.addEventListener("parkflowLoginReady", function () {
    const login = window.ParkFlowLogin;
    const { email } = login.elements;
    const { sadSvg, infoSvg } = login.icons;
    login.validateEmail = function () {
        if (!email) return false;
        const value = email.value.trim();
        if (!value) {
            login.showNotification(
                "error",
                "Email Required",
                "Please enter your email address.",
                sadSvg,
            );
            return false;
        }
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(value)) {
            login.showNotification(
                "error",
                "Invalid Email",
                "Please enter a valid email address.",
                sadSvg,
            );
            return false;
        }
        login.state.emailVerified = true;
        if (!login.state.emailAccountExists) {
            login.showNotification(
                "default",
                "Checking Email ✨",
                "Checking whether this email is registered in ParkFlow...",
                infoSvg,
            );
        }
        return true;
    };
});
