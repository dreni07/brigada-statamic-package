<?php

namespace Brigada\StatamicCmsStarter\Domain\Sections;

use Brigada\StatamicCmsStarter\Contracts\SectionContract;
use Brigada\StatamicCmsStarter\ViewModels\Sections\VideoViewModel;

class VideoSection implements SectionContract
{
    public function __construct(
        private readonly ?string $sectionHeading,
        private readonly ?string $sectionDescription,
        private readonly string $source,
        private readonly ?string $embedUrl,
        private readonly ?string $fileUrl,
        private readonly ?string $poster,
        private readonly bool $autoplay,
        private readonly bool $loop,
        private readonly bool $muted,
        private readonly string $headingTagValue,
    ) {}

    public function type(): string
    {
        return 'video';
    }

    public function viewName(): string
    {
        return 'cms-starter::sections.video';
    }

    public function toViewModel(): VideoViewModel
    {
        return new VideoViewModel(
            sectionHeading: $this->sectionHeading,
            sectionDescription: $this->sectionDescription,
            headingTag: $this->headingTagValue,
            source: $this->source,
            embedUrl: $this->embedUrl,
            fileUrl: $this->fileUrl,
            poster: $this->poster,
            autoplay: $this->autoplay,
            loop: $this->loop,
            muted: $this->muted,
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
