<?php

require_once __DIR__ . '/BaseEvent.php';

class DanceEvent extends BaseEvent
{
    protected string $eventSlug = 'dance';
    
    public function getEventDetails(): array
    {
        $dto = $this->fetchEventData();
        if (!$dto) {
            return [
                'heroTitle' => 'DANCE FESTIVAL',
                'heroParagraph' => 'Join us for an unforgettable night of dance!',
                'heroBgImage' => '/assets/images/dance-default.jpg',
                'extraHeading' => 'GET YOUR TICKETS NOW!',
                'extraText' => 'Don\'t miss out on the hottest dance event of the year',
                'button1Link' => '/tickets/dance',
                'button1Text' => 'Buy Tickets'
            ];
        }
        
        return [
            'heroTitle' => $dto->heroTitle,
            'heroParagraph' => $dto->heroParagraph,
            'heroBgImage' => $dto->heroBgImage,
            'extraHeading' => $dto->extraHeading ?? 'GET YOUR TICKETS NOW!',
            'extraText' => $dto->extraText ?? 'Don\'t miss out on the hottest dance event of the year',
            'button1Link' => $dto->button1Link ?? '/tickets/dance',
            'button1Text' => $dto->button1Text ?? 'Buy Tickets'
        ];
    }
}


