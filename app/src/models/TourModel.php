<?php

require_once(__DIR__ . "/BaseModel.php");
require_once(__DIR__ . '/../dto/TourDTO.php');

class TourModel extends BaseModel
{
    /**
     * Fetches all tours from the database.
     *
     * @return array An array of tour objects.
     */
    public function fetchAllTours(): array
    {
        $query = self::$pdo->prepare(
            'SELECT tour.id, guide_id, tour_id as tour_type_id, date_time, capacity, single_price, family_price, language_id, name, description, image, language
                    FROM tour
                    JOIN tour_type ON tour_type.id = tour_id
                    JOIN guide ON guide.id = guide_id
                    JOIN language ON language.id = language_id
                    ORDER BY date_time, name'
        );
        $query->execute();
        $tours = $query->fetchAll(PDO::FETCH_ASSOC);
        $dtos = [];

        foreach ($tours as $tour) {
            $dto = TourDTO::fromArray($tour);
            $dtos[] = $dto;
        }

        return $dtos;
    }
}