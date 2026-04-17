<?php

use Brigada\StatamicCmsStarter\Http\Controllers\PagesController;
use Brigada\StatamicCmsStarter\Http\Controllers\RobotsController;
use Brigada\StatamicCmsStarter\Http\Controllers\SitemapController;
use Illuminate\Support\Facades\Route;

if (config('cms-starter.sitemap.enabled', true)) {
    Route::get('/sitemap.xml', [SitemapController::class, 'show'])
        ->name('cms.sitemap');
}

if (config('cms-starter.robots.enabled', true)) {
    Route::get('/robots.txt', [RobotsController::class, 'show'])
        ->name('cms.robots');
}

Route::get('/', [PagesController::class, 'show'])
    ->defaults('slug', 'home')
    ->name('cms.page.home');

Route::get('/{slug}', [PagesController::class, 'show'])
    ->where('slug', '[a-z0-9\-]+')
    ->name('cms.page.show');
