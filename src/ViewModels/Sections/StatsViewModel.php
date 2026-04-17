<?php

namespace Brigada\StatamicCmsStarter\ViewModels\Sections;

use Brigada\StatamicCmsStarter\ViewModels\Blocks\StatViewModel;

readonly class StatsViewModel
{
    /**
     * @param  StatViewModel[]  $stats
     */
    public function __construct(
        public ?string $sectionHeading,
        public ?string $sectionDescription,
        public string $headingTag,
        public array $stats,
    ) {}
}
