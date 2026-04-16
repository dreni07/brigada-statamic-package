<?php

namespace Brigada\StatamicCmsStarter\Domain\Sections;

use Brigada\StatamicCmsStarter\Contracts\SectionContract;
use Brigada\StatamicCmsStarter\ViewModels\Sections\TextContentViewModel;
use Illuminate\Support\Str;

class TextContentSection implements SectionContract
{
    public function __construct(
        private readonly string $content,
        private readonly string $headingTagValue,
    ) {}

    public function type(): string
    {
        return 'text_content';
    }

    public function viewName(): string
    {
        return 'cms-starter::sections.text-content';
    }

    public function toViewModel(): TextContentViewModel
    {
        return new TextContentViewModel(
            htmlContent: Str::markdown($this->content),
            headingTag: $this->headingTagValue,
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
