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

];
