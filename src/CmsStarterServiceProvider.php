<?php

namespace Brigada\StatamicCmsStarter;

use Illuminate\Support\ServiceProvider;
use Brigada\StatamicCmsStarter\Commands\CmsInstallCommand;
use Brigada\StatamicCmsStarter\Listeners\ConvertUploadedImageToWebp;
use Illuminate\Support\Facades\Event;
use Statamic\Events\AssetUploaded;

class CmsStarterServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Event::listen(AssetUploaded::class, ConvertUploadedImageToWebp::class);

        if ($this->app->runningInConsole()) {
            $this->commands([
                CmsInstallCommand::class,
            ]);

            $this->publishes([
                __DIR__ . '/../resources/blueprints' => resource_path('blueprints'),
                __DIR__ . '/../resources/fieldsets' => resource_path('fieldsets'),
                __DIR__ . '/../resources/content' => base_path('content'),
                __DIR__ . '/../resources/forms' => resource_path('forms'),
            ], 'cms-starter');
        }
    }
}
