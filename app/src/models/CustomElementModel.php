<?php

require_once(__DIR__ . "/BaseModel.php");
require_once(__DIR__ . '/../dto/CustomDTO.php');

/**
 * CustomElementModel class extends BaseModel to interact with the CUSTOM entity in the database.
 */
class CustomElementModel extends BaseModel
{
    /**
     * Fetches a single custom CMS entity by its identifier.
     *
     * @param string $identifier The identifier of the custom CMS entity to fetch.
     * @return CustomDTO|null The custom CMS entity object if found, otherwise null.
     */
    public function fetchCustomByIdentifier(string $identifier): ?CustomDTO
    {
        $query = self::$pdo->prepare(
            'SELECT id, identifier, content
        FROM custom
        WHERE identifier = :identifier'
        );

        $query->execute([':identifier' => $identifier]);
        $custom = $query->fetch(PDO::FETCH_ASSOC);

        if (!$custom) {
            return null;
        }

        return CustomDTO::fromArray($custom);
    }
}