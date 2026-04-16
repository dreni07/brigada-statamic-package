<?php

namespace Brigada\StatamicCmsStarter\ViewModels\Sections;

use Brigada\StatamicCmsStarter\ViewModels\Blocks\CardViewModel;

readonly class ContentCardsViewModel
{
    /**
     * @param  CardViewModel[]  $cards
     */
    public function __construct(
        public ?string $sectionHeading,
        public string $headingTag,
        public array $cards,
    ) {}
}
