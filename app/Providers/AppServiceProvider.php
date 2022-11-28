<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
// use Illuminate\Routing\UrlGenerator; // 追加。

use Illuminate\Pagination\Paginator; // ページネーションビューのため。

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
        // \URL::forceScheme('https');
    }
}
