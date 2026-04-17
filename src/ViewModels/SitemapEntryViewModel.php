<?php 

    namespace Brigada\StatamicCmsStarter\ViewModels;

    readonly class SitemapEntryViewModel 
    {
        public function __construct(
            public string $loc,
            public string $lastmod
        ) {}
    }