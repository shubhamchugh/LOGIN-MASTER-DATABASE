<?php

namespace App\Providers;

use App\View\Composers\SidebarView;
use Illuminate\Support\ServiceProvider;

class VariableSharingServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // view()->composer('*',CmsSettingsView::class);
        view()->composer(['themes.loginVP.panels.sidebar',
            'themes.loginVP.content.home',
            'themes.loginVP.content.post',
            'themes.loginVP.content.staticpage.contact',
            'themes.loginVP.content.staticpage.terms',
            'themes.loginVP.content.staticpage.privacy',
            'themes.loginVP.content.staticpage.terms',
            'themes.loginVP.content.staticpage.about',
            'themes.loginVP.content.staticpage.dmca'], SidebarView::class);
        // view()->composer('*',SitemapView::class);
    }
}
