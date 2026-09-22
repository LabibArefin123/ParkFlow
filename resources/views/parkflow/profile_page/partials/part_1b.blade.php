  <div class="profile-card profile-personal-card">
      <div class="profile-card-top"> <span class="profile-card-icon"> <i class="fa-solid fa-user-pen"></i> </span>
          <div>
              <h3>Personal Information</h3>
              <p>Update your basic account details</p>
          </div>
      </div>
      <form action="{{ route('profile.update') }}" method="POST"> @csrf @method('PUT') <div class="profile-form-group">
              <label for="profile_name"> Full Name <span>*</span> </label>
              <div class="profile-input-wrapper"> <i class="fa-solid fa-user"></i> <input type="text" id="profile_name"
                      name="name" value="{{ old('name', $user->name) }}" placeholder="Enter your full name"
                      autocomplete="name" required> </div> @error('name')
                  <small class="profile-error"> <i class="fa-solid fa-circle-exclamation"></i> {{ $message }}
                  </small>
              @enderror
          </div>
          <div class="profile-form-group"> <label for="profile_email"> Email Address </label>
              <div class="profile-input-wrapper profile-input-disabled"> <i class="fa-solid fa-envelope"></i>
                  <input type="email" id="profile_email" value="{{ $user->email }}" readonly> <i
                      class="fa-solid fa-lock profile-input-lock"></i>
              </div> <small class="profile-field-note">
                  <i class="fa-solid fa-circle-info"></i> Your email address is fixed and cannot be changed.
              </small>
          </div>
          <div class="profile-form-actions"> <button type="submit" class="profile-save-btn"> <i
                      class="fa-solid fa-check"></i> Save Changes </button> </div>
      </form>
  </div>
