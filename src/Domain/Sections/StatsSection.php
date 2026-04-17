<?php

namespace Brigada\StatamicCmsStarter\Domain\Sections;

use Brigada\StatamicCmsStarter\Contracts\BlockContract;
use Brigada\StatamicCmsStarter\Contracts\SectionContract;
use Brigada\StatamicCmsStarter\ViewModels\Sections\StatsViewModel;

class StatsSection implements SectionContract
{
    /**
     * @param  BlockContract[]  $stats
     */
    public function __construct(
        private readonly ?string $sectionHeading,
        private readonly ?string $sectionDescription,
        private readonly array $stats,
        private readonly string $headingTagValue,
    ) {}

    public function type(): string
    {
        return 'stats';
    }

    public function viewName(): string
    {
        return 'cms-starter::sections.stats';
    }

    public function toViewModel(): StatsViewModel
    {
        return new StatsViewModel(
            sectionHeading: $this->sectionHeading,
            sectionDescription: $this->sectionDescription,
            headingTag: $this->headingTagValue,
            stats: array_map(
                fn (BlockContract $stat) => $stat->toViewModel(),
                $this->stats,
            ),
        );
    }

    public function isFullWidth(): bool
    {
        return true;
    }

    public function blocks(): array
    {
        return $this->stats;
    }

    public function headingTag(): string
    {
        return $this->headingTagValue;
    }
}
