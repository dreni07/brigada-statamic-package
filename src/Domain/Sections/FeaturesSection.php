<?php

namespace Brigada\StatamicCmsStarter\Domain\Sections;

use Brigada\StatamicCmsStarter\Contracts\BlockContract;
use Brigada\StatamicCmsStarter\Contracts\SectionContract;
use Brigada\StatamicCmsStarter\ViewModels\Sections\FeaturesViewModel;

class FeaturesSection implements SectionContract
{
    /**
     * @param  BlockContract[]  $features
     */
    public function __construct(
        private readonly ?string $sectionHeading,
        private readonly ?string $sectionDescription,
        private readonly int $columns,
        private readonly array $features,
        private readonly string $headingTagValue,
    ) {}

    public function type(): string
    {
        return 'features';
    }

    public function viewName(): string
    {
        return 'cms-starter::sections.features';
    }

    public function toViewModel(): FeaturesViewModel
    {
        return new FeaturesViewModel(
            sectionHeading: $this->sectionHeading,
            sectionDescription: $this->sectionDescription,
            headingTag: $this->headingTagValue,
            columns: $this->columns,
            features: array_map(
                fn (BlockContract $feature) => $feature->toViewModel(),
                $this->features,
            ),
        );
    }

    public function isFullWidth(): bool
    {
        return true;
    }

    public function blocks(): array
    {
        return $this->features;
    }

    public function headingTag(): string
    {
        return $this->headingTagValue;
    }
}
