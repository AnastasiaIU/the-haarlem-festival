<?php

require_once(__DIR__ . "/BaseModel.php");
require_once(__DIR__ . '/../dto/ArtistDTO.php');

/**
 * ArtistModel class extends BaseModel to interact with the ARTIST entity in the database.
 */
class ArtistModel extends BaseModel
{
    /**
     * Fetches all artists from the database.
     *
     * @return array An array of artist objects.
     */
    public function fetchAllArtists(): array
    {
        $query = self::$pdo->prepare(
            'SELECT id, event_id, slug, stage_name, genre, hero_description, card_description, image, card_image, carousel_image1, carousel_image2, carousel_image3, carousel_image4, carousel_image5, carousel_image6
                    FROM artist'
        );
        $query->execute();
        $artists = $query->fetchAll(PDO::FETCH_ASSOC);
        $dtos = [];

        foreach ($artists as $artist) {
            $dto = ArtistDTO::fromArray($artist);
            $dtos[] = $dto;
        }

        return $dtos;
    }

    /**
     * Fetches a single artist entity by its id.
     *
     * @param int $id The id of the artist to fetch.
     * @return EventDTO|null The artist object if found, otherwise null.
     */
    public function fetchArtistById(int $id): ?ArtistDTO
    {
        $query = self::$pdo->prepare(
            'SELECT id, event_id, slug, stage_name, genre, hero_description, card_description, image, card_image, carousel_image1, carousel_image2, carousel_image3, carousel_image4, carousel_image5, carousel_image6
        FROM artist
        WHERE id = :id'
        );

        $query->execute([':id' => $id]);
        $artist = $query->fetch(PDO::FETCH_ASSOC);

        if (!$artist) {
            return null;
        }

        return ArtistDTO::fromArray($artist);
    }

    /**
     * Fetches a single artist by its slug.
     *
     * @param string $slug The slug of the artist to fetch.
     * @return ArtistDTO|null The artist object if found, otherwise null.
     */
    public function fetchArtistBySlug(string $slug): ?ArtistDTO
    {
        $query = self::$pdo->prepare(
            'SELECT id, event_id, slug, stage_name, genre, hero_description, card_description, image, card_image, carousel_image1, carousel_image2, carousel_image3, carousel_image4, carousel_image5, carousel_image6
        FROM artist
        WHERE slug = :slug'
        );

        $query->execute([':slug' => $slug]);
        $artist = $query->fetch(PDO::FETCH_ASSOC);

        if (!$artist) {
            return null;
        }

        return ArtistDTO::fromArray($artist);
    }

    public function updateArtist(int $id, array $data): bool
{
    $allowedFields = [
        'slug',
        'stage_name',
        'genre',
        'hero_description',
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

    $setParts = ['event_id = 2'];

    foreach ($allowedFields as $field) {
        if (array_key_exists($field, $data)) {
            $setParts[] = "$field = :$field";
        }
    }

    $setClause = implode(', ', $setParts);

    $sql = "UPDATE artist SET $setClause WHERE id = :id";

    $query = self::$pdo->prepare($sql);
    $data['id'] = $id;

    return $query->execute($data);
}

    public function createArtist(array $data): bool
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
            'INSERT INTO artist 
            (event_id, slug, stage_name, genre, hero_description, card_description, 
            image, card_image, carousel_image1, carousel_image2, carousel_image3, 
            carousel_image4, carousel_image5, carousel_image6) 
            VALUES 
            (2, :slug, :stage_name, :genre, :hero_description, :card_description, 
            :image, :card_image, :carousel_image1, :carousel_image2, :carousel_image3, 
            :carousel_image4, :carousel_image5, :carousel_image6)'
        );

        return $query->execute($data);
    }

    public function deleteArtist(int $id): bool
        {
            $query = self::$pdo->prepare('DELETE FROM artist WHERE id = :id');
            return $query->execute(['id' => $id]);
        }
}