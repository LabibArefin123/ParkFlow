window.addEventListener("parkflowLoginReady", function () {
    const login = window.ParkFlowLogin;

    const { email, password } = login.elements;

    const { happySvg, sadSvg, infoSvg } = login.icons;

    login.scheduleVerification = function (field) {
        clearTimeout(login.timers.verification);

        login.timers.verification = setTimeout(function () {
            if (field === "email" && login.state.emailVerified) {
                login.showNotification(
                    "success",
                    "Email Verified 😊",
                    "Your email format has been checked successfully!",
                    happySvg,
                );
            }

            if (field === "password" && login.state.passwordReady) {
                login.showNotification(
                    "success",
                    "Password Ready 😊",
                    "Your password is ready for secure server verification.",
                    happySvg,
                );
            }
        }, 5000);
    };

    login.validateEmail = function () {
        if (!email) {
            return false;
        }

        const value = email.value.trim();

        login.state.emailVerified = false;

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

        login.showNotification(
            "default",
            "Checking Email ✨",
            "Your email format looks valid. Final account verification happens securely on sign in.",
            infoSvg,
        );

        login.scheduleVerification("email");

        return true;
    };

    login.validatePassword = function () {
        if (!password) {
            return false;
        }

        login.state.passwordReady = false;

        if (!password.value) {
            login.showNotification(
                "error",
                "Password Required",
                "Please enter your password to continue.",
                sadSvg,
            );

            return false;
        }

        login.state.passwordReady = true;

        login.showNotification(
            "default",
            "Password Entered 🔐",
            "Preparing your password for secure verification...",
            infoSvg,
        );

        login.scheduleVerification("password");

        return true;
    };

    email?.addEventListener("blur", function () {
        login.state.hasInteracted = true;

        login.validateEmail();
    });

    password?.addEventListener("blur", function () {
        login.state.hasInteracted = true;

        login.validatePassword();
    });

    email?.addEventListener("input", function () {
        if (!login.state.hasInteracted) {
            return;
        }

        clearTimeout(login.timers.verification);

        login.state.emailVerified = false;

        login.showNotification(
            "default",
            "Email Updated ✨",
            "Finish entering your email address.",
            infoSvg,
        );
    });

    password?.addEventListener("input", function () {
        if (!login.state.hasInteracted) {
            return;
        }

        clearTimeout(login.timers.verification);

        login.state.passwordReady = false;

        login.showNotification(
            "default",
            "Password Updated 🔐",
            "Your password will be checked securely when you sign in.",
            infoSvg,
        );
    });
});
