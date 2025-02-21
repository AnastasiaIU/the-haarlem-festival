<section class="event-map-section">
    <div class="container">
        <h2>Event Location</h2>
        <div class="location-details">
            <address>
                <strong><?= htmlspecialchars($event->getVenueName()) ?></strong><br>
                <?= htmlspecialchars($event->getAddress()) ?><br>
                <?= htmlspecialchars($event->getCity()) ?>
            </address>
        </div>
        <div id="eventMap" class="map-container" 
             data-lat="<?= $event->getLatitude() ?>" 
             data-lng="<?= $event->getLongitude() ?>"
             data-title="<?= htmlspecialchars($event->getTitle()) ?>">
        </div>
        <div>
            <!-- Event map placeholder -->
        </div>
    </div>
</section>
