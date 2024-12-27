<?php

namespace debugged\ApiLogger;

use Illuminate\Support\ServiceProvider;
use debugged\ApiLogger\Http\Middleware\APILog;

class ApiLoggerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__.'/database/migrations' => database_path('migrations')
        ], 'migrations');

        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
    }

    public function register()
    {
        $this->app['router']->aliasMiddleware('api-logger', APILog::class);
    }
}
