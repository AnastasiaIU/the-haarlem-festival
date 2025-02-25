

<!-- filler code for now -->


<!-- App Promotion Blocks -->
<section class="app-promo">
  <h3>Discover a World of Mystery with Magic@Teylers App</h3>
  <p>Engaging text about the benefits of the app ...</p>
  <img src="/assets/images/phone-mockup.png" alt="Phone Mockup" />
</section>

<section class="qr-code">
  <h3>Scan To Download Teyler's Mystery App</h3>
  <img src="/assets/images/qr-code.png" alt="QR Code" />
</section>

<!-- Map Section (later will be made its own partial used in all events with the map data for each event from database) -->
<section class="map-section">
  <h2>Locations</h2>
  <div class="map-container">
    <?php if (!empty($eventData['map_embed_url'])): ?>
      <?= $eventData['map_embed_url']; ?>
    <?php else: ?>
      <p>No map location set for this event yet.</p>
    <?php endif; ?>
  </div>
</section>