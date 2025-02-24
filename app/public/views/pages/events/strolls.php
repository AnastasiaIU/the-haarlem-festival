<?php
$heroData = [
  'bg_image'  => $eventDTO->heroBgImage  ?? '/assets/images/default-hero.jpg',
  'title'     => $eventDTO->heroTitle    ?? 'History Strolls',
  'paragraph' => $eventDTO->heroParagraph ?? 'Explore the old city...',
  'svg_path'  => '/assets/images/Rectangle4Strolls.svg',
  'show_ellipse' => true  
];

$mainContent = __DIR__ . '/../../partials/events/strolls/strolls.php';
include __DIR__ . '/../../templates/event-page.php';
