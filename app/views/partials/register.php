<main class="container-fluid d-flex flex-column flex-grow-1 align-items-center p-0">
    <section class="card col-md-6 col-lg-5 col-xl-4 p-4 m-4">
        <form class="d-flex flex-column gap-2 needs-validation" id="registrationForm" method="post" novalidate>
            <div class="d-flex flex-column justify-content-center align-items-center gap-3">
                <img src="../../assets/images/logo_form.svg" class="img-fluid image-height-40 form-logo"
                     alt="Logo">
                <p class="h5 mb-3 medium-grey-text">Create a new account</p>
            </div>
            <div class="d-flex flex-column gap-3 mb-2">
                <div class="form-group">
                    <label for="inputEmail">Email address</label>
                    <input type="email" name="email" class="form-control" id="inputEmail" aria-describedby="emailHelp"
                           placeholder="Enter email" required>
                    <div class="invalid-feedback" id="inputEmailPrompt">
                        Email address cannot be empty.
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputName">Name</label>
                    <input type="text" name="name" class="form-control" id="inputName"
                           placeholder="Enter email" required>
                    <div class="invalid-feedback" id="inputNamePrompt">
                        Name cannot be empty.
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword">Password</label>
                    <input type="password" name="password" class="form-control" id="inputPassword"
                           placeholder="Password" required>
                </div>
                <div class="form-group">
                    <label for="inputConfirmPassword">Confirm password</label>
                    <input type="password" name="confirmPassword" class="form-control" id="inputConfirmPassword"
                           placeholder="Confirm password" required>
                    <div class="invalid-feedback" id="confirmPasswordPrompt">
                        Password cannot be empty.
                    </div>
                </div>
            </div>
            <div class="d-flex align-items-center">
                <input class="checkbox me-2" type="checkbox" value="" id="showPasswordCheck">
                <label class="" for="showPasswordCheck">
                    Show passwords
                </label>
            </div>
            <div class="mb-2">
                <div class="g-recaptcha mt-2" data-sitekey="<?php echo $_ENV['RECAPTCHA_SITE_KEY']; ?>"
                     data-action="<?php echo $_ENV['RECAPTCHA_ACTION']; ?>"></div>
                <div class="form-prompt" id="captchaPrompt">Please complete the captcha.</div>
            </div>
            <button type="submit" class="btn btn-primary mb-3" id="registerBtn">Register</button>
        </form>
    </section>
</main>