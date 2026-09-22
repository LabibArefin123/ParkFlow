<div class="profile-card profile-password-card">
    <div class="profile-card-top"> <span class="profile-card-icon password-icon"> <i class="fa-solid fa-shield-halved"></i>
        </span>
        <div>
            <h3>Password & Security</h3>
            <p>Keep your ParkFlow account protected</p>
        </div>
    </div>
    <div class="security-notice">
        <div class="security-notice-icon"> <i class="fa-solid fa-lock"></i> </div>
        <div> <strong>Secure your account</strong>
            <p> Use a strong password with at least 8 characters. </p>
        </div>
    </div>
    <form action="{{ route('profile.password.update') }}" method="POST"> @csrf @method('PUT') <div
            class="profile-form-group"> <label for="current_password"> Current Password <span>*</span> </label>
            <div class="profile-input-wrapper password-wrapper"> <i class="fa-solid fa-key"></i> <input type="password"
                    id="current_password" name="current_password" placeholder="Enter current password"
                    autocomplete="current-password" required> <button type="button" class="password-toggle"
                    data-target="current_password"> <i class="fa-solid fa-eye"></i> </button> </div>
            @error('current_password')
                <small class="profile-error"> <i class="fa-solid fa-circle-exclamation"></i> {{ $message }}
                </small>
            @enderror
        </div>
        <div class="profile-password-row">
            <div class="profile-form-group"> <label for="password"> New Password <span>*</span> </label>
                <div class="profile-input-wrapper password-wrapper"> <i class="fa-solid fa-lock"></i> <input
                        type="password" id="password" name="password" placeholder="New password"
                        autocomplete="new-password" required> <button type="button" class="password-toggle"
                        data-target="password"> <i class="fa-solid fa-eye"></i> </button> </div>
                @error('password')
                    <small class="profile-error"> <i class="fa-solid fa-circle-exclamation"></i>
                        {{ $message }} </small>
                @enderror
            </div>
            <div class="profile-form-group"> <label for="password_confirmation"> Confirm Password
                    <span>*</span> </label>
                <div class="profile-input-wrapper password-wrapper"> <i class="fa-solid fa-lock"></i> <input
                        type="password" id="password_confirmation" name="password_confirmation"
                        placeholder="Confirm password" autocomplete="new-password" required> <button type="button"
                        class="password-toggle" data-target="password_confirmation"> <i class="fa-solid fa-eye"></i>
                    </button> </div>
            </div>
        </div>
        <div class="password-strength" id="passwordStrength">
            <div class="password-strength-header"> <span>Password strength</span> <strong id="passwordStrengthText">
                    Enter password </strong> </div>
            <div class="password-strength-bar"> <span id="passwordStrengthFill"></span> </div>
        </div>
        <div class="profile-form-actions"> <button type="submit" class="profile-security-btn"> <i
                    class="fa-solid fa-key"></i> Change Password </button> </div>
    </form>
</div>
