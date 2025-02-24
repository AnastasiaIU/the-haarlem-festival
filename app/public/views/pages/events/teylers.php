<?php

$heroData = [
  'bg_image'    => $eventDTO->heroBgImage  ?? '/assets/images/default-hero.jpg',
  'title'       => $eventDTO->heroTitle    ?? 'VISIT THE TEYLER\'S MUSEUM',
  'paragraph'   => $eventDTO->heroParagraph?? 'Default Teylers paragraph...',
  'svg_path'    => '/assets/images/Rectangle4MagicTeylers.svg',

  // two buttons
  'extra_heading' => "HAVE FUN ON OUR NEW APP AND DISCOVER PROFESSOR TYLER'S SECRET!",
  'extra_text'    => "Download the app now to experience exclusive content.",
  'button1_link'  => "https://play.google.com",
  'button1_text'  => "Get on Android",
  'button2_link'  => "https://apps.apple.com",
  'button2_text'  => "Get on iOS"
];

$mainContent = __DIR__ . '/../../partials/events/teylers/teylers.php';
include __DIR__ . '/../../templates/event-page.php';
