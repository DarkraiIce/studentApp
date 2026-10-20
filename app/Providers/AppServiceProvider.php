<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Base44 sandbox preview only (BASE44_PREVIEW_MODE is unset everywhere else, so
        // behaviour outside the sandbox is unchanged). The preview reaches the app through
        // a public HTTPS proxy while the container itself is served over plain HTTP, so
        // generated URLs (asset(), url(), route(), redirects) must be pinned to the public
        // origin or they would point at an unreachable http:// address.
        if (env('BASE44_PREVIEW_MODE') === '1' && config('app.url')) {
            URL::forceRootUrl(config('app.url'));
            URL::forceScheme('https');
        }
    }
}
