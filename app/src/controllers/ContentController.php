<?php

require_once(__DIR__ . '/../models/ContentModel.php');

/**
 * Controller class for handling content-related operations.
 */
class ContentController
{
    private ContentModel $contentModel;

    public function __construct()
    {
        $this->contentModel = new ContentModel();
    }

    /**
     * Updates content in the specified database table.
     *
     * This function updates a record in the database by setting the specified column
     * to the provided content, based on a given row ID.
     *
     * @param string $table The name of the database table where the content should be updated.
     * @param string $column The column name that stores the related content.
     * @param int $id The id of the record to be updated.
     * @param string|null $content The content which will be stored in the database. Can be NULL.
     *
     * @return void This method does not return any value.
     *
     */
    public function updateContent(string $table, string $column, int $id, ?string $content): void
    {
        $this->contentModel->updateContent($table, $column, $id, $content);
    }
}