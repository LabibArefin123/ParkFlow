window.addEventListener("parkflowLoginReady", function () {
    const login = window.ParkFlowLogin;
    const { email, password } = login.elements;
    const { infoSvg } = login.icons;
    email?.addEventListener("blur", function () {
        login.state.hasInteracted = true;
        login.validateEmail();
    });
    password?.addEventListener("blur", async function () {
        login.state.hasInteracted = true;
        if (!login.state.emailAccountExists) return;
        await login.validatePassword();
    });
    email?.addEventListener("input", function () {
        if (!login.state.hasInteracted) return;
        clearTimeout(login.timers.verification);
        login.state.emailVerified = false;
        login.state.emailAccountExists = false;
        login.state.passwordVerified = false;
        login.showNotification(
            "default",
            "Email Updated ✨",
            "Finish entering your email address.",
            infoSvg,
        );
    });
    password?.addEventListener("input", function () {
        if (!login.state.hasInteracted) return;
        clearTimeout(login.timers.verification);
        login.state.passwordReady = false;
        login.state.passwordVerified = false;
        login.showNotification(
            "default",
            "Password Updated 🔐",
            "Your password will be checked against this account.",
            infoSvg,
        );
    });
});
