<?php

require_once(__DIR__ . '/../../src/controllers/SocialMediaController.php');

Route::add('/api/getSocialMediaByRestaurantId/([0-9]+)', function ($restaurantId) {
    $socialMediaController = new SocialMediaController();
    $socialMedia = $socialMediaController->fetchSocialMediaByRestaurant($restaurantId);
    echo json_encode($socialMedia);
});