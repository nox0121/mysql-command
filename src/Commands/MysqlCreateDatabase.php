<?php

namespace Nox0121\MysqlCommand\Commands;

use Illuminate\Console\Command;

use PDO;

class MysqlCreateDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mysql:create-database';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Mysql database';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $host = env('DB_HOST');
        $database = env('DB_DATABASE');
        $username = env('DB_USERNAME');
        $password = env('DB_PASSWORD');

        try {
            $conn = new PDO("mysql:host=$host", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = 'CREATE DATABASE ' . $database . ' CHARACTER SET utf8 COLLATE utf8_general_ci';
            $conn->exec($sql);
            $this->info('Mysql database create completed!');
        } catch (PDOException $e) {
            $this->info($e->getMessage());
        }
    }
}
