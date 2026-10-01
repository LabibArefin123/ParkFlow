window.addEventListener("parkflowLoginReady", function () {
    const login = window.ParkFlowLogin;

    const { password, passwordToggle } = login.elements;

    if (!passwordToggle || !password) {
        return;
    }

    passwordToggle.addEventListener("click", function () {
        const showPassword = password.type === "password";

        password.type = showPassword ? "text" : "password";

        this.innerHTML = showPassword
            ? '<i class="fa-regular fa-eye-slash"></i>'
            : '<i class="fa-regular fa-eye"></i>';

        this.setAttribute(
            "aria-label",
            showPassword ? "Hide password" : "Show password",
        );
    });
});
