<?php

require_once(__DIR__ . '/../partials/header.php');
require_once(__DIR__ . '/../partials/header_nav.php');
?>

    <main class="container-fluid d-flex flex-column flex-grow-1 p-0">
        <?php
        require_once(__DIR__ . '/../partials/events/hero.php');
        require_once(__DIR__ . '/../partials/events/promo.php');
        include $mainContent;
        // add map here
        ?>
    </main>

<?php
require_once(__DIR__ . '/../partials/footer.php');
?>