<?php

/**
 * Data Transfer Object (DTO) for representing an event.
 */
class EventDTO {
    private int $id;
    private string $slug;
    private string $menuName;
    private ?string $heroTitle;
    private ?string $heroSubtitle;
    private ?string $heroDescription;
    private ?string $title;
    private ?string $subtitle;
    private ?string $homePageTitle;
    private ?string $homePageDescription;
    private ?string $image;
    private ?string $shape;

    public function __construct(
        int $id, string $slug, string $menuName, ?string $heroTitle,
        ?string $heroSubtitle, ?string $heroDescription, ?string $title,
        ?string $subtitle, ?string $homePageTitle, ?string $homePageDescription,
        ?string $image, ?string $shape
    ) {
        $this->id = $id;
        $this->slug = $slug;
        $this->menuName = $menuName;
        $this->heroTitle = $heroTitle;
        $this->heroSubtitle = $heroSubtitle;
        $this->heroDescription = $heroDescription;
        $this->title = $title;
        $this->subtitle = $subtitle;
        $this->homePageTitle = $homePageTitle;
        $this->homePageDescription = $homePageDescription;
        $this->image = $image;
        $this->shape = $shape;
    }

    // Getters
    public function getId(): int {
        return $this->id;
    }

    public function getSlug(): string {
        return $this->slug;
    }

    public function getMenuName(): string {
        return $this->menuName;
    }

    public function getHeroTitle(): ?string {
        return $this->heroTitle;
    }

    public function getHeroSubtitle(): ?string {
        return $this->heroSubtitle;
    }

    public function getHeroDescription(): ?string {
        return $this->heroDescription;
    }

    public function getTitle(): ?string {
        return $this->title;
    }

    public function getSubtitle(): ?string {
        return $this->subtitle;
    }

    public function getHomePageTitle(): ?string {
        return $this->homePageTitle;
    }

    public function getHomePageDescription(): ?string {
        return $this->homePageDescription;
    }

    public function getImage(): ?string {
        return $this->image;
    }

    public function getShape(): ?string {
        return $this->shape;
    }

    /**
     * Converts the EventDTO object to an associative array.
     *
     * @return array An associative array representing the EventDTO object.
     */
    public function toArray(): array {
        return [
            'id' => $this->id,
            'slug' => $this->slug,
            'menu_name' => $this->menuName,
            'hero_title' => $this->heroTitle,
            'hero_subtitle' => $this->heroSubtitle,
            'hero_description' => $this->heroDescription,
            'title' => $this->title,
            'subtitle' => $this->subtitle,
            'home_page_title' => $this->homePageTitle,
            'home_page_description' => $this->homePageDescription,
            'image' => $this->image,
            'shape' => $this->shape
        ];
    }

    /**
     * Creates an EventDTO instance from an associative array.
     *
     * @param array $data The associative array containing event data.
     * @return self A new instance of EventDTO populated with the provided data.
     */
    public static function fromArray(array $data): self {
        return new self(
            $data['id'],
            $data['slug'],
            $data['menu_name'],
            $data['hero_title'] ?? null,
            $data['hero_subtitle'] ?? null,
            $data['hero_description'] ?? null,
            $data['title'] ?? null,
            $data['subtitle'] ?? null,
            $data['home_page_title'] ?? null,
            $data['home_page_description'] ?? null,
            $data['image'] ?? null,
            $data['shape'] ?? null
        );
    }
}