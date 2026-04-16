<?php

namespace Brigada\StatamicCmsStarter\Http\ViewComposers;

use Brigada\StatamicCmsStarter\Contracts\PageRepositoryContract;
use Illuminate\View\View;

class NavComposer
{
    public function __construct(
        private readonly PageRepositoryContract $repository,
    ) {}

    public function compose(View $view): void
    {
        $navItems = $this->repository->allPages();
        $currentSlug = request()->segment(1) ?: 'home';

        $view->with('navItems', $navItems);
        $view->with('currentSlug', $currentSlug);
        $view->with('siteName', config('cms-starter.site_name', config('app.name', 'Brigada CMS')));
    }
}
