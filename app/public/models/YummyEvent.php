<?php

require_once __DIR__ . '/BaseEvent.php';

class YummyEvent extends BaseEvent
{
    protected string $eventSlug = 'yummy';

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
