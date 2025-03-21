<?php

require_once(__DIR__ . '/../models/PassModel.php');
require_once(__DIR__ . '/../dto/PassDTO.php');

/**
 * Controller class for handling pass-related operations for the DANCE! event.
 */
class PassController
{
    private PassModel $passModel;

    public function __construct()
    {
        $this->passModel = new PassModel();
    }

    /**
     * Fetches all passes from the database.
     *
     * @return array An array of pass objects.
     */
    public function fetchAllPasses(): array
    {
        return $this->passModel->fetchAllPasses();
    }
}