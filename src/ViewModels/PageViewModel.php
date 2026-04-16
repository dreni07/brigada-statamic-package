<?php

namespace Brigada\StatamicCmsStarter\ViewModels;

readonly class PageViewModel
{
    /**
     * @param  SectionViewModelEntry[]  $sections
     */
    public function __construct(
        public string $title,
        public string $slug,
        public SeoViewModel $seo,
        public array $sections,
    ) {}
}
