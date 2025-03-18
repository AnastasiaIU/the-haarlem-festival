<?php

require_once(__DIR__ . '/../models/ImageModel.php');

class ImageController
{
    private ImageModel $imageModel;

    public function __construct()
    {
        $this->imageModel = new ImageModel();
    }

    /**
     * Updates an image reference in the specified database table.
     *
     * This function updates a record in the database by setting the specified column
     * to the provided image filename, based on a given row ID.
     *
     * @param string $table The name of the database table where the image path should be updated.
     * @param string $column The column name that stores the image filename.
     * @param int $id The id of the record to be updated.
     * @param string $imageName The filename of the uploaded image to be stored in the database.
     *
     * @return void This method does not return any value.
     *
     * @throws PDOException If the database query fails.
     */
    public function updateImage(string $table, string $column, int $id, string $imageName): void
    {
        $this->imageModel->updateImage($table, $column, $id, $imageName);
    }
}