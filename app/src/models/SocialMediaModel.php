<?php

require_once(__DIR__ . "/BaseModel.php");
require_once(__DIR__ . '/../dto/SocialMediaDTO.php');

/**
 * SocialMediaDTO class extends BaseModel to interact with the SOCIAL MEDIA entity in the database.
 */
class SocialMediaModel extends BaseModel
{
    /**
     * Fetches all social media for the restaurant.
     *
     * @param int $restaurantId The id of the restaurant.
     * @return array An array of social media objects.
     */
    public function fetchSocialMediaByRestaurant(int $restaurantId): array
    {
        $query = self::$pdo->prepare(
            'SELECT id, restaurant_id, platform, link
                    FROM social_media
                    WHERE restaurant_id = :restaurantId'
        );

        $query->execute([':restaurantId' => $restaurantId]);
        $socialMedia = $query->fetchAll(PDO::FETCH_ASSOC);

        $dtos = [];

        foreach ($socialMedia as $sm) {
            $dto = SocialMediaDTO::fromArray($sm);
            $dtos[] = $dto;
        }

        return $dtos;
    }
}