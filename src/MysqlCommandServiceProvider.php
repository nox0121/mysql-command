<?php

namespace Nox0121\MysqlCommand;

use Illuminate\Support\ServiceProvider;
use Nox0121\MysqlCommand\Commands\MysqlCreateDatabase;
use Nox0121\MysqlCommand\Commands\MysqlDump;
use Nox0121\MysqlCommand\Commands\MysqlRestore;

class MysqlCommandServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/mysql-command.php' => config_path('mysql-command.php'),
        ], 'config');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/mysql-command.php', 'mysql-command');

        $this->app->bind('command.mysql:create-database', MysqlCreateDatabase::class);
        $this->app->bind('command.mysql:dump-database', MysqlDump::class);
        $this->app->bind('command.mysql:restore-database', MysqlRestore::class);

        $this->commands([
            'command.mysql:create-database',
            'command.mysql:dump-database',
            'command.mysql:restore-database',
        ]);

        $this->app->singleton(ConsoleOutput::class);
    }
}
