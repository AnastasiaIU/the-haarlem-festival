<?php

require_once(__DIR__ . '/../models/CustomElementModel.php');

/**
 * Controller class for handling custom-element-related operations.
 */
class CustomElementController
{
    private CustomElementModel $customModel;

    public function __construct()
    {
        $this->customModel = new CustomElementModel();
    }

    /**
     * Fetches a single custom CMS entity by its identifier.
     *
     * @param string $identifier The identifier of the custom CMS entity to fetch.
     * @return CustomDTO|null The custom CMS entity object if found, otherwise null.
     */
    public function fetchCustomByIdentifier(string $identifier): ?CustomDTO
    {
        return $this->customModel->fetchCustomByIdentifier($identifier);
    }
}