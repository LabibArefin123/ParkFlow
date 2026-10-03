window.addEventListener("parkflowLoginReady", function () {
    const login = window.ParkFlowLogin;
    const { email, password, csrfToken } = login.elements;
    const { happySvg, sadSvg, infoSvg } = login.icons;
    login.validatePassword = async function () {
        if (!password) return false;
        const emailValue = email?.value.trim();
        const passwordValue = password.value;
        login.state.passwordReady = false;
        login.state.passwordVerified = false;
        if (!emailValue) {
            login.showNotification(
                "error",
                "Email Required",
                "Enter your email address before checking your password.",
                sadSvg,
            );
            return false;
        }
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(emailValue)) {
            login.showNotification(
                "error",
                "Invalid Email",
                "Enter a valid email address before checking your password.",
                sadSvg,
            );
            return false;
        }
        if (!passwordValue) {
            login.showNotification(
                "error",
                "Password Required",
                "Please enter your password to continue.",
                sadSvg,
            );
            return false;
        }
        if (!login.state.emailAccountExists) {
            login.showNotification(
                "error",
                "Email Not Verified",
                "Please enter a registered email address first.",
                sadSvg,
            );
            return false;
        }
        login.showNotification(
            "default",
            "Checking Password 🔐",
            "Checking your password securely...",
            infoSvg,
        );
        try {
            const response = await fetch("/login/check-password", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": csrfToken,
                    Accept: "application/json",
                },
                body: JSON.stringify({
                    email: emailValue,
                    password: passwordValue,
                }),
            });
            if (!response.ok) {
                login.showNotification(
                    "error",
                    "Password Check Failed",
                    "Unable to verify your password right now.",
                    sadSvg,
                );
                return false;
            }
            const result = await response.json();
            if (!result.verified) {
                login.state.passwordVerified = false;
                login.showNotification(
                    "error",
                    "Incorrect Password",
                    "The password does not match this account.",
                    sadSvg,
                );
                return false;
            }
            login.state.passwordReady = true;
            login.state.passwordVerified = true;
            login.showNotification(
                "success",
                "Password Verified 😊",
                "Your password matches your ParkFlow account.",
                happySvg,
            );
            return true;
        } catch (error) {
            console.error("Password verification failed:", error);
            login.showNotification(
                "error",
                "Verification Error",
                "Unable to check your password. Please try again.",
                sadSvg,
            );
            return false;
        }
    };
});
