<?php

namespace Brigada\StatamicCmsStarter\Services;

use Brigada\StatamicCmsStarter\Contracts\PageRepositoryContract;
use Brigada\StatamicCmsStarter\Domain\Page;
use Brigada\StatamicCmsStarter\Domain\SeoData;
use Brigada\StatamicCmsStarter\Factories\SectionFactory;

class PageBuilderService
{
    public function __construct(
        private readonly PageRepositoryContract $repository,
        private readonly SectionFactory $sectionFactory,
        private readonly DataNormalizerService $normalizer,
    ) {}

    public function build(string $slug): ?Page
    {
        $data = $this->repository->findBySlug($slug);

        if ($data === null) {
            return null;
        }

        $seo = $this->buildSeoData($data['seo'] ?? [], $data['title'] ?? '');
        $rawSections = $data['sections'] ?? [];
        $headingTags = $this->resolveHeadingTags($rawSections);

        $sections = [];
        foreach ($rawSections as $index => $set) {
            $type = $set['type'] ?? null;

            if ($type === null) {
                continue;
            }

            if (isset($set['enabled']) && ! $set['enabled']) {
                continue;
            }

            try {
                $sections[] = $this->sectionFactory->create(
                    $type,
                    $set,
                    $headingTags[$index] ?? 'h2',
                );
            } catch (\InvalidArgumentException) {
                continue;
            }
        }

        return new Page(
            title: $this->normalizer->normalizeString($data['title'] ?? null, $slug),
            slug: $slug,
            seo: $seo,
            sections: $sections,
        );
    }

    private function buildSeoData(array $seoArray, string $fallbackTitle): SeoData
    {
        return new SeoData(
            title: $this->normalizer->normalizeString($seoArray['seo_title'] ?? null, $fallbackTitle),
            description: $this->normalizer->normalizeString($seoArray['seo_description'] ?? null),
            canonicalUrl: $this->normalizer->normalizeUrl($seoArray['canonical_url'] ?? null),
            noIndex: $this->normalizer->normalizeBool($seoArray['no_index'] ?? null),
            ogImage: is_string($seoArray['og_image'] ?? null) ? $seoArray['og_image'] : null,
            ogType: $this->normalizer->normalizeString($seoArray['og_type'] ?? null, 'website'),
        );
    }

    /**
     * SEO heading tag policy:
     * - If any section is 'hero', it gets h1. All others get h2.
     * - If no hero, the first section gets h1. All subsequent get h2.
     *
     * @return string[]
     */
    private function resolveHeadingTags(array $rawSections): array
    {
        $tags = [];
        $hasHero = false;

        foreach ($rawSections as $set) {
            if (($set['type'] ?? null) === 'hero') {
                $hasHero = true;
                break;
            }
        }

        $h1Assigned = false;

        foreach ($rawSections as $set) {
            $type = $set['type'] ?? null;

            if ($hasHero && $type === 'hero' && ! $h1Assigned) {
                $tags[] = 'h1';
                $h1Assigned = true;
            } elseif (! $hasHero && ! $h1Assigned) {
                $tags[] = 'h1';
                $h1Assigned = true;
            } else {
                $tags[] = 'h2';
            }
        }

        return $tags;
    }
}
