<?php

namespace Brigada\StatamicCmsStarter\ViewModels;

readonly class RobotsAgentViewModel
{
    /**
     * @param  string[]  $disallow
     * @param  string[]  $allow
     */
    public function __construct(
        public string $userAgent,
        public array $disallow,
        public array $allow,
    ) {}
}
