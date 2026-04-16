<?php

namespace Brigada\StatamicCmsStarter\Domain;

use Brigada\StatamicCmsStarter\Contracts\SectionContract;
use Brigada\StatamicCmsStarter\ViewModels\PageViewModel;
use Brigada\StatamicCmsStarter\ViewModels\SectionViewModelEntry;

class Page
{
    /**
     * @param  SectionContract[]  $sections
     */
    public function __construct(
        private readonly string $title,
        private readonly string $slug,
        private readonly SeoData $seo,
        private readonly array $sections,
    ) {}

    public function title(): string
    {
        return $this->title;
    }

    public function slug(): string
    {
        return $this->slug;
    }

    public function seo(): SeoData
    {
        return $this->seo;
    }

    /**
     * @return SectionContract[]
     */
    public function sections(): array
    {
        return $this->sections;
    }

    public function toViewModel(): PageViewModel
    {
        $sectionEntries = array_map(
            fn (SectionContract $section) => new SectionViewModelEntry(
                viewName: $section->viewName(),
                data: $section->toViewModel(),
                isFullWidth: $section->isFullWidth(),
            ),
            $this->sections,
        );

        return new PageViewModel(
            title: $this->title,
            slug: $this->slug,
            seo: $this->seo->toViewModel(),
            sections: $sectionEntries,
        );
    }
}
