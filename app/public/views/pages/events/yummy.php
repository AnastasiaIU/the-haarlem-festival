<?php
// $eventDTO from YummyEventController

$heroData = [
  'bg_image'  => $eventDTO->heroBgImage  ?? '/assets/images/default-hero.jpg',
  'title'     => $eventDTO->heroTitle    ?? 'Yummy Delights',
  'paragraph' => $eventDTO->heroParagraph ?? 'Taste the best cuisines...',
  'svg_path'  => '/assets/images/Rectangle4Yummy.svg',
  'show_ellipse' => true  
];

$mainContent = __DIR__ . '/../../partials/events/yummy/yummy.php';
include __DIR__ . '/../../templates/event-page.php';
