<?php

namespace Brigada\StatamicCmsStarter\Commands;

use Illuminate\Console\Command;
use Statamic\Facades\User;
use Illuminate\Support\Facades\File;

class CmsInstallCommand extends Command
{
    protected $signature = 'cms:install
        {--skip-user : Skip admin user creation}
        {--skip-blueprints : Skip blueprint installation}
        {--skip-collections : Skip collection creation}
        {--skip-assets : Skip asset container setup}
        {--skip-content : Skip default content copy}
        {--skip-forms : Skip form installation}';

    protected $description = 'Install the Brigada Statamic CMS starter kit with blueprints, collections, assets, forms, and an admin user.';

    protected string $packageResources;

    public function handle(): int
    {
        $this->packageResources = __DIR__ . '/../../resources';

        $this->info('==========================================');
        $this->info('  Brigada Statamic CMS Starter Installer  ');
        $this->info('==========================================');
        $this->newLine();

        if (! $this->option('skip-user')) {
            $this->createAdminUser();
        }

        if (! $this->option('skip-blueprints')) {
            $this->installBlueprints();
        }

        if (! $this->option('skip-collections')) {
            $this->installCollections();
        }

        if (! $this->option('skip-assets')) {
            $this->installAssetContainers();
        }

        if (! $this->option('skip-forms')) {
            $this->installForms();
        }

        if (! $this->option('skip-content')) {
            $this->installContent();
        }

        $this->newLine();
        $this->info('CMS installation complete!');

        return self::SUCCESS;
    }

    protected function createAdminUser(): void
    {
        $this->info('--- Admin User Setup ---');

        $email = $this->ask('Admin email');
        $name = $this->ask('Admin username');
        $password = $this->secret('Admin password');

        if (User::findByEmail($email)) {
            $this->warn("User with email [{$email}] already exists. Skipping user creation.");
            return;
        }

        $user = User::make()
            ->email($email)
            ->data(['name' => $name])
            ->password($password);

        $user->makeSuper();
        $user->save();

        $this->info("Super admin [{$name}] created successfully.");
    }

    protected function installBlueprints(): void
    {
        $this->info('--- Installing Blueprints ---');

        $source = $this->packageResources . '/blueprints';

        if (! File::isDirectory($source)) {
            $this->warn('No blueprints directory found in package resources. Skipping.');
            return;
        }

        $directories = File::directories($source);

        foreach ($directories as $directory) {
            $collectionName = basename($directory);
            $destination = resource_path("blueprints/collections/{$collectionName}");

            if (File::isDirectory($destination)) {
                $this->warn("Blueprint directory [{$collectionName}] already exists. Skipping.");
                continue;
            }

            File::copyDirectory($directory, $destination);
            $this->info("Blueprint [{$collectionName}] installed.");
        }

        // Install fieldsets
        $fieldsetSource = $this->packageResources . '/fieldsets';

        if (File::isDirectory($fieldsetSource)) {
            $fieldsetDest = resource_path('fieldsets');
            File::ensureDirectoryExists($fieldsetDest);

            foreach (File::files($fieldsetSource) as $file) {
                $filename = $file->getFilename();
                $destFile = "{$fieldsetDest}/{$filename}";

                if (File::exists($destFile)) {
                    $this->warn("Fieldset [{$filename}] already exists. Skipping.");
                    continue;
                }

                File::copy($file->getPathname(), $destFile);
                $this->info("Fieldset [{$filename}] installed.");
            }
        }
    }

    protected function installCollections(): void
    {
        $this->info('--- Installing Collections ---');

        $source = $this->packageResources . '/collections';

        if (! File::isDirectory($source)) {
            $this->warn('No collections directory found in package resources. Skipping.');
            return;
        }

        $files = File::files($source);

        foreach ($files as $file) {
            $filename = $file->getFilename();
            $destination = base_path("content/collections/{$filename}");

            if (File::exists($destination)) {
                $this->warn("Collection [{$filename}] already exists. Skipping.");
                continue;
            }

            File::ensureDirectoryExists(dirname($destination));
            File::copy($file->getPathname(), $destination);
            $this->info("Collection [{$filename}] installed.");
        }
    }

    protected function installAssetContainers(): void
    {
        $this->info('--- Installing Asset Containers ---');

        $source = $this->packageResources . '/assets';

        if (! File::isDirectory($source)) {
            $this->warn('No assets directory found in package resources. Skipping.');
            return;
        }

        $files = File::files($source);

        foreach ($files as $file) {
            $filename = $file->getFilename();
            $destination = base_path("content/assets/{$filename}");

            if (File::exists($destination)) {
                $this->warn("Asset container [{$filename}] already exists. Skipping.");
                continue;
            }

            File::ensureDirectoryExists(dirname($destination));
            File::copy($file->getPathname(), $destination);
            $this->info("Asset container [{$filename}] installed.");
        }
    }

    protected function installForms(): void
    {
        $this->info('--- Installing Forms ---');

        $source = $this->packageResources . '/forms';

        if (! File::isDirectory($source)) {
            $this->warn('No forms directory found in package resources. Skipping.');
            return;
        }

        $files = File::files($source);

        foreach ($files as $file) {
            $filename = $file->getFilename();
            $destination = resource_path("forms/{$filename}");

            if (File::exists($destination)) {
                $this->warn("Form [{$filename}] already exists. Skipping.");
                continue;
            }

            File::ensureDirectoryExists(dirname($destination));
            File::copy($file->getPathname(), $destination);
            $this->info("Form [{$filename}] installed.");
        }
    }

    protected function installContent(): void
    {
        $this->info('--- Installing Default Content ---');

        $source = $this->packageResources . '/content';

        if (! File::isDirectory($source)) {
            $this->warn('No content directory found in package resources. Skipping.');
            return;
        }

        $directories = File::directories($source);

        foreach ($directories as $directory) {
            $name = basename($directory);
            $destination = base_path("content/collections/{$name}");

            File::ensureDirectoryExists($destination);

            $files = File::allFiles($directory);

            foreach ($files as $file) {
                $relativePath = $file->getRelativePathname();
                $destFile = "{$destination}/{$relativePath}";

                if (File::exists($destFile)) {
                    $this->warn("Content file [{$name}/{$relativePath}] already exists. Skipping.");
                    continue;
                }

                File::ensureDirectoryExists(dirname($destFile));
                File::copy($file->getPathname(), $destFile);
                $this->info("Content [{$name}/{$relativePath}] installed.");
            }
        }
    }
}
