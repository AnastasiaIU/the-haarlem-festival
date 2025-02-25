<!-- doesnt work for now-->



<!-- Feature Section -->
<?php if (!empty($eventData['feature_bg_image']) ||
          !empty($eventData['feature_title']) ||
          !empty($eventData['feature_paragraph'])): ?>
<section class="feature-section"
  style="background-image: url('<?= !empty($eventData['feature_bg_image'])
    ? htmlspecialchars($eventData['feature_bg_image'])
    : '/assets/images/default-feature.jpg' ?>');">
  <h2>
    <?= !empty($eventData['feature_title'])
        ? htmlspecialchars($eventData['feature_title'])
        : 'Default Feature Title' ?>
  </h2>
  <p>
    <?= !empty($eventData['feature_paragraph'])
        ? nl2br(htmlspecialchars($eventData['feature_paragraph']))
        : 'Default feature description...' ?>
  </p>
  <button class="btn btn-light">View Schedule</button>
</section>
<?php endif; ?>
