<?php
/**
 * Hero partial (universal for any event)
 *
 * Expects an array $heroData with the following keys:
 * - 'bg_image'    => string (background image URL)
 * - 'title'       => string (hero heading)
 * - 'paragraph'   => string (hero paragraph text)
 * - 'svg_path'    => string (path to the shape SVG)
 *
 * Optional keys for extra call-to-action:
 * - 'extra_heading' => string (optional extra heading)
 * - 'extra_text'    => string (optional extra text)
 * - 'button1_link'  => string (URL for button 1)
 * - 'button1_text'  => string (Label for button 1)
 * - 'button2_link'  => string (URL for button 2)
 * - 'button2_text'  => string (Label for button 2)
 *
 * - 'show_ellipse' => boolean (whether to show the ellipse overlay)
 */
?>

<section class="hero-section"
  style="background: url('<?= !empty($heroData['bg_image'])
    ? htmlspecialchars($heroData['bg_image'])
    : '/assets/images/default-hero.jpg' ?>')
    no-repeat left center;">
  
  <!-- The shape (SVG) -->
  <img class="shape"
       src="<?= !empty($heroData['svg_path'])
         ? htmlspecialchars($heroData['svg_path'])
         : '/assets/images/Rectangle4MagicTeylers.svg' ?>"
       alt="Shape decoration" />

  <!-- Text Container -->
  <div class="hero-text-container">
    <h1>
      <?= !empty($heroData['title'])
        ? htmlspecialchars($heroData['title'])
        : "DEFAULT EVENT TITLE" ?>
    </h1>

    <p>
      <?= !empty($heroData['paragraph'])
        ? nl2br(htmlspecialchars($heroData['paragraph']))
        : "Default paragraph..." ?>
    </p>

    <!-- Optional extra section -->
    <?php if (!empty($heroData['extra_heading']) ||
              !empty($heroData['extra_text'])    ||
              !empty($heroData['button1_link'])   ||
              !empty($heroData['button2_link'])): ?>

      <?php if (!empty($heroData['extra_heading'])): ?>
        <h2 class="sub-heading">
          <?= htmlspecialchars($heroData['extra_heading']) ?>
        </h2>
      <?php endif; ?>

      <?php if (!empty($heroData['extra_text'])): ?>
        <p class="extra-text">
          <?= htmlspecialchars($heroData['extra_text']) ?>
        </p>
      <?php endif; ?>

      <div class="button-group">
        <?php if (!empty($heroData['button1_link']) && !empty($heroData['button1_text'])): ?>
          <a href="<?= htmlspecialchars($heroData['button1_link']) ?>" class="btn store-badge">
            <?= htmlspecialchars($heroData['button1_text']) ?>
          </a>
        <?php endif; ?>

        <?php if (!empty($heroData['button2_link']) && !empty($heroData['button2_text'])): ?>
          <a href="<?= htmlspecialchars($heroData['button2_link']) ?>" class="btn store-badge">
            <?= htmlspecialchars($heroData['button2_text']) ?>
          </a>
        <?php endif; ?>
      </div>

    <?php endif; ?>
  </div>
  
  <?php if (!empty($heroData['show_ellipse'])): ?>
    <img class="hero-ellipse"
         src="/assets/images/Ellipse.png"
         alt="Decorative ellipse" />
  <?php endif; ?>
</section>
