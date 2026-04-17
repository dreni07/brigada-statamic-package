<?php

namespace Brigada\StatamicCmsStarter\Domain\Sections;

use Brigada\StatamicCmsStarter\Contracts\BlockContract;
use Brigada\StatamicCmsStarter\Contracts\SectionContract;
use Brigada\StatamicCmsStarter\ViewModels\Sections\PricingViewModel;

class PricingSection implements SectionContract
{
    /**
     * @param  BlockContract[]  $tiers
     */
    public function __construct(
        private readonly ?string $sectionHeading,
        private readonly ?string $sectionDescription,
        private readonly array $tiers,
        private readonly string $headingTagValue,
    ) {}

    public function type(): string
    {
        return 'pricing';
    }

    public function viewName(): string
    {
        return 'cms-starter::sections.pricing';
    }

    public function toViewModel(): PricingViewModel
    {
        return new PricingViewModel(
            sectionHeading: $this->sectionHeading,
            sectionDescription: $this->sectionDescription,
            headingTag: $this->headingTagValue,
            tiers: array_map(
                fn (BlockContract $tier) => $tier->toViewModel(),
                $this->tiers,
            ),
        );
    }

    public function isFullWidth(): bool
    {
        return true;
    }

    public function blocks(): array
    {
        return $this->tiers;
    }

    public function headingTag(): string
    {
        return $this->headingTagValue;
    }
}
