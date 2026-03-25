<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        // Dùng Bootstrap 5 cho pagination
        Paginator::useBootstrapFive();

        // Đặt locale tiếng Việt cho Carbon
        App::setLocale('vi');
    }
}
