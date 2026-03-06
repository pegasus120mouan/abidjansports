<?php

namespace App\Providers;

use App\Services\ApiService;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(ApiService::class, function ($app) {
            return new ApiService();
        });
    }

    public function boot(): void
    {
        View::composer(['layouts.app', 'home'], function ($view) {
            $apiService = app(ApiService::class);
            
            $view->with('menuCategories', $apiService->getCategories());
            $view->with('flashInfos', $apiService->getFlashInformations());
        });
    }
}
