<?php

namespace Brigada\StatamicCmsStarter\Domain;

use Brigada\StatamicCmsStarter\ViewModels\SeoViewModel;

class SeoData
{
    public function __construct(
        private readonly string $title,
        private readonly string $description,
        private readonly ?string $canonicalUrl,
        private readonly bool $noIndex,
        private readonly ?string $ogImage,
        private readonly string $ogType,
    ) {}

    public function title(): string
    {
        return $this->title;
    }

    public function description(): string
    {
        return $this->description;
    }

    public function canonicalUrl(): ?string
    {
        return $this->canonicalUrl;
    }

    public function noIndex(): bool
    {
        return $this->noIndex;
    }

    public function ogImage(): ?string
    {
        return $this->ogImage;
    }

    public function ogType(): string
    {
        return $this->ogType;
    }

    public function toViewModel(): SeoViewModel
    {
        return new SeoViewModel(
            title: $this->title,
            description: $this->description,
            canonicalUrl: $this->canonicalUrl,
            noIndex: $this->noIndex,
            ogImage: $this->ogImage,
            ogType: $this->ogType,
        );
    }
}
