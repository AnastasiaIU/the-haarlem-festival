<?php

require_once(__DIR__ . '/../models/DescriptionModel.php');
require_once(__DIR__ . '/../dto/DescriptionDTO.php');

/**
 * Controller class for handling description-related operations.
 */
class DescriptionController
{
    private DescriptionModel $descriptionModel;

    public function __construct()
    {
        $this->descriptionModel = new DescriptionModel();
    }

    /**
     * Fetches all descriptions for the location from the database.
     *
     * @param int $locationId The id of the location.
     * @return array An array of description objects.
     */
    public function fetchDescriptionsByLocation(int $locationId): array
    {
        return $this->descriptionModel->fetchDescriptionsByLocation($locationId);
    }
}