<?php

namespace Brigada\StatamicCmsStarter\Repositories;

use Brigada\StatamicCmsStarter\Contracts\PageRepositoryContract;
use Statamic\Facades\Entry;

class StatamicPageRepository implements PageRepositoryContract
{
    public function findBySlug(string $slug): ?array
    {
        $entry = Entry::query()
            ->where('collection', 'pages')
            ->where('slug', $slug)
            ->first();

        if (! $entry) {
            return null;
        }

        $data = $entry->toAugmentedArray();

        return [
            'title' => $data['title']?->value() ?? $slug,
            'slug' => $data['slug']?->value() ?? $slug,
            'sections' => $this->extractSections($data),
            'seo' => $this->extractSeo($data),
        ];
    }

    public function allPages(): array
    {
        return Entry::query()
            ->where('collection', 'pages')
            ->get()
            ->map(fn ($entry) => [
                'title' => $entry->get('title', ''),
                'slug' => $entry->slug(),
                'url' => $entry->url(),
            ])
            ->all();
    }

    private function extractSections(array $data): array
    {
        $sections = $data['sections'] ?? null;

        if ($sections === null) {
            return [];
        }

        $raw = $sections->value();

        if (! is_array($raw)) {
            return [];
        }

        return array_map(function ($set) {
            $normalized = [];

            foreach ($set as $key => $value) {
                $normalized[$key] = is_object($value) && method_exists($value, 'value')
                    ? $value->value()
                    : $value;
            }

            return $normalized;
        }, $raw);
    }

    private function extractSeo(array $data): array
    {
        $extract = function (string $key) use ($data) {
            $value = $data[$key] ?? null;

            return is_object($value) && method_exists($value, 'value')
                ? $value->value()
                : $value;
        };

        return [
            'seo_title' => $extract('seo_title') ?? $extract('title') ?? '',
            'seo_description' => $extract('seo_description') ?? '',
            'canonical_url' => $extract('canonical_url'),
            'no_index' => (bool) ($extract('no_index') ?? false),
            'og_image' => $extract('og_image'),
            'og_type' => $extract('og_type') ?? 'website',
        ];
    }
}
