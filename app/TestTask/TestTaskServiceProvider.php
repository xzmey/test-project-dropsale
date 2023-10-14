<?php

namespace App\TestTask;

use Illuminate\Support\ServiceProvider;

class TestTaskServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(\App\TestTask\Http\Controllers\ImportController::class, function ($app) {
            return new \App\TestTask\Http\Controllers\ImportController(
                $app->make('log')->channel('test-task'),
            );
        });
    }
}
