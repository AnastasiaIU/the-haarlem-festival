<?php

require_once __DIR__ . '/BaseEvent.php';

class MagicTeylersEvent extends BaseEvent
{
    protected string $eventSlug = 'teylers';

    public function getEventDetails(): array
    {
        $dto = $this->fetchEventData();
        if (!$dto) {
            return [
                'heroTitle' => 'VISIT THE TEYLER\'S MUSEUM',
                'heroParagraph' => 'Step into a world of wonder and discovery...',
                'heroBgImage' => '/assets/images/teylers-default.jpg',
                'extraHeading' => 'DOWNLOAD OUR MAGICAL APP!',
                'extraText' => 'Discover Professor Tyler\'s secrets with our interactive app',
                'button1Link' => 'https://play.google.com',
                'button1Text' => 'Get on Android',
                'button2Link' => 'https://apps.apple.com',
                'button2Text' => 'Get on iOS'
            ];
        }

        return [
            'heroTitle' => $dto->heroTitle,
            'heroParagraph' => $dto->heroParagraph,
            'heroBgImage' => $dto->heroBgImage,
            'extraHeading' => $dto->extraHeading ?? 'DOWNLOAD OUR MAGICAL APP!',
            'extraText' => $dto->extraText ?? 'Discover Professor Tyler\'s secrets with our interactive app',
            'button1Link' => $dto->button1Link ?? 'https://play.google.com',
            'button1Text' => $dto->button1Text ?? 'Get on Android',
            'button2Link' => $dto->button2Link ?? 'https://apps.apple.com',
            'button2Text' => $dto->button2Text ?? 'Get on iOS'
        ];
    }
}

