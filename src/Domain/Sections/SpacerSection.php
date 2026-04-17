<?php

namespace Brigada\StatamicCmsStarter\Domain\Sections;

use Brigada\StatamicCmsStarter\Contracts\SectionContract;
use Brigada\StatamicCmsStarter\ViewModels\Sections\SpacerViewModel;

class SpacerSection implements SectionContract
{
    public function __construct(
        private readonly string $size,
        private readonly bool $showDivider,
        private readonly string $headingTagValue,
    ) {}

    public function type(): string
    {
        return 'spacer';
    }

    public function viewName(): string
    {
        return 'cms-starter::sections.spacer';
    }

    public function toViewModel(): SpacerViewModel
    {
        return new SpacerViewModel(
            size: $this->size,
            showDivider: $this->showDivider,
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
