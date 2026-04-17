<?php 

    namespace Brigada\StatamicCmsStarter\ViewModels;

    readonly class SitemapViewModel 
    {
        public function __construct(
            public array $entries
        ) {}
    
    }