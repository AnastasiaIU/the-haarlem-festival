<?php
// Assume $eventDTO is provided by DanceEventController.

$heroData = [
  'bg_image'    => $eventDTO->heroBgImage  ?? '/assets/images/default-hero.jpg',
  'title'       => $eventDTO->heroTitle    ?? 'DANCE FESTIVAL',
  'paragraph'   => $eventDTO->heroParagraph?? 'Join the groove and dance the night away!',
  'svg_path'    => '/assets/images/Rectangle4Dance.svg',
  'show_ellipse' => true,  

  // For Dance, maybe only one button is needed:
  'extra_heading' => "BUY TICKETS NOW!",
  'extra_text'    => "Secure your spot and enjoy exclusive performances.",
  'button1_link'  => "https://ticketing.example.com/dance",
  'button1_text'  => "Buy Tickets"
  // No second button provided.
];

$mainContent = __DIR__ . '/../../partials/events/dance/dance.php';
include __DIR__ . '/../../templates/event-page.php';
