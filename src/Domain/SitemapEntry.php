<?php

namespace Brigada\StatamicCmsStarter\Domain;

use Brigada\StatamicCmsStarter\ViewModels\SitemapEntryViewModel;

class SitemapEntry
{
    public function __construct(
        private readonly string $loc,
        private readonly string $lastmod,
    ) {}

    public function loc(): string
    {
        return $this->loc;
    }

    public function lastmod(): string
    {
        return $this->lastmod;
    }

    public function toViewModel(): SitemapEntryViewModel
    {
        return new SitemapEntryViewModel(
            loc: $this->loc,
            lastmod: $this->lastmod,
        );
    }
}
