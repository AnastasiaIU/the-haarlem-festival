<?php

require_once(__DIR__ . '/../enums/Michelin.php');

/**
 * Data Transfer Object (DTO) for representing a restaurant.
 */
class RestaurantDTO
{
    private int $id;
    private int $eventId;
    private string $slug;
    private string $name;
    private string $address;
    private int $stars;
    private ?Michelin $michelin;
    private string $description;
    private string $cardDescription;
    private int $capacity;
    private float $fullPrice;
    private float $adultPrice;
    private float $kidsPrice;
    private float $duration;
    private int $sessions;
    private string $firstSession;
    private string $menu;
    private string $phone;
    private string $email;
    private string $startDate;
    private string $endDate;

    public function __construct(
        int    $id, int $eventId, string $slug, string $name, string $address,
        int    $stars, ?Michelin $michelin, string $description, string $cardDescription,
        int    $capacity, float $fullPrice, float $adultPrice, float $kidsPrice,
        float  $duration, int $sessions, string $firstSession, string $menu,
        string $phone, string $email, string $startDate, string $endDate
    )
    {
        $this->id = $id;
        $this->eventId = $eventId;
        $this->slug = $slug;
        $this->name = $name;
        $this->address = $address;
        $this->stars = $stars;
        $this->michelin = $michelin;
        $this->description = $description;
        $this->cardDescription = $cardDescription;
        $this->capacity = $capacity;
        $this->fullPrice = $fullPrice;
        $this->adultPrice = $adultPrice;
        $this->kidsPrice = $kidsPrice;
        $this->duration = $duration;
        $this->sessions = $sessions;
        $this->firstSession = $firstSession;
        $this->menu = $menu;
        $this->phone = $phone;
        $this->email = $email;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    /**
     * Converts the RestaurantDTO object to an associative array.
     *
     * @return array An associative array representing the RestaurantDTO object.
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'event_id' => $this->eventId,
            'slug' => $this->slug,
            'name' => $this->name,
            'address' => $this->address,
            'stars' => $this->stars,
            'michelin' => $this->michelin->value,
            'description' => $this->description,
            'card_description' => $this->cardDescription,
            'capacity' => $this->capacity,
            'full_price' => $this->fullPrice,
            'adult_price' => $this->adultPrice,
            'kids_price' => $this->kidsPrice,
            'duration' => $this->duration,
            'sessions' => $this->sessions,
            'first_session' => $this->firstSession,
            'menu' => $this->menu,
            'phone' => $this->phone,
            'email' => $this->email,
            'start_date' => $this->startDate,
            'end_date' => $this->endDate
        ];
    }

    /**
     * Creates a RestaurantDTO instance from an associative array.
     *
     * @param array $data The associative array containing restaurant data.
     * @return self A new instance of RestaurantDTO populated with the provided data.
     */
    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'],
            $data['event_id'],
            $data['slug'],
            $data['name'],
            $data['address'],
            $data['stars'],
            Michelin::from($data['michelin']) ?? null,
            $data['description'],
            $data['card_description'],
            $data['capacity'],
            $data['full_price'],
            $data['adult_price'],
            $data['kids_price'],
            $data['duration'],
            $data['sessions'],
            $data['first_session'],
            $data['menu'],
            $data['phone'],
            $data['email'],
            $data['start_date'],
            $data['end_date']
        );
    }
}