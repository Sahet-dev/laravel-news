<?php

namespace App\Providers;

use App\Repositories\NewsArticleRepository;
use App\Repositories\NewsCategoryRepository;
use App\Services\NewsArticleService;
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
        $this->app->singleton(NewsArticleService::class, function ($app) {
            return new NewsArticleService(
                $app->make(NewsArticleRepository::class),
                $app->make(NewsCategoryRepository::class)
            );
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
