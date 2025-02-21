<?php

abstract class BaseEvent extends BaseModel
{
    // Common protected properties for all events
    protected string $title       = '';
    protected string $description = '';
    protected string $image       = '';
    protected string $location    = '';

    /**
     * Force child classes to implement how they load or return event data.
     * Could return a DTO or just assign properties internally.
     */
    abstract public function getEventDetails(): array;


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

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getImage(): string
    {
        return $this->image;
    }

    public function setImage(string $image): void
    {
        $this->image = $image;
    }

    public function getLocation(): string
    {
        return $this->location;
    }

    public function setLocation(string $location): void
    {
        $this->location = $location;
    }
}
