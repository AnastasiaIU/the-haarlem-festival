<?php
namespace dto;

class DanceEventDTO extends EventDTO
{

    public ?string $artistName;
    public ?string $artistParagraph;

    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->artistName = $data['artist_name'] ?? null;
        $this->artistParagraph = $data['artist_paragraph'] ?? null;
    }
}
