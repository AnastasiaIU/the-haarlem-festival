<?php

namespace App\DTO;

class MagicTeylersDTO
{
    public ?int $id = null;
    public ?string $event_slug = null;

    // Hero
    public ?string $hero_bg_image = null;
    public ?string $hero_title = null;
    public ?string $hero_paragraph = null;

    // Feature
    public ?string $feature_bg_image = null;
    public ?string $feature_title = null;
    public ?string $feature_paragraph = null;

    // Map
    public ?string $map_embed_url = null;
}
