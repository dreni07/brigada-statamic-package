<?php

namespace Brigada\StatamicCmsStarter\Services;

use Illuminate\Support\Str;

class DataNormalizerService
{
    public function normalizeString(mixed $value, string $default = ''): string
    {
        if ($value === null || $value === '') {
            return $default;
        }

        return trim((string) $value);
    }

    public function normalizeBool(mixed $value, bool $default = false): bool
    {
        if ($value === null) {
            return $default;
        }

        return (bool) $value;
    }

    public function normalizeUrl(mixed $url): ?string
    {
        $url = $this->normalizeString($url);

        return $url !== '' ? $url : null;
    }

    public function renderMarkdown(?string $markdown): string
    {
        if ($markdown === null || trim($markdown) === '') {
            return '';
        }

        return Str::markdown(trim($markdown));
    }
}
