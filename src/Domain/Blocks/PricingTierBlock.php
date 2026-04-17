<?php

namespace Brigada\StatamicCmsStarter\Domain\Blocks;

use Brigada\StatamicCmsStarter\Contracts\BlockContract;
use Brigada\StatamicCmsStarter\ViewModels\Blocks\PricingTierViewModel;

class PricingTierBlock implements BlockContract
{
    /**
     * @param  string[]  $features
     */
    public function __construct(
        private readonly string $name,
        private readonly ?string $description,
        private readonly string $price,
        private readonly ?string $pricePrefix,
        private readonly ?string $pricePeriod,
        private readonly array $features,
        private readonly ?string $buttonText,
        private readonly ?string $buttonUrl,
        private readonly string $buttonStyle,
        private readonly bool $isFeatured,
    ) {}

    public function type(): string
    {
        return 'pricing_tier';
    }

    public function toViewModel(): PricingTierViewModel
    {
        return new PricingTierViewModel(
            name: $this->name,
            description: $this->description,
            price: $this->price,
            pricePrefix: $this->pricePrefix,
            pricePeriod: $this->pricePeriod,
            features: $this->features,
            buttonText: $this->buttonText,
            buttonUrl: $this->buttonUrl,
            buttonStyle: $this->buttonStyle,
            isFeatured: $this->isFeatured,
        );
    }
}
