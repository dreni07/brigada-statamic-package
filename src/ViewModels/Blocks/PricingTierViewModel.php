<?php

namespace Brigada\StatamicCmsStarter\ViewModels\Blocks;

readonly class PricingTierViewModel
{
    /**
     * @param  string[]  $features
     */
    public function __construct(
        public string $name,
        public ?string $description,
        public string $price,
        public ?string $pricePrefix,
        public ?string $pricePeriod,
        public array $features,
        public ?string $buttonText,
        public ?string $buttonUrl,
        public string $buttonStyle,
        public bool $isFeatured,
    ) {}
}
