<?php

namespace Brigada\StatamicCmsStarter\Domain\Sections;

use Brigada\StatamicCmsStarter\Contracts\SectionContract;
use Brigada\StatamicCmsStarter\ViewModels\Sections\RichTextViewModel;

class RichTextSection implements SectionContract
{
    public function __construct(
        private readonly string $format,
        private readonly string $htmlContent,
        private readonly string $maxWidth,
        private readonly string $headingTagValue,
    ) {}

    public function type(): string
    {
        return 'rich_text';
    }

    public function viewName(): string
    {
        return 'cms-starter::sections.rich-text';
    }

    public function toViewModel(): RichTextViewModel
    {
        return new RichTextViewModel(
            format: $this->format,
            htmlContent: $this->htmlContent,
            maxWidth: $this->maxWidth,
        );
    }

    public function isFullWidth(): bool
    {
        return false;
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
