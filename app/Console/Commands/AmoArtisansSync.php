<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Dotzero\LaravelAmoCrm\Facades\AmoCrm;
use App\Traits\Console\Commands\AmoArtisansEach;
use App\Jobs\AmoArtisansSync as AmoArtisansSyncJob;

class AmoArtisansSync extends Command
{
    use AmoArtisansEach;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'artisans:amo:sync
                            {--y|yes : Automatic yes to prompts; assume "yes" as answer to all prompts and run non-interactively.}
                            {--count=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync AmoCRM Artisans';

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
        static::each(function ($artisan) {
            AmoArtisansSyncJob::dispatch($artisan);
        });
    }
}
