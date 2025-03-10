<nav class="navbar nav-underline navbar-expand-lg" data-bs-theme="dark">
    <div class="container-fluid">
        <a class="navbar-brand ms-3" href="/">
            <img src="/assets/images/logo_header.svg" class="img-fluid navbar-logo"
                 alt="Logo The Haarlem Festival with a windmill">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
            <ul class="navbar-nav mb-2 mb-lg-0 ms-3 gap-3">
                <li class="nav-item">
                    <a class="nav-link" id="nav-item-home" href="/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="nav-item-dance" href="/dance">DANCE!</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="nav-item-yummy" href="/yummy">Yummy!</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="nav-item-strolls" href="/strolls">History Strolls</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="nav-item-teylers" href="/teylers">Magic@Teylers</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="nav-item-cart" href="/cart">
                        <img src="/assets/images/shopping_cart.svg" alt="Shopping Cart" class="img-fluid icon">
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="nav-item-profile"
                        <?php if (isset($_SESSION['user'])): ?>
                            href="/profile">
                        <?php else: ?>
                            href="/login">
                        <?php endif; ?>
                        <img src="/assets/images/profile.svg" alt="Profile Icon" class="img-fluid icon">
                    </a>
                </li>
            </ul>
            <div>
                <a type="button" class="btn btn-primary ms-3 font-p-16 fw-bold" id="loginButton"
                    <?php if (isset($_SESSION['user'])): ?>
                        href="/logout">Sign out</a>
                    <?php else: ?>
                        href="/login">Sign in</a>
                    <?php endif; ?>
            </div>
        </div>
    </div>
</nav>