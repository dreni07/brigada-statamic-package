<?php

namespace Brigada\StatamicCmsStarter\Http\ViewComposers;

use Illuminate\View\View;

class SeoComposer
{
    public function compose(View $view): void
    {
        $siteName = config('cms-starter.site_name', config('app.name', 'Brigada CMS'));

        $view->with('siteName', $siteName);
    }
}
