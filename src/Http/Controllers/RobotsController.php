<?php

namespace Brigada\StatamicCmsStarter\Http\Controllers;

use Brigada\StatamicCmsStarter\Services\RobotsService;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class RobotsController extends Controller
{
    public function __construct(
        private readonly RobotsService $robots,
    ) {}

    public function show(): Response
    {
        $body = view('cms-starter::robots', [
            'robots' => $this->robots->build(),
        ])->render();

        return response($body, 200)
            ->header('Content-Type', 'text/plain; charset=utf-8');
    }
}
