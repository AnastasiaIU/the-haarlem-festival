<?php

require_once(__DIR__ . '/../models/ButtonModel.php');

/**
 * Controller class for handling button-related operations.
 */
class ButtonController
{
    private ButtonModel $buttonModel;

    public function __construct()
    {
        $this->buttonModel = new ButtonModel();
    }

    /**
     * Fetches a single button by its id.
     *
     * @param int $id The id of the button to fetch.
     * @return ButtonDTO|null The button object if found, otherwise null.
     */
    public function fetchButtonById(int $id): ?ButtonDTO
    {
        return $this->buttonModel->fetchButtonById($id);
    }
}