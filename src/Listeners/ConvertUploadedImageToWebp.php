<?php

namespace Brigada\StatamicCmsStarter\Listeners;

use Illuminate\Support\Facades\Log;
use Intervention\Image\Drivers\Gd\Driver as GdDriver;
use Intervention\Image\ImageManager;
use Statamic\Events\AssetUploaded;

class ConvertUploadedImageToWebp
{
    private const CONVERTIBLE_EXTENSIONS = ['jpg', 'jpeg', 'png', 'bmp', 'gif'];

    private const SKIP_CONTAINERS = ['icons'];

    private const MAX_EXECUTION_SECONDS = 120;

    private const QUALITY = 80;

    public function handle(AssetUploaded $event): void
    {
        $asset = $event->asset;
        $extension = strtolower($asset->extension());

        if (in_array($asset->containerHandle(), self::SKIP_CONTAINERS)) {
            return;
        }

        if (! in_array($extension, self::CONVERTIBLE_EXTENSIONS)) {
            return;
        }

        $previousLimit = (int) ini_get('max_execution_time');
        set_time_limit(self::MAX_EXECUTION_SECONDS);

        $disk = $asset->disk();
        $originalPath = $asset->path();
        $webpPath = preg_replace('/\.[^.]+$/', '.webp', $originalPath);

        try {
            $imageData = $disk->get($originalPath);

            $manager = new ImageManager(new GdDriver);
            $webpData = $manager->read($imageData)->toWebp(quality: self::QUALITY)->toString();

            $disk->put($webpPath, $webpData);

            if (! $disk->exists($webpPath)) {
                Log::error('WebP conversion failed: converted file was not written to disk', [
                    'asset' => $originalPath,
                    'webp' => $webpPath,
                ]);

                return;
            }

            $disk->delete($originalPath);

            $asset->path($webpPath);
            $asset->save();

            Log::info('WebP conversion successful', [
                'asset' => $originalPath,
                'webp' => $webpPath,
            ]);

        } catch (\Throwable $e) {
            if ($disk->exists($webpPath) && $disk->exists($originalPath)) {
                $disk->delete($webpPath);
            }

            Log::error('WebP conversion failed', [
                'asset' => $originalPath,
                'error' => $e->getMessage(),
            ]);
        } finally {
            set_time_limit($previousLimit);
        }
    }
}
