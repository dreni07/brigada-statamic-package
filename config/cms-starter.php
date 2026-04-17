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

];
