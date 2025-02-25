<?php
namespace dto;

class TeylersEventDTO extends EventDTO 
{

    public ?string $featureTitle; 
    public ?string $featureParagraph; 
    public ?string $featureBgImage; 
    public ?string $appPromotionTitle;
    public ?string $appPromotionParagraph;

    public function __construct(array $data)
    {
        // constructs from master dto
        parent::__construct($data);

        // new fields
        $this->featureTitle= $data['feature_title'] ?? null; 
        $this->featureParagraph = $data['feature_paragraph'] ?? null; 
        $this->featureBgImage = $data['feature_bg_image'] ?? null;
        $this->appPromotionTitle = $data['app_promotion_title'] ?? null;
        $this->appPromotionParagraph = $data['app_promotion_paragraph'] ?? null;

    }
}