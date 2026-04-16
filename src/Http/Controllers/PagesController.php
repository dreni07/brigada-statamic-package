<?php

namespace Brigada\StatamicCmsStarter\Http\Controllers;

use Brigada\StatamicCmsStarter\Services\PageBuilderService;
use Illuminate\Routing\Controller;
use Illuminate\View\View;

class PagesController extends Controller
{
    public function __construct(
        private readonly PageBuilderService $pageBuilder,
    ) {}

    public function show(string $slug = 'home'): View
    {
        $page = $this->pageBuilder->build($slug);

        if ($page === null) {
            abort(404);
        }

        return view('cms-starter::page', [
            'page' => $page->toViewModel(),
        ]);
    }
}
