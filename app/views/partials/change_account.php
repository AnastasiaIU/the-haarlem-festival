<script type="module" src="../../assets/js/change_account.js"></script>
<main class="container d-flex flex-column align-items-center justify-content-center" style="min-height: 100vh;">
<section class="card col-md-6 col-lg-5 col-xl-4 p-4">
        <form class="d-flex flex-column gap-2 needs-validation" id="editProfileForm" method="post" novalidate>
            <div class="d-flex flex-column justify-content-center align-items-center gap-3">
                <p class="h5 mb-3 medium-grey-text">Edit Your Profile</p>
            </div>
            
            <div class="form-group">
                <label for="editEmail">Change Your Email Address</label>
                <input type="email" name="email" class="form-control" id="editEmail"
                       placeholder="Enter new email" autocomplete="email" required>
                <div class="invalid-feedback" id="editEmailPrompt">
                    Email address cannot be empty.
                </div>
            </div>

            <div class="form-group mb-2">
                <label for="editPassword">Type New Password</label>
                <input type="password" name="password" class="form-control" id="editPassword"
                       placeholder="Enter new password" autocomplete="new-password">
                <div class="invalid-feedback" id="editPasswordPrompt">
                    Password cannot be empty.
                </div>
            </div>

            <div class="d-flex align-items-center mb-4">
                <input class="checkbox me-2" type="checkbox" value="" id="showEditPasswordCheck">
                <label for="showEditPasswordCheck">Show password</label>
            </div>

            <button type="submit" class="btn btn-primary mb-3">Save Changes</button>
        </form>
    </section>

    <div id="profileSuccessMessage" class="alert alert-success col-md-6 col-lg-5 col-xl-4 d-none" role="alert">
        Profile updated successfully!
    </div>

  </main>