<?php

namespace Brigada\StatamicCmsStarter\Http\Controllers;

use Brigada\StatamicCmsStarter\Services\SitemapService;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class SitemapController extends Controller
{
    public function __construct(
        private readonly SitemapService $sitemap,
    ) {}

    public function show(): Response
    {
        $xml = view('cms-starter::sitemap', [
            'sitemap' => $this->sitemap->build(),
        ])->render();

        return response($xml, 200)
            ->header('Content-Type', 'application/xml; charset=utf-8');
    }
}
