<?php
// add here the partials see example in teylers.php


// instead of having this on every page (redundant now we set them up once in the base controller)

// $mainContent = __DIR__ . '/../../partials/events/dance/dance.php';
// include __DIR__ . '/../../templates/event-page.php';



//partials

require_once __DIR__ . '/../../partials/events/dance/artist.php';
//for artists will make a for each loop to display all artists
//artist partial will have if counter % 2 == 0 then display artist left else display artist right
//artist partial has Artist Name, SUBTITLE, PARAGRAPH, LEARN MORE BUTTON NEXT TO IMMAGE OF ARTIST


require_once __DIR__ . '/../../partials/events/dance/specialOffers.php';
require_once __DIR__ . '/../../partials/events/dance/location.php';