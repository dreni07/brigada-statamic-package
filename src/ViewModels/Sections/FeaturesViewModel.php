<?php

namespace Brigada\StatamicCmsStarter\ViewModels\Sections;

use Brigada\StatamicCmsStarter\ViewModels\Blocks\FeatureViewModel;

readonly class FeaturesViewModel
{
    /**
     * @param  FeatureViewModel[]  $features
     */
    public function __construct(
        public ?string $sectionHeading,
        public ?string $sectionDescription,
        public string $headingTag,
        public int $columns,
        public array $features,
    ) {}
}
