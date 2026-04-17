<?php

namespace Brigada\StatamicCmsStarter\Services;

use Brigada\StatamicCmsStarter\ViewModels\SchemaViewModel;
use Statamic\Contracts\Entries\Entry as EntryContract;
use Statamic\Facades\Entry;

class SchemaService
{
    public function buildForCurrentRequest(): SchemaViewModel
    {
        if (! (bool) config('cms-starter.schema.enabled', true)) {
            return new SchemaViewModel(blocks: []);
        }

        $blocks = [];

        if ((bool) config('cms-starter.schema.organization.enabled', true)) {
            $blocks[] = $this->buildOrganization();
        }

        if ((bool) config('cms-starter.schema.website.enabled', true)) {
            $blocks[] = $this->buildWebsite();
        }

        $entry = $this->currentEntry();

        if ($entry !== null && (bool) config('cms-starter.schema.webpage.enabled', true)) {
            $blocks[] = $this->buildWebPageOrArticle($entry);
        }

        if ($entry !== null
            && (bool) config('cms-starter.schema.breadcrumbs.enabled', true)
            && $this->entryUrl($entry) !== '/'
        ) {
            $blocks[] = $this->buildBreadcrumbs($entry);
        }

        return new SchemaViewModel(
            blocks: array_values(array_filter($blocks, fn ($block) => is_string($block) && $block !== '')),
        );
    }

    private function currentEntry(): ?EntryContract
    {
        $uri = '/' . ltrim(request()->path(), '/');

        try {
            return Entry::findByUri($uri === '/.' ? '/' : $uri);
        } catch (\Throwable) {
            return null;
        }
    }

    private function entryUrl(EntryContract $entry): string
    {
        return (string) ($entry->url() ?? '/');
    }

    private function buildOrganization(): string
    {
        $data = [
            '@context' => 'https://schema.org',
            '@type' => 'Organization',
            'name' => $this->organizationName(),
            'url' => url('/'),
        ];

        $logo = config('cms-starter.schema.organization.logo_url');
        if (is_string($logo) && $logo !== '') {
            $data['logo'] = $logo;
        }

        $sameAs = config('cms-starter.schema.organization.same_as', []);
        if (is_array($sameAs) && $sameAs !== []) {
            $data['sameAs'] = array_values(array_filter(
                array_map(fn ($u) => is_string($u) ? trim($u) : '', $sameAs),
                fn (string $u) => $u !== '',
            ));
        }

        return $this->encode($data);
    }

    private function buildWebsite(): string
    {
        return $this->encode([
            '@context' => 'https://schema.org',
            '@type' => 'WebSite',
            'name' => $this->organizationName(),
            'url' => url('/'),
        ]);
    }

    private function buildWebPageOrArticle(EntryContract $entry): string
    {
        $isArticle = $entry->collectionHandle() === 'blog';
        $type = $isArticle ? 'Article' : 'WebPage';

        $title = $this->stringField($entry, 'seo_title') ?: $this->stringField($entry, 'title');
        $description = $this->stringField($entry, 'seo_description');
        $url = url($this->entryUrl($entry));

        $data = [
            '@context' => 'https://schema.org',
            '@type' => $type,
            'name' => $title,
            'url' => $url,
        ];

        if ($description !== '') {
            $data['description'] = $description;
        }

        $modified = $entry->lastModified();
        if ($modified !== null) {
            $data['dateModified'] = $modified->toIso8601String();
        }

        if ($isArticle) {
            $published = $entry->date();
            if ($published !== null) {
                $data['datePublished'] = $published->toIso8601String();
            }

            $data['publisher'] = [
                '@type' => 'Organization',
                'name' => $this->organizationName(),
            ];
        }

        return $this->encode($data);
    }

    private function buildBreadcrumbs(EntryContract $entry): string
    {
        $items = [
            [
                '@type' => 'ListItem',
                'position' => 1,
                'name' => 'Home',
                'item' => url('/'),
            ],
            [
                '@type' => 'ListItem',
                'position' => 2,
                'name' => $this->stringField($entry, 'title'),
                'item' => url($this->entryUrl($entry)),
            ],
        ];

        return $this->encode([
            '@context' => 'https://schema.org',
            '@type' => 'BreadcrumbList',
            'itemListElement' => $items,
        ]);
    }

    private function organizationName(): string
    {
        $name = config('cms-starter.schema.organization.name');

        if (! is_string($name) || $name === '') {
            $name = config('cms-starter.site_name', config('app.name', 'Website'));
        }

        return (string) $name;
    }

    private function stringField(EntryContract $entry, string $field): string
    {
        $value = $entry->get($field);

        return is_string($value) ? trim($value) : '';
    }

    private function encode(array $data): string
    {
        return (string) json_encode($data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    }
}
