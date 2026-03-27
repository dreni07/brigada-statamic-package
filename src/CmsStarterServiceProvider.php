<?php 

    namespace Brigada\StatamicCmsStarter;

    use Illuminate\Support\ServiceProvider;
    use Brigada\StatamicCmsStarter\Commands\CmsInstallCommand;


    class CmsStarterServiceProvider extends ServiceProvider 
    {
        public function boot(): void 
        {
            if ($this->app->runningInConsole()) {
                $this->commands([
                    CmsInstallCommand::class
                ]);

                $this->publishes([
                    __DIR__ . '/../resources/blueprints' => resource_path('blueprints'),
                    __DIR__ . '/../resources/fieldsets' => resource_path('fieldsets'),
                    __DIR__ . '/../resources/content' => base_path('content')
                ],'cms-starter');

            }
        }
    }