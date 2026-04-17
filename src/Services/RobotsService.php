<?php

namespace Brigada\StatamicCmsStarter\Services;

use Brigada\StatamicCmsStarter\ViewModels\RobotsAgentViewModel;
use Brigada\StatamicCmsStarter\ViewModels\RobotsViewModel;

class RobotsService
{
    public function build(): RobotsViewModel
    {
        $agents = array_map(
            fn (array $agent) => $this->toAgentViewModel($agent),
            $this->normalizeAgents(config('cms-starter.robots.agents', [])),
        );

        return new RobotsViewModel(
            agents: $agents,
            sitemapUrl: $this->resolveSitemapUrl(),
        );
    }

    /**
     * @return array<int, array{user_agent: string, disallow: string[], allow: string[]}>
     */
    private function normalizeAgents(mixed $raw): array
    {
        if (! is_array($raw) || $raw === []) {
            return [[
                'user_agent' => '*',
                'disallow' => [],
                'allow' => [],
            ]];
        }

        return array_map(function ($agent) {
            return [
                'user_agent' => is_string($agent['user_agent'] ?? null)
                    ? trim($agent['user_agent'])
                    : '*',
                'disallow' => $this->normalizePaths($agent['disallow'] ?? []),
                'allow' => $this->normalizePaths($agent['allow'] ?? []),
            ];
        }, array_values($raw));
    }

    /**
     * @return string[]
     */
    private function normalizePaths(mixed $paths): array
    {
        if (! is_array($paths)) {
            return [];
        }

        return array_values(array_filter(
            array_map(fn ($path) => is_string($path) ? trim($path) : '', $paths),
            fn (string $path) => $path !== '',
        ));
    }

    private function toAgentViewModel(array $agent): RobotsAgentViewModel
    {
        return new RobotsAgentViewModel(
            userAgent: $agent['user_agent'],
            disallow: $agent['disallow'],
            allow: $agent['allow'],
        );
    }

    private function resolveSitemapUrl(): ?string
    {
        $includeSitemap = (bool) config('cms-starter.robots.include_sitemap', true);
        $sitemapEnabled = (bool) config('cms-starter.sitemap.enabled', true);

        if (! $includeSitemap || ! $sitemapEnabled) {
            return null;
        }

        return url('/sitemap.xml');
    }
}
