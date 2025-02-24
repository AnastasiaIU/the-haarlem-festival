<?php

require_once __DIR__ . '/BaseEvent.php';

class MagicTeylersEvent extends BaseEvent
{
    protected string $eventSlug = 'teylers';
   //for now it has the stuff for hero section only

    public function getEventDetails(): array
    {
        $dto = $this->fetchEventData();
        if (!$dto) {
            return [];
        }
        return [
            'heroTitle'    => $dto->heroTitle,
            'heroParagraph'=> $dto->heroParagraph,
            'heroBgImage'  => $dto->heroBgImage
        ];
    }
}

