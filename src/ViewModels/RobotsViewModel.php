<?php

namespace Brigada\StatamicCmsStarter\ViewModels;

readonly class RobotsViewModel
{
    /**
     * @param  RobotsAgentViewModel[]  $agents
     */
    public function __construct(
        public array $agents,
        public ?string $sitemapUrl,
    ) {}
}
