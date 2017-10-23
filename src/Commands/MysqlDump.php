<?php

namespace Nox0121\MysqlCommand\Commands;

use Illuminate\Console\Command;

class MysqlDump extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mysql:dump-database
                            {filename? : Mysql backup filename}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Dump your Mysql database to a file';

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

        \Log::debug(__METHOD__, [
            '$path' => config('mysql-command.settings.dump-restore-path'),
        ]);

        $backupPath = config('mysql-command.settings.dump-restore-path') . '/database/';
        $backupPath = str_replace('//', '/', $backupPath);

        $filename = $database.'_'.empty(trim($this->argument('filename'))) ? $database.'_'.date('Y-m-d-His') : trim($this->argument('filename'));

        $dumpCommand = "mysqldump -e -f -h $host -u $username -p$password $database > $backupPath$filename.sql";

        exec($dumpCommand);

        $this->info('Mysql backup completed!');
    }
}
