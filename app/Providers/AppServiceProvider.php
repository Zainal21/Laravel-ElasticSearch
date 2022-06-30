<?php

namespace App\Providers;
use App\Interface\SearchRepository;
use App\Repository\ArticlesRepository;
use App\Repository\EloquentSearchRepository;
use App\Repository\ElasticsearchRepository;
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
        // $this->app->bind(SearchRepository::class, EloquentSearchRepository::class);
        $this->app->bind(ArticlesRepository::class, function ($app) {
            if (! config('services.search.enabled')) {
                return new Articles\EloquentRepository();
            }

            return new Articles\ElasticsearchRepository(
                $app->make(Client::class)
            );
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
