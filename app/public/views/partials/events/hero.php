<?php
/**
 * Hero partial (for any event)
 * expected data in $heroData
 * 
 * Required keys:
 * - 'bg_image'    => string (background image URL)
 * - 'title'       => string (hero heading)
 * - 'paragraph'   => string (hero paragraph text)
 * - 'svg_path'    => string (path to the shape SVG)
 *
 * Optional keys (can add more if needed):
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
    no-repeat left center; background-size: cover;">
  
  <!-- The shape (SVG) -->
  <img class="shape"
       src="<?= !empty($heroData['svg_path'])
         ? htmlspecialchars($heroData['svg_path'])
         : '/assets/images/Rectangle4MagicTeylers.svg' ?>"
       alt="Shape decoration" />

  <div class="hero-text-container">
    <!-- Main Title -->
    <h1>
      <?= !empty($heroData['title'])
        ? htmlspecialchars($heroData['title'])
        : "DEFAULT EVENT TITLE" ?>
    </h1>

    <!-- Paragraph -->
    <p>
      <?= !empty($heroData['paragraph'])
        ? nl2br(htmlspecialchars($heroData['paragraph']))
        : "Default paragraph..." ?>
    </p>
<!-- optional sections bools check if the event page has any of the optional variables set up  -->
    <?php 
    $hasExtraHeading = !empty($heroData['extra_heading']);
    $hasExtraText    = !empty($heroData['extra_text']);
    $hasButton1      = !empty($heroData['button1_link']) && !empty($heroData['button1_text']);
    $hasButton2      = !empty($heroData['button2_link']) && !empty($heroData['button2_text']);


    // if any of the optional bools sections are set up, display them
    if ($hasExtraHeading || $hasExtraText || $hasButton1 || $hasButton2): ?>
      
      <!-- Optional Sub-Heading -->
      <?php if ($hasExtraHeading): ?>
        <h2 class="sub-heading">
          <?= htmlspecialchars($heroData['extra_heading']) ?>
        </h2>
      <?php endif; ?>

      <!-- Optional Extra Text -->
      <?php if ($hasExtraText): ?>
        <p class="extra-text">
          <?= htmlspecialchars($heroData['extra_text']) ?>
        </p>
      <?php endif; ?>

      <!-- Button Group (1 or 2 buttons) -->
      <div class="button-group">
        <?php if ($hasButton1): ?>
          <a href="<?= htmlspecialchars($heroData['button1_link']) ?>" class="btn store-badge">
            <?= htmlspecialchars($heroData['button1_text']) ?>
          </a>
        <?php endif; ?>

        <?php if ($hasButton2): ?>
          <a href="<?= htmlspecialchars($heroData['button2_link']) ?>" class="btn store-badge">
            <?= htmlspecialchars($heroData['button2_text']) ?>
          </a>
        <?php endif; ?>
      </div>
    <?php endif; ?>
  </div>
  
  <!-- Optional ellipse overlay -->
  <?php if (!empty($heroData['show_ellipse'])): ?>
    <img class="hero-ellipse"
         src="/assets/images/Ellipse.png"
         alt="Decorative ellipse" />
  <?php endif; ?>
</section>
