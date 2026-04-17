<?php

namespace Brigada\StatamicCmsStarter\ViewModels;

readonly class SchemaViewModel
{
    /**
     * @param  string[]  $blocks  Each entry is a pre-encoded JSON-LD string.
     */
    public function __construct(
        public array $blocks,
    ) {}
}
