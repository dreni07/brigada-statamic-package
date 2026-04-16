<?php

use Brigada\StatamicCmsStarter\Http\Controllers\PagesController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PagesController::class, 'show'])
    ->defaults('slug', 'home')
    ->name('cms.page.home');

Route::get('/{slug}', [PagesController::class, 'show'])
    ->where('slug', '[a-z0-9\-]+')
    ->name('cms.page.show');
