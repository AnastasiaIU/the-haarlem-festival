<?php

require_once(__DIR__ . '/../models/TourModel.php');
require_once(__DIR__ . '/../dto/TourDTO.php');

/**
 * Controller class for handling tour-related operations.
 */
class TourController
{
    private TourModel $tourModel;

    public function __construct()
    {
        $this->tourModel = new TourModel();
    }

    /**
     * Fetches all tours from the database.
     *
     * @return array An array of tour objects.
     */
    public function fetchAllTours(): array
    {
        return $this->tourModel->fetchAllTours();
    }
}