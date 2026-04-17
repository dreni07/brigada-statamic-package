<?php

namespace Brigada\StatamicCmsStarter\ViewModels\Sections;

use Brigada\StatamicCmsStarter\ViewModels\Blocks\PricingTierViewModel;

readonly class PricingViewModel
{
    /**
     * @param  PricingTierViewModel[]  $tiers
     */
    public function __construct(
        public ?string $sectionHeading,
        public ?string $sectionDescription,
        public string $headingTag,
        public array $tiers,
    ) {}
}
