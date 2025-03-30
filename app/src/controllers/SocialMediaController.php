<?php

require_once(__DIR__ . '/../models/SocialMediaModel.php');
require_once(__DIR__ . '/../dto/SocialMediaDTO.php');

/**
 * Controller class for handling social media-related operations.
 */
class SocialMediaController
{
    private SocialMediaModel $socialMediaModel;

    public function __construct()
    {
        $this->socialMediaModel = new SocialMediaModel();
    }

    /**
     * Fetches all social media for the restaurant.
     *
     * @param int $restaurantId The id of the restaurant.
     * @return array An array of social media objects.
     */
    public function fetchSocialMediaByRestaurant(int $restaurantId): array
    {
        return $this->socialMediaModel->fetchSocialMediaByRestaurant($restaurantId);
    }
}