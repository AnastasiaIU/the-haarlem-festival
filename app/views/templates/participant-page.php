<?php

require_once(__DIR__ . '/../partials/header.php');
require_once(__DIR__ . '/../partials/header_nav.php');
?>

    <main class="container-fluid d-flex flex-column flex-grow-1 w-100 align-items-center p-0">
        <?php
        if (preg_match('#^/yummy/([a-z0-9-]+)$#', $_SERVER['REQUEST_URI'])) {
            require_once(__DIR__ . '/../partials/events/yummy/hero.php');
        } else {
            require_once(__DIR__ . '/../partials/events/hero.php');
        }
        include $mainContent;
        ?>
    </main>

<?php
require_once(__DIR__ . '/../partials/footer.php');
?>