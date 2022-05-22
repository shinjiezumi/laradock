<?php

namespace App\Providers;

use App\DDD\Todo\Application\ITodoService;
use App\DDD\Todo\Application\TodoService;
use App\DDD\Todo\Domain\Model\ITodoRepository;
use App\DDD\Todo\Infrastructure\MySQL\TodoRepository;
use Illuminate\Support\ServiceProvider;

class TodoServiceProvider extends ServiceProvider
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
        $this->app->bind(
            ITodoService::class,
            TodoService::class
        );
        $this->app->bind(
            ITodoRepository::class,
            TodoRepository::class
        );
    }
}
