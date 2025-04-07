<?php

require_once(__DIR__ . "/BaseModel.php");
require_once(__DIR__ . '/../dto/LocationDTO.php');

/**
 * LocationModel class extends BaseModel to interact with the LOCATION entity in the database.
 */
class LocationModel extends BaseModel
{
    /**
     * Fetches all location from the database.
     *
     * @return array An array of location objects.
     */
    public function fetchAllLocations(): array
    {
        $query = self::$pdo->prepare(
            'SELECT id, event_id, slug, name, address, description, card_description, image, card_image, carousel_image1, carousel_image2, carousel_image3, carousel_image4, carousel_image5, carousel_image6
                    FROM location'
        );
        $query->execute();
        $locations = $query->fetchAll(PDO::FETCH_ASSOC);
        $dtos = [];

        foreach ($locations as $location) {
            $dto = LocationDTO::fromArray($location);
            $dtos[] = $dto;
        }

        return $dtos;
    }

    /**
     * Fetches a single location by its slug.
     *
     * @param string $slug The slug of the location to fetch.
     * @return LocationDTO|null The location object if found, otherwise null.
     */
    public function fetchLocationBySlug(string $slug): ?LocationDTO
    {
        $query = self::$pdo->prepare(
            'SELECT id, event_id, slug, name, address, description, card_description, image, card_image, carousel_image1, carousel_image2, carousel_image3, carousel_image4, carousel_image5, carousel_image6
                    FROM location
                    WHERE slug = :slug'
        );

        $query->execute([':slug' => $slug]);
        $location = $query->fetch(PDO::FETCH_ASSOC);

        if (!$location) {
            return null;
        }

        return LocationDTO::fromArray($location);
    }

    public function createLocation(array $data): bool
    {
        $uploadDir = __DIR__ . '/../../public/assets/images/'; 
        $imagePaths = [];
    
        $imageFields = [
            'image', 'card_image', 'carousel_image1', 'carousel_image2', 
            'carousel_image3', 'carousel_image4', 'carousel_image5', 'carousel_image6'
        ];
    
        foreach ($imageFields as $field) {
            if (isset($_FILES[$field]) && $_FILES[$field]['error'] == UPLOAD_ERR_OK) {
                $file = $_FILES[$field];
                $fileName = time() . '_' . basename($file['name']); 
                $filePath = $uploadDir . $fileName;

                if (move_uploaded_file($file['tmp_name'], $filePath)) {
                    $imagePaths[$field] = $fileName;
                } else {
                    echo json_encode(["success" => false, "message" => "Error uploading file: $field"]);
                    return false;
                }
            }
        }

        $data = array_merge($data, $imagePaths);

        $query = self::$pdo->prepare(
            'INSERT INTO location 
            (event_id, slug, name, address, description, card_description, image, card_image, 
            carousel_image1, carousel_image2, carousel_image3, carousel_image4, carousel_image5, carousel_image6) 
            VALUES 
            (4, :slug, :name, :address, :description, :card_description, :image, :card_image, 
            :carousel_image1, :carousel_image2, :carousel_image3, :carousel_image4, :carousel_image5, :carousel_image6)'
        );
    
        return $query->execute($data);
    }

    public function updateLocation(int $id, array $data): bool
    {
        $data['event_id'] = 4;
        $data['id'] = $id;

        $allowedFields = [
            'slug',
            'name',
            'address',
            'description',
            'card_description',
            'image',
            'card_image',
            'carousel_image1',
            'carousel_image2',
            'carousel_image3',
            'carousel_image4',
            'carousel_image5',
            'carousel_image6'
        ];

        $setParts = ['event_id = :event_id'];

        foreach ($allowedFields as $field) {
            if (array_key_exists($field, $data)) {
                $setParts[] = "$field = :$field";
            }
        }

        if (count($setParts) === 1) {
            return false; 
        }

        $setClause = implode(', ', $setParts);
        $sql = "UPDATE location SET $setClause WHERE id = :id";

        $query = self::$pdo->prepare($sql);
        return $query->execute($data); 
    }

    public function deleteLocation(int $id): bool
    {
        $query = self::$pdo->prepare('DELETE FROM location WHERE id = :id');
        return $query->execute(['id' => $id]);
    }
}