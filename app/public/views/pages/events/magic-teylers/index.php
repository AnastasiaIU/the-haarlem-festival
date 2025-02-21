<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $pageTitle ?? 'Magic@Teylers' ?></title>
    <link rel="stylesheet" href="/assets/css/magic-teylers.css">
</head>
<body>
    <section class="hero-section" style="background: url('<?= !empty($eventData['hero_bg_image']) ? htmlspecialchars($eventData['hero_bg_image']) : '/assets/images/default-hero.jpg' ?>') no-repeat left center; background-size: cover;">
        <img class="green-shape" src="/assets/images/Rectangle4MagicTeylers.svg" alt="Green shape decoration" />
        
        <div class="hero-text-container">
            <h1><?= !empty($eventData['hero_title']) ? htmlspecialchars($eventData['hero_title']) : 'VISIT THE TEYLER\'S MUSEUM' ?></h1>
            <p><?= !empty($eventData['hero_paragraph']) ? nl2br(htmlspecialchars($eventData['hero_paragraph'])) : 'Default paragraph about Teyler\'s Museum...' ?></p>

            <h2 class="sub-heading">HAVE FUN ON OUR NEW APP AND DISCOVER PROFESSOR TYLER'S SECRET!</h2>
            <p class="download-prompt">Download the app now</p>
            <div class="store-badges">
                <a href="https://play.google.com" class="store-badge">
                    <img src="/assets/images/google-play-icon.png" alt="">
                    Download for Android
                </a>
                <a href="https://apps.apple.com" class="store-badge">
                    <img src="/assets/images/apple-icon.png" alt="">
                    Download for iOS
                </a>
            </div>
        </div>
    </section>

    <?php if (!empty($eventData['feature_bg_image']) || !empty($eventData['feature_title']) || !empty($eventData['feature_paragraph'])): ?>
    <section class="feature-section" style="background-image: url('<?= !empty($eventData['feature_bg_image']) ? htmlspecialchars($eventData['feature_bg_image']) : '/assets/images/default-feature.jpg' ?>');">
        <h2><?= !empty($eventData['feature_title']) ? htmlspecialchars($eventData['feature_title']) : 'Default Feature Title' ?></h2>
        <p><?= !empty($eventData['feature_paragraph']) ? nl2br(htmlspecialchars($eventData['feature_paragraph'])) : 'Default feature description...' ?></p>
        <button class="btn btn-light">View Schedule</button>
    </section>
    <?php endif; ?>

    <section class="app-promo">
        <h3>Discover a World of Mystery with Magic@Teylers App</h3>
        <p>Engaging text about the benefits of the app ...</p>
        <img src="/assets/images/phone-mockup.png" alt="Phone Mockup" />
    </section>

    <section class="qr-code">
        <h3>Scan To Download Teyler's Mystery App</h3>
        <img src="/assets/images/qr-code.png" alt="QR Code" />
    </section>

    <section class="map-section">
        <h2>Locations</h2>
        <div class="map-container">
            <?php if (!empty($eventData['map_embed_url'])): ?>
                <?= $eventData['map_embed_url'] ?>
            <?php else: ?>
                <p>No map location set for this event yet.</p>
            <?php endif; ?>
        </div>
    </section>
</body>
</html>
