<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Site Name
    |--------------------------------------------------------------------------
    |
    | Used in SEO meta tags and navigation. Falls back to APP_NAME.
    |
    */
    'site_name' => env('APP_NAME', 'Brigada CMS'),

    /*
    |--------------------------------------------------------------------------
    | Register Routes
    |--------------------------------------------------------------------------
    |
    | Set to false to disable the package's route registration.
    | Useful when you want to define your own routes in the consuming app.
    |
    */
    'register_routes' => true,

    /*
    |--------------------------------------------------------------------------
    | Sitemap
    |--------------------------------------------------------------------------
    |
    | Controls whether the package registers the dynamic /sitemap.xml route.
    | Set 'enabled' to false if your app provides its own sitemap.
    |
    */
    'sitemap' => [
        'enabled' => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | Robots
    |--------------------------------------------------------------------------
    |
    | Controls the dynamic /robots.txt route.
    |
    | - 'enabled'         → register the route or not.
    | - 'include_sitemap' → append "Sitemap: <url>" when sitemap.enabled is true.
    | - 'agents'          → one entry per User-agent block.
    |                       Each supports 'user_agent', 'disallow', 'allow'.
    |
    */
    'robots' => [
        'enabled' => true,
        'include_sitemap' => true,
        'agents' => [
            [
                'user_agent' => '*',
                'disallow' => [],
                'allow' => [],
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Schema.org JSON-LD
    |--------------------------------------------------------------------------
    |
    | Controls the structured-data JSON-LD blocks rendered in the <head> of
    | every page. Each block is gated by its own 'enabled' flag so consumers
    | can turn off individual schemas without disabling the whole feature.
    |
    | - organization.name       → defaults to site_name when null.
    | - organization.logo_url   → absolute URL to the organization logo.
    | - organization.same_as    → array of social / profile URLs for the brand.
    |
    | Per-page schemas (webpage, breadcrumbs) are emitted when the current
    | URL resolves to a Statamic entry. Entries in the 'blog' collection are
    | rendered as 'Article' instead of 'WebPage'.
    |
    */
    'schema' => [
        'enabled' => true,
        'organization' => [
            'enabled' => true,
            'name' => null,
            'logo_url' => null,
            'same_as' => [],
        ],
        'website' => [
            'enabled' => true,
        ],
        'webpage' => [
            'enabled' => true,
        ],
        'breadcrumbs' => [
            'enabled' => true,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Performance hints
    |--------------------------------------------------------------------------
    |
    | Emits <link rel="preconnect"> and <link rel="preload"> tags in the
    | page <head> so browsers can open network connections and fetch
    | critical resources (LCP image, custom fonts) as early as possible.
    |
    | - preconnect: third-party origins you load from (fonts, analytics,
    |   CDNs). Set 'crossorigin' => true for origins serving CORS assets
    |   such as fonts. Set 'dns_prefetch' => true to also emit a
    |   <link rel="dns-prefetch"> as a fallback for older browsers.
    |
    | - preload: resources the browser should start fetching immediately.
    |   Required keys: 'href', 'as' (image, font, style, script, fetch).
    |   For fonts set 'type' => 'font/woff2' and 'crossorigin' => true.
    |   For the LCP image use 'as' => 'image' and optionally provide
    |   'imagesrcset' / 'imagesizes' to match the responsive <img>.
    |
    */
    'performance' => [
        'preconnect' => [
            // [
            //     'href' => 'https://fonts.gstatic.com',
            //     'crossorigin' => true,
            //     'dns_prefetch' => false,
            // ],
        ],
        'preload' => [
            // [
            //     'href' => '/fonts/inter.woff2',
            //     'as' => 'font',
            //     'type' => 'font/woff2',
            //     'crossorigin' => true,
            // ],
            // [
            //     'href' => '/storage/images/hero.webp',
            //     'as' => 'image',
            //     'fetchpriority' => 'high',
            //     'imagesrcset' => '/storage/images/hero.webp 1x',
            //     'imagesizes' => '100vw',
            // ],
        ],
    ],

];
