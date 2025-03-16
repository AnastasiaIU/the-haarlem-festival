<footer class="container-fluid p-0">
    <section class="footer-top m-0 py-4">
        <div class="container">
            <div class="row justify-content-between gap-3">
                <div class="col-md-4">
                    <a href="/">
                        <img src="../../assets/images/logo_footer.svg" class="img-fluid logo"
                             alt="Logo The Haarlem Festival with a windmill">
                    </a>
                    <p class="pt-2 m-0">Haarlem: a cozy historic center, famous museums, stores, restaurants and the
                        beach around the corner. Welcome to the city that has everything. On the one hand, the hidden
                        streets of bygone days and trendy concept stores. On the other hand, the medieval church and
                        waterfront cafés. From Dutch masters to French star chefs. From antique market to pop
                        concert.</p>
                </div>
                <div class="col-md-2">
                    <h5>Sitemap</h5>
                    <ul class="p-0 m-0" id="sitemap"></ul>
                    <a class="footer-link" href="/cart">Shopping Cart</a>
                    <a class="footer-link"
                        <?php if (isset($_SESSION['user'])): ?>
                            href="/profile">
                        <?php else: ?>
                            href="/register">
                        <?php endif; ?>
                        Profile
                    </a>
                </div>
                <div class="col-md-4">
                    <h5>Do you also enjoy going out?</h5>
                    <p class="pt-2 m-0">Subscribe to our social media!</p>
                    <div class="container-fluid d-flex gap-4 px-0 py-3">
                        <a class="footer-link" href="https://www.facebook.com/Haarlemmarketing">
                            <img src="../../assets/images/facebook.svg" alt="Facebook Icon" class="img-fluid icon">
                        </a>
                        <a class="footer-link" href="https://www.instagram.com/visithaarlem">
                            <img src="../../assets/images/instagram.svg" alt="Instagram Icon" class="img-fluid icon">
                        </a>
                        <a class="footer-link" href="https://www.youtube.com/visithaarlem">
                            <img src="../../assets/images/youtube.svg" alt="Youtube Icon" class="img-fluid icon">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <p class="footer-bottom text-center m-0 py-4">© 2025 The Haarlem Festival. All rights reserved.</p>
</footer>

</body>

</html>