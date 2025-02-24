<?php

namespace dto;

class EventDTO
{
    public int $id;
    public string $eventSlug;
    public ?string $title;
    public ?string $description;
    public ?string $heroBgImage;
    public ?string $heroTitle;
    public ?string $heroParagraph;
    public ?string $featureBgImage;
    public ?string $featureTitle;
    public ?string $featureParagraph;
    public ?string $mapEmbedUrl;
    public ?string $location;

    public function __construct(array $data)
    {
        $this->id               = (int)($data['id'] ?? 0);
        $this->eventSlug        = $data['event_slug']        ?? '';
        $this->title            = $data['title']             ?? null;
        $this->description      = $data['description']       ?? null;
        $this->heroBgImage      = $data['hero_bg_image']     ?? null;
        $this->heroTitle        = $data['hero_title']        ?? null;
        $this->heroParagraph    = $data['hero_paragraph']    ?? null;

        // These are optional maybe move to a teylers folder only
        $this->featureBgImage   = $data['feature_bg_image']  ?? null;
        $this->featureTitle     = $data['feature_title']     ?? null;
        $this->featureParagraph = $data['feature_paragraph'] ?? null;
        $this->mapEmbedUrl      = $data['map_embed_url']     ?? null;
        $this->location         = $data['location']          ?? null;
    }
}
