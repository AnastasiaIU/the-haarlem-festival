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

    // Optional extra call-to-action fields
    public ?string $extraHeading;
    public ?string $extraText;
    public ?string $button1Link;
    public ?string $button1Text;
    public ?string $button2Link;
    public ?string $button2Text;

    //will update to have fields for restaurant (rating stars, location, and whatever else is needed)

    public function __construct(array $data)
    {
        $this->id               = (int)($data['id'] ?? 0);
        $this->eventSlug        = $data['event_slug']        ?? '';
        $this->title            = $data['title']             ?? null;
        $this->description      = $data['description']       ?? null;
        $this->heroBgImage      = $data['hero_bg_image']     ?? null;
        $this->heroTitle        = $data['hero_title']        ?? null;
        $this->heroParagraph    = $data['hero_paragraph']    ?? null;
        $this->featureBgImage   = $data['feature_bg_image']  ?? null;
        $this->featureTitle     = $data['feature_title']     ?? null;
        $this->featureParagraph = $data['feature_paragraph'] ?? null;
        $this->mapEmbedUrl      = $data['map_embed_url']     ?? null;
        $this->location         = $data['location']          ?? null;
        $this->extraHeading     = $data['extra_heading']     ?? null;
        $this->extraText        = $data['extra_text']        ?? null;
        $this->button1Link      = $data['button1_link']      ?? null;
        $this->button1Text      = $data['button1_text']      ?? null;
        $this->button2Link      = $data['button2_link']      ?? null;
        $this->button2Text      = $data['button2_text']      ?? null;
    }
}
