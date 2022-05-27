<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class Migration extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate:generator';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Generator migration";

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $db_name = config('database.connections.mysql.database');
        $db_name = "<fg=yellow>\"</><fg=#ff0000>$db_name</><fg=yellow>\"</>";
        $this->line("<fg=magenta>this command will migrate folder path and sub folder with data seed in {$db_name} database </>");
        Artisan::call('migrate:fresh');
        $this->line("<fg=magenta>try run command 'php artisan migrate:fresh --seed' to migrate static Models with seed in {$db_name} database</>");
        Artisan::call('migrate --path=database/migrations/Generated');
        $this->line("<fg=magenta>try run command 'php artisan migrate --path=database/migrations/Generated to migrate Generated Models in {$db_name} database</>");
        Artisan::call('migrate --seed');
        $this->line("<fg=green>finish! migration all models with generated to {$db_name} database </>");
    }
}
