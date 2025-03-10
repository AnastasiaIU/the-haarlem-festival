<main class="container-fluid d-flex flex-column flex-grow-1 align-items-center p-0">
    <section class="card col-md-6 col-lg-5 col-xl-4 p-4 m-4">
        <form class="d-flex flex-column gap-2 needs-validation" id="loginForm" method="post" novalidate>
            <div class="d-flex flex-column justify-content-center align-items-center gap-3">
                <img src="../../assets/images/logo_form.svg" class="img-fluid image-height-40 form-logo"
                     alt="Logo">
                <p class="h5 mb-3 medium-grey-text">Sign in to your account</p>
            </div>
            <div class="form-group">
                <label for="loginEmail">Email address</label>
                <input type="email" name="email" class="form-control" id="loginEmail"
                       aria-describedby="emailHelp" placeholder="Enter email" autocomplete="email"
                    <?php if (isset($loginFormData['email'])): ?>
                       value="<?= htmlspecialchars($loginFormData['email']) ?>" required>
                <div class="invalid-feedback" id="loginEmailPrompt"></div>
                <?php else: ?>
                    required>
                    <div class="invalid-feedback" id="loginEmailPrompt">
                        Email address cannot be empty.
                    </div>
                <?php endif; ?>
            </div>
            <div class="form-group mb-2">
                <label for="loginPassword">Password</label>
                <input type="password" name="password" class="form-control" id="loginPassword" placeholder="Password"
                       autocomplete="current-password"
                    <?php if (isset($loginFormData['password'])): ?>
                       value="<?= htmlspecialchars($loginFormData['password']) ?>" required>
                <div class="invalid-feedback" id="loginPasswordPrompt">
                    <?= htmlspecialchars($loginError) ?>
                </div>
                <?php else: ?>
                    required>
                    <div class="invalid-feedback" id="loginPasswordPrompt">
                        Password cannot be empty.
                    </div>
                <?php endif; ?>
            </div>
            <div class="d-flex align-items-center mb-4">
                <input class="checkbox me-2" type="checkbox" value="" id="showPasswordCheck">
                <label class="" for="showPasswordCheck">
                    Show password
                </label>
            </div>
            <button type="submit" class="btn btn-primary mb-3">Sign in</button>
            <p>Don't have an account? <a class="link-opacity-75-hover" href="/register">Sign up</a>.</p>
        </form>
    </section>
    <?php if (isset($loginUserCreated)): ?>
        <div class="alert alert-success col-md-6 col-lg-5 col-xl-4" role="alert">
            <?= htmlspecialchars($loginUserCreated) ?>
        </div>
    <?php endif; ?>
</main>