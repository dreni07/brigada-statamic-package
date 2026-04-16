<?php

namespace Brigada\StatamicCmsStarter\Domain\Sections;

use Brigada\StatamicCmsStarter\Contracts\SectionContract;
use Brigada\StatamicCmsStarter\ViewModels\Sections\HeroViewModel;

class HeroSection implements SectionContract
{
    public function __construct(
        private readonly string $heading,
        private readonly ?string $subheading,
        private readonly ?string $backgroundImage,
        private readonly ?string $ctaButtonText,
        private readonly ?string $ctaButtonUrl,
        private readonly string $headingTagValue,
    ) {}

    public function type(): string
    {
        return 'hero';
    }

    public function viewName(): string
    {
        return 'cms-starter::sections.hero';
    }

    public function toViewModel(): HeroViewModel
    {
        return new HeroViewModel(
            heading: $this->heading,
            headingTag: $this->headingTagValue,
            subheading: $this->subheading,
            backgroundImage: $this->backgroundImage,
            ctaButtonText: $this->ctaButtonText,
            ctaButtonUrl: $this->ctaButtonUrl,
        );
    }

    public function isFullWidth(): bool
    {
        return true;
    }

    public function blocks(): array
    {
        return [];
    }

    public function headingTag(): string
    {
        return $this->headingTagValue;
    }
}
