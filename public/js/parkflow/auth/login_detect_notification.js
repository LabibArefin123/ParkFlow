window.addEventListener("parkflowLoginReady", function () {
    const login = window.ParkFlowLogin;

    const {
        notification,
        notificationTitle,
        notificationMessage,
        notificationIcon,
        closeButton,
    } = login.elements;

    const happySvg = `
        <svg viewBox="0 0 64 64"
             class="login-happy-svg"
             role="img"
             aria-label="Happy">

            <defs>
                <linearGradient
                    id="happyGradient"
                    x1="0%"
                    y1="0%"
                    x2="100%"
                    y2="100%"
                >
                    <stop offset="0%" stop-color="#86efac"/>
                    <stop offset="100%" stop-color="#22c55e"/>
                </linearGradient>
            </defs>

            <circle
                cx="32"
                cy="32"
                r="29"
                fill="url(#happyGradient)"
            />

            <circle cx="22" cy="25" r="3" fill="#14532d"/>
            <circle cx="42" cy="25" r="3" fill="#14532d"/>

            <path
                d="M19 35 Q32 51 45 35"
                fill="none"
                stroke="#14532d"
                stroke-width="3.5"
                stroke-linecap="round"
            />

            <circle
                cx="15"
                cy="34"
                r="4"
                fill="#bbf7d0"
                opacity=".8"
            />

            <circle
                cx="49"
                cy="34"
                r="4"
                fill="#bbf7d0"
                opacity=".8"
            />
        </svg>
    `;

    const sadSvg = `
        <svg viewBox="0 0 64 64"
             class="login-happy-svg"
             role="img"
             aria-label="Sad">

            <circle
                cx="32"
                cy="32"
                r="29"
                fill="#fee2e2"
            />

            <circle cx="22" cy="25" r="3" fill="#991b1b"/>
            <circle cx="42" cy="25" r="3" fill="#991b1b"/>

            <path
                d="M19 46 Q32 31 45 46"
                fill="none"
                stroke="#991b1b"
                stroke-width="3.5"
                stroke-linecap="round"
            />

            <path
                d="M48 30 Q53 37 48 41 Q43 37 48 30"
                fill="#60a5fa"
            />
        </svg>
    `;

    const infoSvg = `
        <svg viewBox="0 0 64 64"
             class="login-happy-svg"
             role="img"
             aria-label="Information">

            <circle
                cx="32"
                cy="32"
                r="29"
                fill="#dbeafe"
            />

            <circle
                cx="32"
                cy="19"
                r="3"
                fill="#1d4ed8"
            />

            <path
                d="M32 29 V46"
                stroke="#1d4ed8"
                stroke-width="5"
                stroke-linecap="round"
            />
        </svg>
    `;

    login.icons = {
        happySvg,
        sadSvg,
        infoSvg,
    };

    login.showNotification = function (type, title, message, iconMarkup) {
        clearTimeout(login.timers.notification);

        notification.dataset.type = type;

        if (notificationTitle) {
            notificationTitle.textContent = title;
        }

        if (notificationMessage) {
            notificationMessage.textContent = message;
        }

        if (notificationIcon) {
            notificationIcon.innerHTML = iconMarkup || infoSvg;
        }

        notification.classList.remove("is-closing");
        notification.classList.add("is-visible");

        login.timers.notification = setTimeout(login.closeNotification, 10000);
    };

    login.closeNotification = function () {
        notification.classList.remove("is-visible");
        notification.classList.add("is-closing");
    };

    closeButton?.addEventListener("click", function () {
        clearTimeout(login.timers.notification);
        clearTimeout(login.timers.verification);

        login.closeNotification();
    });
});
