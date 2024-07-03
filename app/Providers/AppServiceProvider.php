<?php

namespace App\Providers;

use App\Repository\CategoryRepository;
use App\Interfaces\ICategoryRepository;
use App\Interfaces\IPostRepository;
use App\Repository\PostRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app->bind(ICategoryRepository::class, CategoryRepository::class);
        $this->app->bind(IPostRepository::class, PostRepository::class);
        
    }
}
