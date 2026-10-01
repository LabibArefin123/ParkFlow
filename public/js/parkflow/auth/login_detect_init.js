document.addEventListener("DOMContentLoaded", function () {
    const notification = document.getElementById("loginNotification");

    if (!notification) {
        return;
    }

    const elements = {
        notification,
        notificationTitle: document.getElementById("loginNotificationTitle"),
        notificationMessage: document.getElementById(
            "loginNotificationMessage",
        ),
        notificationIcon: notification.querySelector(
            ".login-notification-icon",
        ),
        closeButton: document.getElementById("loginNotificationClose"),

        emailInput: document.querySelector('input[name="email"]'),

        csrfToken: document.querySelector('meta[name="csrf-token"]')?.content,

        email: document.getElementById("email"),
        password: document.getElementById("password"),
        passwordToggle: document.getElementById("passwordToggle"),

        loginForm: document.querySelector(".parkflow-login-form"),
    };

    window.ParkFlowLogin = {
        elements,

        timers: {
            notification: null,
            verification: null,
            emailCheck: null,
        },

        state: {
            hasInteracted: false,
            emailVerified: false,
            emailAccountExists: false,
            passwordReady: false,
            passwordVerified: false,
        },
    };

    window.dispatchEvent(new CustomEvent("parkflowLoginReady"));
});
