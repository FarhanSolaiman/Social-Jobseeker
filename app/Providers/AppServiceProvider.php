<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Schema;

class AppServiceProvider extends ServiceProvider
{

    public function boot()
    {
        Schema::defaultStringLength(191);
    }

    public function register()
    {
        $this -> app -> bind('path.public', function()
        {
        return base_path('public_html');
        });
    }
}
