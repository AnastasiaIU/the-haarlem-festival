<?php

require_once(__DIR__ . '/../enums/Michelin.php');

/**
 * Data Transfer Object (DTO) for representing a restaurant.
 */
class RestaurantDTO implements JsonSerializable
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
    private string $carouselImage1;
    private string $carouselImage2;
    private string $carouselImage3;
    private string $carouselImage4;
    private string $carouselImage5;
    private string $carouselImage6;
    private array $foodTypes;

    public function __construct(
        int    $id, int $eventId, string $slug, string $name, string $address,
        int    $stars, ?Michelin $michelin, string $description, string $cardDescription,
        int    $capacity, float $fullPrice, float $adultPrice, float $kidsPrice,
        float  $duration, int $sessions, string $firstSession, string $menu,
        string $phone, string $email, string $startDate, string $endDate, string $carouselImage1, string $carouselImage2,
        string $carouselImage3, string $carouselImage4, string $carouselImage5, string $carouselImage6, array $foodTypes
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
        $this->carouselImage1 = $carouselImage1;
        $this->carouselImage2 = $carouselImage2;
        $this->carouselImage3 = $carouselImage3;
        $this->carouselImage4 = $carouselImage4;
        $this->carouselImage5 = $carouselImage5;
        $this->carouselImage6 = $carouselImage6;
        $this->foodTypes = $foodTypes;
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
            'michelin' => $this->michelin?->value,
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
            'end_date' => $this->endDate,
            'carousel_image1' => $this->carouselImage1,
            'carousel_image2' => $this->carouselImage2,
            'carousel_image3' => $this->carouselImage3,
            'carousel_image4' => $this->carouselImage4,
            'carousel_image5' => $this->carouselImage5,
            'carousel_image6' => $this->carouselImage6,
            'food_types' => array_map(fn($p) => $p->toArray(), $this->foodTypes)
        ];
    }

    /**
     * Creates a RestaurantDTO instance from an associative array.
     *
     * @param array $restaurant The associative array containing restaurant data.
     * @return self A new instance of RestaurantDTO populated with the provided data.
     */
    public static function fromArray(array $restaurant, array $foodTypes): self
    {
        $michelin = isset($restaurant['michelin']) ? Michelin::from($restaurant['michelin']) : null;

        return new self(
            $restaurant['id'],
            $restaurant['event_id'],
            $restaurant['slug'],
            $restaurant['name'],
            $restaurant['address'],
            $restaurant['stars'],
            $michelin,
            $restaurant['description'],
            $restaurant['card_description'],
            $restaurant['capacity'],
            $restaurant['full_price'],
            $restaurant['adult_price'],
            $restaurant['kids_price'],
            $restaurant['duration'],
            $restaurant['sessions'],
            $restaurant['first_session'],
            $restaurant['menu'],
            $restaurant['phone'],
            $restaurant['email'],
            $restaurant['start_date'],
            $restaurant['end_date'],
            $restaurant['carousel_image1'],
            $restaurant['carousel_image2'],
            $restaurant['carousel_image3'],
            $restaurant['carousel_image4'],
            $restaurant['carousel_image5'],
            $restaurant['carousel_image6'],
            $foodTypes
        );
    }

    /**
     * Converts the EventDTO object to a JSON-serializable array.
     *
     * @return array A JSON-serializable array representing the EventDTO object.
     */
    public function jsonSerialize(): array
    {
        return self::toArray();
    }
}