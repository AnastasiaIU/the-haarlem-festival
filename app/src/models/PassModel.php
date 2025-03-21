<?php

require_once(__DIR__ . "/BaseModel.php");
require_once(__DIR__ . '/../dto/PassDTO.php');

/**
 * PassModel class extends BaseModel to interact with the PASS entity in the database.
 */
class PassModel extends BaseModel
{
    /**
     * Fetches all passes from the database.
     *
     * @return array An array of pass objects.
     */
    public function fetchAllPasses(): array
    {
        $query = self::$pdo->prepare(
            'SELECT id, price, day
                    FROM pass'
        );
        $query->execute();
        $passes = $query->fetchAll(PDO::FETCH_ASSOC);
        $dtos = [];

        foreach ($passes as $pass) {
            $dto = PassDTO::fromArray($pass);
            $dtos[] = $dto;
        }

        return $dtos;
    }
}