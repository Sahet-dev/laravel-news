<?php

namespace App\Providers;

use App\Repositories\NewsArticleRepository;
use App\Repositories\NewsCategoryRepository;
use App\Services\NewsArticleService;
use App\Services\NewsCategoryService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(NewsCategoryRepository::class, fn() => new NewsCategoryRepository());
        $this->app->bind(NewsArticleRepository::class, fn() => new NewsArticleRepository());
        $this->app->bind(NewsCategoryService::class, fn($app) => new NewsCategoryService($app->make(NewsCategoryRepository::class)));
        $this->app->bind(NewsArticleService::class, fn($app) => new NewsArticleService($app->make(NewsArticleRepository::class)));
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
