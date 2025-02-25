<?php
// add here the partials see example in teylers.php


// instead of having this on every page (redundant now we set them up once in the base controller)

// $mainContent = __DIR__ . '/../../partials/events/strolls/strolls.php';
// include __DIR__ . '/../../templates/event-page.php';


//partials

// require_once __DIR__ . '/../../partials/events/strolls/textSection.php';
//there are 3 text sections  each with title+ paragraph x 3 so we store it once to db as an object 
//textSection partial will have a for each loop to display all text sections


require_once __DIR__ . '/../../partials/events/dance/specialOffers.php';
require_once __DIR__ . '/../../partials/events/dance/location.php';