window.addEventListener("parkflowLoginReady", function () {
    const login = window.ParkFlowLogin;
    const { happySvg, sadSvg, infoSvg } = login.icons;
    login.scheduleVerification = function (field) {
        clearTimeout(login.timers.verification);
        login.timers.verification = setTimeout(function () {
            if (field === "email" && login.state.emailVerified) {
                login.showNotification(
                    "success",
                    "Email Verified 😊",
                    "Your email has been checked successfully!",
                    happySvg,
                );
            }
            if (field === "password" && login.state.passwordVerified) {
                login.showNotification(
                    "success",
                    "Password Verified 😊",
                    "Your password matches your account.",
                    happySvg,
                );
            }
        }, 5000);
    };
});
