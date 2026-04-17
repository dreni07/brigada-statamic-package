<?php

namespace Brigada\StatamicCmsStarter\ViewModels\Sections;

use Brigada\StatamicCmsStarter\ViewModels\Blocks\FaqItemViewModel;

readonly class FaqViewModel
{
    /**
     * @param  FaqItemViewModel[]  $items
     */
    public function __construct(
        public ?string $sectionHeading,
        public ?string $sectionDescription,
        public string $headingTag,
        public array $items,
        public ?string $jsonLd,
    ) {}
}
