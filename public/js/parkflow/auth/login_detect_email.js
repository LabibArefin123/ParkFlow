window.addEventListener("parkflowLoginReady", function () {
    const login = window.ParkFlowLogin;

    const { emailInput, csrfToken } = login.elements;

    if (!emailInput) {
        return;
    }

    emailInput.addEventListener("input", function () {
        clearTimeout(login.timers.emailCheck);

        const email = this.value.trim();

        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if (!emailPattern.test(email)) {
            return;
        }

        login.timers.emailCheck = setTimeout(async function () {
            try {
                const response = await fetch("/login/check-email", {
                    method: "POST",

                    headers: {
                        "Content-Type": "application/json",

                        "X-CSRF-TOKEN": csrfToken,

                        Accept: "application/json",
                    },

                    body: JSON.stringify({
                        email: email,
                    }),
                });

                if (!response.ok) {
                    return;
                }

                const result = await response.json();

                if (result.verified) {
                    login.showNotification(
                        "success",
                        "Email Verified",
                        "Your email is registered in ParkFlow.",
                        login.icons.happySvg,
                    );
                } else {
                    login.showNotification(
                        "error",
                        "Email Not Found",
                        "Please check your email address.",
                        login.icons.sadSvg,
                    );
                }
            } catch (error) {
                console.error("Email verification failed:", error);
            }
        }, 800);
    });
});
