<?php

namespace Brigada\StatamicCmsStarter\Services;

use Statamic\Facades\Asset;

class AssetResolverService
{
    public function resolve(mixed $assetReference): ?string
    {
        if ($assetReference === null || $assetReference === '' || $assetReference === []) {
            return null;
        }

        if (is_array($assetReference)) {
            $assetReference = $assetReference[0] ?? null;
        }

        if ($assetReference === null) {
            return null;
        }

        $asset = Asset::find($assetReference);

        if ($asset) {
            return $asset->url();
        }

        if (is_string($assetReference) && str_starts_with($assetReference, '/')) {
            return $assetReference;
        }

        return null;
    }
}
