<?php

require_once __DIR__ . '/BaseEvent.php';

class DanceEvent extends BaseEvent
{
    protected string $eventSlug = 'dance';
    public function getEventDetails(): array
    {
        $dto = $this->fetchEventData();
        if (!$dto) {
            return [];
        }
        return [
            'heroTitle' => $dto->heroTitle,
            'heroParagraph' => $dto->heroParagraph,
            'heroBgImage' => $dto->heroBgImage
        ];
    }
}


