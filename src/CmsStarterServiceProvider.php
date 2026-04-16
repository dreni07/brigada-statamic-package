<?php

namespace Brigada\StatamicCmsStarter;

use Brigada\StatamicCmsStarter\Commands\CmsInstallCommand;
use Brigada\StatamicCmsStarter\Contracts\PageRepositoryContract;
use Brigada\StatamicCmsStarter\Http\ViewComposers\NavComposer;
use Brigada\StatamicCmsStarter\Http\ViewComposers\SeoComposer;
use Brigada\StatamicCmsStarter\Listeners\ConvertUploadedImageToWebp;
use Brigada\StatamicCmsStarter\Repositories\StatamicPageRepository;
use Brigada\StatamicCmsStarter\Services\AssetResolverService;
use Brigada\StatamicCmsStarter\Services\DataNormalizerService;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Statamic\Events\AssetUploaded;

class CmsStarterServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/cms-starter.php', 'cms-starter');

        $this->app->bind(PageRepositoryContract::class, StatamicPageRepository::class);
        $this->app->singleton(AssetResolverService::class);
        $this->app->singleton(DataNormalizerService::class);
    }

    public function boot(): void
    {
        Event::listen(AssetUploaded::class, ConvertUploadedImageToWebp::class);

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'cms-starter');

        if (config('cms-starter.register_routes', true)) {
            $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        }

        View::composer('cms-starter::partials.seo-meta', SeoComposer::class);
        View::composer('cms-starter::partials.nav', NavComposer::class);

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

            $this->publishes([
                __DIR__ . '/../resources/views' => resource_path('views/vendor/cms-starter'),
            ], 'cms-starter-views');

            $this->publishes([
                __DIR__ . '/../routes/web.php' => base_path('routes/cms-starter.php'),
            ], 'cms-starter-routes');

            $this->publishes([
                __DIR__ . '/../config/cms-starter.php' => config_path('cms-starter.php'),
            ], 'cms-starter-config');
        }
    }
}
