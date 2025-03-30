<?php

require_once(__DIR__ . "/BaseModel.php");
require_once(__DIR__ . '/../dto/DescriptionDTO.php');

/**
 * DescriptionModel class extends BaseModel to interact with the DESCRIPTION entity in the database.
 */
class DescriptionModel extends BaseModel
{
    /**
     * Fetches all descriptions for the location from the database.
     *
     * @param int $locationId The id of the location.
     * @return array An array of description objects.
     */
    public function fetchDescriptionsByLocation(int $locationId): array
    {
        $query = self::$pdo->prepare(
            'SELECT description.id, location_id, title_id, description.description, display_order, title
                    FROM description
                    JOIN title ON description.title_id = title.id
                    WHERE location_id = :locationId
                    ORDER BY display_order'
        );
        $query->execute([':locationId' => $locationId]);
        $descriptions = $query->fetchAll(PDO::FETCH_ASSOC);
        $dtos = [];

        foreach ($descriptions as $description) {
            $dto = DescriptionDTO::fromArray($description);
            $dtos[] = $dto;
        }

        return $dtos;
    }
}