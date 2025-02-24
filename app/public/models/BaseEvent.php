<?php

require_once __DIR__ . '/BaseModel.php';
require_once __DIR__ . '/../dto/EventDTO.php';

use dto\EventDTO;

abstract class BaseEvent extends BaseModel
{
    protected string $eventSlug = '';  
    protected string $title = '';
    protected string $description = '';
    protected string $image = '';
    protected string $location = '';   


    public function fetchEventData(): ? EventDTO
    {
        try {
            $sql = "SELECT * FROM events WHERE event_slug = :slug LIMIT 1";
            $stmt = self::$pdo->prepare($sql);
            $stmt->bindValue(':slug', $this->eventSlug, PDO::PARAM_STR);
            $stmt->execute();

            $row = $stmt->fetch();
            if (!$row) {
                return null;
            }
            $dto = new EventDTO($row);

            $this->setTitle($dto->heroTitle ?? '');
            $this->setDescription($dto->heroParagraph ?? '');
            $this->setImage($dto->heroBgImage ?? '');
            // $this->location = $dto->location ?? '';

            return $dto;
        } catch (PDOException $e) {
            error_log("Database error in " . get_class($this) . ": " . $e->getMessage());
            return null;
        }
    }

    // Abstrac method so we can have different event details for every event

    abstract public function getEventDetails(): array;

    // getters/setters
    public function getTitle(): string
    {
        return $this->title;
    }
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }
    public function setDescription(string $desc): void
    {
        $this->description = $desc;
    }

    public function getImage(): string
    {
        return $this->image;
    }
    public function setImage(string $img): void
    {
        $this->image = $img;
    }

    public function getLocation(): string
    {
        return $this->location;
    }
    public function setLocation(string $loc): void
    {
        $this->location = $loc;
    }
}
